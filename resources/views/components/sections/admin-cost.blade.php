@props(['ctaUrl'])
{{-- Visitors' own numbers only. The result is the cost of the admin they describe, never a promised saving. --}}
<section class="texture-dots divider-top bg-navy-950 py-20 lg:py-32">
    <div class="container">
        <x-ui.section-heading
            title="What does admin cost you?"
            subtitle="Your numbers, not ours. Move the sliders."
            alignment="center"
            class="reveal-up"
        />

        <div
            class="max-w-5xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-8 items-stretch reveal-up"
            data-calculator
            x-data="{
                hours: 10,
                rate: 35,
                get yearly() { return Math.round(this.hours * this.rate * 46) },
                get weeks() { return (this.hours * 46 / 37.5).toFixed(1) },
                money(value) { return '£' + value.toLocaleString('en-GB') },
            }"
        >
            <div class="card-glass p-8 space-y-10">
                <div>
                    <div class="flex items-baseline justify-between gap-4 mb-3">
                        <label for="admin-hours" class="text-gray-200 font-medium">Hours a week your business spends on admin</label>
                        <span class="text-2xl font-bold text-white tabular-nums" x-text="hours">10</span>
                    </div>
                    <input id="admin-hours" type="range" min="1" max="60" step="1" x-model.number="hours" class="w-full accent-sky-400 cursor-pointer" aria-describedby="admin-cost-note">
                    <div class="flex justify-between text-xs text-gray-500 mt-1"><span>1</span><span>60</span></div>
                </div>

                <div>
                    <div class="flex items-baseline justify-between gap-4 mb-3">
                        <label for="admin-rate" class="text-gray-200 font-medium">What an hour of that time is worth</label>
                        <span class="text-2xl font-bold text-white tabular-nums" x-text="'£' + rate">£35</span>
                    </div>
                    <input id="admin-rate" type="range" min="15" max="150" step="5" x-model.number="rate" class="w-full accent-sky-400 cursor-pointer" aria-describedby="admin-cost-note">
                    <div class="flex justify-between text-xs text-gray-500 mt-1"><span>£15</span><span>£150</span></div>
                </div>
            </div>

            <div class="rounded-xl border border-accent-400/30 bg-gradient-to-br from-accent-500/15 to-purple-500/10 p-8 flex flex-col justify-center" aria-live="polite">
                <p class="text-gray-300 mb-1">A year of admin costs you</p>
                <p class="text-5xl md:text-6xl font-bold text-white tabular-nums mb-6" x-text="money(yearly)">£16,100</p>
                <p class="text-gray-300 mb-8">That is <span class="font-semibold text-white tabular-nums" x-text="weeks">12.3</span> working weeks a year.</p>
                <a href="{{ $ctaUrl }}" class="btn btn-primary px-6 py-3 text-center self-start">Find out how much could be handed off</a>
            </div>
        </div>

        <p id="admin-cost-note" class="max-w-3xl mx-auto text-center text-sm text-gray-500 mt-8">Based on 46 working weeks a year and a 37.5 hour week. This is your number, not our promise. The audit tells you how much of it can be handed off.</p>
    </div>
</section>
