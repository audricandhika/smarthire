<?php

namespace App\Http\Controllers\Recruiter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        $user    = $request->user();
        $company = $user->company;

        $recentApplications = collect();
        $stats = ['jobs' => 0, 'total_applicants' => 0, 'pending' => 0, 'accepted' => 0];

        if ($company) {
            $recentApplications = \App\Models\Application::whereHas('jobPosting', fn ($q) =>
                    $q->where('company_id', $company->id)
                )->with(['applicantProfile.user', 'jobPosting', 'aiAnalysis'])
                ->latest()
                ->take(6)
                ->get();

            $stats = [
                'jobs'             => $company->jobPostings()->where('status', 'active')->count(),
                'total_applicants' => \App\Models\Application::whereHas('jobPosting', fn ($q) =>
                        $q->where('company_id', $company->id))->count(),
                'pending'          => \App\Models\Application::whereHas('jobPosting', fn ($q) =>
                        $q->where('company_id', $company->id))->where('status', 'pending')->count(),
                'accepted'         => \App\Models\Application::whereHas('jobPosting', fn ($q) =>
                        $q->where('company_id', $company->id))->where('status', 'accepted')->count(),
            ];
        }

        return view('recruiter.dashboard', compact('user', 'company', 'recentApplications', 'stats'));
    }
}
