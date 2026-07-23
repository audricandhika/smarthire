<x-dashboard-layout title="Post a Job" active-page="jobs">

    <div class="sh-dash-header">
        <a href="{{ route('recruiter.jobs.index') }}" class="sh-panel__action" style="display:inline-flex;align-items:center;gap:4px;margin-bottom:8px;">
            ← Back to Jobs
        </a>
        <h1 class="sh-dash-header__greeting">Post a New Job</h1>
        <p class="sh-dash-header__sub">Fill in the details below to publish your opening.</p>
    </div>

    <form method="POST" action="{{ route('recruiter.jobs.store') }}" id="job-form">
        @csrf

        <div style="display:grid; grid-template-columns:1fr 320px; gap:20px; align-items:start;">

            {{-- Main fields --}}
            <div style="display:flex; flex-direction:column; gap:16px;">

                {{-- Basic info --}}
                <div class="sh-panel">
                    <div class="sh-panel__header">
                        <h2 class="sh-panel__title">Basic Information</h2>
                    </div>
                    <div class="sh-panel__body" style="display:flex; flex-direction:column; gap:16px;">

                        <div class="sh-form-group">
                            <label for="title" class="sh-form-label">Job Title <span style="color:#cc0000">*</span></label>
                            <input id="title" type="text" name="title"
                                class="sh-form-input {{ $errors->has('title') ? 'sh-form-input--error' : '' }}"
                                value="{{ old('title') }}"
                                placeholder="e.g. Senior Frontend Engineer"
                                required>
                            @error('title')<span class="sh-form-error">{{ $message }}</span>@enderror
                        </div>

                        <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
                            <div class="sh-form-group">
                                <label for="department" class="sh-form-label">Department</label>
                                <input id="department" type="text" name="department"
                                    class="sh-form-input"
                                    value="{{ old('department') }}"
                                    placeholder="e.g. Engineering">
                            </div>
                            <div class="sh-form-group">
                                <label for="location" class="sh-form-label">Location <span style="color:#cc0000">*</span></label>
                                <input id="location" type="text" name="location"
                                    class="sh-form-input {{ $errors->has('location') ? 'sh-form-input--error' : '' }}"
                                    value="{{ old('location') }}"
                                    placeholder="e.g. Jakarta or Remote"
                                    required>
                                @error('location')<span class="sh-form-error">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
                            <div class="sh-form-group">
                                <label for="type" class="sh-form-label">Employment Type <span style="color:#cc0000">*</span></label>
                                <select id="type" name="type" class="sh-form-input {{ $errors->has('type') ? 'sh-form-input--error' : '' }}" required>
                                    <option value="">Select type…</option>
                                    @foreach(['full-time' => 'Full Time','part-time' => 'Part Time','contract' => 'Contract','internship' => 'Internship','remote' => 'Remote'] as $val => $label)
                                        <option value="{{ $val }}" {{ old('type') === $val ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
                                @error('type')<span class="sh-form-error">{{ $message }}</span>@enderror
                            </div>
                            <div class="sh-form-group">
                                <label for="experience_required" class="sh-form-label">Experience (years)</label>
                                <input id="experience_required" type="number" name="experience_required"
                                    class="sh-form-input"
                                    value="{{ old('experience_required', 0) }}"
                                    min="0" max="30">
                            </div>
                        </div>

                    </div>
                </div>

                {{-- Description --}}
                <div class="sh-panel">
                    <div class="sh-panel__header">
                        <h2 class="sh-panel__title">Job Details</h2>
                    </div>
                    <div class="sh-panel__body" style="display:flex; flex-direction:column; gap:16px;">

                        <div class="sh-form-group">
                            <label for="description" class="sh-form-label">Job Description <span style="color:#cc0000">*</span></label>
                            <textarea id="description" name="description" rows="6"
                                class="sh-form-input {{ $errors->has('description') ? 'sh-form-input--error' : '' }}"
                                placeholder="Describe what this role is about, the team, and day-to-day responsibilities…"
                                required>{{ old('description') }}</textarea>
                            @error('description')<span class="sh-form-error">{{ $message }}</span>@enderror
                        </div>

                        <div class="sh-form-group">
                            <label for="requirements" class="sh-form-label">Requirements <span style="color:#cc0000">*</span></label>
                            <textarea id="requirements" name="requirements" rows="6"
                                class="sh-form-input {{ $errors->has('requirements') ? 'sh-form-input--error' : '' }}"
                                placeholder="List required skills, qualifications, and experience. This is used by our AI to score candidates."
                                required>{{ old('requirements') }}</textarea>
                            <p style="font-size:12px; color:var(--color-primary); margin-top:4px;">
                                💡 Be specific — AI scoring uses this field to match candidates.
                            </p>
                            @error('requirements')<span class="sh-form-error">{{ $message }}</span>@enderror
                        </div>

                        <div class="sh-form-group">
                            <label for="responsibilities" class="sh-form-label">Responsibilities</label>
                            <textarea id="responsibilities" name="responsibilities" rows="4"
                                class="sh-form-input"
                                placeholder="List the main duties and responsibilities for this role…">{{ old('responsibilities') }}</textarea>
                        </div>

                    </div>
                </div>

            </div>

            {{-- Sidebar --}}
            <div style="display:flex; flex-direction:column; gap:16px;">

                {{-- Publish settings --}}
                <div class="sh-panel">
                    <div class="sh-panel__header">
                        <h2 class="sh-panel__title">Publish Settings</h2>
                    </div>
                    <div class="sh-panel__body" style="display:flex; flex-direction:column; gap:16px;">

                        <div class="sh-form-group">
                            <label class="sh-form-label">Status <span style="color:#cc0000">*</span></label>
                            <div style="display:flex; gap:10px;">
                                @foreach(['draft' => 'Save as Draft', 'active' => 'Publish Now'] as $val => $label)
                                    <label class="sh-role-card" style="flex:1;">
                                        <input type="radio" name="status" value="{{ $val }}"
                                            {{ old('status', 'draft') === $val ? 'checked' : '' }}>
                                        <div class="sh-role-card__body" style="padding:10px 8px;">
                                            <span class="sh-role-card__label" style="font-size:13px;">{{ $label }}</span>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="sh-form-group">
                            <label for="deadline" class="sh-form-label">Application Deadline</label>
                            <input id="deadline" type="date" name="deadline"
                                class="sh-form-input"
                                value="{{ old('deadline') }}"
                                min="{{ now()->addDay()->format('Y-m-d') }}">
                        </div>

                    </div>
                </div>

                {{-- Salary --}}
                <div class="sh-panel">
                    <div class="sh-panel__header">
                        <h2 class="sh-panel__title">Salary Range</h2>
                    </div>
                    <div class="sh-panel__body" style="display:flex; flex-direction:column; gap:12px;">
                        <div class="sh-form-group">
                            <label for="min_salary" class="sh-form-label">Minimum (Rp)</label>
                            <input id="min_salary" type="number" name="min_salary"
                                class="sh-form-input"
                                value="{{ old('min_salary') }}"
                                placeholder="0" min="0" step="500000">
                        </div>
                        <div class="sh-form-group">
                            <label for="max_salary" class="sh-form-label">Maximum (Rp)</label>
                            <input id="max_salary" type="number" name="max_salary"
                                class="sh-form-input"
                                value="{{ old('max_salary') }}"
                                placeholder="0" min="0" step="500000">
                        </div>
                        <p style="font-size:12px; color:var(--color-ink-muted-48);">Leave empty to show "Negotiable".</p>
                    </div>
                </div>

                {{-- Submit --}}
                <button type="submit" class="sh-btn-auth-submit" id="btn-submit-job">
                    Post Job
                </button>
                <a href="{{ route('recruiter.jobs.index') }}"
                   style="display:block; text-align:center; font-size:14px; color:var(--color-ink-muted-48); text-decoration:none; margin-top:-4px;">
                    Cancel
                </a>

            </div>
        </div>
    </form>

</x-dashboard-layout>
