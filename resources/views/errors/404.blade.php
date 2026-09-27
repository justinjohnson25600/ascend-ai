<x-layout.app title="Page not found" :noIndex="true">
    <section class="bg-navy-950 py-24 lg:py-32">
        <div class="container">
            <div class="max-w-2xl mx-auto text-center">
                <p class="text-sm text-accent-400 mb-4">404</p>
                <h1 class="text-display-md md:text-display-lg font-bold text-white mb-6">That page isn't here</h1>
                <p class="text-lg text-gray-300 mb-10">
                    It may have moved when we changed what we do. Try Solutions or How It Works, or book an audit and we will point you the right way.
                </p>
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                    <a href="{{ route('solutions') }}" class="btn btn-primary px-8 py-4">Solutions</a>
                    <a href="{{ route('how-it-works') }}" class="btn btn-ghost px-8 py-4">How It Works</a>
                    <a href="{{ route('contact', ['type' => 'audit']) }}" class="btn btn-ghost px-8 py-4">Book a free audit</a>
                </div>
            </div>
        </div>
    </section>
</x-layout.app>
