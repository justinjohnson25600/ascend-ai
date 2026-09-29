@php($company = config('ascend.company'))
<x-layout.app :title="$title" :description="$description">
    <x-sections.hero
        title="Book your free automation audit"
        subtitle="Tell us a little about your business. We will reply within one working day to arrange a 30 minute call. If you just have a question, the same form works."
        :fullHeight="false"
    />

    <section class="bg-navy-900 py-20 lg:py-32 relative overflow-hidden" style="background-image: linear-gradient(to right, rgba(15, 23, 42, 0.4) 0%, rgba(15, 23, 42, 0.5) 40%, rgba(15, 23, 42, 0.8) 70%, rgba(15, 23, 42, 1) 100%), url('{{ asset('images/digi-city.webp') }}'); background-size: cover; background-position: left center; background-repeat: no-repeat;">
        <div class="container">
            <div class="max-w-4xl mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-5 gap-12">
                    {{-- Contact information --}}
                    <div class="lg:col-span-2">
                        <h2 class="text-2xl font-bold text-white mb-8">Contact</h2>
                        <a href="mailto:{{ $company['email'] }}" class="flex items-center gap-4 text-gray-300 hover:text-accent-400 transition-colors group">
                            <div class="w-12 h-12 flex items-center justify-center bg-navy-800 rounded-lg group-hover:bg-accent-500/20 transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Email</p>
                                <p class="font-medium">{{ $company['email'] }}</p>
                            </div>
                        </a>

                        <div class="mt-12 card-glass p-6">
                            <h3 class="text-lg font-semibold text-white mb-2">What happens next</h3>
                            <p class="text-gray-400">We read every enquiry ourselves and reply within one working day. For an audit, the reply includes a link to pick a time.</p>
                        </div>
                    </div>

                    {{-- Form --}}
                    <div class="lg:col-span-3">
                        <form x-data="contactForm()" @submit.prevent="submit" class="space-y-6" novalidate>
                            @csrf
                            <x-forms.honeypot model="form.website" />

                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-300 mb-2">Your name</label>
                                <input type="text" id="name" name="name" x-model="form.name" required autocomplete="name"
                                    class="w-full bg-navy-800 border border-navy-700 rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:border-accent-500 focus:ring-1 focus:ring-accent-500 transition-colors">
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Email address</label>
                                <input type="email" id="email" name="email" x-model="form.email" required autocomplete="email"
                                    class="w-full bg-navy-800 border border-navy-700 rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:border-accent-500 focus:ring-1 focus:ring-accent-500 transition-colors">
                            </div>

                            <div>
                                <label for="organisation" class="block text-sm font-medium text-gray-300 mb-2">Business name <span class="text-gray-500">(optional)</span></label>
                                <input type="text" id="organisation" name="organisation" x-model="form.organisation" autocomplete="organization"
                                    class="w-full bg-navy-800 border border-navy-700 rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:border-accent-500 focus:ring-1 focus:ring-accent-500 transition-colors">
                            </div>

                            <div>
                                <label for="enquiry_type" class="block text-sm font-medium text-gray-300 mb-2">What can we help with?</label>
                                <select id="enquiry_type" name="enquiry_type" x-model="form.enquiry_type" required
                                    class="w-full bg-navy-800 border border-navy-700 rounded-lg px-4 py-3 text-white focus:border-accent-500 focus:ring-1 focus:ring-accent-500 transition-colors">
                                    @foreach ($enquiryTypes as $type)
                                        <option value="{{ $type->value }}" @selected($type->value === $selectedType)>{{ $type->label() }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="message" class="block text-sm font-medium text-gray-300 mb-2">Tell us about your business</label>
                                <textarea id="message" name="message" x-model="form.message" required minlength="20" maxlength="5000" rows="5"
                                    class="w-full bg-navy-800 border border-navy-700 rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:border-accent-500 focus:ring-1 focus:ring-accent-500 transition-colors resize-none"
                                    placeholder="What does your business do, roughly how many people, and what eats the most time?"></textarea>
                                <p class="text-xs mt-2 text-gray-500" x-show="form.message.length > 0 && form.message.length < 20" x-cloak>
                                    A little more detail helps. <span x-text="20 - form.message.length"></span> more characters.
                                </p>
                            </div>

                            <div x-show="statusMessage" x-cloak
                                :class="success ? 'bg-green-500/10 border-green-500/30 text-green-400' : 'bg-red-500/10 border-red-500/30 text-red-400'"
                                class="p-4 rounded-lg border" x-text="statusMessage" role="status"></div>

                            <button type="submit" :disabled="loading" class="w-full btn btn-primary py-4 text-lg flex items-center justify-center gap-3">
                                <span x-show="!loading">Send</span>
                                <span x-show="loading" x-cloak class="animate-spin">⟳</span>
                                <span x-show="loading" x-cloak>Sending...</span>
                            </button>

                            <p class="text-xs text-gray-500 text-center">
                                Your information is handled in accordance with our
                                <a href="{{ route('privacy-policy') }}" class="text-accent-400 hover:text-accent-300">Privacy Policy</a>. We will not add you to any list.
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
            const blank = () => ({
                name: '',
                email: '',
                organisation: '',
                enquiry_type: @json($selectedType),
                message: '',
                website: ''
            });

            return {
                form: blank(),
                loading: false,
                success: false,
                statusMessage: '',

                async submit() {
                    this.loading = true;
                    this.statusMessage = '';

                    try {
                        const response = await fetch(@json(route('contact.submit')), {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify(this.form)
                        });

                        const data = await response.json();

                        if (response.ok && data.success) {
                            this.success = true;
                            this.statusMessage = data.message;
                            this.form = blank();
                        } else {
                            this.success = false;
                            this.statusMessage = data.message || 'That did not send. Please try again or email {{ $company['email'] }}.';
                        }
                    } catch (error) {
                        this.success = false;
                        this.statusMessage = 'That did not send. Please try again or email {{ $company['email'] }}.';
                    } finally {
                        this.loading = false;
                    }
                }
            };
        }
    </script>
    @endpush
</x-layout.app>
