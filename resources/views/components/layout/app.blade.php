@props([
    'title' => null,
    'description' => null,
    'ogImage' => null,
    'ogType' => 'website',
    'noIndex' => false,
    'bodyClass' => '',
])
@php
    $company = config('ascend.company');
    $defaultDescription = 'Ascend AI builds AI automation around the way your small business already works. Delivered in stages, kept running by us.';
    $description ??= $defaultDescription;
    $structuredData = [
        '@context' => 'https://schema.org',
        '@type' => 'ProfessionalService',
        'name' => $company['name'],
        'description' => $defaultDescription,
        'serviceType' => 'Business process automation',
        'areaServed' => 'GB',
        'url' => url('/'),
        'logo' => asset('images/ascend-logo.webp'),
        'email' => $company['email'],
        'address' => [
            '@type' => 'PostalAddress',
            'streetAddress' => $company['address'][0].', '.$company['address'][1],
            'addressLocality' => $company['address'][2],
            'addressRegion' => $company['address'][3],
            'postalCode' => $company['address'][4],
            'addressCountry' => 'GB',
        ],
        'sameAs' => array_values(config('ascend.social')),
    ];
@endphp
<!DOCTYPE html>
<html lang="en-GB" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ? "$title | " : "" }}Ascend AI</title>

    <meta name="description" content="{{ $description }}">
    <meta name="author" content="Ascend AI">

    @if ($noIndex)
        <meta name="robots" content="noindex, nofollow">
    @else
        <meta name="robots" content="index, follow">
    @endif

    {{-- Open Graph --}}
    <meta property="og:type" content="{{ $ogType }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $title ?? 'Ascend AI' }}">
    <meta property="og:description" content="{{ $description }}">
    <meta property="og:image" content="{{ $ogImage ?? asset('images/ascend-logo.webp') }}">
    <meta property="og:site_name" content="Ascend AI">
    <meta property="og:locale" content="en_GB">

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $title ?? 'Ascend AI' }}">
    <meta name="twitter:description" content="{{ $description }}">
    <meta name="twitter:image" content="{{ $ogImage ?? asset('images/ascend-logo.webp') }}">

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

    {{-- Structured data --}}
    <script type="application/ld+json">{!! json_encode($structuredData, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="{{ trim('bg-navy-950 text-white font-sans antialiased ' . $bodyClass) }}">
    <x-layout.header />

    {{-- The header is sticky and in the page flow, so content never sits underneath it at any screen size --}}
    <main>
        {{ $slot }}
    </main>

    <x-layout.footer />

    @stack('scripts')

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.section-droid-video').forEach((video) => {
                video.addEventListener('playing', () => video.removeAttribute('poster'), { once: true });
            });
        });
    </script>
</body>
</html>
