<?php

use App\Http\Controllers\Admin\AdminInsertController;

Route::prefix('')->group(function () {
    Route::get('/insertLesson', [AdminInsertController::class, 'insertLesson']);
    Route::post('/enrollEmployee', [AdminInsertController::class, 'enrollEmployee']);
    Route::post('/addAssessment', [AdminInsertController::class, 'addAssessment']);
    Route::post('/uploadLegalFormFiles', [AdminInsertController::class, 'uploadLegalFormFiles']);
});
