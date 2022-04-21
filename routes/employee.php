<?php

use App\Http\Controllers\PagesController;

Route::prefix('employee')->group(function () {
    Route::get('/home', [PagesController::class, 'employeehome']);
    Route::get('/orientation', [PagesController::class, 'employeeorientation']);
    Route::get('/training', [PagesController::class, 'employeetraining']);
    Route::get('/correction', [PagesController::class, 'employeecorrection']);
    Route::get('/message', [PagesController::class, 'employeemessage']);
    Route::get('/profile', [PagesController::class, 'employeeprofile']);
});
