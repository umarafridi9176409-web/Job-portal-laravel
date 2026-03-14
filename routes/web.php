<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Employer\JobController as EmployerJobController;
use App\Http\Controllers\Admin\ModerationController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\SavedJobController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Seeker Authenticated Routes
    Route::get('/seeker/dashboard', [JobController::class, 'dashboard'])->name('seeker.dashboard');
    Route::get('/saved-jobs', [SavedJobController::class, 'index'])->name('jobs.saved');
    Route::post('/jobs/{job}/save', [SavedJobController::class, 'toggle'])->name('jobs.toggle-save');
    Route::post('/jobs/{job}/apply', [ApplicationController::class, 'store'])->name('applications.store');

    // Employer Routes
    Route::middleware(['auth'])->prefix('employer')->name('employer.')->group(function () {
        Route::get('jobs/{job}/applicants', [EmployerJobController::class, 'applicants'])->name('jobs.applicants');
        Route::patch('applications/{application}/status', [EmployerJobController::class, 'updateApplicationStatus'])->name('applications.status.update');
        Route::resource('jobs', EmployerJobController::class);
    });

    // Admin Routes
    Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('moderation', [ModerationController::class, 'index'])->name('moderation.index');
        Route::post('moderation/{job}/approve', [ModerationController::class, 'approve'])->name('moderation.approve');
        Route::post('moderation/{job}/reject', [ModerationController::class, 'reject'])->name('moderation.reject');
    });

});

// Public Seeker Routes
Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
Route::get('/api/jobs/search', [JobController::class, 'search'])->name('api.jobs.search');
Route::get('/jobs/{job:slug}', [JobController::class, 'show'])->name('jobs.show');

require __DIR__.'/auth.php';
