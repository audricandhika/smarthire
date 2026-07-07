<?php

use App\Http\Controllers\Applicant\DashboardController as ApplicantDashboard;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Recruiter\DashboardController as RecruiterDashboard;
use Illuminate\Support\Facades\Route;

// ─── Public ──────────────────────────────────────────────────────────────
Route::get('/', fn () => view('welcome'))->name('home');
Route::get('/jobs', fn () => view('jobs.index'))->name('jobs.index');

// ─── Auth (Breeze) ────────────────────────────────────────────────────────
require __DIR__ . '/auth.php';

// ─── Authenticated ────────────────────────────────────────────────────────
Route::middleware(['auth', 'verified'])->group(function () {

    // Breeze profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ── Applicant routes ──────────────────────────────────────────
    Route::middleware('role:applicant')->prefix('applicant')->name('applicant.')->group(function () {
        Route::get('/dashboard', [ApplicantDashboard::class, 'index'])->name('dashboard');
    });

    // ── Recruiter routes ──────────────────────────────────────────
    Route::middleware('role:recruiter')->prefix('recruiter')->name('recruiter.')->group(function () {
        Route::get('/dashboard', [RecruiterDashboard::class, 'index'])->name('dashboard');
    });

});
