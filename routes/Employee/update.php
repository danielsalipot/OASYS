<?php

use App\Http\Controllers\Employee\EmployeeUpdateController;
use Illuminate\Support\Facades\Route;

Route::prefix('')->group(function () {
    Route::post('/updateModule', [EmployeeUpdateController::class,'updateModule']);
    Route::post('/updateCompleteModule', [EmployeeUpdateController::class,'updateCompleteModule']);
    Route::post('/employeeUpdateDetail', [EmployeeUpdateController::class,'employeeUpdateDetail']);

});
