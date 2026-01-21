<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Ascend AI' }}{{ $title ? ' - ' : '' }}Ascend AI</title>

    <meta name="description" content="{{ $description ?? 'Ascend AI builds SaaS companies from the ground up around artificial intelligence. Unbeatable economics. Infinite scalability. Margins that legacy competitors cannot match.' }}">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon.ico') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'], 'build')
</head>
<body class="bg-navy-950 text-white font-sans antialiased">
    {{-- Header --}}
    <x-layout.header />

    {{-- Main Content --}}
    <main>
        {{ $slot ?? '' }}
    </main>

    {{-- Footer --}}
    <x-layout.footer />

    {{-- Scripts Stack --}}
    @stack('scripts')
</body>
</html>
