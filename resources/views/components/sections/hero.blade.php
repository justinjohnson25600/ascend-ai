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

@section('hero_classes', $fullHeight ? 'flex items-center justify-center py-20' : 'py-24 lg:py-32')

<section class="{{ $background }} {{ $__env->yieldContent('hero_classes') }} {{ $fullHeight ? 'hero-bleed' : '' }} relative overflow-hidden" style="{{ $fullHeight ? 'min-height:45vh;' : '' }}">
    <x-ui.circuit-background />

    <div class="container relative z-10">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight">
                {{ $title }}
            </h1>

            @if($subtitle)
                <p class="text-lg md:text-xl text-gray-300 max-w-3xl mx-auto leading-relaxed {{ ($ctaText || $secondaryCtaText || $note) ? 'mb-10' : '' }}">
                    {{ $subtitle }}
                </p>
            @endif

            @if($ctaText || $secondaryCtaText)
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
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
    </div>
</section>
