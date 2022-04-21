<?php

use App\Http\Controllers\Employee\EmployeeController;

Route::prefix('employee')->group(function () {
    Route::get('/home', [EmployeeController::class, 'employeehome']);
    Route::get('/orientation', [EmployeeController::class, 'employeeorientation']);
    Route::get('/training', [EmployeeController::class, 'employeetraining']);
    Route::get('/correction', [EmployeeController::class, 'employeecorrection']);
    Route::get('/message', [EmployeeController::class, 'employeemessage']);
    Route::get('/profile', [EmployeeController::class, 'employeeprofile']);
});
