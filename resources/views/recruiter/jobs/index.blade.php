<x-dashboard-layout title="Job Postings" active-page="jobs">

    <div class="sh-dash-header">
        <div style="display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:12px;">
            <div>
                <h1 class="sh-dash-header__greeting">Job Postings</h1>
                <p class="sh-dash-header__sub">Manage your open positions and track applicants.</p>
            </div>
            <a href="{{ route('recruiter.jobs.create') }}" class="sh-btn-primary" id="btn-post-job">
                + Post a Job
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="sh-alert sh-alert--success" role="status" style="margin-bottom:20px;">
            ✓ {{ session('success') }}
        </div>
    @endif

    @if($jobs->isEmpty())
        <div class="sh-panel">
            <div class="sh-empty-state">
                <div class="sh-empty-state__icon">
                    <svg width="48" height="48" viewBox="0 0 48 48" fill="none"><rect x="4" y="14" width="40" height="30" rx="4" stroke="currentColor" stroke-width="1.5"/><path d="M16 14v-3a8 8 0 0 1 16 0v3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/><path d="M24 28v4M22 30h4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
                </div>
                <p class="sh-empty-state__title">No job postings yet</p>
                <p class="sh-empty-state__text">Create your first job posting to start receiving applications.</p>
                <a href="{{ route('recruiter.jobs.create') }}" class="sh-btn-primary">Post Your First Job</a>
            </div>
        </div>
    @else
        <div class="sh-panel">
            {{-- Table header --}}
            <div style="display:grid; grid-template-columns:1fr 100px 100px 80px 120px; gap:12px; padding:10px 22px; border-bottom:1px solid var(--color-hairline);">
                <p class="sh-stat-card__label">Position</p>
                <p class="sh-stat-card__label">Type</p>
                <p class="sh-stat-card__label">Applicants</p>
                <p class="sh-stat-card__label">Status</p>
                <p class="sh-stat-card__label" style="text-align:right;">Actions</p>
            </div>

            @foreach($jobs as $job)
                <div class="sh-app-row" style="display:grid; grid-template-columns:1fr 100px 100px 80px 120px; gap:12px; align-items:center;">

                    {{-- Title + meta --}}
                    <div>
                        <p class="sh-app-row__title">{{ $job->title }}</p>
                        <p class="sh-app-row__company">
                            {{ $job->location }}
                            @if($job->department) · {{ $job->department }} @endif
                            @if($job->deadline) · Closes {{ $job->deadline->format('d M Y') }} @endif
                        </p>
                    </div>

                    {{-- Type --}}
                    <p style="font-size:13px; color:var(--color-ink-muted-80);">
                        {{ Str::title(str_replace('-', ' ', $job->type)) }}
                    </p>

                    {{-- Applicants count --}}
                    <p style="font-size:15px; font-weight:600; color:var(--color-primary);">
                        {{ $job->applications_count }}
                    </p>

                    {{-- Status badge --}}
                    <span class="sh-status-badge sh-status-badge--{{ $job->status === 'active' ? 'accepted' : ($job->status === 'draft' ? 'pending' : 'rejected') }}">
                        {{ ucfirst($job->status) }}
                    </span>

                    {{-- Actions --}}
                    <div style="display:flex; gap:8px; justify-content:flex-end;">
                        <a href="{{ route('recruiter.jobs.show', $job) }}"
                           style="font-size:13px; color:var(--color-primary); text-decoration:none; padding:4px 0;">
                            View
                        </a>
                        <a href="{{ route('recruiter.jobs.edit', $job) }}"
                           style="font-size:13px; color:var(--color-ink-muted-48); text-decoration:none; padding:4px 0;">
                            Edit
                        </a>
                        <form method="POST" action="{{ route('recruiter.jobs.destroy', $job) }}"
                              onsubmit="return confirm('Delete this job posting?')">
                            @csrf @method('DELETE')
                            <button type="submit"
                                style="font-size:13px; color:#cc0000; background:none; border:none; cursor:pointer; padding:4px 0; font-family:inherit;">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach

            {{-- Pagination --}}
            @if($jobs->hasPages())
                <div style="padding:16px 22px; border-top:1px solid var(--color-hairline);">
                    {{ $jobs->links() }}
                </div>
            @endif
        </div>
    @endif

</x-dashboard-layout>
