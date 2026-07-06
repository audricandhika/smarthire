@props(['title' => null, 'description' => null])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{{ $description ?? 'SmartHire AI — AI-powered recruitment platform.' }}">
    <title>{{ $title ?? 'SmartHire AI — Smarter Hiring with AI' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="sh-body">

    <!-- Global Nav -->
    <nav class="sh-global-nav" id="global-nav" aria-label="Global navigation">
        <div class="sh-global-nav__inner">
            <a href="{{ route('home') }}" class="sh-global-nav__logo" aria-label="SmartHire AI home">
                <svg width="22" height="22" viewBox="0 0 22 22" fill="none" aria-hidden="true">
                    <rect width="22" height="22" rx="5" fill="#0066cc"/>
                    <path d="M6 16L11 6L16 16M8.5 12.5H13.5" stroke="white" stroke-width="1.8" stroke-linecap="round"/>
                </svg>
                <span class="sh-global-nav__brand">SmartHire</span>
            </a>

            <ul class="sh-global-nav__links" role="list">
                <li><a href="{{ route('jobs.index') }}" class="sh-global-nav__link">Jobs</a></li>
                <li><a href="{{ route('home') }}#how-it-works" class="sh-global-nav__link">How It Works</a></li>
                <li><a href="{{ route('home') }}#features" class="sh-global-nav__link">Features</a></li>
            </ul>

            <div class="sh-global-nav__actions">
                @auth
                    @if(auth()->user()->isRecruiter())
                        <a href="{{ route('recruiter.dashboard') }}" class="sh-btn-dark-utility">Dashboard</a>
                    @else
                        <a href="{{ route('applicant.dashboard') }}" class="sh-btn-dark-utility">Dashboard</a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="sh-global-nav__link">Sign In</a>
                    <a href="{{ route('register') }}" class="sh-btn-primary sh-btn-primary--sm" id="nav-get-started">Get Started</a>
                @endauth
            </div>

            <button class="sh-global-nav__hamburger" id="nav-toggle" aria-expanded="false" aria-label="Toggle menu">
                <span></span><span></span><span></span>
            </button>
        </div>

        <div class="sh-global-nav__drawer" id="nav-drawer" aria-hidden="true">
            <a href="{{ route('jobs.index') }}" class="sh-global-nav__drawer-link">Jobs</a>
            <a href="{{ route('home') }}#how-it-works" class="sh-global-nav__drawer-link">How It Works</a>
            <a href="{{ route('home') }}#features" class="sh-global-nav__drawer-link">Features</a>
            <div class="sh-global-nav__drawer-actions">
                @auth
                    <a href="{{ auth()->user()->isRecruiter() ? route('recruiter.dashboard') : route('applicant.dashboard') }}" class="sh-btn-primary sh-btn-primary--block">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="sh-btn-secondary-pill sh-btn-secondary-pill--block">Sign In</a>
                    <a href="{{ route('register') }}" class="sh-btn-primary sh-btn-primary--block">Get Started</a>
                @endauth
            </div>
        </div>
    </nav>

    <main id="main-content">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="sh-footer" aria-label="Site footer">
        <div class="sh-footer__inner">
            <div class="sh-footer__grid">
                <div class="sh-footer__col">
                    <p class="sh-footer__col-heading">SmartHire AI</p>
                    <a href="{{ route('jobs.index') }}" class="sh-footer__link">Browse Jobs</a>
                    <a href="{{ route('home') }}#how-it-works" class="sh-footer__link">How It Works</a>
                    <a href="{{ route('home') }}#features" class="sh-footer__link">Features</a>
                </div>
                <div class="sh-footer__col">
                    <p class="sh-footer__col-heading">For Recruiters</p>
                    <a href="{{ route('register') }}?role=recruiter" class="sh-footer__link">Post a Job</a>
                    <a href="{{ route('login') }}" class="sh-footer__link">Sign In</a>
                </div>
                <div class="sh-footer__col">
                    <p class="sh-footer__col-heading">For Applicants</p>
                    <a href="{{ route('register') }}" class="sh-footer__link">Create Profile</a>
                    <a href="{{ route('jobs.index') }}" class="sh-footer__link">Find Jobs</a>
                </div>
                <div class="sh-footer__col">
                    <p class="sh-footer__col-heading">Company</p>
                    <a href="#" class="sh-footer__link">About</a>
                    <a href="#" class="sh-footer__link">Privacy Policy</a>
                    <a href="#" class="sh-footer__link">Terms of Service</a>
                </div>
            </div>
            <div class="sh-footer__legal">
                <p>Copyright &copy; {{ date('Y') }} SmartHire AI. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        const toggle = document.getElementById('nav-toggle');
        const drawer = document.getElementById('nav-drawer');
        if (toggle && drawer) {
            toggle.addEventListener('click', () => {
                const open = drawer.classList.toggle('is-open');
                toggle.setAttribute('aria-expanded', open);
                drawer.setAttribute('aria-hidden', !open);
            });
        }
    </script>
    @stack('scripts')
</body>
</html>
