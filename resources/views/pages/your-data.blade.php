@php
    // Copy approved in CONTENT_BLUEPRINT_V2, item 14. Keep in step with the Privacy Policy and Terms.
    $auditUrl = route('contact', ['type' => 'audit']);
    $access = [
        ['Email inbox', 'To read and answer enquiries and route what matters to you.', 'A permission you grant in your email account.'],
        ['Calendar', 'To book, move and remind.', 'A permission you grant.'],
        ['Accounts software', 'To file receipts, raise and chase invoices, and match payments.', 'A connection you approve inside the accounts software.'],
        ['Website forms and chat', 'To answer and capture enquiries.', 'Added to your site with your agreement.'],
        ['Phone and text provider', 'To text back missed calls and send reminders.', 'An account in your name, or one we manage for you.'],
    ];
@endphp
<x-layout.app :title="$title" :description="$description">
    <x-sections.hero
        title="Your data, in plain English"
        subtitle="What we touch, where it goes, and what we never do with it."
        :fullHeight="false"
    >
        <x-slot:visual>
            <x-graphics.data-flow />
        </x-slot:visual>
    </x-sections.hero>

    {{-- The short version --}}
    <section class="texture-glow divider-top bg-navy-900 py-20 lg:py-24">
        <div class="container">
            <div class="max-w-3xl mx-auto">
                <h2 class="text-3xl md:text-4xl font-bold gradient-text mb-8">The short version</h2>
                <ul class="space-y-4">
                    @foreach ([
                        'Your data stays in your systems wherever the design allows.',
                        'We only access what a stage needs, using permissions you grant and can take back at any time.',
                        'The AI providers we use are not allowed to train their models on your data.',
                        'You own the automation we build for you.',
                        'When you leave, we hand it over and delete what we hold.',
                    ] as $point)
                        <li class="flex items-start gap-4 p-5 rounded-xl bg-navy-800/60 border border-navy-700/50">
                            <svg class="w-6 h-6 text-emerald-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            <span class="text-gray-200 text-lg">{{ $point }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>

    {{-- What we might access --}}
    <section class="texture-dots divider-top bg-navy-950 py-20 lg:py-24">
        <div class="container">
            <div class="max-w-5xl mx-auto">
                <h2 class="text-3xl md:text-4xl font-bold gradient-text mb-8 text-center">What we might access, and why</h2>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-navy-700">
                                <th scope="col" class="py-4 pr-6 text-sm uppercase tracking-wider text-gray-500 font-medium">System</th>
                                <th scope="col" class="py-4 pr-6 text-sm uppercase tracking-wider text-gray-500 font-medium">Why</th>
                                <th scope="col" class="py-4 text-sm uppercase tracking-wider text-gray-500 font-medium">How access works</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-300">
                            @foreach ($access as [$system, $why, $how])
                                <tr class="border-b border-navy-800 last:border-0">
                                    <th scope="row" class="py-5 pr-6 font-semibold text-white whitespace-nowrap">{{ $system }}</th>
                                    <td class="py-5 pr-6">{{ $why }}</td>
                                    <td class="py-5">{{ $how }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    {{-- Where it goes, never, wrong, leaving --}}
    <section class="texture-glow divider-top bg-navy-900 py-20 lg:py-24">
        <div class="container">
            <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-6">
                <x-ui.card variant="glass" padding="lg" class="md:col-span-2 border border-white/5">
                    <h2 class="text-2xl font-bold text-white mb-4">Where it goes</h2>
                    <p class="text-gray-300 leading-relaxed">Automation runs on hosting we manage. When a step needs AI, the part of the message it needs is sent to the AI provider named in your scope, which reads it and sends back an answer. Their terms do not allow them to train on it. Some providers process data outside the UK; where they do, the transfer is covered by the UK's adequacy rules or the International Data Transfer Agreement, and you can ask for UK or EU processing only.</p>
                </x-ui.card>

                <x-ui.card variant="glass" padding="lg" class="border border-white/5">
                    <h2 class="text-2xl font-bold text-white mb-4">What we never do</h2>
                    <ul class="space-y-3">
                        @foreach ([
                            "Sell your data or your customers' data.",
                            "Use your customers' details for our own marketing.",
                            'Train our own AI models on your data.',
                            'Keep copies we do not need.',
                        ] as $never)
                            <li class="flex items-start gap-3 text-gray-300">
                                <svg class="w-5 h-5 text-red-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                <span>{{ $never }}</span>
                            </li>
                        @endforeach
                    </ul>
                </x-ui.card>

                <div class="space-y-6">
                    <x-ui.card variant="glass" padding="lg" class="border border-white/5">
                        <h2 class="text-2xl font-bold text-white mb-4">If something goes wrong</h2>
                        <p class="text-gray-300">We monitor what we build, so we usually know first. If personal data is affected we tell you without delay, and help you tell the Information Commissioner's Office where the law requires it.</p>
                    </x-ui.card>

                    <x-ui.card variant="glass" padding="lg" class="border border-white/5">
                        <h2 class="text-2xl font-bold text-white mb-4">When you leave</h2>
                        <p class="text-gray-300">Either of us can end the monthly service with 30 days' notice. We hand over what we built with documentation, remove our access, and delete or return your data as you instruct.</p>
                    </x-ui.card>
                </div>
            </div>

            <p class="max-w-3xl mx-auto text-center text-gray-400 mt-12">The detail is in our <a href="{{ route('privacy-policy') }}" class="text-accent-400 hover:text-accent-300">Privacy Policy</a>, and every client gets a data processing agreement on request.</p>
        </div>
    </section>

    <x-sections.cta
        title="Questions about your data?"
        subtitle="Ask them on the audit call. We will go through exactly what a first stage would touch."
        ctaText="Book a free automation audit"
        :ctaUrl="$auditUrl"
    />
</x-layout.app>
