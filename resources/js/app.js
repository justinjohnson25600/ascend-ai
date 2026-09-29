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

            const data = await response.json();

            if (data.success) {
                this.success = true;
                this.message = data.message || 'Thank you for subscribing!';
                this.email = '';
            } else {
                this.success = false;
                this.message = data.message || 'Something went wrong. Please try again.';
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

Alpine.start();
