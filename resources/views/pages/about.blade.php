<x-layout.app :title="$title" :description="$description">
    {{-- Hero Section --}}
    <x-sections.hero
        :title="'Why Ascend AI Exists'"
        :subtitle="'The economics of business have changed. We\'re building the companies that prove it.'"
        :fullHeight="false"
    />

    {{-- The Thesis Section --}}
    <section class="bg-navy-900 py-20 lg:py-32">
        <div class="container">
            <div class="max-w-3xl mx-auto">
                <x-ui.section-heading
                    title="A Simple Observation. A Radical Conclusion."
                    alignment="left"
                />

                <div class="prose prose-lg prose-invert max-w-none">
                    <p class="text-gray-300 leading-relaxed mb-6">
                        For decades, the cost of building and running a software company was dominated by one factor: <span class="text-white font-semibold">people</span>.
                    </p>

                    <p class="text-gray-300 leading-relaxed mb-6">
                        Developers to write the code. Support staff to answer the queries. Administrators to keep the servers running. Managers to coordinate them all. Each person represented not just a salary, but holiday entitlement, pension contributions, sick leave, training costs, and the ever-present risk that they might leave—taking institutional knowledge with them.
                    </p>

                    <p class="text-gray-300 leading-relaxed mb-6">
                        Then artificial intelligence crossed a threshold.
                    </p>

                    <p class="text-gray-300 leading-relaxed mb-6">
                        Not the threshold of sentience or superintelligence—the threshold of <span class="text-accent-400 font-semibold">economic utility</span>. AI became capable enough to perform tasks that previously required human labour, reliably enough to trust in production, and cheaply enough to fundamentally alter the maths of business.
                    </p>

                    <p class="text-gray-300 leading-relaxed mb-6">
                        Most companies responded by adding AI to their existing operations. Chatbots here. Copilots there. Incremental efficiency gains layered onto fundamentally unchanged structures.
                    </p>

                    <p class="text-gray-300 leading-relaxed mb-6">
                        We asked a different question: <span class="text-white font-semibold">What if you designed a company around AI from the beginning?</span> Not AI-assisted. AI-centric. Where artificial intelligence isn't a tool used by the workforce—it is the workforce.
                    </p>

                    <div class="card-glass p-8 my-12 border-l-4 border-accent-500">
                        <p class="text-2xl font-bold gradient-text">
                            Ascend AI is the answer to that question.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Philosophy/Principles Section --}}
    <section class="bg-navy-950 py-20 lg:py-32">
        <div class="container">
            <x-ui.section-heading
                title="Principles That Define Us"
                alignment="center"
            />

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto">
                {{-- Principle 1 --}}
                <x-ui.card variant="glass" :hover="true" padding="lg">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 flex-shrink-0 flex items-center justify-center bg-accent-500/20 rounded-lg">
                            <span class="text-accent-500 font-bold">01</span>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-white mb-2">AI-Native, Not AI-Adapted</h3>
                            <p class="text-gray-400 text-sm">We don't retrofit automation onto legacy processes. We architect businesses where AI handles core functions from day one. The difference isn't incremental—it's fundamental.</p>
                        </div>
                    </div>
                </x-ui.card>

                {{-- Principle 2 --}}
                <x-ui.card variant="glass" :hover="true" padding="lg">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 flex-shrink-0 flex items-center justify-center bg-accent-500/20 rounded-lg">
                            <span class="text-accent-500 font-bold">02</span>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-white mb-2">Speed as Strategy</h3>
                            <p class="text-gray-400 text-sm">When development takes days instead of months, first-mover advantage becomes structural. We launch while competitors are still scoping. We iterate while they're still planning.</p>
                        </div>
                    </div>
                </x-ui.card>

                {{-- Principle 3 --}}
                <x-ui.card variant="glass" :hover="true" padding="lg">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 flex-shrink-0 flex items-center justify-center bg-accent-500/20 rounded-lg">
                            <span class="text-accent-500 font-bold">03</span>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-white mb-2">Margin Is the Moat</h3>
                            <p class="text-gray-400 text-sm">Traditional competitors can't match our pricing without destroying their business models. Our cost structure isn't just an advantage—it's our competitive protection.</p>
                        </div>
                    </div>
                </x-ui.card>

                {{-- Principle 4 --}}
                <x-ui.card variant="glass" :hover="true" padding="lg">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 flex-shrink-0 flex items-center justify-center bg-accent-500/20 rounded-lg">
                            <span class="text-accent-500 font-bold">04</span>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-white mb-2">Scale Without Constraint</h3>
                            <p class="text-gray-400 text-sm">Human workforces create linear scaling problems. Every new customer needs a proportional increase in support, administration, and management. AI workforces don't. Our companies grow without proportional complexity.</p>
                        </div>
                    </div>
                </x-ui.card>

                {{-- Principle 5 --}}
                <x-ui.card variant="glass" :hover="true" padding="lg">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 flex-shrink-0 flex items-center justify-center bg-accent-500/20 rounded-lg">
                            <span class="text-accent-500 font-bold">05</span>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-white mb-2">Continuous Evolution</h3>
                            <p class="text-gray-400 text-sm">AI-accelerated development means our products evolve quarterly based on customer feedback—faster than any traditional roadmap allows. Our customers shape the product; we simply build what they need.</p>
                        </div>
                    </div>
                </x-ui.card>
            </div>
        </div>
    </section>

    {{-- Leadership Section --}}
    <section class="bg-navy-900 py-20 lg:py-32">
        <div class="container">
            <div class="max-w-3xl mx-auto text-center">
                <x-ui.section-heading
                    title="The Team"
                    alignment="center"
                />

                <div class="card-glass p-8">
                    <p class="text-lg text-gray-300 leading-relaxed">
                        Ascend AI operates with a deliberately minimal human footprint—proof of our own thesis. Strategic direction is provided by our founding team, while artificial intelligence handles the work traditionally requiring large organisations.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="bg-navy-950 py-20">
        <div class="container text-center">
            <p class="text-xl text-gray-300 mb-8">Want to understand our methodology in detail?</p>
            <a href="{{ route('what-we-do') }}" class="btn btn-primary px-8 py-4">
                See What We Do
            </a>
        </div>
    </section>
</x-layout.app>
