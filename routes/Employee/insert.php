<?php

use App\Http\Controllers\Employee\EmployeeInsertController;
use Illuminate\Support\Facades\Route;

Route::prefix('')->group(function () {
    Route::post('/TimeInInsert', [EmployeeInsertController::class,'TimeInInsert']);
    Route::post('/TimeOutInsert', [EmployeeInsertController::class,'TimeOutInsert']);
    Route::post('/overtimeApplicationInsert', [EmployeeInsertController::class,'overtimeApplicationInsert']);
    Route::post('/insertEmployeeLeave', [EmployeeInsertController::class,'insertEmployeeLeave']);
    Route::post('/insertEmployeeResignation', [EmployeeInsertController::class,'insertEmployeeResignation']);
    Route::post('/insertHealthCheck', [EmployeeInsertController::class,'insertHealthCheck']);


});
