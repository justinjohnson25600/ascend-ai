@php
    $auditUrl = route('contact', ['type' => 'audit']);
    $solutions = fn (string $anchor) => route('solutions').'#'.$anchor;

    $steps = [
        ['It does the work.', 'Replies to enquiries, drafts quotes, files receipts, fills the diary: whatever it was built for, inside the limits you set.'],
        ['It keeps a record.', 'Every job, what it did and how it turned out. Which quotes were accepted, which replies got an answer, which questions it could not answer.'],
        ['It learns from you.', 'Change a draft before it goes out and it notes what you changed. Tell it once that you do not travel north of Chelmsford and it stops booking jobs there. Each lesson goes into your playbook, in plain English.'],
        ['It looks back over its week.', 'It reads its own record for patterns: quotes that go quiet, questions it keeps passing to you, steps that always need a person, slots that stay empty.'],
        ['It brings you suggestions.', 'A short list, with its reasons. You say yes, no or "let\'s talk". Only what you approve goes ahead.'],
    ];

    $checks = [
        ['Nothing changes without your yes.', 'Suggestions wait for you. It does not quietly rewrite how your business works.', 'M5 13l4 4L19 7'],
        ['It works inside limits you set.', 'What it can send, book or promise without asking. Discounts, refunds and anything unusual always come to you.', 'M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z'],
        ['Everything is written down.', 'What it did, when and why. Pick any job and see how it was handled.', 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01'],
        ['You can read what it has learned.', 'Your playbook is in plain English. Change a lesson or delete it, and it stops.', 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253'],
        ['It asks when it is not sure.', 'Anything it has not seen before comes to you with the details attached.', 'M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
        ['It learns your business, and nobody else\'s.', 'Your data does not train anyone\'s AI model, ours or the provider\'s. The playbook is yours, and comes with you if you ever leave.', 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z', true],
    ];

    $areas = [
        ['enquiries', 'Enquiries', 'Replies, asks your questions and books the call.', 'Which replies get an answer, and which enquiries tend to become work.', 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z'],
        ['quotes', 'Quotes', 'Drafts from your price list, sends and chases.', 'How you price the awkward jobs, and when a nudge works better than a call.', 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'],
        ['scheduling', 'Diary', 'Books, reminds and follows up no-shows.', 'Which slots stay empty, and who needs a second reminder.', 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'],
        ['questions', 'Customer questions', 'Answers from your information.', 'The questions it could not answer, so you only have to answer them once.', 'M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z'],
        ['paperwork', 'Paperwork', 'Reads receipts and files them into your accounts.', 'How you and your accountant like things categorised.', 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4'],
        ['reporting', 'Reporting', 'Sends you the numbers you run the business on.', 'Which numbers you actually look at, and tells you when one moves.', 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z'],
    ];

    $faqs = [
        ['Is it really learning, or just following rules?', 'It learns, but not by retraining an AI model on your data. It keeps a written playbook of your rules, your corrections and what has worked, and reads it before every job. That is how it gets better, and why you can see exactly what it has learned.'],
        ['Will it change things on its own?', 'Only inside the limits you set at the start, such as sending routine replies. Anything that changes how your business deals with customers, prices or money waits for your yes.'],
        ['What if it learns the wrong thing?', 'Every lesson is written down with where it came from. If one is wrong, you or we remove it, and it stops straight away.'],
        ['Do I have to check everything it does, for ever?', 'No. Every job starts with you checking. As it proves itself on a job, you can let it handle that job on its own, and take it back at any time.'],
        ['Does an agent cost more than ordinary automation?', 'It depends on the job. Agents are built and priced in stages like everything else we do, and the audit gives you a range before you commit to anything. Small changes it suggests are covered by the monthly fee; anything bigger is priced first.'],
        ['Is my data used to train AI?', 'No. The AI providers we use are not allowed to train on your data, and we never train our own models on it. What your agent learns stays in its playbook, which is yours.', true],
    ];
@endphp
<x-layout.app :title="$title" :description="$description">
    <x-sections.hero
        title="AI agents that get better at your business"
        subtitle="Most automation does exactly what it was set up to do, for ever. An agent does the job, learns from the way you correct it, and comes back with ideas to save time and win more work. Nothing changes without your say-so."
        ctaText="Book a free automation audit"
        :ctaUrl="$auditUrl"
        :fullHeight="false"
    >
        <x-slot:visual>
            <x-graphics.learning-loop />
        </x-slot:visual>
    </x-sections.hero>

    {{-- What is an AI agent? --}}
    <section class="texture-glow divider-top bg-navy-900 py-20 lg:py-28 relative overflow-hidden">
        <x-ui.section-photo desktop="agents-desktop.webp" mobile="agents-mobile.webp" />

        <div class="container relative z-10">
            <div class="max-w-3xl mx-auto">
                <h2 class="text-display-sm md:text-display-md font-bold gradient-text mb-8 reveal-up">What is an AI agent?</h2>
                <div class="space-y-6 text-lg text-gray-300 leading-relaxed reveal-up">
                    <p>You may have heard the phrase. In a small business it means this. Ordinary automation follows a fixed recipe: when this happens, do that. An agent is given a job and your rules, and works out the steps for each case. It reads what has come in, checks your diary or your price list, decides what needs doing, does it, and checks it worked.</p>
                    <p>When something does not fit, it asks you instead of guessing. And unlike a fixed recipe, it gets better at the job the longer it does it.</p>
                </div>
            </div>

            <div class="max-w-4xl mx-auto mt-12 grid grid-cols-1 md:grid-cols-2 gap-6 reveal-stagger">
                @foreach ([
                    ['Fixed automation', 'border-white/10', 'text-gray-500', [
                        'Follows the same steps every time.',
                        'Needs someone to change it when your business changes.',
                        'Is exactly as good on day 300 as it was on day one.',
                    ]],
                    ['An agent', 'border-accent-500/30', 'text-accent-400', [
                        'Works out the steps for each job, inside your rules.',
                        'Picks up changes from the way you correct it.',
                        'Is better on day 300 than on day one, and can show you why.',
                    ]],
                ] as [$heading, $border, $tick, $lines])
                    <div class="h-full p-8 rounded-2xl bg-navy-800/60 border {{ $border }}">
                        <h3 class="text-xl font-semibold text-white mb-5">{{ $heading }}</h3>
                        <ul class="space-y-3">
                            @foreach ($lines as $line)
                                <li class="flex items-start gap-3 text-gray-300">
                                    <svg class="w-5 h-5 {{ $tick }} flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                    <span>{{ $line }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>

            <p class="max-w-3xl mx-auto mt-10 text-center text-lg text-gray-300 reveal-up">Both have their place. Where a job never varies, fixed steps are simpler and cost less. The audit tells you which is which.</p>
        </div>
    </section>

    {{-- How it gets better --}}
    <section class="texture-dots divider-top bg-navy-950 py-20 lg:py-28 overflow-hidden">
        <div class="container">
            <x-ui.section-heading
                title="How it gets better"
                subtitle="The way a good new starter does: by doing the work, listening when you put it right, and writing it down."
                alignment="center"
            />

            <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                <ol class="space-y-8 reveal-up">
                    @foreach ($steps as $i => [$heading, $body])
                        <li class="flex gap-5">
                            <span class="flex-shrink-0 w-11 h-11 flex items-center justify-center rounded-full font-bold text-white {{ $i === 2 ? 'bg-purple-500' : 'bg-accent-500' }}">
                                {{ str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT) }}
                            </span>
                            <div>
                                <h3 class="text-lg font-semibold text-white mb-1">{{ $heading }}</h3>
                                <p class="text-gray-400">{{ $body }}</p>
                            </div>
                        </li>
                    @endforeach
                </ol>

                <div class="reveal-up stagger-2">
                    <x-vignettes.lesson />
                </div>
            </div>
        </div>
    </section>

    {{-- Suggestions --}}
    <section class="divider-top bg-navy-900 py-20 lg:py-28 relative overflow-hidden">
        <div class="absolute top-1/4 -left-32 w-64 h-64 bg-accent-500/20 rounded-full blur-3xl animate-float pointer-events-none"></div>
        <div class="absolute bottom-1/4 -right-32 w-96 h-96 bg-purple-500/10 rounded-full blur-3xl animate-float-delayed pointer-events-none"></div>

        <div class="container relative z-10">
            <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                <div class="lg:order-last reveal-up">
                    <h2 class="text-display-sm md:text-display-md font-bold gradient-text mb-6">Suggestions, with its reasons</h2>
                    <div class="space-y-5 text-lg text-gray-300 leading-relaxed">
                        <p>Once a week, or once a month if you prefer, it sends you a short list of changes it thinks would help. Each one says what it noticed, what it would change and why. Some save time. Some win back work that was slipping away. Some are simply things you would want to know.</p>
                        <p>You decide which go ahead. Small changes are part of the monthly fee. Anything bigger is priced before it starts, as always.</p>
                    </div>
                </div>

                <div class="reveal-up stagger-2">
                    <x-vignettes.suggestions />
                </div>
            </div>
        </div>
    </section>

    {{-- How much it does on its own --}}
    <section class="texture-glow divider-top bg-navy-950 py-20 lg:py-28">
        <div class="container">
            <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                <div class="reveal-up">
                    <h2 class="text-display-sm md:text-display-md font-bold gradient-text mb-6">You decide how much it does on its own</h2>
                    <p class="text-lg text-gray-300 leading-relaxed">Every job starts with you checking. It moves up only when you say so, one job at a time, and you can move it back whenever you like.</p>
                </div>

                <div class="px-4 reveal-up stagger-2">
                    <x-graphics.trust-ladder />
                </div>
            </div>
        </div>
    </section>

    {{-- Built to be checked --}}
    <section class="texture-dots divider-top bg-navy-900 py-20 lg:py-28">
        <div class="container">
            <x-ui.section-heading
                title="Built to be checked"
                subtitle="An agent that learns is only useful if you can trust what it has learned."
                alignment="center"
            />

            <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 reveal-stagger">
                @foreach ($checks as $check)
                    @php [$heading, $body, $icon, $dataLink] = $check + [3 => false]; @endphp
                    <div class="h-full p-7 rounded-2xl bg-navy-800/60 border border-navy-700/50">
                        <span class="w-11 h-11 mb-5 flex items-center justify-center rounded-lg bg-accent-500/15 text-accent-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icon }}"/></svg>
                        </span>
                        <h3 class="text-lg font-semibold text-white mb-2">{{ $heading }}</h3>
                        <p class="text-gray-400">{{ $body }}</p>
                        @if ($dataLink)
                            <p class="mt-3"><a href="{{ route('your-data') }}" class="text-accent-400 hover:text-accent-300 font-medium">Your data, in plain English</a></p>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- What an agent does, and what it learns --}}
    <section class="texture-glow divider-top bg-navy-950 py-20 lg:py-28">
        <div class="container">
            <x-ui.section-heading title="What an agent does, and what it learns" alignment="center" />

            <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 reveal-stagger">
                @foreach ($areas as [$anchor, $heading, $does, $learns, $icon])
                    <x-ui.card variant="glass" padding="md" class="h-full border border-white/5">
                        <a href="{{ $solutions($anchor) }}" class="flex items-center gap-3 mb-5 group">
                            <span class="w-10 h-10 flex-shrink-0 rounded-full border border-white/10 bg-navy-800/95 flex items-center justify-center text-accent-300">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icon }}"/></svg>
                            </span>
                            <h3 class="text-lg font-semibold text-white group-hover:text-accent-300 transition-colors">{{ $heading }}</h3>
                        </a>
                        <p class="text-xs uppercase tracking-wider text-accent-400 mb-1">Does</p>
                        <p class="text-gray-300 mb-4">{{ $does }}</p>
                        <p class="text-xs uppercase tracking-wider text-purple-300 mb-1">Learns</p>
                        <p class="text-gray-300">{{ $learns }}</p>
                    </x-ui.card>
                @endforeach
            </div>

            <p class="text-center mt-10 reveal-up"><a href="{{ route('solutions') }}" class="text-accent-400 hover:text-accent-300 font-medium">See all six areas in detail</a></p>
        </div>
    </section>

    {{-- FAQ --}}
    <section id="faq" class="texture-dots divider-top bg-navy-900 py-20 lg:py-28 scroll-mt-24 relative overflow-hidden">
        <x-ui.section-photo desktop="agents-van-desktop.webp" mobile="agents-van-mobile.webp" />
        <div class="container relative z-10">
            <x-ui.section-heading title="Questions owners ask" alignment="center" />

            <div class="max-w-3xl mx-auto space-y-4 reveal-up" x-data="{ open: null }">
                @foreach ($faqs as $i => $faq)
                    @php [$question, $answer, $dataLink] = $faq + [2 => false]; @endphp
                    <div class="card overflow-hidden">
                        <button type="button" @click="open = open === {{ $i }} ? null : {{ $i }}" :aria-expanded="open === {{ $i }}" class="w-full flex items-center justify-between gap-4 p-6 text-left">
                            <span class="text-lg font-semibold text-white">{{ $question }}</span>
                            <svg class="w-5 h-5 text-accent-400 flex-shrink-0 transition-transform" :class="open === {{ $i }} ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div x-show="open === {{ $i }}" x-transition x-cloak class="px-6 pb-6">
                            <p class="text-gray-300">{{ $answer }}</p>
                            @if ($dataLink)
                                <p class="mt-3"><a href="{{ route('your-data') }}" class="text-accent-400 hover:text-accent-300 font-medium">Your data, in plain English</a></p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <x-sections.cta
        title="Find the jobs an agent would do well"
        subtitle="The free audit is where we work out which jobs in your business suit an agent, which suit simpler automation, and which should stay with a person."
        ctaText="Book a free automation audit"
        :ctaUrl="$auditUrl"
        variant="gradient"
    />
</x-layout.app>
