<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? config('app.name', 'SmartHire AI') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="sh-body sh-auth-body">

    {{-- Minimal nav bar --}}
    <nav class="sh-global-nav" aria-label="Global navigation">
        <div class="sh-global-nav__inner">
            <a href="{{ route('home') }}" class="sh-global-nav__logo" aria-label="SmartHire AI home">
                <svg width="22" height="22" viewBox="0 0 22 22" fill="none" aria-hidden="true">
                    <rect width="22" height="22" rx="5" fill="#0066cc"/>
                    <path d="M6 16L11 6L16 16M8.5 12.5H13.5" stroke="white" stroke-width="1.8" stroke-linecap="round"/>
                </svg>
                <span class="sh-global-nav__brand">SmartHire</span>
            </a>
        </div>
    </nav>

    {{-- Auth content --}}
    <main class="sh-auth-main" id="main-content">
        {{ $slot }}
    </main>

</body>
</html>
