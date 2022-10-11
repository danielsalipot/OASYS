<?php

use App\Http\Controllers\Staff\StaffController;

Route::prefix('staff')->group(function () {
    Route::get('/home', [StaffController::class, 'staffhome'])->middleware('prevent-back-history');
    Route::get('/onboarding', [StaffController::class, 'onboarding'])->middleware('prevent-back-history');
    Route::get('/termination', [StaffController::class, 'termination'])->middleware('prevent-back-history');
    Route::get('/offboarding', [StaffController::class, 'offboarding'])->middleware('prevent-back-history');
    Route::get('/schedules', [StaffController::class, 'schedules'])->middleware('prevent-back-history');
    Route::get('/interview', [StaffController::class, 'interview'])->middleware('prevent-back-history');
    Route::get('/department', [StaffController::class, 'department'])->middleware('prevent-back-history');
    Route::get('/audittrail', [StaffController::class, 'audittrail'])->middleware('prevent-back-history');
    Route::get('/position', [StaffController::class, 'position'])->middleware('prevent-back-history');
    Route::get('/manual', [StaffController::class, 'staffManual'])->middleware('prevent-back-history');

});
