<?php

use App\Http\Controllers\Employee\JsonController;

Route::prefix('')->group(function () {
    Route::get('/overtimeJsonEmployee', [JsonController::class, 'overtimeJsonEmployee']);
    Route::get('/AssessmentJson', [JsonController::class, 'AssessmentJson']);
});

