<footer class="bg-navy-950 border-t border-navy-800 py-12 lg:py-16">
    <div class="container">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-8">
            {{-- Brand Column --}}
            <div class="lg:col-span-1">
                <img src="{{ asset('images/ascend-logo.webp') }}" alt="Ascend AI" class="h-8 w-auto mb-4">
                <p class="text-gray-400 text-sm">
                    Building the companies that make traditional business obsolete.
                </p>
            </div>

            {{-- Navigation Column --}}
            <div>
                <h3 class="text-white font-semibold mb-4">Navigation</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-white transition-colors text-sm">Home</a></li>
                    <li><a href="{{ route('about') }}" class="text-gray-400 hover:text-white transition-colors text-sm">About</a></li>
                    <li><a href="{{ route('what-we-do') }}" class="text-gray-400 hover:text-white transition-colors text-sm">What We Do</a></li>
                    <li><a href="{{ route('portfolio') }}" class="text-gray-400 hover:text-white transition-colors text-sm">Portfolio</a></li>
                    <li><a href="{{ route('work-with-us') }}" class="text-gray-400 hover:text-white transition-colors text-sm">Work With Us</a></li>
                    <li><a href="{{ route('contact') }}" class="text-gray-400 hover:text-white transition-colors text-sm">Contact</a></li>
                </ul>
            </div>

            {{-- Legal Column --}}
            <div>
                <h3 class="text-white font-semibold mb-4">Legal</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('privacy-policy') }}" class="text-gray-400 hover:text-white transition-colors text-sm">Privacy Policy</a></li>
                    <li><a href="{{ route('terms-and-conditions') }}" class="text-gray-400 hover:text-white transition-colors text-sm">Terms & Conditions</a></li>
                </ul>
            </div>

            {{-- Contact Column --}}
            <div>
                <h3 class="text-white font-semibold mb-4">Contact</h3>
                <a href="mailto:contact@ascend-ai.co.uk" class="text-gray-400 hover:text-white transition-colors text-sm">
                    contact@ascend-ai.co.uk
                </a>
            </div>
        </div>

        {{-- Bottom Bar --}}
        <div class="border-t border-navy-800 pt-8 text-center">
            <p class="text-gray-500 text-sm">
                &copy; {{ date('Y') }} Ascend AI. All rights reserved.
            </p>
        </div>
    </div>
</footer>
