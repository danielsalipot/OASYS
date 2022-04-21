<?php

use App\Http\Controllers\Applicant\ApplicantController;

Route::prefix('applicant')->group(function () {
    Route::get('/introduce', [ApplicantController::class, 'introduce']);
    Route::get('/signup', [ApplicantController::class, 'signup']);
    Route::get('/application', [ApplicantController::class, 'application']);
    Route::get('/applying', [ApplicantController::class, 'applying']);
    Route::get('/home', [ApplicantController::class, 'applicanthome']);
});
