<x-dashboard-layout title="Edit Job" active-page="jobs">

    <div class="sh-dash-header">
        <a href="{{ route('recruiter.jobs.show', $job) }}" class="sh-panel__action" style="display:inline-flex;align-items:center;gap:4px;margin-bottom:8px;">
            ← Back to Job
        </a>
        <h1 class="sh-dash-header__greeting">Edit Job Posting</h1>
        <p class="sh-dash-header__sub">{{ $job->title }}</p>
    </div>

    <form method="POST" action="{{ route('recruiter.jobs.update', $job) }}" id="job-edit-form">
        @csrf
        @method('PATCH')

        <div style="display:grid; grid-template-columns:1fr 320px; gap:20px; align-items:start;">

            <div style="display:flex; flex-direction:column; gap:16px;">

                <div class="sh-panel">
                    <div class="sh-panel__header"><h2 class="sh-panel__title">Basic Information</h2></div>
                    <div class="sh-panel__body" style="display:flex; flex-direction:column; gap:16px;">

                        <div class="sh-form-group">
                            <label for="title" class="sh-form-label">Job Title <span style="color:#cc0000">*</span></label>
                            <input id="title" type="text" name="title"
                                class="sh-form-input {{ $errors->has('title') ? 'sh-form-input--error' : '' }}"
                                value="{{ old('title', $job->title) }}" required>
                            @error('title')<span class="sh-form-error">{{ $message }}</span>@enderror
                        </div>

                        <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
                            <div class="sh-form-group">
                                <label for="department" class="sh-form-label">Department</label>
                                <input id="department" type="text" name="department"
                                    class="sh-form-input" value="{{ old('department', $job->department) }}">
                            </div>
                            <div class="sh-form-group">
                                <label for="location" class="sh-form-label">Location <span style="color:#cc0000">*</span></label>
                                <input id="location" type="text" name="location"
                                    class="sh-form-input" value="{{ old('location', $job->location) }}" required>
                            </div>
                        </div>

                        <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
                            <div class="sh-form-group">
                                <label for="type" class="sh-form-label">Employment Type <span style="color:#cc0000">*</span></label>
                                <select id="type" name="type" class="sh-form-input" required>
                                    @foreach(['full-time' => 'Full Time','part-time' => 'Part Time','contract' => 'Contract','internship' => 'Internship','remote' => 'Remote'] as $val => $label)
                                        <option value="{{ $val }}" {{ old('type', $job->type) === $val ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="sh-form-group">
                                <label for="experience_required" class="sh-form-label">Experience (years)</label>
                                <input id="experience_required" type="number" name="experience_required"
                                    class="sh-form-input" value="{{ old('experience_required', $job->experience_required) }}" min="0" max="30">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="sh-panel">
                    <div class="sh-panel__header"><h2 class="sh-panel__title">Job Details</h2></div>
                    <div class="sh-panel__body" style="display:flex; flex-direction:column; gap:16px;">

                        <div class="sh-form-group">
                            <label for="description" class="sh-form-label">Job Description <span style="color:#cc0000">*</span></label>
                            <textarea id="description" name="description" rows="6" class="sh-form-input" required>{{ old('description', $job->description) }}</textarea>
                            @error('description')<span class="sh-form-error">{{ $message }}</span>@enderror
                        </div>

                        <div class="sh-form-group">
                            <label for="requirements" class="sh-form-label">Requirements <span style="color:#cc0000">*</span></label>
                            <textarea id="requirements" name="requirements" rows="6" class="sh-form-input" required>{{ old('requirements', $job->requirements) }}</textarea>
                            <p style="font-size:12px; color:var(--color-primary); margin-top:4px;">💡 Be specific — AI scoring uses this field.</p>
                        </div>

                        <div class="sh-form-group">
                            <label for="responsibilities" class="sh-form-label">Responsibilities</label>
                            <textarea id="responsibilities" name="responsibilities" rows="4" class="sh-form-input">{{ old('responsibilities', $job->responsibilities) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div style="display:flex; flex-direction:column; gap:16px;">

                <div class="sh-panel">
                    <div class="sh-panel__header"><h2 class="sh-panel__title">Publish Settings</h2></div>
                    <div class="sh-panel__body" style="display:flex; flex-direction:column; gap:16px;">

                        <div class="sh-form-group">
                            <label class="sh-form-label">Status</label>
                            <div style="display:flex; flex-direction:column; gap:8px;">
                                @foreach(['draft' => 'Draft','active' => 'Active','closed' => 'Closed'] as $val => $label)
                                    <label class="sh-checkbox-label">
                                        <input type="radio" name="status" value="{{ $val }}" class="sh-checkbox"
                                            {{ old('status', $job->status) === $val ? 'checked' : '' }}>
                                        {{ $label }}
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="sh-form-group">
                            <label for="deadline" class="sh-form-label">Application Deadline</label>
                            <input id="deadline" type="date" name="deadline"
                                class="sh-form-input"
                                value="{{ old('deadline', $job->deadline?->format('Y-m-d')) }}">
                        </div>
                    </div>
                </div>

                <div class="sh-panel">
                    <div class="sh-panel__header"><h2 class="sh-panel__title">Salary Range</h2></div>
                    <div class="sh-panel__body" style="display:flex; flex-direction:column; gap:12px;">
                        <div class="sh-form-group">
                            <label for="min_salary" class="sh-form-label">Minimum (Rp)</label>
                            <input id="min_salary" type="number" name="min_salary" class="sh-form-input"
                                value="{{ old('min_salary', $job->min_salary) }}" min="0" step="500000">
                        </div>
                        <div class="sh-form-group">
                            <label for="max_salary" class="sh-form-label">Maximum (Rp)</label>
                            <input id="max_salary" type="number" name="max_salary" class="sh-form-input"
                                value="{{ old('max_salary', $job->max_salary) }}" min="0" step="500000">
                        </div>
                    </div>
                </div>

                <button type="submit" class="sh-btn-auth-submit" id="btn-update-job">Save Changes</button>

                <form method="POST" action="{{ route('recruiter.jobs.destroy', $job) }}"
                      onsubmit="return confirm('Delete this job posting? This cannot be undone.')"
                      style="margin-top:-4px;">
                    @csrf @method('DELETE')
                    <button type="submit"
                        style="display:block; width:100%; text-align:center; font-size:14px; color:#cc0000; background:none; border:1px solid #ffcdd2; border-radius:var(--rounded-pill); padding:10px; cursor:pointer; font-family:inherit; transition:background 0.15s;"
                        onmouseover="this.style.background='#fff0f0'"
                        onmouseout="this.style.background='none'">
                        Delete Job Posting
                    </button>
                </form>
            </div>
        </div>
    </form>

</x-dashboard-layout>
