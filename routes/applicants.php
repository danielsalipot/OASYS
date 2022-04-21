<?php

use App\Http\Controllers\PagesController;
use App\Http\Controllers\CrudController;

Route::prefix('applicant')->group(function () {
    Route::get('/introduce', [PagesController::class, 'introduce']);
    Route::get('/signup', [PagesController::class, 'signup']);
    Route::get('/application', [PagesController::class, 'application']);
    Route::get('/applying', [PagesController::class, 'applying']);
    Route::get('/home', [PagesController::class, 'applicanthome']);
});
