<x-layout.app :title="$title" :description="$description">
    {{-- Hero Section --}}
    <x-sections.hero
        :title="'Get In Touch'"
        :subtitle="'Interested in Ascend AI, our portfolio, or partnership opportunities? We\'d like to hear from you.'"
        :fullHeight="false"
    />

    {{-- Contact Section --}}
    <section class="bg-navy-900 py-20 lg:py-32">
        <div class="container">
            <div class="max-w-4xl mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-5 gap-12">
                    {{-- Contact Information --}}
                    <div class="lg:col-span-2">
                        <h2 class="text-2xl font-bold text-white mb-8">Contact Information</h2>
                        <div class="space-y-6">
                            <a href="mailto:contact@ascend-ai.co.uk" class="flex items-center gap-4 text-gray-300 hover:text-accent-400 transition-colors group">
                                <div class="w-12 h-12 flex items-center justify-center bg-navy-800 rounded-lg group-hover:bg-accent-500/20 transition-colors">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Email</p>
                                    <p class="font-medium">contact@ascend-ai.co.uk</p>
                                </div>
                            </a>
                        </div>

                        <div class="mt-12 card-glass p-6">
                            <h3 class="text-lg font-semibold text-white mb-2">Response Expectation</h3>
                            <p class="text-gray-400">We review all enquiries personally and aim to respond within 48 hours.</p>
                        </div>
                    </div>

                    {{-- Contact Form --}}
                    <div class="lg:col-span-3">
                        <form
                            x-data="contactForm()"
                            @submit.prevent="submit"
                            class="space-y-6"
                        >
                            @csrf
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-300 mb-2">Your Name *</label>
                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    x-model="form.name"
                                    required
                                    class="w-full bg-navy-800 border border-navy-700 rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:border-accent-500 focus:ring-1 focus:ring-accent-500 transition-colors"
                                    placeholder="John Smith"
                                >
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Email Address *</label>
                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    x-model="form.email"
                                    required
                                    class="w-full bg-navy-800 border border-navy-700 rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:border-accent-500 focus:ring-1 focus:ring-accent-500 transition-colors"
                                    placeholder="john@company.com"
                                >
                            </div>

                            <div>
                                <label for="organisation" class="block text-sm font-medium text-gray-300 mb-2">Organisation</label>
                                <input
                                    type="text"
                                    id="organisation"
                                    name="organisation"
                                    x-model="form.organisation"
                                    class="w-full bg-navy-800 border border-navy-700 rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:border-accent-500 focus:ring-1 focus:ring-accent-500 transition-colors"
                                    placeholder="Company name (optional)"
                                >
                            </div>

                            <div>
                                <label for="enquiry_type" class="block text-sm font-medium text-gray-300 mb-2">Nature of Enquiry *</label>
                                <select
                                    id="enquiry_type"
                                    name="enquiry_type"
                                    x-model="form.enquiry_type"
                                    required
                                    class="w-full bg-navy-800 border border-navy-700 rounded-lg px-4 py-3 text-white focus:border-accent-500 focus:ring-1 focus:ring-accent-500 transition-colors"
                                >
                                    <option value="">Select an option</option>
                                    <option value="investment">Investment</option>
                                    <option value="partnership">Partnership</option>
                                    <option value="advisory">Advisory</option>
                                    <option value="general">General Enquiry</option>
                                </select>
                            </div>

                            <div>
                                <label for="message" class="block text-sm font-medium text-gray-300 mb-2">Message *</label>
                                <textarea
                                    id="message"
                                    name="message"
                                    x-model="form.message"
                                    required
                                    minlength="50"
                                    maxlength="5000"
                                    rows="5"
                                    class="w-full bg-navy-800 border border-navy-700 rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:border-accent-500 focus:ring-1 focus:ring-accent-500 transition-colors resize-none"
                                    placeholder="Tell us about your interest in Ascend AI..."
                                ></textarea>
                                <p class="text-xs text-gray-500 mt-2">Minimum 50 characters</p>
                            </div>

                            {{-- Success/Error Messages --}}
                            <div x-show="form.message" x-cloak
                                 :class="form.success ? 'bg-green-500/10 border-green-500/30 text-green-400' : 'bg-red-500/10 border-red-500/30 text-red-400'"
                                 class="p-4 rounded-lg border"
                                 x-text="form.message">
                            </div>

                            <button
                                type="submit"
                                :disabled="form.loading"
                                class="w-full btn btn-primary py-4 text-lg flex items-center justify-center gap-3"
                            >
                                <span x-show="!form.loading">Send Message</span>
                                <span x-show="form.loading" x-cloak class="animate-spin">⟳</span>
                                <span x-show="form.loading" x-cloak>Sending...</span>
                            </button>

                            <p class="text-xs text-gray-500 text-center">
                                Your information will be handled in accordance with our
                                <a href="{{ route('privacy-policy') }}" class="text-accent-400 hover:text-accent-300">Privacy Policy</a>.
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
    <script>
        function contactForm() {
            return {
                form: {
                    name: '',
                    email: '',
                    organisation: '',
                    enquiry_type: '',
                    message: '',
                    loading: false,
                    success: false,
                    message: ''
                },

                async submit() {
                    this.form.loading = true;
                    this.form.message = '';

                    try {
                        const response = await this.$fetch('{{ route('contact.submit') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify(this.form)
                        });

                        const data = await response.json();

                        if (data.success) {
                            this.form.success = true;
                            this.form.message = data.message || 'Thank you for your enquiry. We will respond within 48 hours.';
                            // Reset form
                            this.form.name = '';
                            this.form.email = '';
                            this.form.organisation = '';
                            this.form.enquiry_type = '';
                            this.form.message = '';
                        } else {
                            this.form.success = false;
                            this.form.message = data.message || 'Failed to send message. Please try again.';
                        }
                    } catch (error) {
                        this.form.success = false;
                        this.form.message = 'Failed to send message. Please try again or email us directly.';
                    } finally {
                        this.form.loading = false;
                    }
                }
            };
        }

        // Add $fetch method for POST requests
        document.addEventListener('alpine:init', () => {
            Alpine.magic('fetch', (el) => {
                return async (url, options = {}) => {
                    const response = await fetch(url, options);
                    return response;
                };
            });
        });
    </script>
    @endpush
</x-layout.app>
