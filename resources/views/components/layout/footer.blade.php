@php($company = config('ascend.company'))
<footer class="bg-navy-950 border-t border-navy-800 py-12 lg:py-16">
    <div class="container">
        {{-- Newsletter Signup --}}
        <div class="card-glass p-8 mb-12 max-w-2xl mx-auto text-center">
            <h3 class="text-xl font-semibold text-white mb-2">Automation ideas for small businesses</h3>
            <p class="text-gray-400 text-sm mb-6">One email a month. Real examples of work being automated in businesses like yours, and what it took. No sales sequence.</p>

            <form
                x-data="newsletterForm()"
                @submit.prevent="subscribe"
                class="flex flex-col sm:flex-row gap-3"
            >
                <x-forms.honeypot model="website" />
                <label for="newsletter-email" class="sr-only">Your email address</label>
                <input
                    type="email"
                    id="newsletter-email"
                    x-model="email"
                    required
                    placeholder="Your email address"
                    class="flex-1 px-4 py-3 bg-navy-900/50 border border-navy-700 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-accent-500 focus:border-transparent transition-colors"
                >
                <button
                    type="submit"
                    :disabled="loading"
                    class="btn btn-primary px-6 py-3 whitespace-nowrap"
                    x-text="loading ? 'Adding you...' : 'Subscribe'"
                ></button>
            </form>

            <p x-show="message" x-cloak :class="success ? 'text-green-400' : 'text-red-400'" class="text-sm mt-3" x-text="message"></p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-8">
            {{-- Brand Column --}}
            <div class="lg:col-span-1">
                <img src="{{ asset('images/ascend-logo.webp') }}" alt="Ascend AI" class="h-8 w-auto mb-4">
                <p class="text-gray-400 text-sm">
                    AI automation built around the way your business already works.
                </p>
            </div>

            {{-- Navigation Column --}}
            <div>
                <h3 class="text-white font-semibold mb-4">Site</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-white transition-colors text-sm">Home</a></li>
                    <li><a href="{{ route('what-is-business-automation') }}" class="text-gray-400 hover:text-white transition-colors text-sm">What is Business Automation?</a></li>
                    <li><a href="{{ route('solutions') }}" class="text-gray-400 hover:text-white transition-colors text-sm">Solutions</a></li>
                    <li><a href="{{ route('how-it-works') }}" class="text-gray-400 hover:text-white transition-colors text-sm">How It Works</a></li>
                    <li><a href="{{ route('automation-ideas') }}" class="text-gray-400 hover:text-white transition-colors text-sm">Automation ideas</a></li>
                    <li><a href="{{ route('about') }}" class="text-gray-400 hover:text-white transition-colors text-sm">About</a></li>
                    <li><a href="{{ route('contact') }}" class="text-gray-400 hover:text-white transition-colors text-sm">Contact</a></li>
                </ul>
            </div>

            {{-- Legal Column --}}
            <div>
                <h3 class="text-white font-semibold mb-4">Legal</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('privacy-policy') }}" class="text-gray-400 hover:text-white transition-colors text-sm">Privacy Policy</a></li>
                    <li><a href="{{ route('your-data') }}" class="text-gray-400 hover:text-white transition-colors text-sm">Your data</a></li>
                    <li><a href="{{ route('terms-and-conditions') }}" class="text-gray-400 hover:text-white transition-colors text-sm">Terms and Conditions</a></li>
                </ul>
            </div>

            {{-- Contact Column --}}
            <div>
                <h3 class="text-white font-semibold mb-4">Contact</h3>
                <a href="mailto:{{ $company['email'] }}" class="text-gray-400 hover:text-white transition-colors text-sm block mb-4">
                    {{ $company['email'] }}
                </a>

                <h3 class="text-white font-semibold mb-3">Follow us</h3>
                <x-ui.social-links gap="gap-3" />
            </div>
        </div>

        {{-- Bottom Bar --}}
        <div class="border-t border-navy-800 pt-8 text-center">
            <p class="text-gray-500 text-sm">
                &copy; {{ date('Y') }} {{ $company['name'] }}. {{ $company['descriptor'] }}.
            </p>
        </div>
    </div>
</footer>
