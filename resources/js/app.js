import '../css/app.css';
import './bootstrap';

// Initialize Alpine.js
import Alpine from 'alpinejs';

window.Alpine = Alpine;

// Newsletter form component
Alpine.data('newsletterForm', () => ({
    email: '',
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
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ email: this.email })
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

Alpine.start();
