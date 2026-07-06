<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/jobs', function () {
    return view('jobs.index');
})->name('jobs.index');

// Auth
require __DIR__.'/auth.php';

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Applicant dashboard
    Route::get('/applicant/dashboard', function () {
        return view('applicant.dashboard');
    })->name('applicant.dashboard');

    // Recruiter dashboard 
    Route::get('/recruiter/dashboard', function () {
        return view('recruiter.dashboard');
    })->name('recruiter.dashboard');

});
