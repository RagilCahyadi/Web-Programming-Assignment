<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ValidationController;
use App\Http\Controllers\JobVacancyController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\ValidationManagementController;

// Society (Job Seeker) Routes
Route::get('/', [AuthController::class, 'showLogin'])->name('login')->middleware('redirect.if.authenticated:society');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('redirect.if.authenticated:society');
Route::post('/login/action', [AuthController::class, 'login'])->name('login.action');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth.society')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/validation', [ValidationController::class, 'index'])->name('validation.index');
    Route::post('/validation', [ValidationController::class, 'store'])->name('validation.store');

    Route::get('/job-vacancies', [JobVacancyController::class, 'index'])->name('job-vacancies.index');
    Route::get('/job-vacancies/{id}', [JobVacancyController::class, 'show'])->name('job-vacancies.show');

    Route::get('/applications', [ApplicationController::class, 'index'])->name('applications.index');
    Route::post('/applications', [ApplicationController::class, 'store'])->name('applications.store');
});

// Admin Routes (Validators & Officers)
Route::prefix('admin')->group(function () {

    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('admin.login')->middleware('redirect.if.authenticated:admin');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.post');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

    Route::middleware('auth.admin')->group(function () {

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

        // Validation Management (for both validators and officers)
        Route::get('/validations', [ValidationManagementController::class, 'index'])->name('admin.validations.index');
        Route::get('/validations/{id}', [ValidationManagementController::class, 'show'])->name('admin.validations.show');
        Route::post('/validations/{id}/assign', [ValidationManagementController::class, 'assign'])->name('admin.validations.assign');


        Route::post('/validations/{id}/update', [ValidationManagementController::class, 'update'])->name('admin.validations.update');
    });
});
