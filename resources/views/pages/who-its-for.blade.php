@php
    $auditUrl = route('contact', ['type' => 'audit']);
    $solutions = fn (string $anchor) => route('solutions').'#'.$anchor;

    // The carousel opens on our specialism; the other slides use the approved sector picker copy.
    $slides = [
        [
            'eyebrow' => 'Our specialism',
            'title' => 'Small building firms and trades',
            'graphic' => 'trades',
            'body' => 'Ascend AI is a UK company that specialises in automation for building firms and trades of 1 to 25 people. You do the work. We take the paperwork out of your evenings: receipts, CIS, VAT, quotes and pricing.',
            'points' => ['Receipts texted from site, filed in your accounts', 'CIS and VAT checked before you submit', 'Quotes priced from what jobs really cost', 'From one person and a van to a team of 25'],
            'ctaText' => 'Book a free automation audit',
            'ctaUrl' => $auditUrl,
            'secondaryCtaText' => 'What we do for builders',
            'secondaryCtaUrl' => '#specialism',
        ],
        [
            'eyebrow' => 'We also work with',
            'title' => 'Clinics and salons',
            'visual' => 'diary',
            'body' => 'Your diary is the business. A typical first stage looks like this.',
            'points' => ['Online booking with deposits and reminders', 'No-shows followed up and rebooked', 'Intake and consent forms completed before the appointment', 'Answers to the questions reception gets all day'],
            'ctaText' => 'Book a free automation audit',
            'ctaUrl' => $auditUrl,
            'secondaryCtaText' => 'See what we automate',
            'secondaryCtaUrl' => $solutions('scheduling'),
        ],
        [
            'eyebrow' => 'We also work with',
            'title' => 'Cafés, pubs and restaurants',
            'visual' => 'table-booking',
            'body' => 'Busy when your customers are, and short of hands. A typical first stage looks like this.',
            'points' => ['Table and event enquiries answered and booked', 'Review replies drafted for you to approve', 'Supplier orders built from stock counts', 'Rota questions answered from the rota'],
            'ctaText' => 'Book a free automation audit',
            'ctaUrl' => $auditUrl,
            'secondaryCtaText' => 'See what we automate',
            'secondaryCtaUrl' => $solutions('questions'),
        ],
        [
            'eyebrow' => 'We also work with',
            'title' => 'Agencies and consultancies',
            'visual' => 'onboarding',
            'body' => 'Your time is what you sell, so admin is lost revenue. A typical first stage looks like this.',
            'points' => ['Enquiries qualified and booked into discovery calls', 'New clients onboarded: agreement, forms and folders set up', 'Timesheets and project updates collected without chasing', 'Overdue invoices chased politely'],
            'ctaText' => 'Book a free automation audit',
            'ctaUrl' => $auditUrl,
            'secondaryCtaText' => 'See what we automate',
            'secondaryCtaUrl' => $solutions('enquiries'),
        ],
        [
            'eyebrow' => 'We also work with',
            'title' => 'Shops and online stores',
            'visual' => 'order-status',
            'body' => 'Customers want answers now, whatever the hour. A typical first stage looks like this.',
            'points' => ['"Where is my order?" answered from your order system', 'Returns handled to your policy', 'Low stock flagged before it runs out', 'A daily sales summary sent to your phone'],
            'ctaText' => 'Book a free automation audit',
            'ctaUrl' => $auditUrl,
            'secondaryCtaText' => 'See what we automate',
            'secondaryCtaUrl' => $solutions('questions'),
        ],
    ];

    // Checked against the published statistics on 30 September 2026; see $sources.
    $facts = [
        ['885,485', 'construction businesses in the UK, more than any other sector. Almost 98% have fewer than 10 employees.'],
        ['17%', 'of company insolvencies in England and Wales in the year to August 2026 were construction firms, more than any other sector.'],
        ['43%', 'more for building materials than in January 2021, on the government\'s all-work price index.'],
    ];

    // The three things building firms ask for most, each beside its animated example.
    $features = [
        [
            'id' => 'receipts',
            'visual' => 'receipts-in',
            'heading' => 'Receipts that file themselves',
            'problem' => 'Receipts in the van, in a drawer, in a pile of emails. Typed in on a Sunday, or handed to your accountant in a carrier bag.',
            'build' => 'Text a photo from site, forward the email, or keep using your spreadsheet. Each receipt is read, the VAT picked out, filed against the right job and category in the accounts software you already use, and matched to the bank. A card payment with no receipt is flagged within days, not found in January.',
            'yours' => 'Nothing you want to keep doing by hand. Making Tax Digital still expects you to keep your receipts, so a copy stays with every record.',
        ],
        [
            'id' => 'checks',
            'visual' => 'pre-check',
            'heading' => 'A second pair of eyes before anything goes to HMRC',
            'problem' => 'The CIS return is due on the 19th and the VAT return is never far behind. A mistake found after you submit costs more to put right than one found before.',
            'build' => 'Before each CIS return, VAT return or Making Tax Digital update, your records are checked. Subcontractors paid but not verified. Deductions that do not add up. Statements not sent. Invoices missing the reverse charge wording. VAT claimed on a receipt with no VAT number. Duplicates and gaps. You and your accountant get a short list of what to fix, in time to fix it.',
            'yours' => 'The submission. We check and flag; we never file anything or give tax advice. You or your accountant still submit.',
        ],
        [
            'id' => 'pricing',
            'visual' => 'job-review',
            'heading' => 'Pricing that learns from every job',
            'problem' => 'You find out a job was underpriced when it is finished, if you find out at all. The next one like it gets priced the same way.',
            'build' => 'It learns how you price: your day rates, your markup on materials, your rates per square metre, what you add for access or an awkward site. When a job is finished, it compares what you quoted with what the job really cost, from your receipts and your team\'s hours. If a job made less than it should have, it works out where, and suggests a pricing lesson for similar jobs. You approve it, and the next quote uses it.',
            'yours' => 'The price. It suggests; you decide.',
            'link' => [route('ai-agents'), 'How an agent learns from you'],
        ],
    ];

    $more = [
        ['Variations and extras', 'The extra agreed on site by text is priced, confirmed with the customer in writing, and added to the final invoice, not forgotten.', 'M12 6v6m0 0v6m0-6h6m-6 0H6'],
        ['Stage payments and retentions', 'Stage invoices go out as each stage is signed off, and get chased. Retentions, typically 3 to 5% of the job, are tracked to their release dates, so the second half is claimed when the defects period ends.', 'M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z'],
        ['Subcontractors and CIS', 'A reminder to verify each new subcontractor before their first payment, deductions worked out on every payment, and statements ready to send by the 19th. Paid nobody this month? You are reminded, because nil returns came back in April 2026.', 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z'],
        ['Getting paid on commercial work', 'On contracts covered by the Construction Act, the dates for payment notices and pay less notices are tracked, and you are reminded before each one passes.', 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
        ['Enquiries and site visits', 'Missed calls texted back within a minute. Enquiries asked the questions you would ask: where, what, when, and a few photos. Site visits booked into your diary.', 'M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z'],
        ['Certificates and renewals', 'Building regulations notifications for Part P and gas work, due within 30 days of finishing, prompted when the job is marked done. Waste transfer notes filed. Insurance, van and card renewals reminded in time.', 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z'],
    ];

    $calendar = [
        ['Every month', 'If you pay subcontractors', 'CIS return by the 19th. Deductions paid to HMRC by the 22nd. Statements to your subcontractors by the 19th. And since 6 April 2026, a nil return if you paid nobody, unless you told HMRC in advance. Late returns cost £100 the day after, and more from there.', 'text-accent-300 bg-accent-500/10 border-accent-400/30'],
        ['Every quarter', 'If Making Tax Digital applies to you', 'Updates by 7 August, 7 November, 7 February and 7 May. It started on 6 April 2026 for sole traders and landlords with qualifying income over £50,000 in 2024-25. Over £30,000 joins in April 2027, and over £20,000 in April 2028.', 'text-purple-300 bg-purple-400/10 border-purple-400/30'],
        ['Every VAT period', 'If you are VAT registered', 'Returns through software, usually due one month and seven days after the period ends. Reverse charge invoices worded correctly, with no VAT charged on them.', 'text-emerald-300 bg-emerald-400/10 border-emerald-400/30'],
        ['Every year', 'And for years after', 'Tax return by 31 January. Receipts kept for at least five years after that deadline if you are a sole trader, and six years from the year end for a company.', 'text-amber-200 bg-amber-400/10 border-amber-400/30'],
    ];

    $faqs = [
        ['Are you accountants?', 'No. We build the automation that keeps your records right as you go and checks them before anything is submitted. Your accountant still prepares and files your returns, and gets tidier records to work from.'],
        ['I am a subcontractor, not a contractor. Is this for me?', 'Yes. Your side of CIS is making sure the deductions on your statements match what you were paid, so you can claim them back: on your tax return as a sole trader, or each month as a limited company. That is exactly the kind of checking automation does well.'],
        ['I keep my receipts in a spreadsheet. Is that a problem?', 'No. It can read the spreadsheet you already keep. Spreadsheets are allowed for Making Tax Digital as long as they are linked to the software that sends your updates rather than copied across by hand, and automation can make that link.'],
        ['Does Making Tax Digital for Income Tax apply to me yet?', 'If you are a sole trader or landlord and your qualifying income was over £50,000 in 2024-25, it started on 6 April 2026. Qualifying income is your turnover before expenses, not your profit. Over £30,000 in 2025-26 means April 2027, and over £20,000 in 2026-27 means April 2028. HMRC has a checker on gov.uk.', ['https://www.gov.uk/guidance/check-if-youre-eligible-for-making-tax-digital-for-income-tax', 'HMRC\'s Making Tax Digital checker']],
        ['It is just me and a van. Is that too small?', 'No. One person and a van is where the evenings on paperwork hurt most. At the other end, if you are bigger than 25 people, talk to us anyway and we will tell you honestly whether we are the right fit.'],
        ['I am not a building firm. Can you still help?', 'Yes. Building firms and trades are our specialism, not our only customers. We work with other owner-run businesses too, from clinics and salons to agencies, cafés and shops.', [route('solutions'), 'See what we automate']],
    ];

    $sources = [
        ['Business population estimates 2025, table 5', 'https://www.gov.uk/government/statistics/business-population-estimates-2025'],
        ['Company insolvencies, August 2026 (cases where the industry was recorded)', 'https://www.gov.uk/government/statistics/company-insolvencies-august-2026/commentary-company-insolvency-statistics-august-2026'],
        ['Building materials price index, August 2026 release, table 1a (July 2026 provisional)', 'https://www.gov.uk/government/statistics/building-materials-and-components-statistics-august-2026--2'],
        ['CIS returns, payment dates and penalties', 'https://www.gov.uk/what-you-must-do-as-a-cis-contractor/file-your-monthly-returns'],
        ['CIS nil returns from 6 April 2026 (SI 2026/289)', 'https://www.legislation.gov.uk/uksi/2026/289/made'],
        ['Verifying subcontractors', 'https://www.gov.uk/what-you-must-do-as-a-cis-contractor/verify-subcontractors'],
        ['VAT domestic reverse charge', 'https://www.gov.uk/guidance/vat-reverse-charge-technical-guide'],
        ['VAT return deadlines', 'https://www.gov.uk/vat-returns/deadlines'],
        ['Making Tax Digital for Income Tax: who and when', 'https://www.gov.uk/guidance/check-if-youre-eligible-for-making-tax-digital-for-income-tax'],
        ['Making Tax Digital quarterly updates', 'https://www.gov.uk/guidance/use-making-tax-digital-for-income-tax/send-quarterly-updates'],
        ['Making Tax Digital digital records and receipts', 'https://www.gov.uk/guidance/use-making-tax-digital-for-income-tax/create-digital-records'],
        ['How long to keep records', 'https://www.gov.uk/self-employed-records/how-long-to-keep-your-records'],
        ['Retentions and late payment', 'https://www.gov.uk/government/consultations/late-payments-tackling-poor-payment-practices/late-payments-consultation-tackling-poor-payment-practices'],
        ['Building regulations notifications under a competent person scheme', 'https://www.legislation.gov.uk/uksi/2010/2214/regulation/20'],
    ];
@endphp
<x-layout.app :title="$title" :description="$description">
    {{-- Who it's for: opens on our specialism, then the other businesses we work with --}}
    <x-sections.hero-carousel :slides="$slides" label="Who we work with" />

    {{-- Why we specialise --}}
    <section id="specialism" class="texture-glow divider-top bg-navy-900 py-20 lg:py-28 scroll-mt-32 relative overflow-hidden">
        <x-ui.section-photo desktop="who-site-office-desktop.webp" mobile="who-site-office-mobile.webp" />
        <div class="container relative z-10">
            <div class="max-w-3xl mx-auto">
                <h2 class="text-display-sm md:text-display-md font-bold gradient-text mb-8 reveal-up">Why we specialise in building firms and trades</h2>
                <div class="space-y-6 text-lg text-gray-300 leading-relaxed reveal-up">
                    <p>Few small businesses carry as much paperwork as a building firm, and none have less time for it. A monthly CIS return. Reverse charge VAT. Stage payments, retentions and variations. And since April 2026, Making Tax Digital updates every quarter for many sole traders. All of it done after a day on site.</p>
                    <p>So that is where we specialise. We know what a CIS statement is, why a reverse charge invoice has no VAT on it, and why the extra socket agreed on Tuesday needs to be on Friday's invoice. You will not have to explain your business to us from scratch.</p>
                </div>
            </div>

            <div class="max-w-5xl mx-auto mt-14 grid grid-cols-1 md:grid-cols-3 gap-6 reveal-stagger">
                @foreach ($facts as [$figure, $text])
                    <div class="h-full p-7 rounded-2xl bg-navy-800/60 border border-navy-700/50">
                        <p class="text-4xl md:text-5xl font-bold gradient-text mb-3 tabular-nums">{{ $figure }}</p>
                        <p class="text-gray-300">{{ $text }}</p>
                    </div>
                @endforeach
            </div>

            <p class="max-w-3xl mx-auto mt-10 text-center text-lg text-gray-300 reveal-up">Thin margins, fixed prices and rising costs leave little room for an underpriced job or a missed receipt. That is why pricing and paperwork are where we start.</p>
        </div>
    </section>

    {{-- The three things building firms ask for most --}}
    @foreach ($features as $i => $feature)
        <section id="{{ $feature['id'] }}" class="{{ $i % 2 === 0 ? 'bg-navy-950' : 'bg-navy-900' }} divider-top py-20 lg:py-28 scroll-mt-32 relative overflow-hidden">
            <div class="absolute {{ $i % 2 === 0 ? '-right-40' : '-left-40' }} top-1/3 w-96 h-96 rounded-full blur-3xl {{ $i % 2 === 0 ? 'bg-accent-500/10' : 'bg-purple-500/10' }} pointer-events-none"></div>

            <div class="container relative">
                <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                    <div class="{{ $i % 2 === 1 ? 'lg:order-last' : '' }} reveal-up">
                        <div class="flex items-center gap-4 mb-8">
                            <span class="flex-shrink-0 w-12 h-12 flex items-center justify-center bg-accent-500 rounded-full font-bold text-lg text-white">
                                {{ str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT) }}
                            </span>
                            <h2 class="text-3xl md:text-4xl font-bold text-white">{{ $feature['heading'] }}</h2>
                        </div>

                        <p class="text-xs uppercase tracking-wider text-accent-400 mb-2">The problem</p>
                        <p class="text-lg text-gray-300 mb-8">{{ $feature['problem'] }}</p>

                        <x-ui.card variant="glass" padding="lg" class="border border-accent-500/20">
                            <p class="text-xs uppercase tracking-wider text-accent-400 mb-3">What we build</p>
                            <p class="text-gray-200 mb-6">{{ $feature['build'] }}</p>
                            <p class="text-xs uppercase tracking-wider text-gray-500 mb-2">What stays with you</p>
                            <p class="text-gray-400">{{ $feature['yours'] }}</p>
                            @isset($feature['link'])
                                <p class="mt-5"><a href="{{ $feature['link'][0] }}" class="text-accent-400 hover:text-accent-300 font-medium">{{ $feature['link'][1] }}</a></p>
                            @endisset
                        </x-ui.card>
                    </div>

                    <div class="reveal-up stagger-2">
                        <x-dynamic-component :component="'vignettes.'.$feature['visual']" />
                    </div>
                </div>
            </div>
        </section>
    @endforeach

    {{-- More of the paperwork --}}
    <section class="texture-dots divider-top bg-navy-950 py-20 lg:py-28">
        <div class="container">
            <x-ui.section-heading
                title="More of the paperwork, handled"
                subtitle="The jobs that come with running a building firm, not just any business."
                alignment="center"
            />

            <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 reveal-stagger">
                @foreach ($more as [$heading, $body, $icon])
                    <div class="h-full p-7 rounded-2xl bg-navy-800/60 border border-navy-700/50">
                        <span class="w-11 h-11 mb-5 flex items-center justify-center rounded-lg bg-accent-500/15 text-accent-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icon }}"/></svg>
                        </span>
                        <h3 class="text-lg font-semibold text-white mb-2">{{ $heading }}</h3>
                        <p class="text-gray-400">{{ $body }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- The paperwork calendar --}}
    <section id="deadlines" class="texture-glow divider-top bg-navy-900 py-20 lg:py-28 scroll-mt-32">
        <div class="container">
            <x-ui.section-heading
                title="The paperwork calendar"
                subtitle="What HMRC expects from a building firm, and when. The rules changed again in April 2026."
                alignment="center"
            />

            <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-6 reveal-stagger">
                @foreach ($calendar as [$when, $who, $what, $tagClass])
                    <div class="h-full p-7 rounded-2xl bg-navy-800/60 border border-navy-700/50">
                        <div class="flex flex-wrap items-center gap-3 mb-4">
                            <span class="text-sm font-semibold rounded-full border px-3 py-1 {{ $tagClass }}">{{ $when }}</span>
                            <span class="text-sm text-gray-400">{{ $who }}</span>
                        </div>
                        <p class="text-gray-200">{{ $what }}</p>
                    </div>
                @endforeach
            </div>

            <div class="max-w-5xl mx-auto mt-6 rounded-2xl border border-accent-500/30 bg-accent-500/10 p-7 flex flex-col md:flex-row md:items-center gap-4 reveal-up">
                <p class="text-xl font-bold text-white md:w-1/3">It is turnover, not profit.</p>
                <p class="text-gray-200 md:w-2/3">Making Tax Digital counts your income before expenses. A sole trader who turned over £60,000 in 2024-25, with £35,000 profit after materials and costs, has been in it since April 2026. Automation keeps your records right every quarter, not just once a year.</p>
            </div>
        </div>
    </section>

    {{-- Who we work with --}}
    <section class="texture-dots divider-top bg-navy-950 py-20 lg:py-28">
        <div class="container">
            <x-ui.section-heading title="Who we work with" alignment="center" />

            <ul class="max-w-5xl mx-auto mb-10 flex flex-wrap justify-center gap-2 reveal-stagger" aria-label="Trades we work with">
                @foreach (['Builders', 'Electricians', 'Plumbing and heating', 'Roofers', 'Joiners and carpenters', 'Plasterers and decorators', 'Groundworkers and landscapers', 'Kitchen and bathroom fitters'] as $trade)
                    <li class="rounded-full border border-white/10 bg-navy-800/70 px-3.5 py-1.5 text-sm text-gray-200">{{ $trade }}</li>
                @endforeach
            </ul>

            <div class="max-w-5xl mx-auto grid grid-cols-1 lg:grid-cols-5 gap-6">
                <ul class="lg:col-span-3 grid grid-cols-1 sm:grid-cols-2 gap-4 reveal-stagger">
                    @foreach ([
                        'Sole traders, partnerships and limited companies.',
                        'Main contractors who pay subcontractors, and subcontractors paid under CIS.',
                        'Domestic customers, commercial clients, or both.',
                        'From one person and a van to a team of 25.',
                    ] as $line)
                        <li class="card-glass p-5 flex items-start gap-3">
                            <svg class="w-5 h-5 text-accent-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            <span class="text-gray-200">{{ $line }}</span>
                        </li>
                    @endforeach
                </ul>

                <div class="lg:col-span-2 h-full p-7 rounded-2xl bg-navy-800/60 border border-navy-700/50 reveal-up stagger-2">
                    <h3 class="text-lg font-semibold text-white mb-2">Not a building firm?</h3>
                    <p class="text-gray-400 mb-5">Building firms and trades are our specialism, not our only customers. We work with other owner-run businesses too, from clinics and salons to agencies, cafés and shops.</p>
                    <a href="{{ route('solutions') }}" class="text-accent-400 hover:text-accent-300 font-medium">See what we automate</a>
                </div>
            </div>
        </div>
    </section>

    {{-- What stays with you --}}
    <section class="texture-glow divider-top bg-navy-900 py-20 lg:py-24 relative overflow-hidden">
        <x-ui.section-photo desktop="who-home-on-time-desktop.webp" mobile="who-home-on-time-mobile.webp" />
        <div class="container relative z-10">
            <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-6 text-center reveal-stagger">
                @foreach ([
                    ['You price the work.', 'It learns your pricing and suggests changes. The number on the quote is always yours.'],
                    ['You approve the changes.', 'Nothing about how your business deals with customers, prices or money changes without your yes.'],
                    ['Your accountant files the returns.', 'We check and flag. We never file anything or give tax advice.'],
                ] as [$heading, $body])
                    <div class="p-7 rounded-2xl bg-navy-800/60 border border-navy-700/50">
                        <p class="text-xl font-bold gradient-text mb-3">{{ $heading }}</p>
                        <p class="text-gray-300">{{ $body }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- FAQ --}}
    <section id="faq" class="texture-dots divider-top bg-navy-950 py-20 lg:py-28 scroll-mt-24">
        <div class="container">
            <x-ui.section-heading title="Questions builders ask" alignment="center" />

            <div class="max-w-3xl mx-auto space-y-4 reveal-up" x-data="{ open: null }">
                @foreach ($faqs as $i => $faq)
                    @php [$question, $answer, $link] = $faq + [2 => null]; @endphp
                    <div class="card overflow-hidden">
                        <button type="button" @click="open = open === {{ $i }} ? null : {{ $i }}" :aria-expanded="open === {{ $i }}" class="w-full flex items-center justify-between gap-4 p-6 text-left">
                            <span class="text-lg font-semibold text-white">{{ $question }}</span>
                            <svg class="w-5 h-5 text-accent-400 flex-shrink-0 transition-transform" :class="open === {{ $i }} ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div x-show="open === {{ $i }}" x-transition x-cloak class="px-6 pb-6">
                            <p class="text-gray-300">{{ $answer }}</p>
                            @if ($link)
                                <p class="mt-3"><a href="{{ $link[0] }}" class="text-accent-400 hover:text-accent-300 font-medium" @if (str_starts_with($link[0], 'https://www.gov.uk')) target="_blank" rel="noopener noreferrer" @endif>{{ $link[1] }}</a></p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Sources for the rules and figures on this page --}}
    <section class="bg-navy-950 border-t border-navy-800 py-12">
        <div class="container">
            <div class="max-w-5xl mx-auto">
                <h2 class="text-sm uppercase tracking-wider text-gray-500 mb-4 reveal-up">Sources, checked 30 September 2026</h2>
                <ul class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-2 text-sm reveal-stagger">
                    @foreach ($sources as [$label, $url])
                        <li><a href="{{ $url }}" target="_blank" rel="noopener noreferrer" class="text-gray-400 hover:text-accent-300 underline decoration-gray-600 underline-offset-2">{{ $label }}</a></li>
                    @endforeach
                </ul>
                <p class="mt-4 text-sm text-gray-500 reveal-up">This page describes the rules in general. It is not tax or legal advice; your accountant can tell you how they apply to you.</p>
            </div>
        </div>
    </section>

    <x-sections.cta
        title="Get your evenings back"
        subtitle="Book a free automation audit. Thirty minutes on a call, and a written list of what could come off your plate, from receipts to CIS to pricing."
        ctaText="Book a free automation audit"
        :ctaUrl="$auditUrl"
        variant="gradient"
    />
</x-layout.app>
