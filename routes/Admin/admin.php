<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {
    Route::get('/home', [AdminController::class, 'adminhome']);
    Route::get('/attendance', [AdminController::class, 'attendance']);
    Route::get('/audittrail', [AdminController::class, 'audittrail']);
    Route::get('/forms', [AdminController::class, 'LegalForms']);

    Route::get('/employees/activities', [AdminController::class, 'employee_activities']);

    Route::get('/regularization', [AdminController::class, 'regularization']);
    Route::get('/regularization/{id}', [AdminController::class, 'regularization_main']);


    Route::get('/performance', [AdminController::class, 'performance']);
    Route::get('/performance/{id}', [AdminController::class, 'assessment']);
    Route::get('/performance/{id}/history', [AdminController::class, 'assessment_history']);

    Route::get('/orientation/add', [AdminController::class, 'addorientation']);
    Route::get('/orientation/{id}/edit', [AdminController::class, 'editlessonorientation']);
    Route::get('/orientation/people', [AdminController::class, 'peopleorientation']);
    Route::get('/orientation/module', [AdminController::class, 'moduleorientation']);

    Route::get('/training/add', [AdminController::class, 'addtraining']);
    Route::get('/training/people', [AdminController::class, 'peopletraining']);
    Route::get('/training/{id}/edit', [AdminController::class, 'editlessontraining']);
    Route::get('/training/module', [AdminController::class, 'moduletraining']);

    Route::get('/correction/add', [AdminController::class, 'addcorrection']);
    Route::get('/correction/{id}/edit', [AdminController::class, 'editlessoncorrection']);
    Route::get('/correction/people', [AdminController::class, 'peoplecorrection']);
    Route::get('/correction/module', [AdminController::class, 'modulecorrection']);

    Route::get('/message', [AdminController::class, 'adminmessage']);
    Route::get('/notification', [AdminController::class, 'adminnotification']);
});
