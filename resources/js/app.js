import '../css/app.css';
import './bootstrap';

// Initialize Alpine.js
import Alpine from 'alpinejs';

window.Alpine = Alpine;

// Newsletter form component
Alpine.data('newsletterForm', () => ({
    email: '',
    website: '',
    loading: false,
    message: '',
    success: false,

    async subscribe() {
        this.loading = true;
        this.message = '';

        try {
            const response = await fetch('/newsletter/subscribe', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ email: this.email, website: this.website })
            });

            const data = await response.json().catch(() => ({}));

            if (response.ok && data.success) {
                this.success = true;
                this.message = data.message || 'Thank you for subscribing!';
                this.email = '';
            } else {
                // Show our own "already subscribed" and validation messages, never raw server errors.
                this.success = false;
                this.message = [409, 422].includes(response.status) && data.message
                    ? data.message
                    : 'Something went wrong. Please try again.';
            }
        } catch (error) {
            this.success = false;
            this.message = 'Something went wrong. Please try again.';
        } finally {
            this.loading = false;
        }
    }
}));

// "Automation in action" examples: step through a short story while on screen, pause off screen,
// loop after a hold, and show the final frame straight away when the visitor prefers reduced motion.
Alpine.data('vignette', (steps = 5, stepMs = 1100, holdMs = 4200) => ({
    step: 0,
    timer: null,
    visible: false,

    init() {
        if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
            this.step = steps;
            return;
        }

        new IntersectionObserver(([entry]) => {
            this.visible = entry.isIntersecting;
            this.visible ? this.schedule(400) : this.halt();
        }, { threshold: 0.3 }).observe(this.$el);
    },

    // A vignette on a carousel slide that is not showing waits at the start of its story.
    offStage() {
        return this.$el.closest('[aria-hidden="true"]') !== null;
    },

    schedule(delay) {
        if (this.timer) return;

        this.timer = setTimeout(() => {
            this.timer = null;
            if (!this.visible) return;

            if (this.offStage()) {
                this.step = 0;
                this.schedule(stepMs);
                return;
            }

            this.step = this.step >= steps ? 0 : this.step + 1;
            this.schedule(this.step >= steps ? holdMs : (this.step === 0 ? 700 : stepMs));
        }, delay);
    },

    halt() {
        clearTimeout(this.timer);
        this.timer = null;
    },

    at(n) {
        return this.step >= n;
    },
}));

// Website assistant chat. The conversation is held in the visitor's session on the server,
// so nothing is stored in the browser; opening the panel fetches it.
const UNAVAILABLE = "Sorry, I can't answer right now. You can use the contact form or email contact@ascend-ai.co.uk.";

Alpine.data('assistantChat', (urls) => ({
    open: false,
    loaded: false,
    sending: false,
    input: '',
    messages: [],

    headers() {
        return {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        };
    },

    async toggle() {
        this.open = !this.open;

        if (this.open) {
            if (!this.loaded) {
                await this.load();
            }
            this.$nextTick(() => {
                this.$refs.input?.focus();
                this.scroll();
            });
        }
    },

    close() {
        this.open = false;
        this.$nextTick(() => this.$refs.launcher?.focus());
    },

    async load() {
        try {
            const response = await fetch(urls.history, { headers: this.headers() });
            const data = await response.json();
            this.messages = data.messages || [];
        } catch (error) {
            this.messages = [];
        }
        this.loaded = true;
    },

    async send() {
        const text = this.input.trim();

        if (text === '' || this.sending) {
            return;
        }

        this.messages.push({ role: 'user', content: text });
        this.input = '';
        this.sending = true;
        this.scroll();

        let reply;

        try {
            const response = await fetch(urls.message, {
                method: 'POST',
                headers: this.headers(),
                body: JSON.stringify({ message: text }),
            });
            const data = await response.json().catch(() => ({}));

            // Only our own replies and validation messages are shown; never raw server errors.
            if (response.ok && data.reply) {
                reply = data.reply;
            } else if (response.status === 422 && data.message) {
                reply = data.message;
            } else if (response.status === 429) {
                reply = 'You are sending messages a little fast. Please wait a moment and try again.';
            } else {
                reply = UNAVAILABLE;
            }
        } catch (error) {
            reply = UNAVAILABLE;
        }

        this.messages.push({ role: 'assistant', content: reply });
        this.sending = false;
        this.scroll();
        this.$nextTick(() => this.$refs.input?.focus());
    },

    async reset() {
        try {
            await fetch(urls.reset, { method: 'POST', headers: this.headers() });
        } catch (error) {
            // Nothing to do: the visible conversation is cleared either way.
        }
        this.messages = [];
        this.$refs.input?.focus();
    },

    scroll() {
        this.$nextTick(() => {
            const log = this.$refs.log;
            if (log) {
                log.scrollTop = log.scrollHeight;
            }
        });
    },
}));

Alpine.start();
