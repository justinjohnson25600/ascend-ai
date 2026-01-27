@props([
    'title' => null,
    'description' => null,
    'ogImage' => null,
    'ogType' => 'website',
    'noIndex' => false,
    'bodyClass' => '',
])
<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Title --}}
    <title>{{ $title ? "$title - " : "" }}Ascend AI</title>

    {{-- SEO Meta Tags --}}
    <meta name="description" content="{{ $description ?? 'Ascend AI builds SaaS companies from the ground up around artificial intelligence. Unbeatable economics. Infinite scalability. Margins that legacy competitors cannot match.' }}">
    <meta name="keywords" content="AI, artificial intelligence, SaaS, venture builder, startup, AI companies, business intelligence, enterprise AI">
    <meta name="author" content="Ascend AI">

    @if ($noIndex)
        <meta name="robots" content="noindex, nofollow">
    @else
        <meta name="robots" content="index, follow">
        <meta name="googlebot" content="index, follow">
    @endif

    {{-- Open Graph / Facebook --}}
    <meta property="og:type" content="{{ $ogType ?? 'website' }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $title ?? 'Ascend AI' }}">
    <meta property="og:description" content="{{ $description ?? 'Ascend AI builds SaaS companies from the ground up around artificial intelligence.' }}">
    <meta property="og:image" content="{{ $ogImage ?? asset('images/ascend-logo.webp') }}">
    <meta property="og:site_name" content="Ascend AI">

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ url()->current() }}">
    <meta name="twitter:title" content="{{ $title ?? 'Ascend AI' }}">
    <meta name="twitter:description" content="{{ $description ?? 'Ascend AI builds SaaS companies from the ground up around artificial intelligence.' }}">
    <meta name="twitter:image" content="{{ $ogImage ?? asset('images/ascend-logo.webp') }}">

    {{-- Canonical URL --}}
    <link rel="canonical" href="{{ url()->current() }}">

    {{-- Favicon --}}
    <link rel="icon" href="{{ asset('images/favicon.ico') }}">
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/favicon-ai-box.svg') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicon-ai-box-180.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon-ai-box-transparent-32.png') }}">
    <link rel="icon" type="image/png" sizes="64x64" href="{{ asset('images/favicon-ai-box-transparent-64.png') }}">

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- JSON-LD Structured Data --}}
    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@@type": "Organization",
        "name": "Ascend AI",
        "description": "Ascend AI builds SaaS companies from the ground up around artificial intelligence.",
        "url": "{{ url('/') }}",
        "logo": "{{ asset('images/ascend-logo.webp') }}",
        "sameAs": [
            "https://linkedin.com/company/ascend-ai",
            "https://youtube.com/@ascend-ai",
            "https://instagram.com/ascend.ai",
            "https://x.com/ascend_ai",
            "https://facebook.com/ascend.ai"
        ],
        "contactPoint": {
            "@@type": "ContactPoint",
            "email": "contact@ascend-ai.co.uk",
            "contactType": "customer service"
        }
    }
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="{{ trim('bg-navy-950 text-white font-sans antialiased ' . $bodyClass) }}">
    {{-- Header --}}
    <x-layout.header />

    {{-- Main Content --}}
    <main class="pt-20">
        {{ $slot }}
    </main>

    {{-- Footer --}}
    <x-layout.footer />

    {{-- Scripts Stack --}}
    @stack('scripts')

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const video = document.querySelector('.section-droid-video');
            if (!video) return;

            const hidePoster = () => {
                video.removeAttribute('poster');
            };

            video.addEventListener('playing', hidePoster, { once: true });
        });
    </script>
</body>
</html>
