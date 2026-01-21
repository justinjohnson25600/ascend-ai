@props(['title' => null, 'description' => null])
<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Ascend AI' }}{{ $title ? ' - ' : '' }}Ascend AI</title>

    <meta name="description" content="{{ $description ?? 'Ascend AI builds SaaS companies from the ground up around artificial intelligence. Unbeatable economics. Infinite scalability. Margins that legacy competitors cannot match.' }}">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/favicon.ico') }}">
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/favicon-ai-box.svg') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicon-ai-box-180.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon-ai-box-transparent-32.png') }}">
    <link rel="icon" type="image/png" sizes="64x64" href="{{ asset('images/favicon-ai-box-transparent-64.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-navy-950 text-white font-sans antialiased">
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
