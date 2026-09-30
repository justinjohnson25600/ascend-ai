@php
    use App\Support\AutomationIdeas;

    $ideas = AutomationIdeas::all();
    $auditUrl = route('contact', ['type' => 'audit']);
    $index = array_map(fn (array $idea): array => ['area' => $idea['area'], 'sectors' => $idea['sectors']], $ideas);
@endphp
<x-layout.app :title="$title" :description="$description">
    <x-sections.hero
        title="Automation ideas for small businesses"
        :subtitle="count($ideas).' jobs small businesses hand to automation. Filter by the kind of business you run and the part of the day they take.'"
        :fullHeight="false"
    />

    <section
        class="texture-dots divider-top bg-navy-900 py-16 lg:py-24"
        x-data="{
            sector: 'all',
            area: 'all',
            index: @js($index),
            shows(area, sectors) {
                return (this.area === 'all' || this.area === area) && (this.sector === 'all' || sectors.includes(this.sector));
            },
            get count() {
                return this.index.filter(idea => this.shows(idea.area, idea.sectors)).length;
            },
        }"
    >
        <div class="container">
            <div class="max-w-6xl mx-auto">
                {{-- Filters --}}
                <div class="space-y-5 mb-10 reveal-up">
                    <div>
                        <p id="filter-sector" class="text-xs uppercase tracking-wider text-gray-500 mb-2">Your business</p>
                        <div class="flex flex-wrap gap-2" role="group" aria-labelledby="filter-sector">
                            @foreach (['all' => 'All'] + AutomationIdeas::SECTORS as $key => $label)
                                <button type="button" @click="sector = '{{ $key }}'" :aria-pressed="sector === '{{ $key }}'"
                                    class="rounded-full border px-4 py-1.5 text-sm transition-colors"
                                    :class="sector === '{{ $key }}' ? 'border-accent-400 bg-accent-500/20 text-white' : 'border-white/10 bg-white/5 text-gray-300 hover:border-white/30'">{{ $label }}</button>
                            @endforeach
                        </div>
                    </div>
                    <div>
                        <p id="filter-area" class="text-xs uppercase tracking-wider text-gray-500 mb-2">The job</p>
                        <div class="flex flex-wrap gap-2" role="group" aria-labelledby="filter-area">
                            @foreach (['all' => 'All'] + AutomationIdeas::AREAS as $key => $label)
                                <button type="button" @click="area = '{{ $key }}'" :aria-pressed="area === '{{ $key }}'"
                                    class="rounded-full border px-4 py-1.5 text-sm transition-colors"
                                    :class="area === '{{ $key }}' ? 'border-purple-400 bg-purple-500/20 text-white' : 'border-white/10 bg-white/5 text-gray-300 hover:border-white/30'">{{ $label }}</button>
                            @endforeach
                        </div>
                    </div>
                    <p class="text-sm text-gray-400" aria-live="polite"><span x-text="count">{{ count($ideas) }}</span> ideas shown</p>
                </div>

                {{-- Ideas --}}
                <ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                    @foreach ($ideas as $idea)
                        <li data-idea x-show="shows('{{ $idea['area'] }}', {{ Js::from($idea['sectors']) }})" x-transition.opacity>
                            <div class="h-full card-glass p-6 flex flex-col">
                                <div class="flex items-center gap-3 mb-4">
                                    <span class="w-10 h-10 flex-shrink-0 rounded-lg bg-accent-500/15 text-accent-300 flex items-center justify-center" aria-hidden="true">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ AutomationIdeas::ICONS[$idea['area']] }}"/></svg>
                                    </span>
                                    <p class="text-xs uppercase tracking-wider text-accent-300">{{ AutomationIdeas::AREAS[$idea['area']] }}</p>
                                </div>
                                <h2 class="text-lg font-semibold text-white mb-2">{{ $idea['title'] }}</h2>
                                <p class="text-gray-400 mb-5 flex-1">{{ $idea['summary'] }}</p>
                                <p class="text-xs text-gray-500">
                                    {{ count($idea['sectors']) === count(AutomationIdeas::SECTORS) ? 'Suits most small businesses' : implode(' · ', array_map(fn ($s) => AutomationIdeas::SECTORS[$s], $idea['sectors'])) }}
                                </p>
                            </div>
                        </li>
                    @endforeach
                </ul>

                <p x-show="count === 0" x-cloak class="text-center text-gray-400 py-12">Nothing matches both filters. Try "All" on one of them.</p>
            </div>
        </div>
    </section>

    <x-sections.cta
        title="Seen something you want?"
        subtitle="The audit is where we work out what yours would look like."
        ctaText="Book a free automation audit"
        :ctaUrl="$auditUrl"
        variant="gradient"
    />
</x-layout.app>
