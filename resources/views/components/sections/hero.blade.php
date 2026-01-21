@props([
    'title' => '',
    'subtitle' => null,
    'ctaText' => 'Get Started',
    'ctaUrl' => '/contact',
    'secondaryCtaText' => null,
    'secondaryCtaUrl' => null,
    'background' => 'bg-navy-950',
    'fullHeight' => false,
])

@section('hero_classes', $fullHeight ? 'flex items-center justify-center py-20' : 'py-24 lg:py-32')

<section class="{{ $background }} {{ $__env->yieldContent('hero_classes') }} {{ $fullHeight ? 'hero-bleed' : '' }} relative overflow-hidden" style="{{ $fullHeight ? 'min-height:45vh;' : '' }}">
    {{-- Background gradient effect --}}
    <div class="absolute inset-0 bg-gradient-to-br from-accent-500/10 via-transparent to-purple-500/10 pointer-events-none"></div>
    <div class="hero-circuit" aria-hidden="true">
        <svg viewBox="0 0 1200 600" preserveAspectRatio="none">
            <g class="circuit-lines">
                <path d="M40 60 H260 V140 H420 V110 H620 V220 H840" />
                <path class="alt" d="M80 520 H320 V430 H520 V500 H760 V380 H1020" />
                <path d="M200 40 V240 H140 V320 H420 V280 H660 V90 H980" />
                <path class="alt" d="M60 300 H240 V230 H380 V330 H560 V210 H740" />
                <path d="M700 60 V220 H900 V300 H1120" />
                <path class="alt" d="M500 360 V520 H740 V460 H940" />
                <path d="M120 120 H320 V200 H520 V160 H720 V260 H960" />
                <path class="alt" d="M180 480 H380 V380 H600 V440 H820 V320 H1080" />
                <path d="M260 100 V280 H220 V360 H500 V320 H740 V120 H1060" />
                <path class="alt" d="M100 260 H300 V200 H460 V300 H640 V180 H820" />
                <path d="M760 120 V260 H980 V340 H1160" />
                <path class="alt" d="M560 320 V500 H800 V420 H1020" />
                <path d="M300 80 H520 V180 H700 V140 H900 V240 H1100" />
                <path class="alt" d="M140 340 H360 V260 H540 V360 H720 V240 H900" />
                <path d="M420 60 V240 H360 V320 H600 V280 H860 V100 H1140" />
                <path class="alt" d="M220 540 H440 V460 H640 V520 H880 V400 H1120" />
            </g>
            <g class="circuit-nodes">
                <circle cx="280" cy="170" r="2" />
                <circle cx="420" cy="120" r="2" />
                <circle cx="610" cy="240" r="2" />
                <circle cx="340" cy="420" r="2" />
                <circle cx="520" cy="500" r="2" />
                <circle cx="740" cy="380" r="2" />
                <circle cx="160" cy="340" r="2" />
                <circle cx="440" cy="300" r="2" />
                <circle cx="640" cy="110" r="2" />
                <circle cx="260" cy="240" r="2" />
                <circle cx="360" cy="340" r="2" />
                <circle cx="520" cy="220" r="2" />
                <circle cx="930" cy="320" r="2" />
                <circle cx="720" cy="460" r="2" />
                <circle cx="320" cy="200" r="2" />
                <circle cx="520" cy="160" r="2" />
                <circle cx="720" cy="260" r="2" />
                <circle cx="380" cy="380" r="2" />
                <circle cx="600" cy="440" r="2" />
                <circle cx="820" cy="320" r="2" />
                <circle cx="220" cy="360" r="2" />
                <circle cx="500" cy="320" r="2" />
                <circle cx="740" cy="120" r="2" />
                <circle cx="300" cy="200" r="2" />
                <circle cx="460" cy="300" r="2" />
                <circle cx="640" cy="180" r="2" />
                <circle cx="980" cy="340" r="2" />
                <circle cx="800" cy="420" r="2" />
                <circle cx="700" cy="140" r="2" />
                <circle cx="900" cy="240" r="2" />
                <circle cx="360" cy="320" r="2" />
                <circle cx="600" cy="280" r="2" />
                <circle cx="860" cy="100" r="2" />
                <circle cx="440" cy="460" r="2" />
                <circle cx="640" cy="520" r="2" />
                <circle cx="880" cy="400" r="2" />
            </g>
            <g class="circuit-pulses">
                <path class="pulse pulse-1" d="M40 60 H260 V140 H420 V110 H620 V220 H840" />
                <path class="pulse pulse-2" d="M80 520 H320 V430 H520 V500 H760 V380 H1020" />
                <path class="pulse pulse-3" d="M200 40 V240 H140 V320 H420 V280 H660 V90 H980" />
                <path class="pulse pulse-4" d="M500 360 V520 H740 V460 H940" />
                <path class="pulse pulse-5" d="M120 120 H320 V200 H520 V160 H720 V260 H960" />
                <path class="pulse pulse-6" d="M180 480 H380 V380 H600 V440 H820 V320 H1080" />
                <path class="pulse pulse-7" d="M300 80 H520 V180 H700 V140 H900 V240 H1100" />
                <path class="pulse pulse-8" d="M140 340 H360 V260 H540 V360 H720 V240 H900" />
            </g>
        </svg>
    </div>

    <div class="container relative z-10">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-display-xl md:text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight">
                {{ $title }}
            </h1>

            @if($subtitle)
                <p class="text-xl text-gray-300 mb-10 max-w-3xl mx-auto leading-relaxed">
                    {{ $subtitle }}
                </p>
            @endif

            @if(isset($ctaText) || isset($secondaryCtaText))
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                    @if(isset($ctaText))
                        <a href="{{ $ctaUrl }}" class="btn btn-primary px-8 py-4 text-lg">
                            {{ $ctaText }}
                        </a>
                    @endif

                    @if(isset($secondaryCtaText))
                        <a href="{{ $secondaryCtaUrl }}" class="btn btn-ghost px-8 py-4 text-lg">
                            {{ $secondaryCtaText }}
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </div>
</section>
