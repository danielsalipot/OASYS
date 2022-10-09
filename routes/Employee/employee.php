<?php

use App\Http\Controllers\Employee\EmployeeController;

Route::prefix('employee')->group(function () {
    Route::get('/home', [EmployeeController::class, 'employeehome']);
    Route::get('/orientation', [EmployeeController::class, 'employeeorientation']);
    Route::get('/training', [EmployeeController::class, 'employeetraining']);
    Route::get('/correction', [EmployeeController::class, 'employeecorrection']);
    Route::get('/profile', [EmployeeController::class, 'profile']);
    Route::get('/overtime', [EmployeeController::class, 'overtime']);
    Route::get('/leave', [EmployeeController::class, 'leave']);
    Route::get('/manual', [EmployeeController::class, 'employeeManual']);
    Route::get('/profile/update', [EmployeeController::class, 'updateProfile']);
});

