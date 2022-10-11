<?php

use App\Http\Controllers\Employee\EmployeeController;

Route::prefix('employee')->group(function () {
    Route::get('/home', [EmployeeController::class, 'employeehome'])->middleware('prevent-back-history');
    Route::get('/orientation', [EmployeeController::class, 'employeeorientation'])->middleware('prevent-back-history');
    Route::get('/training', [EmployeeController::class, 'employeetraining'])->middleware('prevent-back-history');
    Route::get('/correction', [EmployeeController::class, 'employeecorrection'])->middleware('prevent-back-history');
    Route::get('/profile', [EmployeeController::class, 'profile'])->middleware('prevent-back-history');
    Route::get('/overtime', [EmployeeController::class, 'overtime'])->middleware('prevent-back-history');
    Route::get('/leave', [EmployeeController::class, 'leave'])->middleware('prevent-back-history');
    Route::get('/manual', [EmployeeController::class, 'employeeManual'])->middleware('prevent-back-history');
    Route::get('/profile/update', [EmployeeController::class, 'updateProfile'])->middleware('prevent-back-history');
});

