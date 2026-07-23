@props(['title' => null, 'activePage' => ''])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ? $title . ' — SmartHire AI' : 'SmartHire AI' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/css/dashboard.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="sh-body sh-dash-body">

<div class="sh-dash-frame">

    {{-- SIDEBAR --}}
    <aside class="sh-sidebar" id="sidebar" aria-label="Sidebar navigation">

        <div class="sh-sidebar__brand">
            <a href="{{ route('home') }}" class="sh-sidebar__logo">
                <svg width="28" height="28" viewBox="0 0 22 22" fill="none" aria-hidden="true">
                    <rect width="22" height="22" rx="5" fill="#0066cc"/>
                    <path d="M6 16L11 6L16 16M8.5 12.5H13.5" stroke="white" stroke-width="1.8" stroke-linecap="round"/>
                </svg>
                <span class="sh-sidebar__brand-name">SmartHire</span>
            </a>
        </div>

        {{-- Navigation --}}
        <nav class="sh-sidebar__nav" aria-label="Main navigation">
            @auth
                @if(auth()->user()->isApplicant())
                    {{-- Applicant nav --}}
                    <p class="sh-sidebar__section-label">Applicant</p>
                    <a href="{{ route('applicant.dashboard') }}"
                       class="sh-sidebar__link {{ $activePage === 'dashboard' ? 'sh-sidebar__link--active' : '' }}">
                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" aria-hidden="true"><rect x="1" y="1" width="6" height="6" rx="1.5" stroke="currentColor" stroke-width="1.5"/><rect x="11" y="1" width="6" height="6" rx="1.5" stroke="currentColor" stroke-width="1.5"/><rect x="1" y="11" width="6" height="6" rx="1.5" stroke="currentColor" stroke-width="1.5"/><rect x="11" y="11" width="6" height="6" rx="1.5" stroke="currentColor" stroke-width="1.5"/></svg>
                        Dashboard
                    </a>
                    <a href="{{ route('jobs.index') }}"
                       class="sh-sidebar__link {{ $activePage === 'jobs' ? 'sh-sidebar__link--active' : '' }}">
                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" aria-hidden="true"><rect x="1" y="5" width="16" height="12" rx="2" stroke="currentColor" stroke-width="1.5"/><path d="M6 5V4a3 3 0 0 1 6 0v1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
                        Browse Jobs
                    </a>
                    <a href="#"
                       class="sh-sidebar__link {{ $activePage === 'applications' ? 'sh-sidebar__link--active' : '' }}">
                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" aria-hidden="true"><path d="M3 3h12a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1z" stroke="currentColor" stroke-width="1.5"/><path d="M5 7h8M5 10h5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
                        My Applications
                    </a>
                    <a href="#"
                       class="sh-sidebar__link {{ $activePage === 'profile' ? 'sh-sidebar__link--active' : '' }}">
                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" aria-hidden="true"><circle cx="9" cy="6" r="3" stroke="currentColor" stroke-width="1.5"/><path d="M3 16c0-3.314 2.686-6 6-6s6 2.686 6 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
                        My Profile
                    </a>
                @elseif(auth()->user()->isRecruiter())
                    {{-- Recruiter nav --}}
                    <p class="sh-sidebar__section-label">Recruiter</p>
                    <a href="{{ route('recruiter.dashboard') }}"
                       class="sh-sidebar__link {{ $activePage === 'dashboard' ? 'sh-sidebar__link--active' : '' }}">
                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" aria-hidden="true"><rect x="1" y="1" width="6" height="6" rx="1.5" stroke="currentColor" stroke-width="1.5"/><rect x="11" y="1" width="6" height="6" rx="1.5" stroke="currentColor" stroke-width="1.5"/><rect x="1" y="11" width="6" height="6" rx="1.5" stroke="currentColor" stroke-width="1.5"/><rect x="11" y="11" width="6" height="6" rx="1.5" stroke="currentColor" stroke-width="1.5"/></svg>
                        Dashboard
                    </a>
                    <a href="{{ route('recruiter.jobs.index') }}"
                       class="sh-sidebar__link {{ $activePage === 'jobs' ? 'sh-sidebar__link--active' : '' }}">
                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" aria-hidden="true"><rect x="1" y="5" width="16" height="12" rx="2" stroke="currentColor" stroke-width="1.5"/><path d="M6 5V4a3 3 0 0 1 6 0v1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
                        Job Postings
                    </a>
                    <a href="#"
                       class="sh-sidebar__link {{ $activePage === 'applicants' ? 'sh-sidebar__link--active' : '' }}">
                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" aria-hidden="true"><path d="M12 13v-1a3 3 0 0 0-3-3H6a3 3 0 0 0-3 3v1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/><circle cx="7.5" cy="6" r="2.5" stroke="currentColor" stroke-width="1.5"/><path d="M15 13v-1a3 3 0 0 0-2-2.83" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/><path d="M12.5 3.17A3 3 0 0 1 12.5 9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
                        Applicants
                    </a>
                    <a href="#"
                       class="sh-sidebar__link {{ $activePage === 'company' ? 'sh-sidebar__link--active' : '' }}">
                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" aria-hidden="true"><path d="M2 16V7l7-4 7 4v9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M7 16v-4h4v4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        Company Profile
                    </a>
                @endif
            @endauth
        </nav>

        {{-- User section --}}
        <div class="sh-sidebar__user">
            @auth
            <div class="sh-sidebar__user-card">
                <div class="sh-sidebar__avatar" aria-hidden="true">
                    {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                </div>
                <div class="sh-sidebar__user-info">
                    <p class="sh-sidebar__user-name">{{ auth()->user()->name }}</p>
                    <p class="sh-sidebar__user-role">{{ ucfirst(auth()->user()->role) }}</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="sh-sidebar__logout">
                    <svg width="15" height="15" viewBox="0 0 15 15" fill="none" aria-hidden="true"><path d="M6 2H3a1 1 0 0 0-1 1v9a1 1 0 0 0 1 1h3M10 10l3-2.5L10 5M6 7.5h7" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    Sign out
                </button>
            </form>
            @endauth
        </div>
    </aside>

    <div class="sh-dash-topbar" aria-hidden="true">
        <button class="sh-dash-topbar__hamburger" id="sidebar-toggle" aria-label="Open navigation">
            <span></span><span></span><span></span>
        </button>
        <span class="sh-dash-topbar__title">SmartHire</span>
    </div>

    <div class="sh-sidebar-overlay" id="sidebar-overlay"></div>

    <main class="sh-dash-main" id="main-content">
        {{ $slot }}
    </main>

</div>

<script>
    const toggle  = document.getElementById('sidebar-toggle');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebar-overlay');

    function openSidebar()  { sidebar.classList.add('sh-sidebar--open'); overlay.classList.add('sh-sidebar-overlay--visible'); }
    function closeSidebar() { sidebar.classList.remove('sh-sidebar--open'); overlay.classList.remove('sh-sidebar-overlay--visible'); }

    toggle?.addEventListener('click', openSidebar);
    overlay?.addEventListener('click', closeSidebar);
</script>

@stack('scripts')
</body>
</html>
