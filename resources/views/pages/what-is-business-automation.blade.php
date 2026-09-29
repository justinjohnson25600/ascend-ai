@php $auditUrl = route('contact', ['type' => 'audit']); @endphp
<x-layout.app :title="$title" :description="$description">
    <x-sections.hero
        title="What is business automation?"
        subtitle="A plain answer, for people who have never had a reason to ask."
        :fullHeight="false"
    />

    {{-- The short answer --}}
    <section class="bg-navy-900 py-20 lg:py-28">
        <div class="container">
            <div class="max-w-3xl mx-auto">
                <h2 class="text-display-sm md:text-display-md font-bold gradient-text mb-8">The short answer</h2>
                <div class="space-y-6 text-lg text-gray-300 leading-relaxed">
                    <p>Business automation is getting software to do the repetitive parts of running your business, the way a good assistant would, without you having to be there. Not the whole job. The parts that follow a pattern: reading an enquiry and replying, chasing a quote, typing a receipt into the accounts, reminding a customer about tomorrow.</p>
                    <p>Until recently that meant expensive systems and a consultant to set them up, so it stayed with big companies. What changed is AI. Software can now read an email and understand what is being asked, not just move data from one box to another. That makes automation practical for a business of three people, not just three hundred.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- You don't know what you don't know --}}
    <section class="bg-navy-950 py-20 lg:py-28">
        <div class="container">
            <div class="max-w-3xl mx-auto">
                <h2 class="text-display-sm md:text-display-md font-bold gradient-text mb-8">You don't know what you don't know</h2>
                <div class="space-y-6 text-lg text-gray-300 leading-relaxed">
                    <p>Most owners never go looking for this, because nobody tells them it exists. The evenings on email. The receipts in a drawer. The enquiry that sat until Thursday. It just feels like what running a business is.</p>
                    <p>It isn't. It's the part that can be handed off.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- What if --}}
    <section class="bg-navy-900 py-20 lg:py-32 relative overflow-hidden">
        <div class="absolute top-1/4 -left-32 w-64 h-64 bg-accent-500/20 rounded-full blur-3xl animate-float"></div>
        <div class="absolute bottom-1/4 -right-32 w-96 h-96 bg-purple-500/10 rounded-full blur-3xl animate-float-delayed"></div>

        <div class="container relative z-10">
            <x-ui.section-heading
                title="What it looks like in a normal week"
                subtitle="Six things that are ordinary for businesses that have automation, and unimaginable for the ones that don't."
                alignment="center"
            />

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-5xl mx-auto">
                @foreach ([
                    ['email', 'What if your emails answered themselves?', 'Every email is read as it arrives. Routine ones get a proper reply, in your words. Anything that matters, a new customer, a complaint, a supplier problem, is sent to you by text so you can deal with it straight away. You open your inbox to find the routine work done and the important things already in your hand.'],
                    ['chat', 'What if the chat on your website did the same?', 'A visitor asks a question at 10pm. They get a real answer from your own information, not a script. If they want to book, or they need you, you get a text. Nobody waits until morning.'],
                    ['receipt', 'What if receipts filed themselves?', 'You photograph a receipt, or forward the email it came in on, and that is the end of your involvement. It is read, entered into your accounts system, put against the right category and matched to the bank. Anything that does not add up, a missing receipt, a payment with no invoice, a duplicate, is flagged to you now rather than found by your accountant in January.'],
                    ['missed-call', 'What if a missed call was not a lost customer?', 'You are on a job and the phone rings out. Within a minute the caller gets a text: sorry we missed you, what can we help with? It takes their details or books them in, and you get a summary when you surface.'],
                    ['quote', 'What if quotes chased themselves?', 'The quote goes out. A polite nudge follows a few days later, then another, on the schedule you set. You find out when they say yes, or when it is time for a personal call.'],
                    ['diary', 'What if tomorrow confirmed itself?', 'Appointments are confirmed the day before by text or email, with a link to move them if needed. The ones who do not turn up are followed up without anyone remembering to do it.'],
                ] as [$visual, $heading, $body])
                    <x-ui.card variant="glass" padding="lg" class="h-full border border-white/5 flex flex-col">
                        <div class="mb-6">
                            <x-dynamic-component :component="'vignettes.'.$visual" />
                        </div>
                        <h3 class="text-xl font-semibold text-white mb-3">{{ $heading }}</h3>
                        <p class="text-gray-300">{{ $body }}</p>
                    </x-ui.card>
                @endforeach
            </div>

            <div class="max-w-3xl mx-auto mt-16 text-center">
                <p class="text-2xl md:text-3xl font-bold gradient-text mb-6">That list is a typical first stage.</p>
                <p class="text-lg text-gray-300">Not a big project. A few weeks of work that takes the cost of a pair of hands off the business and gives you back the hours to do the work only you can do.</p>
            </div>
        </div>
    </section>

    {{-- What it is not --}}
    <section class="bg-navy-950 py-20 lg:py-24">
        <div class="container">
            <div class="max-w-3xl mx-auto">
                <h2 class="text-display-sm md:text-display-md font-bold gradient-text mb-8 text-center">What it is not</h2>
                <ul class="space-y-4">
                    @foreach ([
                        ['Not a robot replacing your staff.', 'It takes the repetitive parts out of their day, so the people you have can do the work that needs a person.'],
                        ['Not another app to log into.', 'It works inside the email, calendar and accounts software you already use.'],
                        ['Not a big IT project.', 'It arrives in stages. The first one is measured in weeks, and you see it working before anything else starts.'],
                        ['Not something that makes things up to your customers.', 'It answers from your information and hands over to a person when it should.'],
                    ] as [$lead, $rest])
                        <li class="flex items-start gap-4 p-5 rounded-xl bg-navy-800/60 border border-navy-700/50">
                            <svg class="w-6 h-6 text-accent-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            <p class="text-gray-200 text-lg"><span class="font-semibold text-white">{{ $lead }}</span> {{ $rest }}</p>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>

    {{-- Signs --}}
    <section class="bg-navy-900 py-20 lg:py-24">
        <div class="container">
            <div class="max-w-3xl mx-auto">
                <h2 class="text-display-sm md:text-display-md font-bold gradient-text mb-4 text-center">How to tell if this is for you</h2>
                <p class="text-gray-400 text-center mb-10">Honest answers only.</p>
                <ul class="space-y-3">
                    @foreach ([
                        'You answer emails after the kids are in bed.',
                        'You type the same customer details into more than one system.',
                        'There is a pile, a drawer or a shoebox of receipts somewhere.',
                        'An enquiry has waited more than a day because you were on a job.',
                        'You know you are busy, but not whether this month is profitable.',
                        'Taking on more work would mean hiring, and hiring feels like a bigger risk than staying small.',
                    ] as $sign)
                        <li class="flex items-start gap-4 p-4 rounded-xl bg-navy-800/40 border border-navy-700/40">
                            <svg class="w-6 h-6 text-accent-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            <span class="text-gray-200">{{ $sign }}</span>
                        </li>
                    @endforeach
                </ul>
                <p class="text-center text-lg text-gray-300 mt-10">If two of those are you, the audit is worth thirty minutes. If you want more detail first, <a href="{{ route('solutions') }}" class="text-accent-400 hover:text-accent-300">see what we automate</a> and <a href="{{ route('how-it-works') }}" class="text-accent-400 hover:text-accent-300">how it works</a>.</p>
            </div>
        </div>
    </section>

    <x-sections.cta
        title="Find out what could be handed off in your business"
        subtitle="A free 30 minute call. You leave with a written list, whether or not you go ahead."
        ctaText="Book a free automation audit"
        :ctaUrl="$auditUrl"
        variant="gradient"
    />
</x-layout.app>
