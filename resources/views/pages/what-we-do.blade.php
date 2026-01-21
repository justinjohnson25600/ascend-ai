<x-layout.app :title="$title" :description="$description">
    {{-- Hero Section --}}
    <x-sections.hero
        :title="'Building the Uncompetable'"
        :subtitle="'From market identification to autonomous operation—how Ascend AI creates companies that legacy businesses can\'t match.'"
        :fullHeight="false"
    />

    {{-- Process/Methodology Section --}}
    <section class="bg-navy-900 py-20 lg:py-32">
        <div class="container">
            <x-ui.section-heading
                title="Our Process"
                alignment="center"
            />

            <div class="max-w-4xl mx-auto space-y-8">
                {{-- Step 1 --}}
                <div class="flex gap-6">
                    <div class="flex-shrink-0 w-12 h-12 flex items-center justify-center bg-accent-500 rounded-full font-bold text-lg">
                        01
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-white mb-2">Market Identification</h3>
                        <p class="text-gray-400">We target industries where incumbent players rely on human-heavy operations, charge premium prices, and have grown complacent. Compliance-driven markets. Fragmented verticals. Anywhere operational overhead creates vulnerability.</p>
                    </div>
                </div>

                {{-- Step 2 --}}
                <div class="flex gap-6">
                    <div class="flex-shrink-0 w-12 h-12 flex items-center justify-center bg-accent-500 rounded-full font-bold text-lg">
                        02
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-white mb-2">AI-First Architecture</h3>
                        <p class="text-gray-400">Every system is designed with artificial intelligence at its core. Development uses AI-accelerated methodologies. Operations are automated from launch. Support is handled by AI agents. Human involvement is strategic, not operational.</p>
                    </div>
                </div>

                {{-- Step 3 --}}
                <div class="flex gap-6">
                    <div class="flex-shrink-0 w-12 h-12 flex items-center justify-center bg-accent-500 rounded-full font-bold text-lg">
                        03
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-white mb-2">Rapid Development</h3>
                        <p class="text-gray-400">Traditional timelines don't apply. Full-featured platforms are built in weeks, not months. This isn't about cutting corners—it's about eliminating the inefficiencies inherent in traditional development.</p>
                    </div>
                </div>

                {{-- Step 4 --}}
                <div class="flex gap-6">
                    <div class="flex-shrink-0 w-12 h-12 flex items-center justify-center bg-accent-500 rounded-full font-bold text-lg">
                        04
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-white mb-2">Autonomous Operations</h3>
                        <p class="text-gray-400">Once launched, our companies run themselves. AI handles customer support 24/7. Infrastructure scales automatically. Monitoring and maintenance require minimal human oversight.</p>
                    </div>
                </div>

                {{-- Step 5 --}}
                <div class="flex gap-6">
                    <div class="flex-shrink-0 w-12 h-12 flex items-center justify-center bg-accent-500 rounded-full font-bold text-lg">
                        05
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-white mb-2">Customer-Driven Evolution</h3>
                        <p class="text-gray-400">Users shape the product roadmap through structured feedback. Quarterly releases incorporate the most-requested features. AI-accelerated development means requests become reality in days.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Economics Comparison Section --}}
    <section class="bg-navy-950 py-20 lg:py-32">
        <div class="container">
            <x-ui.section-heading
                title="The Numbers That Matter"
                alignment="center"
            />

            <div class="max-w-4xl mx-auto overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-navy-700">
                            <th class="text-left py-4 px-6 text-gray-400 font-medium">Metric</th>
                            <th class="text-left py-4 px-6 text-gray-400 font-medium">Traditional SaaS</th>
                            <th class="text-left py-4 px-6 text-accent-500 font-medium">Ascend AI Portfolio</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b border-navy-800">
                            <td class="py-4 px-6 text-white">Development Timeline</td>
                            <td class="py-4 px-6 text-gray-400">6-18 months</td>
                            <td class="py-4 px-6 text-accent-400 font-semibold">2-6 weeks</td>
                        </tr>
                        <tr class="border-b border-navy-800">
                            <td class="py-4 px-6 text-white">Development Cost</td>
                            <td class="py-4 px-6 text-gray-400">£100,000-£500,000+</td>
                            <td class="py-4 px-6 text-accent-400 font-semibold">Minimal</td>
                        </tr>
                        <tr class="border-b border-navy-800">
                            <td class="py-4 px-6 text-white">Support Staff</td>
                            <td class="py-4 px-6 text-gray-400">5-50+ employees</td>
                            <td class="py-4 px-6 text-accent-400 font-semibold">0 (AI agents)</td>
                        </tr>
                        <tr class="border-b border-navy-800">
                            <td class="py-4 px-6 text-white">Operational Overhead</td>
                            <td class="py-4 px-6 text-gray-400">40-60% of revenue</td>
                            <td class="py-4 px-6 text-accent-400 font-semibold">&lt;1% of revenue</td>
                        </tr>
                        <tr class="border-b border-navy-800">
                            <td class="py-4 px-6 text-white">Gross Margin</td>
                            <td class="py-4 px-6 text-gray-400">60-80%</td>
                            <td class="py-4 px-6 text-accent-400 font-semibold">99%+</td>
                        </tr>
                        <tr>
                            <td class="py-4 px-6 text-white">Scaling Model</td>
                            <td class="py-4 px-6 text-gray-400">Hire proportionally</td>
                            <td class="py-4 px-6 text-accent-400 font-semibold">Add servers</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <p class="text-center text-gray-400 mt-8">These aren't projections. These are the economics our portfolio companies already operate within.</p>
        </div>
    </section>

    {{-- What We Build Section --}}
    <section class="bg-navy-900 py-20 lg:py-32">
        <div class="container">
            <x-ui.section-heading
                title="Our Focus"
                subtitle="Ascend AI specialises in SaaS platforms that can be fully automated—subscription-based software businesses where AI can handle the complete operational cycle from customer acquisition support through to ongoing service delivery."
                alignment="center"
            />

            <div class="max-w-2xl mx-auto">
                <ul class="space-y-4">
                    <li class="flex items-center gap-4 text-gray-300">
                        <svg class="w-6 h-6 text-accent-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Recurring revenue models
                    </li>
                    <li class="flex items-center gap-4 text-gray-300">
                        <svg class="w-6 h-6 text-accent-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Definable, automatable workflows
                    </li>
                    <li class="flex items-center gap-4 text-gray-300">
                        <svg class="w-6 h-6 text-accent-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Markets with legacy incumbents
                    </li>
                    <li class="flex items-center gap-4 text-gray-300">
                        <svg class="w-6 h-6 text-accent-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Compliance or data-driven verticals
                    </li>
                    <li class="flex items-center gap-4 text-gray-300">
                        <svg class="w-6 h-6 text-accent-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Global or scalable addressable markets
                    </li>
                </ul>
            </div>
        </div>
    </section>

    {{-- Partnership Options Section --}}
    <section class="bg-navy-950 py-20 lg:py-32">
        <div class="container">
            <x-ui.section-heading
                title="Partnership Opportunities"
                subtitle="While our primary focus is building and operating our own portfolio, we selectively engage with aligned partners."
                alignment="center"
            />

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
                {{-- Investment --}}
                <x-ui.card variant="glass" :hover="true" padding="lg">
                    <h3 class="text-xl font-semibold text-white mb-4">Investment</h3>
                    <p class="text-gray-400 mb-6">Participate in the growth of Ascend AI and its portfolio companies. We seek partners who bring strategic value—market access, distribution networks, and scaling expertise—beyond capital alone.</p>
                    <a href="{{ route('contact') }}" class="text-accent-400 hover:text-accent-300 font-medium">Discuss Investment &rarr;</a>
                </x-ui.card>

                {{-- Joint Ventures --}}
                <x-ui.card variant="glass" :hover="true" padding="lg">
                    <h3 class="text-xl font-semibold text-white mb-4">Joint Ventures</h3>
                    <p class="text-gray-400 mb-6">Identify a market opportunity that fits our methodology? We're open to collaborative builds where partners contribute domain expertise and market access.</p>
                    <a href="{{ route('contact') }}" class="text-accent-400 hover:text-accent-300 font-medium">Propose a Partnership &rarr;</a>
                </x-ui.card>

                {{-- Advisory --}}
                <x-ui.card variant="glass" :hover="true" padding="lg">
                    <h3 class="text-xl font-semibold text-white mb-4">Advisory & Consultancy</h3>
                    <p class="text-gray-400 mb-6">For established businesses seeking to understand AI-native methodologies, we offer strategic advisory services on a selective basis.</p>
                    <a href="{{ route('contact') }}" class="text-accent-400 hover:text-accent-300 font-medium">Request Advisory &rarr;</a>
                </x-ui.card>
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <x-sections.cta
        title="Ready to Build the Future?"
        ctaText="Discuss an Opportunity"
        :ctaUrl="route('contact')"
        variant="default"
    />
</x-layout.app>
