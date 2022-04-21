<?php

use App\Http\Controllers\Admin\AdminController;

Route::prefix('admin')->group(function () {
    Route::get('/home', [AdminController::class, 'adminhome']);
    Route::get('/attendance', [AdminController::class, 'attendance']);
    Route::get('/performance', [AdminController::class, 'performance']);
    Route::get('/peopleorientation', [AdminController::class, 'peopleorientation']);
    Route::get('/moduleorientation', [AdminController::class, 'moduleorientation']);
    Route::get('/peopletraining', [AdminController::class, 'peopletraining']);
    Route::get('/moduletraining', [AdminController::class, 'moduletraining']);
    Route::get('/peoplecorrection', [AdminController::class, 'peoplecorrection']);
    Route::get('/modulecorrection', [AdminController::class, 'modulecorrection']);
    Route::get('/message', [AdminController::class, 'adminmessage']);
    Route::get('/notification', [AdminController::class, 'adminnotification']);
});
