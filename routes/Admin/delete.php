<?php

use App\Http\Controllers\Admin\AdminDeleteController;

Route::prefix('')->group(function () {
    Route::post('/deleteVideo', [AdminDeleteController::class, 'deleteVideo']);
    Route::post('/deleteEmployeeAssessment', [AdminDeleteController::class, 'deleteEmployeeAssessment']);
});
