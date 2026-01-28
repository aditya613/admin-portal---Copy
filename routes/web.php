<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\JobController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\ApplicationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('isAdmin')->group(function () {
    Route::get('/admin', function () {
        return 'Admin Dashboard';
    });
});

Route::middleware(['auth','isAdmin'])->prefix('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
    
    // Jobs routes
    Route::get('/jobs', [JobController::class, 'index'])->name('admin.jobs.index');
    Route::get('/jobs/statistics', [JobController::class, 'statistics'])->name('admin.jobs.statistics');
    Route::get('/jobs/{id}', [JobController::class, 'show'])->name('admin.jobs.show');
    Route::delete('/jobs/{id}', [JobController::class, 'destroy'])->name('admin.jobs.destroy');
    Route::patch('/jobs/{id}/verify', [JobController::class, 'updateVerificationStatus'])->name('admin.jobs.verify');
    
    // Students routes
    Route::get('/students', [StudentController::class, 'index'])->name('admin.students.index');
    Route::get('/students/statistics', [StudentController::class, 'statistics'])->name('admin.students.statistics');
    Route::get('/students/{id}', [StudentController::class, 'show'])->name('admin.students.show');
    Route::post('/api/analyze-resume', [StudentController::class, 'analyzeResume'])->name('admin.students.analyzeResume');
    Route::get('/api/resume/{studentId}', [StudentController::class, 'getResume'])->name('admin.students.getResume');
    
    // Applications routes
    Route::get('/applications', [ApplicationController::class, 'index'])->name('admin.applications.index');
    Route::get('/applications/statistics', [ApplicationController::class, 'statistics'])->name('admin.applications.statistics');
    Route::get('/applications/{id}', [ApplicationController::class, 'show'])->name('admin.applications.show');
    Route::get('/api/applications/student/{studentId}', [ApplicationController::class, 'studentApplications']);
    Route::get('/api/applications/job/{jobId}', [ApplicationController::class, 'jobApplications']);
});


require __DIR__.'/auth.php';
