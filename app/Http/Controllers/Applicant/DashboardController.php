<?php

namespace App\Http\Controllers\Applicant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        $user    = $request->user();
        $profile = $user->applicantProfile;

        if ($profile) {
            $profile->loadMissing(['skills', 'workExperiences', 'educations']);
        }

        $applications = $profile
            ? $profile->applications()
                ->with(['jobPosting.company', 'aiAnalysis'])
                ->latest()
                ->take(5)
                ->get()
            : collect();

        $stats = [
            'total'     => $profile?->applications()->count() ?? 0,
            'pending'   => $profile?->applications()->where('status', 'pending')->count() ?? 0,
            'reviewing' => $profile?->applications()->where('status', 'reviewing')->count() ?? 0,
            'accepted'  => $profile?->applications()->where('status', 'accepted')->count() ?? 0,
        ];

        return view('applicant.dashboard', compact('user', 'profile', 'applications', 'stats'));
    }
}
