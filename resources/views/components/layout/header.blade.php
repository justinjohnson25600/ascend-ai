@php
    $links = [
        ['route' => 'what-is-business-automation', 'label' => 'What is Business Automation?'],
        ['route' => 'solutions', 'label' => 'Solutions'],
        ['route' => 'how-it-works', 'label' => 'How It Works'],
        ['route' => 'about', 'label' => 'About'],
    ];
    $auditUrl = route('contact', ['type' => 'audit']);
@endphp
<header x-data="{ mobileMenuOpen: false }" class="sticky top-0 z-50 bg-navy-950/80 backdrop-blur-md border-b border-white/10">
    <div class="container h-16 md:h-20 flex items-center justify-between">
        {{-- Logo --}}
        <a href="{{ route('home') }}" class="flex items-center" aria-label="Ascend AI home">
            <img src="{{ asset('images/ascend-logo.webp') }}" alt="Ascend AI" class="h-6 md:h-8 w-auto">
        </a>

        {{-- Desktop Navigation --}}
        <nav class="hidden lg:flex items-center space-x-8" aria-label="Main">
            @foreach ($links as $link)
                <a href="{{ route($link['route']) }}" class="transition-colors hover:text-white {{ request()->routeIs($link['route']) ? 'text-accent-400' : 'text-gray-300' }}">
                    {{ $link['label'] }}
                </a>
            @endforeach
        </nav>

        {{-- Desktop CTA --}}
        <div class="hidden lg:block">
            <a href="{{ $auditUrl }}" class="btn btn-primary px-6 py-2.5">
                Book a free audit
            </a>
        </div>

        {{-- Mobile Menu Button --}}
        <button
            @click="mobileMenuOpen = !mobileMenuOpen"
            class="lg:hidden p-2 text-gray-300 hover:text-white"
            aria-label="Toggle menu"
            :aria-expanded="mobileMenuOpen"
        >
            <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
            <svg x-show="mobileMenuOpen" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>

    {{-- Social Media Bar --}}
    <div class="hidden lg:flex items-center justify-center py-3 bg-navy-900/50 border-t border-white/5">
        <x-ui.social-links icon-class="text-gray-300 hover:text-accent-400" gap="gap-5" />
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
        <nav class="container py-4 flex flex-col space-y-4" aria-label="Mobile">
            <a href="{{ route('home') }}" class="py-2 transition-colors hover:text-white {{ request()->routeIs('home') ? 'text-accent-400' : 'text-gray-300' }}">Home</a>
            @foreach ($links as $link)
                <a href="{{ route($link['route']) }}" class="py-2 transition-colors hover:text-white {{ request()->routeIs($link['route']) ? 'text-accent-400' : 'text-gray-300' }}">
                    {{ $link['label'] }}
                </a>
            @endforeach
            <a href="{{ $auditUrl }}" class="btn btn-primary w-full text-center py-3">
                Book a free audit
            </a>

            <div class="pt-4 border-t border-navy-800">
                <p class="text-xs text-gray-500 uppercase tracking-wider mb-3">Follow us</p>
                <x-ui.social-links />
            </div>
        </nav>
    </div>
</header>
