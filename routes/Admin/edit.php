<?php

use App\Http\Controllers\Admin\AdminEditController;

Route::prefix('')->group(function () {
    Route::post('/editLesson', [AdminEditController::class, 'editLesson']);
    Route::post('/completeEmployeeModule', [AdminEditController::class, 'completeEmployeeModule']);
    Route::post('/updateEmployeeAssessment', [AdminEditController::class, 'updateEmployeeAssessment']);
    Route::get('/updateEmploymentStatus/{id}', [AdminEditController::class, 'updateEmploymentStatus']);
});
