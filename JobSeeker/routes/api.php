<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ValidationController;
use App\Http\Controllers\Api\JobVacancyController;
use App\Http\Controllers\Api\ApplicationController;

Route::prefix('v1')->group(function () {
    Route::post('/auth/login', [AuthController::class, 'login']);
    Route::post('/auth/logout', [AuthController::class, 'logout']);

    Route::middleware('auth.api')->group(function () {
        Route::post('/validation', [ValidationController::class, 'store']);
        Route::get('/validations', [ValidationController::class, 'show']);

        Route::get('/job_vacancies', [JobVacancyController::class, 'index']);
        Route::get('/job_vacancies/{id}', [JobVacancyController::class, 'show']);

        Route::post('/applications', [ApplicationController::class, 'store']);
        Route::get('/applications', [ApplicationController::class, 'index']);
    });
});
