@php
    $auditUrl = route('contact', ['type' => 'audit']);
    $areas = [
        [
            'id' => 'enquiries',
            'visual' => 'email',
            'heading' => 'Enquiries and follow-up',
            'problem' => 'An enquiry comes in while you are on a job. By the time you reply, they have booked someone else.',
            'build' => 'Every enquiry, from your website, email, social pages or phone message, gets an immediate reply in your tone of voice. It asks the questions you would ask, works out whether it is a job you want, books a call or a visit, and follows up until there is an answer. You see every conversation and can step in at any point.',
            'yours' => 'The decision. It qualifies and follows up. You still say yes.',
        ],
        [
            'id' => 'quotes',
            'visual' => 'quote',
            'heading' => 'Quotes and invoicing',
            'problem' => 'Quotes take an evening to write and a week of nudging to get answered. Invoices go out late because they get done in batches.',
            'build' => 'Quotes drafted from your own price list and past jobs, sent for your approval or straight to the customer, then chased politely on a schedule you set. When the job is marked done, the invoice goes out and gets chased too. It connects to the accounts software you already use.',
            'yours' => 'Pricing rules and the final approval on anything unusual.',
        ],
        [
            'id' => 'scheduling',
            'visual' => 'diary',
            'heading' => 'Scheduling and reminders',
            'problem' => 'Bookings taken by phone, written in a diary, forgotten by the customer.',
            'build' => 'Customers book, reschedule and cancel themselves within the rules you set. Confirmations and reminders go out by text or email. Your diary, your staff\'s diaries and your job list stay in step. No-shows get followed up automatically.',
            'yours' => 'The rules. Who can be booked, when, for what, and how much notice.',
        ],
        [
            'id' => 'questions',
            'visual' => 'chat',
            'heading' => 'Customer questions',
            'problem' => 'The same twenty questions, every week, answered by whoever picks up.',
            'build' => 'An assistant on your website, email or messaging channels that answers from your own information: your prices, your opening hours, your policies, your product details. It only says what you have told it. Anything it cannot answer goes to a person with the conversation attached.',
            'yours' => 'The source of truth. You change your information, its answers change.',
        ],
        [
            'id' => 'paperwork',
            'visual' => 'receipt',
            'heading' => 'Paperwork and data entry',
            'problem' => 'The same customer details typed into three systems by hand, and one of them always ends up wrong.',
            'build' => 'Information captured once, from a form, an email, a photo of a document or a call note, then checked and pushed to every system that needs it. Job sheets, compliance records, supplier orders, onboarding forms.',
            'yours' => 'Nothing you want to keep doing by hand. Anything that needs a human check gets one.',
        ],
        [
            'id' => 'reporting',
            'visual' => 'report',
            'heading' => 'Reporting',
            'problem' => 'You know the business is busy. You do not know if it is profitable this month until the accountant tells you.',
            'build' => 'The handful of numbers you actually run the business on, pulled from your systems and sent to you on the schedule you choose. Jobs booked, quotes outstanding, cash due, hours by staff member. Whatever matters to you.',
            'yours' => 'The judgement. It shows you the numbers. You decide what to do about them.',
        ],
    ];
@endphp
<x-layout.app :title="$title" :description="$description">
    <x-sections.hero
        title="What we automate"
        subtitle="These are the areas small businesses ask us about most. We specialise in small building firms and trades, so most of our examples come from there. Yours might need one area or a combination. The audit works out which."
        ctaText="Book a free automation audit"
        :ctaUrl="$auditUrl"
        :fullHeight="false"
    >
        <x-slot:visual>
            <x-graphics.hub />
        </x-slot:visual>
    </x-sections.hero>

    {{-- Jump links --}}
    <section class="bg-navy-900 border-y border-navy-800 py-6">
        <div class="container">
            <nav class="flex flex-wrap justify-center gap-x-6 gap-y-2 text-sm reveal-up" aria-label="On this page">
                @foreach ($areas as $area)
                    <a href="#{{ $area['id'] }}" class="text-gray-400 hover:text-accent-400 transition-colors">{{ $area['heading'] }}</a>
                @endforeach
            </nav>
        </div>
    </section>

    {{-- Areas: copy on one side, the matching animated example on the other, alternating down the page --}}
    @foreach ($areas as $i => $area)
        <section id="{{ $area['id'] }}" class="{{ $i % 2 === 0 ? 'bg-navy-950' : 'bg-navy-900' }} py-20 lg:py-28 scroll-mt-32 relative overflow-hidden">
            <div class="absolute {{ $i % 2 === 0 ? '-right-40' : '-left-40' }} top-1/3 w-96 h-96 rounded-full blur-3xl {{ $i % 2 === 0 ? 'bg-accent-500/10' : 'bg-purple-500/10' }} pointer-events-none"></div>

            <div class="container relative">
                <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                    <div class="{{ $i % 2 === 1 ? 'lg:order-last' : '' }} reveal-up">
                        <div class="flex items-center gap-4 mb-8">
                            <span class="flex-shrink-0 w-12 h-12 flex items-center justify-center bg-accent-500 rounded-full font-bold text-lg text-white">
                                {{ str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT) }}
                            </span>
                            <h2 class="text-3xl md:text-4xl font-bold text-white">{{ $area['heading'] }}</h2>
                        </div>

                        <p class="text-xs uppercase tracking-wider text-accent-400 mb-2">The problem</p>
                        <p class="text-lg text-gray-300 mb-8">{{ $area['problem'] }}</p>

                        <x-ui.card variant="glass" padding="lg" class="border border-accent-500/20">
                            <p class="text-xs uppercase tracking-wider text-accent-400 mb-3">What we build</p>
                            <p class="text-gray-200 mb-6">{{ $area['build'] }}</p>
                            <p class="text-xs uppercase tracking-wider text-gray-500 mb-2">What stays with you</p>
                            <p class="text-gray-400">{{ $area['yours'] }}</p>
                        </x-ui.card>
                    </div>

                    <div class="reveal-up stagger-2">
                        <x-dynamic-component :component="'vignettes.'.$area['visual']" />
                    </div>
                </div>
            </div>
        </section>
    @endforeach

    {{-- Item 10: typical first stage by kind of business --}}
    <x-sections.sector-picker />

    {{-- What we don't do --}}
    <section class="texture-dots bg-navy-950 py-20 lg:py-24 border-t border-navy-800">
        <div class="container">
            <div class="max-w-3xl mx-auto">
                <h2 class="text-display-sm md:text-display-md font-bold gradient-text mb-8 text-center reveal-up">What we don't do</h2>
                <ul class="space-y-4 reveal-stagger">
                    @foreach ([
                        "We don't sell a package and make you fit it.",
                        "We don't replace the software you like. We connect to it.",
                        "We don't put an AI in front of your customers that makes things up. It answers from your information or hands over to a person.",
                        "We don't build something and disappear.",
                    ] as $line)
                        <li class="flex items-start gap-4 p-5 rounded-xl bg-navy-800/60 border border-navy-700/50">
                            <svg class="w-6 h-6 text-accent-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            <span class="text-gray-200 text-lg">{{ $line }}</span>
                        </li>
                    @endforeach
                </ul>
                <p class="text-center text-gray-400 mt-6 reveal-up">The last one is covered in <a href="{{ route('how-it-works') }}" class="text-accent-400 hover:text-accent-300">how it works</a>.</p>
            </div>
        </div>
    </section>

    <x-sections.cta
        title="Not sure which of these applies to you?"
        subtitle="That is what the audit is for."
        ctaText="Book a free automation audit"
        :ctaUrl="$auditUrl"
    />
</x-layout.app>
