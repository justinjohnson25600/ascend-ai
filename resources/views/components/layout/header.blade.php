<header x-data="{ mobileMenuOpen: false }" class="fixed top-0 left-0 right-0 z-50 bg-navy-950/80 backdrop-blur-md border-b border-white/10">
    <div class="container h-16 md:h-20 flex items-center justify-between">
        {{-- Logo --}}
        <a href="{{ route('home') }}" class="flex items-center">
            <img src="{{ asset('images/ascend-logo.webp') }}" alt="Ascend AI" class="h-6 md:h-8 w-auto">
        </a>

        {{-- Desktop Navigation --}}
        <nav class="hidden lg:flex items-center space-x-8">
            <a href="{{ route('home') }}" class="text-gray-300 hover:text-white transition-colors {{ request()->routeIs('home') ? 'text-accent-500' : '' }}">
                Home
            </a>
            <a href="{{ route('about') }}" class="text-gray-300 hover:text-white transition-colors {{ request()->routeIs('about') ? 'text-accent-500' : '' }}">
                About
            </a>
            <a href="{{ route('what-we-do') }}" class="text-gray-300 hover:text-white transition-colors {{ request()->routeIs('what-we-do') ? 'text-accent-500' : '' }}">
                What We Do
            </a>
            <a href="{{ route('portfolio') }}" class="text-gray-300 hover:text-white transition-colors {{ request()->routeIs('portfolio') ? 'text-accent-500' : '' }}">
                Portfolio
            </a>
            <a href="{{ route('work-with-us') }}" class="text-gray-300 hover:text-white transition-colors {{ request()->routeIs('work-with-us') ? 'text-accent-500' : '' }}">
                Work With Us
            </a>
        </nav>

        {{-- Desktop CTA --}}
        <div class="hidden lg:block">
            <a href="{{ route('contact') }}" class="btn btn-primary px-6 py-2.5">
                Contact
            </a>
        </div>

        {{-- Mobile Menu Button --}}
        <button
            @click="mobileMenuOpen = !mobileMenuOpen"
            class="lg:hidden p-2 text-gray-300 hover:text-white"
            aria-label="Toggle menu"
        >
            <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
            <svg x-show="mobileMenuOpen" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>

    {{-- Mobile Menu --}}
    <div
        x-show="mobileMenuOpen"
        x-cloak
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
        class="lg:hidden bg-navy-950 border-t border-navy-800"
    >
        <nav class="container py-4 flex flex-col space-y-4">
            <a href="{{ route('home') }}" class="text-gray-300 hover:text-white transition-colors py-2 {{ request()->routeIs('home') ? 'text-accent-500' : '' }}">
                Home
            </a>
            <a href="{{ route('about') }}" class="text-gray-300 hover:text-white transition-colors py-2 {{ request()->routeIs('about') ? 'text-accent-500' : '' }}">
                About
            </a>
            <a href="{{ route('what-we-do') }}" class="text-gray-300 hover:text-white transition-colors py-2 {{ request()->routeIs('what-we-do') ? 'text-accent-500' : '' }}">
                What We Do
            </a>
            <a href="{{ route('portfolio') }}" class="text-gray-300 hover:text-white transition-colors py-2 {{ request()->routeIs('portfolio') ? 'text-accent-500' : '' }}">
                Portfolio
            </a>
            <a href="{{ route('work-with-us') }}" class="text-gray-300 hover:text-white transition-colors py-2 {{ request()->routeIs('work-with-us') ? 'text-accent-500' : '' }}">
                Work With Us
            </a>
            <a href="{{ route('contact') }}" class="btn btn-primary w-full text-center py-3">
                Contact
            </a>
        </nav>
    </div>
</header>
