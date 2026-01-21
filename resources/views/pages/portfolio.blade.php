<x-layout.app :title="$title" :description="$description">
    {{-- Hero Section --}}
    <x-sections.hero
        :title="'Proof of Concept. Proof of Model.'"
        :subtitle="'Our portfolio companies demonstrate the Ascend AI methodology in action—each built in weeks, each operating autonomously, each disrupting established markets.'"
        :fullHeight="false"
    />

    {{-- Coming Soon Notice --}}
    <section class="bg-navy-900 py-20 lg:py-32">
        <div class="container">
            <div class="max-w-3xl mx-auto text-center">
                <div class="inline-flex items-center gap-2 bg-accent-500/10 border border-accent-500/30 rounded-full px-4 py-2 mb-8">
                    <span class="w-2 h-2 bg-accent-500 rounded-full animate-pulse"></span>
                    <span class="text-accent-400 text-sm font-medium">Coming Soon</span>
                </div>

                <p class="text-xl text-gray-300 leading-relaxed">
                    Our portfolio companies are currently in final development and launch preparation. Detailed case studies—including development timelines, operational metrics, and market positioning—will be published as each company goes live.
                </p>
            </div>
        </div>
    </section>

    {{-- Portfolio Preview Section --}}
    <section class="bg-navy-950 py-20 lg:py-32">
        <div class="container">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
                {{-- Financial Technology --}}
                <x-ui.card variant="default" :hover="true" padding="lg">
                    <div class="mb-4">
                        <span class="inline-block bg-accent-500/20 text-accent-400 text-xs font-semibold px-3 py-1 rounded-full">
                            FinTech
                        </span>
                    </div>
                    <h3 class="text-xl font-semibold text-white mb-3">Financial Technology</h3>
                    <p class="text-gray-400 mb-4">Comprehensive accounting and compliance platform for UK limited companies. Full-featured. Fully automated.</p>
                    <div class="flex items-center gap-2 text-accent-400 text-sm">
                        <span class="w-2 h-2 bg-accent-500 rounded-full animate-pulse"></span>
                        <span>Launching soon</span>
                    </div>
                </x-ui.card>

                {{-- Genetic Analysis --}}
                <x-ui.card variant="default" :hover="true" padding="lg">
                    <div class="mb-4">
                        <span class="inline-block bg-purple-500/20 text-purple-400 text-xs font-semibold px-3 py-1 rounded-full">
                            HealthTech
                        </span>
                    </div>
                    <h3 class="text-xl font-semibold text-white mb-3">Genetic Analysis</h3>
                    <p class="text-gray-400 mb-4">Consumer genetic profiling with AI-powered reporting. Global distribution. Autonomous pipeline.</p>
                    <div class="flex items-center gap-2 text-accent-400 text-sm">
                        <span class="w-2 h-2 bg-accent-500 rounded-full animate-pulse"></span>
                        <span>Ready for market</span>
                    </div>
                </x-ui.card>

                {{-- Business Intelligence --}}
                <x-ui.card variant="default" :hover="true" padding="lg">
                    <div class="mb-4">
                        <span class="inline-block bg-cyan-500/20 text-cyan-400 text-xs font-semibold px-3 py-1 rounded-full">
                            HR Tech
                        </span>
                    </div>
                    <h3 class="text-xl font-semibold text-white mb-3">Business Intelligence</h3>
                    <p class="text-gray-400 mb-4">Genetic and psychometric profiling for professional development. Proprietary frameworks.</p>
                    <div class="flex items-center gap-2 text-gray-500 text-sm">
                        <span class="w-2 h-2 bg-gray-600 rounded-full"></span>
                        <span>In development</span>
                    </div>
                </x-ui.card>
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="bg-navy-900 py-20">
        <div class="container text-center">
            <p class="text-xl text-gray-300 mb-8">Want early access or investment information?</p>
            <a href="{{ route('contact') }}" class="btn btn-primary px-8 py-4">
                Contact Us
            </a>
        </div>
    </section>
</x-layout.app>
