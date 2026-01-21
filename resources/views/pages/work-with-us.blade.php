<x-layout.app :title="$title" :description="$description">
    {{-- Hero Section --}}
    <x-sections.hero
        :title="'Build the Future With Us'"
        :subtitle="'Whether you\'re an investor, a potential partner, or an organisation seeking transformation—there\'s a path to working with Ascend AI.'"
        :fullHeight="false"
    />

    {{-- For Investors Section --}}
    <section class="bg-navy-900 py-20 lg:py-32">
        <div class="container">
            <div class="max-w-4xl mx-auto">
                <div class="flex items-start gap-8">
                    <div class="hidden lg:block w-16 h-16 flex-shrink-0 flex items-center justify-center bg-accent-500/20 rounded-xl">
                        <svg class="w-8 h-8 text-accent-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-display-md font-bold text-white mb-6">Investment Opportunities</h2>
                        <p class="text-lg text-gray-300 mb-6 leading-relaxed">
                            Ascend AI and its portfolio companies represent a new category of investment—software businesses with development costs measured in days, operational costs measured in pounds, and margins that traditional competitors cannot replicate.
                        </p>
                        <p class="text-lg text-gray-300 mb-8 leading-relaxed">
                            We're selective about investment partners. Capital matters less than what accompanies it: market access, distribution expertise, strategic networks, and scaling knowledge.
                        </p>
                        <div class="card-glass p-6 border-l-4 border-accent-500">
                            <p class="text-xl font-semibold gradient-text">If you bring more than money to the table, we should talk.</p>
                        </div>
                        <div class="mt-8">
                            <a href="{{ route('contact') }}" class="btn btn-primary px-8 py-4">
                                Discuss Investment
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- For Partners Section --}}
    <section class="bg-navy-950 py-20 lg:py-32">
        <div class="container">
            <div class="max-w-4xl mx-auto">
                <div class="flex items-start gap-8">
                    <div class="hidden lg:block w-16 h-16 flex-shrink-0 flex items-center justify-center bg-accent-500/20 rounded-xl">
                        <svg class="w-8 h-8 text-accent-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-display-md font-bold text-white mb-6">Joint Ventures & Collaboration</h2>
                        <p class="text-lg text-gray-300 mb-6 leading-relaxed">
                            Have you identified a market ripe for disruption? Possess domain expertise in a legacy-heavy industry? Control distribution channels that could accelerate a new entrant?
                        </p>
                        <p class="text-lg text-gray-300 mb-8 leading-relaxed">
                            Ascend AI considers joint ventures where partners contribute strategic assets beyond our core methodology. We build. You guide. We both benefit.
                        </p>
                        <div class="mt-8">
                            <a href="{{ route('contact') }}" class="btn btn-primary px-8 py-4">
                                Propose a Partnership
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- For Organisations Section --}}
    <section class="bg-navy-900 py-20 lg:py-32">
        <div class="container">
            <div class="max-w-4xl mx-auto">
                <div class="flex items-start gap-8">
                    <div class="hidden lg:block w-16 h-16 flex-shrink-0 flex items-center justify-center bg-accent-500/20 rounded-xl">
                        <svg class="w-8 h-8 text-accent-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-display-md font-bold text-white mb-6">Advisory & Consultancy</h2>
                        <p class="text-lg text-gray-300 mb-6 leading-relaxed">
                            For established businesses seeking to understand AI-native methodologies—whether for internal transformation or competitive intelligence—we offer selective advisory engagements.
                        </p>
                        <p class="text-lg text-gray-300 mb-8 leading-relaxed">
                            This isn't implementation consulting. It's strategic education: helping leadership teams understand what's now possible and how the competitive landscape is shifting.
                        </p>
                        <div class="mt-8">
                            <a href="{{ route('contact') }}" class="btn btn-primary px-8 py-4">
                                Request Advisory Services
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- General Enquiries Section --}}
    <section class="bg-navy-950 py-20">
        <div class="container text-center">
            <p class="text-xl text-gray-300 mb-8">Not sure which category fits? Reach out anyway. If there's alignment, we'll find it.</p>
            <a href="{{ route('contact') }}" class="btn btn-ghost px-8 py-4 border border-gray-600 hover:border-accent-500">
                General Enquiry
            </a>
        </div>
    </section>
</x-layout.app>
