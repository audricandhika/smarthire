<?php

namespace App\Http\Controllers\Recruiter;

use App\Http\Controllers\Controller;
use App\Models\JobPosting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class JobPostingController extends Controller
{
    public function index(Request $request): View
    {
        $company = $request->user()->company;

        $jobs = $company
            ? $company->jobPostings()->withCount('applications')->latest()->paginate(10)
            : collect();

        return view('recruiter.jobs.index', compact('company', 'jobs'));
    }

    public function create(Request $request): View
    {
        abort_unless($request->user()->company, 403, 'Please set up your company profile first.');

        return view('recruiter.jobs.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $company = $request->user()->company;
        abort_unless($company, 403);

        $data = $request->validate([
            'title'               => ['required', 'string', 'max:255'],
            'department'          => ['nullable', 'string', 'max:100'],
            'location'            => ['required', 'string', 'max:255'],
            'type'                => ['required', 'in:full-time,part-time,contract,internship,remote'],
            'experience_required' => ['nullable', 'integer', 'min:0', 'max:30'],
            'min_salary'          => ['nullable', 'numeric', 'min:0'],
            'max_salary'          => ['nullable', 'numeric', 'min:0'],
            'description'         => ['required', 'string'],
            'requirements'        => ['required', 'string'],
            'responsibilities'    => ['nullable', 'string'],
            'deadline'            => ['nullable', 'date', 'after:today'],
            'status'              => ['required', 'in:draft,active'],
        ]);

        $company->jobPostings()->create($data);

        return redirect()
            ->route('recruiter.jobs.index')
            ->with('success', 'Job posting created successfully!');
    }

    public function show(Request $request, JobPosting $job): View
    {
        $this->authorizeJob($request, $job);

        $job->loadCount('applications');
        $applications = $job->applications()
            ->with(['applicantProfile.user', 'aiAnalysis'])
            ->latest()
            ->paginate(15);

        return view('recruiter.jobs.show', compact('job', 'applications'));
    }

    public function edit(Request $request, JobPosting $job): View
    {
        $this->authorizeJob($request, $job);

        return view('recruiter.jobs.edit', compact('job'));
    }

    public function update(Request $request, JobPosting $job): RedirectResponse
    {
        $this->authorizeJob($request, $job);

        $data = $request->validate([
            'title'               => ['required', 'string', 'max:255'],
            'department'          => ['nullable', 'string', 'max:100'],
            'location'            => ['required', 'string', 'max:255'],
            'type'                => ['required', 'in:full-time,part-time,contract,internship,remote'],
            'experience_required' => ['nullable', 'integer', 'min:0', 'max:30'],
            'min_salary'          => ['nullable', 'numeric', 'min:0'],
            'max_salary'          => ['nullable', 'numeric', 'min:0'],
            'description'         => ['required', 'string'],
            'requirements'        => ['required', 'string'],
            'responsibilities'    => ['nullable', 'string'],
            'deadline'            => ['nullable', 'date'],
            'status'              => ['required', 'in:draft,active,closed'],
        ]);

        $job->update($data);

        return redirect()
            ->route('recruiter.jobs.show', $job)
            ->with('success', 'Job posting updated.');
    }

    public function destroy(Request $request, JobPosting $job): RedirectResponse
    {
        $this->authorizeJob($request, $job);

        $job->delete();

        return redirect()
            ->route('recruiter.jobs.index')
            ->with('success', 'Job posting deleted.');
    }

    private function authorizeJob(Request $request, JobPosting $job): void
    {
        abort_unless(
            $request->user()->company?->id === $job->company_id,
            403,
            'This job posting does not belong to your company.'
        );
    }
}
