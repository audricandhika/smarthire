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
            {{ now()->format('l, d F Y') }} · Here's your activity overview.
        </p>
    </div>

    {{-- Stat cards --}}
    <div class="sh-stat-grid">
        <div class="sh-stat-card">
            <p class="sh-stat-card__label">Total Applied</p>
            <p class="sh-stat-card__value sh-stat-card__value--blue">{{ $stats['total'] }}</p>
            <p class="sh-stat-card__desc">Applications submitted</p>
        </div>
        <div class="sh-stat-card">
            <p class="sh-stat-card__label">Under Review</p>
            <p class="sh-stat-card__value sh-stat-card__value--yellow">{{ $stats['reviewing'] }}</p>
            <p class="sh-stat-card__desc">Being reviewed</p>
        </div>
        <div class="sh-stat-card">
            <p class="sh-stat-card__label">Accepted</p>
            <p class="sh-stat-card__value sh-stat-card__value--green">{{ $stats['accepted'] }}</p>
            <p class="sh-stat-card__desc">Offers received</p>
        </div>
        <div class="sh-stat-card">
            <p class="sh-stat-card__label">Pending</p>
            <p class="sh-stat-card__value">{{ $stats['pending'] }}</p>
            <p class="sh-stat-card__desc">Awaiting response</p>
        </div>
    </div>

    {{-- Content grid --}}
    <div class="sh-dash-grid">

        {{-- Recent Applications --}}
        <div class="sh-panel">
            <div class="sh-panel__header">
                <h2 class="sh-panel__title">Recent Applications</h2>
                <a href="#" class="sh-panel__action">View all →</a>
            </div>

            @forelse($applications as $app)
                <div class="sh-app-row">
                    <div class="sh-app-row__logo">
                        {{ strtoupper(substr($app->jobPosting->company->name ?? 'C', 0, 2)) }}
                    </div>
                    <div class="sh-app-row__info">
                        <p class="sh-app-row__title">{{ $app->jobPosting->title ?? '—' }}</p>
                        <p class="sh-app-row__company">{{ $app->jobPosting->company->name ?? '—' }}</p>
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
                        <svg width="40" height="40" viewBox="0 0 40 40" fill="none"><rect x="6" y="10" width="28" height="22" rx="3" stroke="currentColor" stroke-width="1.5"/><path d="M6 16l14 9 14-9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
                    </div>
                    <p class="sh-empty-state__title">No applications yet</p>
                    <p class="sh-empty-state__text">Browse open positions and apply to get started.</p>
                    <a href="{{ route('jobs.index') }}" class="sh-btn-primary">Browse Jobs</a>
                </div>
            @endforelse
        </div>

        <div style="display: flex; flex-direction: column; gap: 20px;">

            {{-- Profile completion --}}
            <div class="sh-panel">
                <div class="sh-panel__header">
                    <h2 class="sh-panel__title">Profile Completion</h2>
                </div>
                <div class="sh-profile-card">
                    @php
                        $score = 0;
                        if ($profile?->bio)            $score += 20;
                        if ($profile?->phone)          $score += 10;
                        if ($profile?->location)       $score += 10;
                        if ($profile?->skills?->count() > 0)          $score += 20;
                        if ($profile?->workExperiences?->count() > 0)  $score += 20;
                        if ($profile?->educations?->count() > 0)       $score += 20;
                    @endphp
                    <p class="sh-stat-card__value sh-stat-card__value--{{ $score >= 80 ? 'green' : ($score >= 50 ? 'yellow' : 'red') }}" style="font-size: 24px;">
                        {{ $score }}%
                    </p>
                    <div class="sh-progress-bar" role="progressbar" aria-valuenow="{{ $score }}" aria-valuemin="0" aria-valuemax="100">
                        <div class="sh-progress-bar__fill" style="width: {{ $score }}%"></div>
                    </div>
                    <div class="sh-progress-label">
                        <span>{{ $score < 100 ? 'Incomplete' : 'Complete!' }}</span>
                        <span>{{ $score }}/100</span>
                    </div>

                    @if($score < 100)
                        <a href="#" class="sh-btn-primary" style="display:block; text-align:center; margin-top:16px;">
                            Complete Profile
                        </a>
                    @endif
                </div>
            </div>

            {{-- Quick actions --}}
            <div class="sh-panel">
                <div class="sh-panel__header">
                    <h2 class="sh-panel__title">Quick Actions</h2>
                </div>
                <div class="sh-quick-actions">
                    <a href="{{ route('jobs.index') }}" class="sh-quick-action">
                        <span class="sh-quick-action__icon">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><circle cx="7" cy="7" r="5" stroke="currentColor" stroke-width="1.4"/><path d="M11 11l3 3" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/></svg>
                        </span>
                        Browse Open Jobs
                    </a>
                    <a href="#" class="sh-quick-action">
                        <span class="sh-quick-action__icon">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><circle cx="7" cy="5" r="3" stroke="currentColor" stroke-width="1.4"/><path d="M2 14c0-2.76 2.24-5 5-5s5 2.24 5 5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/></svg>
                        </span>
                        Update Profile
                    </a>
                    <a href="#" class="sh-quick-action">
                        <span class="sh-quick-action__icon">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M8 1v10M4 7l4 4 4-4" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/><path d="M2 14h12" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/></svg>
                        </span>
                        Upload / Update CV
                    </a>
                </div>
            </div>

        </div>
    </div>

</x-dashboard-layout>
