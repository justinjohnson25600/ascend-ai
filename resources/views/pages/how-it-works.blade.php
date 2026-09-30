@php $auditUrl = route('contact', ['type' => 'audit']); @endphp
<x-layout.app :title="$title" :description="$description">
    <x-sections.hero
        title="How it works, and what it costs"
        subtitle="No long contracts, no big bang launch. Small stages, each priced before it starts, each live before the next one begins."
        ctaText="Book a free automation audit"
        :ctaUrl="$auditUrl"
        :fullHeight="false"
    >
        <x-slot:visual>
            <x-graphics.stages />
        </x-slot:visual>
    </x-sections.hero>

    {{-- The process --}}
    <section class="texture-glow divider-top bg-navy-900 py-20 lg:py-32 relative overflow-hidden">
        <x-ui.section-photo desktop="how-salon-desktop.webp" mobile="how-salon-mobile.webp" mobile-position="object-[75%_center]" />
        <div class="container relative z-10">
            <x-ui.section-heading title="The process" alignment="center" />

            <div class="max-w-4xl mx-auto space-y-10 reveal-stagger">
                @foreach ([
                    ['The audit', 'A 30 minute call. You tell us how the business runs and where your time goes. We ask a lot of questions. Within two working days you get a short written document: the jobs we think can be automated, roughly what each would involve, and the order we would do them in. It is free and it is yours to keep, whether or not you work with us.'],
                    ['Scope and setup', 'If you want to go ahead, we scope the first stage in detail: what it does, what it connects to, what it will cost, how long it will take. You pay a setup fee, which covers getting access to your systems, the hosting and the groundwork everything else sits on.'],
                    ['Build in stages', 'Each stage has a fixed development fee agreed before it starts. We build it, test it with your real data, and switch it on. You use it for real before the next stage is scoped. Some businesses do one stage. Some do six over a year. You decide the pace.'],
                    ['Run and improve', 'Once something is live we host it, monitor it, and fix it when a supplier changes their system or your business changes its rules. That is covered by an ongoing monthly fee. Improvements and new stages are quoted as they come up.'],
                ] as $i => [$heading, $body])
                    <div class="flex gap-6">
                        <div class="flex-shrink-0 w-12 h-12 flex items-center justify-center bg-accent-500 rounded-full font-bold text-lg text-white">
                            {{ str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT) }}
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-white mb-2">{{ $heading }}</h3>
                            <p class="text-gray-400">{{ $body }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Item 13: what the free audit gives you --}}
    <section class="texture-glow divider-top bg-navy-950 py-20 lg:py-28 overflow-hidden">
        <div class="container">
            <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-14 lg:gap-16 items-center">
                <div class="reveal-up">
                    <h2 class="text-3xl md:text-4xl font-bold gradient-text mb-6">What you get from the free audit</h2>
                    <p class="text-lg text-gray-300 leading-relaxed mb-8">A short written document, yours to keep whether or not you work with us. It sets out how your business runs today, where the hours go, what we would automate first, what each piece would involve, and a rough cost range. You get it within two working days of the call.</p>
                    <a href="{{ $auditUrl }}" class="btn btn-primary px-8 py-4 text-lg inline-block">Book a free automation audit</a>
                </div>
                <div class="px-4 reveal-up stagger-2">
                    <x-graphics.audit-preview />
                </div>
            </div>
        </div>
    </section>

    {{-- How we charge --}}
    <section id="pricing" class="texture-dots divider-top bg-navy-950 py-20 lg:py-32 scroll-mt-24">
        <div class="container">
            <x-ui.section-heading title="How we charge" subtitle="Three parts, no surprises." alignment="center" />

            <div class="max-w-4xl mx-auto overflow-x-auto reveal-up">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-navy-700">
                            <th class="py-4 pr-6 text-sm uppercase tracking-wider text-gray-500 font-medium"></th>
                            <th class="py-4 pr-6 text-sm uppercase tracking-wider text-gray-500 font-medium">What it covers</th>
                            <th class="py-4 text-sm uppercase tracking-wider text-gray-500 font-medium">When</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-300">
                        <tr class="border-b border-navy-800">
                            <td class="py-5 pr-6 font-semibold text-white whitespace-nowrap">Setup fee</td>
                            <td class="py-5 pr-6">Access, hosting, foundations, the first detailed scope</td>
                            <td class="py-5 whitespace-nowrap">Once, at the start</td>
                        </tr>
                        <tr class="border-b border-navy-800">
                            <td class="py-5 pr-6 font-semibold text-white whitespace-nowrap">Development fee</td>
                            <td class="py-5 pr-6">Building each stage. Fixed price per stage, agreed before work starts. Larger projects are split into several stages, so this may recur while the build is underway</td>
                            <td class="py-5 whitespace-nowrap">Per stage</td>
                        </tr>
                        <tr>
                            <td class="py-5 pr-6 font-semibold text-white whitespace-nowrap">Ongoing fee</td>
                            <td class="py-5 pr-6">Hosting, monitoring, fixes, support, small changes</td>
                            <td class="py-5 whitespace-nowrap">Monthly, once something is live</td>
                        </tr>
                    </tbody>
                </table>
                <p class="text-gray-400 mt-8 text-center">Exact figures depend on the size of the project. The audit document gives you a range before you commit to anything.</p>
            </div>
        </div>
    </section>

    {{-- What we need from you --}}
    <section class="texture-glow divider-top bg-navy-900 py-20 lg:py-24 relative overflow-hidden">
        <x-ui.section-photo desktop="how-clinic-desktop.webp" mobile="how-clinic-mobile.webp" />
        <div class="container relative z-10">
            <div class="max-w-3xl mx-auto">
                <h2 class="text-display-sm md:text-display-md font-bold gradient-text mb-8 text-center reveal-up">What we'll need from you</h2>
                <ul class="space-y-4 reveal-stagger">
                    @foreach ([
                        'An hour or two of your time per stage, mostly at the start, to explain how things really work.',
                        'Access to the systems involved: your calendar, accounts package, website, inbox. We set this up securely and you can revoke it at any time.',
                        'Someone to try it. Real use finds the exceptions that a demo never does.',
                    ] as $line)
                        <li class="flex items-start gap-4 p-5 rounded-xl bg-navy-800/60 border border-navy-700/50">
                            <svg class="w-6 h-6 text-accent-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            <span class="text-gray-200">{{ $line }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>

    {{-- FAQ --}}
    <section id="faq" class="texture-dots divider-top bg-navy-950 py-20 lg:py-32 scroll-mt-24">
        <div class="container">
            <x-ui.section-heading title="Questions owners ask" alignment="center" />

            <div class="max-w-3xl mx-auto space-y-4 reveal-up" x-data="{ open: null }">
                @foreach ([
                    ['Will this replace my staff?', 'Usually it replaces evenings and weekends, not people. It takes the repetitive parts off whoever is doing them, so they can do the work that needs a person.'],
                    ['Do I have to change the software I use?', 'No. We connect to what you already have. If something you use genuinely cannot be connected to, we will tell you at the audit.'],
                    ['Who owns it?', 'You own the automation built for your business. We host and run it for the monthly fee. If you ever want to move it elsewhere, we hand it over with documentation.'],
                    ['What happens when something breaks?', 'We are monitoring it, so we usually know before you do. Fixes are covered by the ongoing fee. If a supplier changes their system in a way that needs a rebuild, we quote that separately and tell you first.'],
                    ['How long does a stage take?', 'It depends on what it does and how many systems it touches. Most first stages are measured in weeks, not months. The scope tells you before you commit.'],
                    ['Is my data safe?', 'Your data stays in your systems. We access it with permissions you grant and can revoke. Where an AI model is used, we choose providers that do not train on your data, and we say which ones in the scope.', [route('your-data'), 'Your data, in plain English']],
                ] as $i => $faq)
                    @php [$question, $answer, $link] = $faq + [2 => null]; @endphp
                    <div class="card overflow-hidden">
                        <button type="button" @click="open = open === {{ $i }} ? null : {{ $i }}" :aria-expanded="open === {{ $i }}" class="w-full flex items-center justify-between gap-4 p-6 text-left">
                            <span class="text-lg font-semibold text-white">{{ $question }}</span>
                            <svg class="w-5 h-5 text-accent-400 flex-shrink-0 transition-transform" :class="open === {{ $i }} ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div x-show="open === {{ $i }}" x-transition x-cloak class="px-6 pb-6">
                            <p class="text-gray-300">{{ $answer }}</p>
                            @if ($link)
                                <p class="mt-3"><a href="{{ $link[0] }}" class="text-accent-400 hover:text-accent-300 font-medium">{{ $link[1] }}</a></p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <x-sections.cta
        title="Start with the audit"
        subtitle="Thirty minutes. A written list of what could be automated in your business. No obligation after that."
        ctaText="Book a free automation audit"
        :ctaUrl="$auditUrl"
        variant="gradient"
    />
</x-layout.app>
