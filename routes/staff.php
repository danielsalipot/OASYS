<?php

use App\Http\Controllers\StaffController;

Route::prefix('staff')->group(function () {
    Route::get('/home', [StaffController::class, 'staffhome']);
    Route::get('/onboarding', [StaffController::class, 'onboarding']);
    Route::get('/termination', [StaffController::class, 'termination']);
    Route::get('/offboarding', [StaffController::class, 'offboarding']);
    Route::get('/schedules', [StaffController::class, 'schedules']);
    Route::get('/interview', [StaffController::class, 'interview']);
    Route::get('/department', [StaffController::class, 'department']);
    Route::get('/position', [StaffController::class, 'position']);
    Route::get('/message', [StaffController::class, 'staffmessage']);
    Route::get('/notification', [StaffController::class, 'staffnotification']);
});
