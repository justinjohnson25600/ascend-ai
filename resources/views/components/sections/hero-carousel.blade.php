@props([
    'slides' => [],      // each: eyebrow, title, body, points (optional list), ctaText, ctaUrl, secondaryCtaText, secondaryCtaUrl, note
    'interval' => 8000,  // ms between automatic advances; paused on hover, focus and reduced-motion
    'label' => 'Highlights',
])

<section
    x-data="heroCarousel({{ count($slides) }}, {{ (int) $interval }})"
    x-init="start()"
    @mouseenter="pause()"
    @mouseleave="resume()"
    @focusin="pause()"
    @focusout="resume()"
    @keydown.left.prevent="previous()"
    @keydown.right.prevent="next()"
    @touchstart.passive="touchStart($event)"
    @touchend.passive="touchEnd($event)"
    class="bg-navy-950 hero-bleed flex items-center justify-center py-20 relative overflow-hidden"
    style="min-height:45vh;"
    role="region"
    aria-roledescription="carousel"
    aria-label="{{ $label }}"
>
    <x-ui.circuit-background />

    <div class="container relative z-10">
        <div class="max-w-4xl mx-auto text-center">
            {{-- Slides share one grid cell so the section keeps the height of the tallest slide --}}
            <div class="grid" aria-live="polite">
                @foreach ($slides as $i => $slide)
                    <div
                        class="col-start-1 row-start-1 transition-opacity duration-700 ease-out"
                        :class="active === {{ $i }} ? 'opacity-100' : 'opacity-0 pointer-events-none'"
                        :aria-hidden="active !== {{ $i }}"
                        :inert="active !== {{ $i }}"
                        role="group"
                        aria-roledescription="slide"
                        aria-label="{{ $i + 1 }} of {{ count($slides) }}"
                    >
                        @if (!empty($slide['eyebrow']))
                            <p class="text-sm uppercase tracking-[0.2em] text-accent-400 mb-5">{{ $slide['eyebrow'] }}</p>
                        @endif

                        @if ($i === 0)
                            <h1 class="text-display-xl md:text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight">{{ $slide['title'] }}</h1>
                        @else
                            <h2 class="text-display-xl md:text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight">{{ $slide['title'] }}</h2>
                        @endif

                        @if (!empty($slide['body']))
                            <p class="text-xl text-gray-300 mb-8 max-w-3xl mx-auto leading-relaxed">{{ $slide['body'] }}</p>
                        @endif

                        @if (!empty($slide['points']))
                            <ul class="flex flex-wrap justify-center gap-x-6 gap-y-2 mb-10 text-sm text-gray-300">
                                @foreach ($slide['points'] as $point)
                                    <li class="flex items-center gap-2">
                                        <span class="w-1.5 h-1.5 rounded-full bg-accent-400" aria-hidden="true"></span>{{ $point }}
                                    </li>
                                @endforeach
                            </ul>
                        @endif

                        @if (!empty($slide['ctaText']) || !empty($slide['secondaryCtaText']))
                            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                                @if (!empty($slide['ctaText']))
                                    <a href="{{ $slide['ctaUrl'] }}" class="btn btn-primary px-8 py-4 text-lg" :tabindex="active === {{ $i }} ? 0 : -1">{{ $slide['ctaText'] }}</a>
                                @endif
                                @if (!empty($slide['secondaryCtaText']))
                                    <a href="{{ $slide['secondaryCtaUrl'] }}" class="btn btn-ghost px-8 py-4 text-lg" :tabindex="active === {{ $i }} ? 0 : -1">{{ $slide['secondaryCtaText'] }}</a>
                                @endif
                            </div>
                        @endif

                        @if (!empty($slide['note']))
                            <p class="mt-6 text-sm text-gray-400">{{ $slide['note'] }}</p>
                        @endif
                    </div>
                @endforeach
            </div>

            {{-- Controls --}}
            <div class="mt-12 flex items-center justify-center gap-6">
                <button type="button" @click="previous(); pause()" class="p-2 rounded-full text-gray-400 hover:text-white hover:bg-white/10 transition-colors" aria-label="Previous slide">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                </button>

                <div class="flex items-center gap-2" role="tablist" aria-label="Choose slide">
                    @foreach ($slides as $i => $slide)
                        <button
                            type="button"
                            @click="go({{ $i }}); pause()"
                            class="h-2 rounded-full transition-all duration-300"
                            :class="active === {{ $i }} ? 'w-8 bg-accent-400' : 'w-2 bg-white/30 hover:bg-white/60'"
                            :aria-current="active === {{ $i }} ? 'true' : 'false'"
                            aria-label="Go to slide {{ $i + 1 }}: {{ $slide['eyebrow'] ?? $slide['title'] }}"
                        ></button>
                    @endforeach
                </div>

                <button type="button" @click="next(); pause()" class="p-2 rounded-full text-gray-400 hover:text-white hover:bg-white/10 transition-colors" aria-label="Next slide">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </button>
            </div>
        </div>
    </div>
</section>

@once
    @push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('heroCarousel', (count, interval) => ({
                active: 0,
                count,
                interval,
                timer: null,
                paused: false,
                touchX: null,
                reducedMotion: window.matchMedia('(prefers-reduced-motion: reduce)').matches,

                start() {
                    if (this.reducedMotion || this.count < 2) return;
                    this.timer = setInterval(() => { if (!this.paused) this.next(); }, this.interval);
                },
                pause() { this.paused = true; },
                resume() { this.paused = false; },
                go(i) { this.active = (i + this.count) % this.count; },
                next() { this.go(this.active + 1); },
                previous() { this.go(this.active - 1); },
                touchStart(e) { this.touchX = e.changedTouches[0].clientX; },
                touchEnd(e) {
                    if (this.touchX === null) return;
                    const delta = e.changedTouches[0].clientX - this.touchX;
                    if (Math.abs(delta) > 50) { delta < 0 ? this.next() : this.previous(); this.pause(); }
                    this.touchX = null;
                },
            }));
        });
    </script>
    @endpush
@endonce
