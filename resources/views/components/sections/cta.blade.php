@props([
    'title' => '',
    'subtitle' => null,
    'ctaText' => 'Contact Us',
    'ctaUrl' => '/contact',
    'variant' => 'default', // default, gradient
])

@php
$backgroundClasses = $variant === 'gradient'
    ? 'bg-gradient-to-r from-accent-600 to-purple-600'
    : 'bg-navy-800 border border-accent-500/30';
@endphp

<section class="{{ $backgroundClasses }} py-20">
    <div class="container text-center">
        <h2 class="text-display-md md:text-display-lg font-bold text-white mb-6">
            {{ $title }}
        </h2>

        @if($subtitle)
            <p class="text-lg text-gray-200 mb-10 max-w-2xl mx-auto">
                {{ $subtitle }}
            </p>
        @endif

        <a href="{{ $ctaUrl }}" class="inline-block bg-white text-accent-600 hover:bg-gray-100 font-semibold px-8 py-4 rounded-lg transition-all duration-200">
            {{ $ctaText }}
        </a>
    </div>
</section>
