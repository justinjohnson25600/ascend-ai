@php $auditUrl = route('contact', ['type' => 'audit']); @endphp
<x-layout.app :title="$title" :description="$description">
    {{-- Hero --}}
    <x-sections.hero
        title="Run your business on autopilot, not overtime."
        subtitle="Ascend AI builds AI automation for small businesses. Not off-the-shelf software you have to fit around. Systems built for the way you already work, that take the repetitive jobs off your desk and keep running while you get on with the business."
        ctaText="Book a free automation audit"
        :ctaUrl="$auditUrl"
        secondaryCtaText="See what we automate"
        :secondaryCtaUrl="route('solutions')"
        note="30 minutes. No obligation. You leave with a written list of what could be automated in your business."
        :fullHeight="true"
    />

    {{-- The problem --}}
    <section class="bg-navy-900 py-20 lg:py-32 section-droid-bg relative overflow-hidden">
        <video class="section-droid-video" autoplay muted loop playsinline poster="{{ asset('images/droid.webp') }}">
            <source src="{{ asset('video/andriod-p.mp4') }}" type="video/mp4">
        </video>
        <div class="absolute inset-0 bg-gradient-to-b from-navy-950/60 via-transparent to-navy-950/60 pointer-events-none"></div>

        <div class="container relative z-10">
            <x-ui.section-heading
                title="The work that never makes it onto the invoice"
                alignment="center"
                class="reveal-up"
            />

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-5xl mx-auto">
                <div class="reveal-up stagger-1">
                    <div class="h-full p-8 rounded-2xl bg-navy-800/60 border border-navy-700/50 backdrop-blur-sm">
                        <h3 class="text-xl font-semibold text-white mb-3">The admin never stops</h3>
                        <p class="text-gray-300">Enquiries answered at 9pm. Quotes chased on a Sunday. The same customer details typed into your diary, your accounts package and a spreadsheet. None of it is billable and all of it lands on you.</p>
                    </div>
                </div>
                <div class="reveal-up stagger-2">
                    <div class="h-full p-8 rounded-2xl bg-navy-800/60 border border-navy-700/50 backdrop-blur-sm">
                        <h3 class="text-xl font-semibold text-white mb-3">You are the bottleneck</h3>
                        <p class="text-gray-300">If a job needs your say-so, it waits until you are free. Customers wait. Staff wait. Growth waits, because taking on more work means more of the same evenings.</p>
                    </div>
                </div>
                <div class="reveal-up stagger-3">
                    <div class="h-full p-8 rounded-2xl bg-navy-800/60 border border-navy-700/50 backdrop-blur-sm">
                        <h3 class="text-xl font-semibold text-white mb-3">Software that made more work</h3>
                        <p class="text-gray-300">You bought the CRM. The booking app. The accounts add-on. Now there are four logins, none of them talk to each other, and somebody still has to copy things between them.</p>
                    </div>
                </div>
            </div>

            <p class="text-center mt-16 text-2xl md:text-3xl font-bold gradient-text reveal-up">None of this needs a bigger team. It needs the repetitive parts done for you.</p>
            <p class="text-center mt-6 text-gray-400 reveal-up">New to all this? <a href="{{ route('what-is-business-automation') }}" class="text-accent-400 hover:text-accent-300">Start with what business automation actually is</a>.</p>
        </div>
    </section>

    {{-- What we automate --}}
    <section class="bg-navy-950 py-20 lg:py-32 relative overflow-hidden">
        <div class="absolute top-1/4 -left-32 w-64 h-64 bg-accent-500/20 rounded-full blur-3xl animate-float"></div>
        <div class="absolute bottom-1/4 -right-32 w-96 h-96 bg-purple-500/10 rounded-full blur-3xl animate-float-delayed"></div>

        <div class="container relative z-10">
            <x-ui.section-heading
                title="Built around the jobs that eat your week"
                subtitle="Every business is different, so we start with what costs you the most time. These are the areas we are asked about most."
                alignment="center"
                class="reveal-up"
            />

            @php
                $areas = [
                    ['enquiries', 'Enquiries and follow-up', 'Every enquiry answered fast, qualified, and followed up until it becomes a booking or a polite no.', 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z'],
                    ['quotes', 'Quotes and invoicing', 'Quotes drafted from your pricing, sent, chased, and turned into invoices when the job is done.', 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'],
                    ['scheduling', 'Scheduling and reminders', 'Bookings, confirmations, reschedules and reminders handled without anyone picking up the phone.', 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'],
                    ['questions', 'Customer questions', 'The questions you answer twenty times a week, answered accurately from your own information, day and night.', 'M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z'],
                    ['paperwork', 'Paperwork and data entry', 'Details captured once and pushed to every system that needs them.', 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4'],
                    ['reporting', 'Reporting', 'The numbers you want on a Monday morning, in your inbox, without building the spreadsheet.', 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z'],
                ];
            @endphp

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-6xl mx-auto">
                @foreach ($areas as $i => [$anchor, $heading, $body, $icon])
                    <a href="{{ route('solutions') }}#{{ $anchor }}" class="reveal-up stagger-{{ ($i % 3) + 1 }} group block h-full">
                        <x-ui.card variant="glass" padding="lg" class="h-full border border-white/5 group-hover:border-accent-500/30 transition-all duration-300">
                            <div class="w-12 h-12 mb-5 flex items-center justify-center bg-accent-500/20 rounded-lg group-hover:bg-accent-500/30 transition-colors">
                                <svg class="w-6 h-6 text-accent-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icon }}"/></svg>
                            </div>
                            <h3 class="text-xl font-semibold text-white mb-2 group-hover:text-accent-400 transition-colors">{{ $heading }}</h3>
                            <p class="text-gray-400">{{ $body }}</p>
                        </x-ui.card>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Why bespoke --}}
    <section class="bg-navy-900 py-20 lg:py-32">
        <div class="container">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 max-w-6xl mx-auto items-center">
                <div class="reveal-up">
                    <h2 class="text-display-md md:text-display-lg font-bold gradient-text mb-6">We don't make your business fit the software</h2>
                    <p class="text-gray-300 text-lg mb-4">Most automation tools are built for an average business. Yours is not average. Your pricing has exceptions. Your best customers get treated differently. Your diary has rules that only you know.</p>
                    <p class="text-gray-300 text-lg">So we don't sell a package. We look at how you work, find the parts that repeat, and build automation that follows your rules. It runs alongside the tools you already use, and you keep working the way you want to.</p>
                </div>
                <div class="reveal-up stagger-2">
                    <ul class="space-y-4">
                        @foreach ([
                            'Built on how you operate today, not a template',
                            'Works with the software you already pay for',
                            'Delivered in stages, so something useful is live early',
                            'Kept running, monitored and improved by us',
                        ] as $point)
                            <li class="flex items-start gap-4 p-5 rounded-xl bg-navy-800/60 border border-navy-700/50">
                                <svg class="w-6 h-6 text-accent-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                <span class="text-gray-200 text-lg">{{ $point }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>

    {{-- How it works --}}
    <section class="bg-navy-950 py-20 lg:py-32">
        <div class="container">
            <x-ui.section-heading
                title="From first call to running in the background"
                alignment="center"
                class="reveal-up"
            />

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-5xl mx-auto">
                @foreach ([
                    ['Audit', 'A 30 minute call about how your business runs and where the hours go. You get a written list of what could be automated and what we would do first. Free, whether or not you go ahead.'],
                    ['Build in stages', 'We scope the first stage, agree a fixed price for it, and build. It goes live. You see it working before the next stage starts.'],
                    ['Run and improve', 'We host it, monitor it, fix it when your suppliers change their systems, and keep adding to it as your business changes.'],
                ] as $i => [$heading, $body])
                    <div class="reveal-up stagger-{{ $i + 1 }} flex gap-5">
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

            <div class="text-center mt-14 reveal-up">
                <a href="{{ route('how-it-works') }}" class="btn btn-ghost px-8 py-4">How it works and what it costs</a>
            </div>
        </div>
    </section>

    {{-- Final CTA --}}
    <x-sections.cta
        title="Find out what is costing you hours"
        subtitle="Book a free automation audit. Thirty minutes on a call, no slides, no obligation. You will come away with a list of what could be automated in your business and a rough order to do it in."
        ctaText="Book a free automation audit"
        :ctaUrl="$auditUrl"
        variant="gradient"
    />

    @push('scripts')
    <script>
        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('revealed');
                    revealObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.reveal-up').forEach((el) => revealObserver.observe(el));
    </script>
    @endpush
</x-layout.app>
