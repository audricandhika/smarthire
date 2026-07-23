<x-dashboard-layout :title="$job->title" active-page="jobs">

    <div class="sh-dash-header">
        <a href="{{ route('recruiter.jobs.index') }}" class="sh-panel__action" style="display:inline-flex;align-items:center;gap:4px;margin-bottom:8px;">
            ← Back to Jobs
        </a>
        <div style="display:flex; align-items:flex-start; justify-content:space-between; gap:16px; flex-wrap:wrap;">
            <div>
                <h1 class="sh-dash-header__greeting">{{ $job->title }}</h1>
                <p class="sh-dash-header__sub">
                    {{ $job->location }} ·
                    {{ Str::title(str_replace('-', ' ', $job->type)) }}
                    @if($job->department) · {{ $job->department }} @endif
                </p>
            </div>
            <div style="display:flex; gap:8px; align-items:center;">
                <span class="sh-status-badge sh-status-badge--{{ $job->status === 'active' ? 'accepted' : ($job->status === 'draft' ? 'pending' : 'rejected') }}" style="font-size:13px; padding:5px 12px;">
                    {{ ucfirst($job->status) }}
                </span>
                <a href="{{ route('recruiter.jobs.edit', $job) }}" class="sh-btn-primary" style="font-size:14px; padding:9px 18px;">
                    Edit Job
                </a>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="sh-alert sh-alert--success" role="status" style="margin-bottom:20px;">✓ {{ session('success') }}</div>
    @endif

    {{-- Stats row --}}
    <div class="sh-stat-grid" style="grid-template-columns: repeat(4,1fr); margin-bottom:24px;">
        <div class="sh-stat-card">
            <p class="sh-stat-card__label">Total Applicants</p>
            <p class="sh-stat-card__value sh-stat-card__value--blue">{{ $job->applications_count }}</p>
        </div>
        <div class="sh-stat-card">
            <p class="sh-stat-card__label">Salary</p>
            <p class="sh-stat-card__value" style="font-size:18px; margin-top:4px;">{{ $job->salaryRange() }}</p>
        </div>
        <div class="sh-stat-card">
            <p class="sh-stat-card__label">Experience</p>
            <p class="sh-stat-card__value" style="font-size:22px; margin-top:4px;">
                {{ $job->experience_required ? $job->experience_required . ' yr' : 'Any' }}
            </p>
        </div>
        <div class="sh-stat-card">
            <p class="sh-stat-card__label">Deadline</p>
            <p class="sh-stat-card__value" style="font-size:18px; margin-top:4px;">
                {{ $job->deadline ? $job->deadline->format('d M Y') : '—' }}
            </p>
        </div>
    </div>

    <div class="sh-dash-grid">

        {{-- Applicants list --}}
        <div class="sh-panel">
            <div class="sh-panel__header">
                <h2 class="sh-panel__title">Applicants ({{ $applications->total() }})</h2>
            </div>

            @forelse($applications as $app)
                <div class="sh-app-row">
                    <div class="sh-app-row__logo">
                        {{ strtoupper(substr($app->applicantProfile->user->name ?? 'A', 0, 2)) }}
                    </div>
                    <div class="sh-app-row__info">
                        <p class="sh-app-row__title">{{ $app->applicantProfile->user->name ?? '—' }}</p>
                        <p class="sh-app-row__company">Applied {{ $app->created_at->diffForHumans() }}</p>
                    </div>
                    <div class="sh-app-row__right">
                        <span class="sh-status-badge sh-status-badge--{{ $app->status }}">{{ ucfirst($app->status) }}</span>
                        @if($app->aiAnalysis)
                            <span class="sh-score-chip sh-score-chip--{{ $app->aiAnalysis->match_score >= 70 ? 'high' : ($app->aiAnalysis->match_score >= 40 ? 'medium' : 'low') }}">
                                AI {{ $app->aiAnalysis->match_score }}%
                            </span>
                        @else
                            <span style="font-size:11px; color:var(--color-ink-muted-48);">Not scored</span>
                        @endif
                    </div>
                </div>
            @empty
                <div class="sh-empty-state">
                    <p class="sh-empty-state__title">No applicants yet</p>
                    <p class="sh-empty-state__text">Share this job posting to attract candidates.</p>
                </div>
            @endforelse

            @if($applications->hasPages())
                <div style="padding:16px 22px; border-top:1px solid var(--color-hairline);">
                    {{ $applications->links() }}
                </div>
            @endif
        </div>

        {{-- Job details sidebar --}}
        <div style="display:flex; flex-direction:column; gap:16px;">
            <div class="sh-panel">
                <div class="sh-panel__header"><h2 class="sh-panel__title">Description</h2></div>
                <div class="sh-panel__body">
                    <p style="font-size:14px; color:var(--color-ink-muted-80); line-height:1.6; white-space:pre-line;">{{ $job->description }}</p>
                </div>
            </div>
            <div class="sh-panel">
                <div class="sh-panel__header"><h2 class="sh-panel__title">Requirements</h2></div>
                <div class="sh-panel__body">
                    <p style="font-size:14px; color:var(--color-ink-muted-80); line-height:1.6; white-space:pre-line;">{{ $job->requirements }}</p>
                </div>
            </div>
            @if($job->responsibilities)
            <div class="sh-panel">
                <div class="sh-panel__header"><h2 class="sh-panel__title">Responsibilities</h2></div>
                <div class="sh-panel__body">
                    <p style="font-size:14px; color:var(--color-ink-muted-80); line-height:1.6; white-space:pre-line;">{{ $job->responsibilities }}</p>
                </div>
            </div>
            @endif
        </div>
    </div>

</x-dashboard-layout>
