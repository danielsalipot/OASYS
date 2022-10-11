<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {
    Route::get('/home', [AdminController::class, 'adminhome'])->middleware('prevent-back-history');
    Route::get('/attendance', [AdminController::class, 'attendance'])->middleware('prevent-back-history');
    Route::get('/audittrail', [AdminController::class, 'audittrail'])->middleware('prevent-back-history');
    Route::get('/forms', [AdminController::class, 'LegalForms'])->middleware('prevent-back-history');
    Route::get('/manual', [AdminController::class, 'adminManual'])->middleware('prevent-back-history');

    Route::get('/employees/activities', [AdminController::class, 'employee_activities'])->middleware('prevent-back-history');

    Route::get('/regularization', [AdminController::class, 'regularization'])->middleware('prevent-back-history');
    Route::get('/regularization/{id}', [AdminController::class, 'regularization_main'])->middleware('prevent-back-history');


    Route::get('/performance', [AdminController::class, 'performance'])->middleware('prevent-back-history');
    Route::get('/performance/{id}', [AdminController::class, 'assessment'])->middleware('prevent-back-history');
    Route::get('/performance/{id}/history', [AdminController::class, 'assessment_history'])->middleware('prevent-back-history');

    Route::get('/orientation/add', [AdminController::class, 'addorientation'])->middleware('prevent-back-history');
    Route::get('/orientation/{id}/edit', [AdminController::class, 'editlessonorientation'])->middleware('prevent-back-history');
    Route::get('/orientation/people', [AdminController::class, 'peopleorientation'])->middleware('prevent-back-history');
    Route::get('/orientation/module', [AdminController::class, 'moduleorientation'])->middleware('prevent-back-history');

    Route::get('/training/add', [AdminController::class, 'addtraining'])->middleware('prevent-back-history');
    Route::get('/training/people', [AdminController::class, 'peopletraining'])->middleware('prevent-back-history');
    Route::get('/training/{id}/edit', [AdminController::class, 'editlessontraining'])->middleware('prevent-back-history');
    Route::get('/training/module', [AdminController::class, 'moduletraining'])->middleware('prevent-back-history');

    Route::get('/correction/add', [AdminController::class, 'addcorrection'])->middleware('prevent-back-history');
    Route::get('/correction/{id}/edit', [AdminController::class, 'editlessoncorrection'])->middleware('prevent-back-history');
    Route::get('/correction/people', [AdminController::class, 'peoplecorrection'])->middleware('prevent-back-history');
    Route::get('/correction/module', [AdminController::class, 'modulecorrection'])->middleware('prevent-back-history');

});
