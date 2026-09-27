@php($auditUrl = route('contact', ['type' => 'audit']))
<x-layout.app :title="$title" :description="$description">
    <x-sections.hero
        title="Built by people who run small businesses"
        subtitle="We didn't come to automation from a software company. We came to it from doing the admin ourselves."
        :ctaText="null"
        :fullHeight="false"
    />

    {{-- Why we exist --}}
    <section class="bg-navy-900 py-20 lg:py-32">
        <div class="container">
            <div class="max-w-3xl mx-auto">
                <h2 class="text-display-sm md:text-display-md font-bold gradient-text mb-8">Why we exist</h2>
                <div class="space-y-6 text-lg text-gray-300 leading-relaxed">
                    <p>Ascend AI started because the founder runs several small businesses and got tired of the same problem in each one. Good work, decent customers, and every spare hour eaten by tasks that did not need a person.</p>
                    <p>The tools on offer were built for companies with an IT department. They needed weeks of setup, a consultant to change anything, and they still expected the business to work their way.</p>
                    <p>So we built automation around our own businesses instead. Systems that followed our rules, connected to the software we already had, and quietly did the repetitive work. Then other owners asked for the same. Ascend AI is that, offered properly.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Principles --}}
    <section class="bg-navy-950 py-20 lg:py-32">
        <div class="container">
            <x-ui.section-heading title="How we work" alignment="center" />

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-6xl mx-auto">
                @foreach ([
                    ['Built around you', 'We start with how your business runs, not with a product we want to sell.'],
                    ['Plain English', 'You will always know what it does, what it costs and what happens next. If we cannot explain it simply, we have not understood it yet.'],
                    ['Live early, then better', 'Something useful is running in weeks. Then it grows. No six-month projects that launch all at once.'],
                    ['Kept running', 'Automation is not a one-off. Suppliers change things, your business changes things. We stay on it.'],
                    ['No hype', 'AI is good at some jobs and hopeless at others. We tell you which is which, including when the answer is "don\'t automate that".'],
                ] as [$heading, $body])
                    <x-ui.card variant="glass" padding="lg" class="h-full border border-white/5">
                        <h3 class="text-xl font-semibold text-white mb-3">{{ $heading }}</h3>
                        <p class="text-gray-400">{{ $body }}</p>
                    </x-ui.card>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Who you'll deal with --}}
    <section class="bg-navy-900 py-20 lg:py-24">
        <div class="container">
            <div class="max-w-3xl mx-auto">
                <h2 class="text-display-sm md:text-display-md font-bold gradient-text mb-8">Who you'll deal with</h2>
                <x-ui.card variant="default" padding="lg">
                    <h3 class="text-xl font-semibold text-white mb-3">Justin Johnson, founder</h3>
                    <p class="text-gray-300 mb-4">Justin runs several small businesses of his own, across manufacturing, health services and software. Ascend AI grew out of the automation he built to keep those running without a back office.</p>
                    <p class="text-gray-400">You deal with the people who build it. No account managers, no handoffs.</p>
                </x-ui.card>
            </div>
        </div>
    </section>

    <x-sections.cta
        title="See what this looks like in your business"
        ctaText="Book a free automation audit"
        :ctaUrl="$auditUrl"
    />
</x-layout.app>
