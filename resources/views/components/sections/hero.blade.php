@props([
    'title' => '',
    'subtitle' => null,
    'ctaText' => null,   // no button unless a page asks for one
    'ctaUrl' => null,
    'secondaryCtaText' => null,
    'secondaryCtaUrl' => null,
    'note' => null,
    'background' => 'bg-navy-950',
    'fullHeight' => false,
])

{{-- Pass <x-slot:visual> to get a two-column hero: text left, graphic right (stacked on phones). --}}
@php $hasVisual = isset($visual) && trim((string) $visual) !== ''; @endphp

<section class="{{ $background }} {{ $fullHeight ? 'flex items-center justify-center py-20 hero-bleed' : ($hasVisual ? 'py-16 lg:py-24' : 'py-24 lg:py-32') }} relative overflow-hidden" style="{{ $fullHeight ? 'min-height:45vh;' : '' }}">
    <x-ui.circuit-background />

    <div class="container relative z-10">
        <div class="{{ $hasVisual ? 'max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center' : 'max-w-4xl mx-auto text-center' }}">
            <div class="{{ $hasVisual ? 'text-center lg:text-left' : '' }}">
                <h1 class="text-4xl md:text-5xl {{ $hasVisual ? '' : 'lg:text-6xl' }} font-bold text-white mb-6 leading-tight">
                    {{ $title }}
                </h1>

                @if($subtitle)
                    <p class="text-lg md:text-xl text-gray-300 max-w-3xl mx-auto {{ $hasVisual ? 'lg:mx-0' : '' }} leading-relaxed {{ ($ctaText || $secondaryCtaText || $note) ? 'mb-10' : '' }}">
                        {{ $subtitle }}
                    </p>
                @endif

                @if($ctaText || $secondaryCtaText)
                    <div class="flex flex-col sm:flex-row items-center justify-center {{ $hasVisual ? 'lg:justify-start' : '' }} gap-4">
                        @if($ctaText)
                            <a href="{{ $ctaUrl }}" class="btn btn-primary px-8 py-4 text-lg">
                                {{ $ctaText }}
                            </a>
                        @endif

                        @if($secondaryCtaText)
                            <a href="{{ $secondaryCtaUrl }}" class="btn btn-ghost px-8 py-4 text-lg">
                                {{ $secondaryCtaText }}
                            </a>
                        @endif
                    </div>
                @endif

                @if($note)
                    <p class="mt-6 text-sm text-gray-400">{{ $note }}</p>
                @endif
            </div>

            @if($hasVisual)
                <div class="w-full max-w-md mx-auto lg:max-w-none">
                    {{ $visual }}
                </div>
            @endif
        </div>
    </div>
</section>
