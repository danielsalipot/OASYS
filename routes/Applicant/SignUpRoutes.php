<?php

use App\Http\Controllers\Applicant\ApplicantSignUpController;

Route::prefix('applicant')->group(function () {
    // STEP 1 BACKEND ROUTE
    Route::post('/crudsignup', [ApplicantSignUpController::class, 'crudsignup']);

    // STEP 2 BACKEND ROUTE
    Route::post('/crudintroduce', [ApplicantSignUpController::class, 'crudintroduce']);

    // STEP 3 BACKEND ROUTE
    Route::post('/crudapply', [ApplicantSignUpController::class, 'crudapply']);

    //Delete applicant's account
    Route::get('/deleteApplication', [ApplicantSignUpController::class, 'deleteApplication']);
});
