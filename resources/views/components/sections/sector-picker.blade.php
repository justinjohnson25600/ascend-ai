@php
    // Copy approved in CONTENT_BLUEPRINT_V2, item 10. Typical first stages, not fixed packages.
    $sectors = [
        ['trade', 'A building firm or trade', 'You are on the tools all day, so the phone and the inbox wait.', [
            'Missed calls texted back and booked in.',
            'Quotes drafted from your price list and chased.',
            'Receipts texted from site and filed into your accounts.',
            'CIS and VAT paperwork checked before it goes to HMRC.',
        ]],
        ['clinic', 'A clinic or salon', 'Your diary is the business.', [
            'Online booking with deposits and reminders.',
            'No-shows followed up and rebooked.',
            'Intake and consent forms completed before the appointment.',
            'Answers to the questions reception gets all day.',
        ]],
        ['agency', 'An agency or consultancy', 'Your time is what you sell, so admin is lost revenue.', [
            'Enquiries qualified and booked into discovery calls.',
            'New clients onboarded: agreement, forms and folders set up.',
            'Timesheets and project updates collected without chasing.',
            'Overdue invoices chased politely.',
        ]],
        ['hospitality', 'A café, pub or restaurant', 'Busy when your customers are, and short of hands.', [
            'Table and event enquiries answered and booked.',
            'Review replies drafted for you to approve.',
            'Supplier orders built from stock counts.',
            'Rota questions answered from the rota.',
        ]],
        ['shop', 'A shop or online store', 'Customers want answers now, whatever the hour.', [
            '"Where is my order?" answered from your order system.',
            'Returns handled to your policy.',
            'Low stock flagged before it runs out.',
            'A daily sales summary sent to your phone.',
        ]],
    ];
@endphp
<section class="texture-glow divider-top bg-navy-900 py-20 lg:py-28" x-data="{
    tab: '{{ $sectors[0][0] }}',
    keys: {{ Js::from(array_column($sectors, 0)) }},
    move(step) {
        const i = (this.keys.indexOf(this.tab) + step + this.keys.length) % this.keys.length;
        this.tab = this.keys[i];
        this.$nextTick(() => document.getElementById('tab-' + this.tab).focus());
    },
}">
    <div class="container">
        <x-ui.section-heading
            title="What a first stage often looks like for a business like yours"
            subtitle="Typical, not fixed. Every business is different, which is why we start with the audit."
            alignment="center"
        />

        <div class="max-w-5xl mx-auto reveal-up">
            <p class="text-center text-sm uppercase tracking-wider text-gray-500 mb-3">I run…</p>
            <div class="flex flex-wrap justify-center gap-2 mb-10" role="tablist" aria-label="Kind of business" @keydown.arrow-right.prevent="move(1)" @keydown.arrow-left.prevent="move(-1)">
                @foreach ($sectors as [$key, $label])
                    <button
                        type="button"
                        role="tab"
                        id="tab-{{ $key }}"
                        aria-controls="panel-{{ $key }}"
                        :aria-selected="tab === '{{ $key }}'"
                        :tabindex="tab === '{{ $key }}' ? 0 : -1"
                        @click="tab = '{{ $key }}'"
                        class="rounded-full border px-5 py-2 text-sm font-medium transition-colors"
                        :class="tab === '{{ $key }}' ? 'border-accent-400 bg-accent-500 text-white' : 'border-white/10 bg-white/5 text-gray-300 hover:border-white/30'"
                    >{{ $label }}</button>
                @endforeach
            </div>

            @foreach ($sectors as $i => [$key, $label, $intro, $stage])
                <div id="panel-{{ $key }}" role="tabpanel" aria-labelledby="tab-{{ $key }}" x-show="tab === '{{ $key }}'" @if ($i > 0) x-cloak @endif x-transition.opacity>
                    <div class="grid grid-cols-1 lg:grid-cols-5 gap-8 items-start">
                        <div class="lg:col-span-2 text-center lg:text-left">
                            <p class="text-2xl md:text-3xl font-bold text-white leading-snug">{{ $intro }}</p>
                        </div>
                        <ul class="lg:col-span-3 grid grid-cols-1 sm:grid-cols-2 gap-4">
                            @foreach ($stage as $item)
                                <li class="card-glass p-5 flex items-start gap-3">
                                    <svg class="w-5 h-5 text-accent-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    <span class="text-gray-200">{{ $item }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endforeach

            <p class="text-center mt-10">
                <a href="{{ route('automation-ideas') }}" class="text-accent-400 hover:text-accent-300 font-medium">See more ideas in the automation ideas library</a>
            </p>
        </div>
    </div>
</section>
