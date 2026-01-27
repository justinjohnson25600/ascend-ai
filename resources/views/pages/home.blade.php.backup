<x-layout.app :title="$title" :description="$description">
    {{-- Hero Section --}}
    <x-sections.hero
        :title="'The Companies That Make Traditional Business Obsolete'"
        :subtitle="'Ascend AI builds software companies from the ground up around artificial intelligence—not humans. The result: unbeatable economics, infinite scalability, and margins that legacy competitors can\'t touch.'"
        :ctaText="'Learn How We Do It'"
        :ctaUrl="'#methodology'"
        :secondaryCtaText="'Get In Touch'"
        :secondaryCtaUrl="route('contact')"
        :fullHeight="true"
    />

    {{-- Problem Statement Section --}}
    <section class="bg-navy-900 py-20 lg:py-32 section-droid-bg">
        <video class="section-droid-video" autoplay muted loop playsinline poster="{{ asset('images/droid.webp') }}">
            <source src="{{ asset('video/andriod-p.mp4') }}" type="video/mp4">
        </video>
        <div class="container">
            <x-ui.section-heading
                title="Traditional Software Companies Are Economically Broken"
                alignment="center"
            />

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-5xl mx-auto">
                {{-- Development --}}
                <div class="text-center">
                    <div class="w-16 h-16 mx-auto mb-6 flex items-center justify-center bg-navy-800 rounded-xl">
                        <svg class="w-8 h-8 text-accent-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-white mb-3">Development</h3>
                    <p class="text-gray-400">Months of coding. Hundreds of thousands in developer costs. Features that arrive too late.</p>
                </div>

                {{-- Operations --}}
                <div class="text-center">
                    <div class="w-16 h-16 mx-auto mb-6 flex items-center justify-center bg-navy-800 rounded-xl">
                        <svg class="w-8 h-8 text-accent-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-white mb-3">Operations</h3>
                    <p class="text-gray-400">Support teams. Server administrators. Account managers. Salaries that scale with growth.</p>
                </div>

                {{-- Limitations --}}
                <div class="text-center">
                    <div class="w-16 h-16 mx-auto mb-6 flex items-center justify-center bg-navy-800 rounded-xl">
                        <svg class="w-8 h-8 text-accent-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-white mb-3">Limitations</h3>
                    <p class="text-gray-400">9-to-5 availability. Holiday cover. Sick leave. Employment obligations that never end.</p>
                </div>
            </div>

            <div class="text-center mt-16">
                <p class="text-2xl md:text-3xl font-bold gradient-text">What if you could eliminate all of it?</p>
            </div>
        </div>
    </section>

    {{-- Methodology Section --}}
    <section id="methodology" class="bg-navy-950 py-20 lg:py-32">
        <div class="container">
            <x-ui.section-heading
                title="Built Around AI From Day One"
                subtitle="Not retrofitting AI onto legacy systems. Architecting entire businesses where AI handles development, operations, and support from the first day."
                alignment="center"
            />

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-5xl mx-auto">
                {{-- AI-Accelerated Development --}}
                <x-ui.card variant="glass" :hover="true" padding="lg">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 flex-shrink-0 flex items-center justify-center bg-accent-500/20 rounded-lg">
                            <svg class="w-6 h-6 text-accent-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-white mb-2">AI-Accelerated Development</h3>
                            <p class="text-gray-400">Concepts become production software in days, not months. What traditionally costs hundreds of thousands costs almost nothing.</p>
                        </div>
                    </div>
                </x-ui.card>

                {{-- Autonomous Operations --}}
                <x-ui.card variant="glass" :hover="true" padding="lg">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 flex-shrink-0 flex items-center justify-center bg-accent-500/20 rounded-lg">
                            <svg class="w-6 h-6 text-accent-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-white mb-2">Autonomous Operations</h3>
                            <p class="text-gray-400">24/7/365 without shifts, overtime, or human bottlenecks. AI handles customer support, monitoring, and maintenance.</p>
                        </div>
                    </div>
                </x-ui.card>

                {{-- Infinite Scalability --}}
                <x-ui.card variant="glass" :hover="true" padding="lg">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 flex-shrink-0 flex items-center justify-center bg-accent-500/20 rounded-lg">
                            <svg class="w-6 h-6 text-accent-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-white mb-2">Infinite Scalability</h3>
                            <p class="text-gray-400">Add customers without adding headcount. Ever. Our architecture scales horizontally without proportional cost increases.</p>
                        </div>
                    </div>
                </x-ui.card>

                {{-- Unassailable Margins --}}
                <x-ui.card variant="glass" :hover="true" padding="lg">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 flex-shrink-0 flex items-center justify-center bg-accent-500/20 rounded-lg">
                            <svg class="w-6 h-6 text-accent-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-white mb-2">Unassailable Margins</h3>
                            <p class="text-gray-400">99%+ gross margins aren't aspirational. They're structural. When your costs are measured in server fees, not salaries, the maths changes entirely.</p>
                        </div>
                    </div>
                </x-ui.card>
            </div>
        </div>
    </section>

    {{-- Proof Points Section --}}
    <section class="bg-navy-900 py-20 lg:py-32 section-ai-video-bg">
        <video class="section-ai-video" autoplay muted loop playsinline>
            <source src="{{ asset('video/ai-video.mp4') }}" type="video/mp4">
        </video>
        <div class="container">
            <x-ui.section-heading
                title="Proven. Replicable. Scalable."
                alignment="center"
            />

            <div class="max-w-3xl mx-auto text-center">
                <p class="text-lg text-gray-300 mb-8">
                    Our methodology has already produced multiple ventures across accounting technology, genetic analysis, and business intelligence—each built in weeks, each operating autonomously, each disrupting markets dominated by legacy players.
                </p>
                <p class="text-xl font-semibold gradient-text">These aren't experiments. They're the first wave.</p>
            </div>

            {{-- Stats --}}
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 max-w-4xl mx-auto mt-16">
                <div class="text-center">
                    <p class="text-4xl md:text-5xl font-bold gradient-text mb-2">14</p>
                    <p class="text-gray-400 text-sm">Days to Production</p>
                </div>
                <div class="text-center">
                    <p class="text-4xl md:text-5xl font-bold gradient-text mb-2">99%</p>
                    <p class="text-gray-400 text-sm">Gross Margins</p>
                </div>
                <div class="text-center">
                    <p class="text-4xl md:text-5xl font-bold gradient-text mb-2">0</p>
                    <p class="text-gray-400 text-sm">Support Staff</p>
                </div>
                <div class="text-center">
                    <p class="text-4xl md:text-5xl font-bold gradient-text mb-2">24/7</p>
                    <p class="text-gray-400 text-sm">Operational Availability</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Opportunity Section --}}
    <section class="bg-navy-950 py-20 lg:py-32">
        <div class="container">
            <div class="max-w-4xl mx-auto text-center">
                <x-ui.section-heading
                    title="Every Legacy Market Is Vulnerable"
                    subtitle="Any industry reliant on human-heavy operations. Any SaaS vertical with inflated pricing. Any market where incumbents have grown complacent."
                    alignment="center"
                />

                <div class="card-glass p-8 mt-12">
                    <p class="text-lg text-gray-200 mb-6">
                        Ascend AI identifies these opportunities, builds the challenger, and captures value that traditional companies leave on the table.
                    </p>
                    <p class="text-xl font-semibold text-accent-400">
                        We're not building one company. We're building a portfolio of market leaders—each with the same economic advantages, each compounding the value of the Ascend AI methodology.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <x-sections.cta
        title="Interested in the Future of Business?"
        subtitle="Whether you're an investor looking for the next generation of software companies, or a collaborator seeking transformation—there's a path to working with Ascend AI."
        ctaText="Contact Us"
        :ctaUrl="route('contact')"
        variant="gradient"
    />
</x-layout.app>
