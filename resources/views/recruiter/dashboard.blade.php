<x-dashboard-layout title="Dashboard" active-page="dashboard">

    @if(request()->query('verified'))
        <div class="sh-verified-banner" role="status">
            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" aria-hidden="true">
                <circle cx="9" cy="9" r="9" fill="#1a7f37"/>
                <path d="M5.5 9.5l2.5 2.5 4.5-5" stroke="white" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Your email is verified. Welcome to SmartHire AI!
        </div>
    @endif

    {{-- Page header --}}
    <div class="sh-dash-header">
        <h1 class="sh-dash-header__greeting">
            Hello, {{ explode(' ', $user->name)[0] }}
        </h1>
        <p class="sh-dash-header__sub">
            {{ now()->format('l, d F Y') }} ·
            @if($company)
                Managing <strong>{{ $company->name }}</strong>
            @else
                Set up your company profile to start posting jobs.
            @endif
        </p>
    </div>

    {{-- No company warning --}}
    @unless($company)
        <div class="sh-alert sh-alert--error" style="margin-bottom: 24px;" role="alert">
            ⚠ Your company profile is incomplete. Please complete it before posting jobs.
            <a href="#" style="color: #cc0000; font-weight: 600; margin-left: 8px;">Set up now →</a>
        </div>
    @endunless

    {{-- Stat cards --}}
    <div class="sh-stat-grid">
        <div class="sh-stat-card">
            <p class="sh-stat-card__label">Active Jobs</p>
            <p class="sh-stat-card__value sh-stat-card__value--blue">{{ $stats['jobs'] }}</p>
            <p class="sh-stat-card__desc">Open positions</p>
        </div>
        <div class="sh-stat-card">
            <p class="sh-stat-card__label">Total Applicants</p>
            <p class="sh-stat-card__value">{{ $stats['total_applicants'] }}</p>
            <p class="sh-stat-card__desc">Across all jobs</p>
        </div>
        <div class="sh-stat-card">
            <p class="sh-stat-card__label">Pending Review</p>
            <p class="sh-stat-card__value sh-stat-card__value--yellow">{{ $stats['pending'] }}</p>
            <p class="sh-stat-card__desc">Awaiting your review</p>
        </div>
        <div class="sh-stat-card">
            <p class="sh-stat-card__label">Accepted</p>
            <p class="sh-stat-card__value sh-stat-card__value--green">{{ $stats['accepted'] }}</p>
            <p class="sh-stat-card__desc">Candidates hired</p>
        </div>
    </div>

    {{-- Content grid --}}
    <div class="sh-dash-grid">

        {{-- Recent applications --}}
        <div class="sh-panel">
            <div class="sh-panel__header">
                <h2 class="sh-panel__title">Recent Applications</h2>
                <a href="#" class="sh-panel__action">View all →</a>
            </div>

            @forelse($recentApplications as $app)
                <div class="sh-app-row">
                    <div class="sh-app-row__logo">
                        {{ strtoupper(substr($app->applicantProfile->user->name ?? 'A', 0, 2)) }}
                    </div>
                    <div class="sh-app-row__info">
                        <p class="sh-app-row__title">{{ $app->applicantProfile->user->name ?? '—' }}</p>
                        <p class="sh-app-row__company">Applied for: {{ $app->jobPosting->title ?? '—' }}</p>
                    </div>
                    <div class="sh-app-row__right">
                        <span class="sh-status-badge sh-status-badge--{{ $app->status }}">
                            {{ ucfirst($app->status) }}
                        </span>
                        @if($app->aiAnalysis)
                            <span class="sh-score-chip sh-score-chip--{{ $app->aiAnalysis->match_score >= 70 ? 'high' : ($app->aiAnalysis->match_score >= 40 ? 'medium' : 'low') }}">
                                AI {{ $app->aiAnalysis->match_score }}%
                            </span>
                        @endif
                        <span class="sh-app-row__date">{{ $app->created_at->diffForHumans() }}</span>
                    </div>
                </div>
            @empty
                <div class="sh-empty-state">
                    <div class="sh-empty-state__icon">
                        <svg width="40" height="40" viewBox="0 0 40 40" fill="none"><path d="M8 18a6 6 0 0 1 6-6h12a6 6 0 0 1 6 6v8a6 6 0 0 1-6 6H14a6 6 0 0 1-6-6v-8z" stroke="currentColor" stroke-width="1.5"/><circle cx="20" cy="14" r="4" stroke="currentColor" stroke-width="1.5"/></svg>
                    </div>
                    <p class="sh-empty-state__title">No applications yet</p>
                    <p class="sh-empty-state__text">Post your first job to start receiving applications.</p>
                    <a href="{{ route('recruiter.jobs.create') }}" class="sh-btn-primary">Post a Job</a>
                </div>
            @endforelse
        </div>

        <div style="display: flex; flex-direction: column; gap: 20px;">

            {{-- Company card --}}
            <div class="sh-panel">
                <div class="sh-panel__header">
                    <h2 class="sh-panel__title">Company</h2>
                    <a href="#" class="sh-panel__action">Edit →</a>
                </div>
                <div class="sh-profile-card">
                    @if($company)
                        <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px;">
                            <div class="sh-sidebar__avatar" style="width:44px; height:44px; font-size:16px;">
                                {{ strtoupper(substr($company->name, 0, 2)) }}
                            </div>
                            <div>
                                <p style="font-size:15px; font-weight:600; color:var(--color-ink); letter-spacing:-0.2px;">{{ $company->name }}</p>
                                @if($company->industry)
                                    <p style="font-size:12px; color:var(--color-ink-muted-48);">{{ $company->industry }}</p>
                                @endif
                            </div>
                        </div>
                        @if($company->website)
                            <p style="font-size:13px; color:var(--color-primary); letter-spacing:-0.1px;">
                                <a href="{{ $company->website }}" target="_blank" style="color:inherit; text-decoration:none;">{{ $company->website }}</a>
                            </p>
                        @endif
                        @unless($company->description)
                            <p style="font-size:13px; color:var(--color-ink-muted-48); margin-top:10px;">Add company description to attract top candidates.</p>
                        @endunless
                    @else
                        <p style="font-size:14px; color:var(--color-ink-muted-48);">Set up your company profile to appear in job listings.</p>
                    @endif
                </div>
            </div>

            {{-- Quick actions --}}
            <div class="sh-panel">
                <div class="sh-panel__header">
                    <h2 class="sh-panel__title">Quick Actions</h2>
                </div>
                <div class="sh-quick-actions">
                    <a href="{{ route('recruiter.jobs.create') }}" class="sh-quick-action">
                        <span class="sh-quick-action__icon">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><rect x="1" y="3" width="14" height="11" rx="2" stroke="currentColor" stroke-width="1.4"/><path d="M5 3V2a2 2 0 0 1 6 0v1" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/><path d="M8 8v3M6.5 9.5h3" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/></svg>
                        </span>
                        Post a New Job
                    </a>
                    <a href="{{ route('recruiter.jobs.index') }}" class="sh-quick-action">
                        <span class="sh-quick-action__icon">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M2 12c0-2.76 2.24-5 5-5h2c2.76 0 5 2.24 5 5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/><circle cx="8" cy="5" r="3" stroke="currentColor" stroke-width="1.4"/></svg>
                        </span>
                        Review Applicants
                    </a>
                    <a href="#" class="sh-quick-action">
                        <span class="sh-quick-action__icon">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M2 4h12M2 8h8M2 12h6" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/></svg>
                        </span>
                        Manage Job Postings
                    </a>
                </div>
            </div>

        </div>
    </div>

</x-dashboard-layout>
