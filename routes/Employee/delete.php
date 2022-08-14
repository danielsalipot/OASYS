<?php

use App\Http\Controllers\Employee\EmployeeDeleteController;

Route::prefix('')->group(function () {
    Route::post('/deleteOvertimeApplication', [EmployeeDeleteController::class, 'deleteOvertimeApplication']);
    Route::post('/deleteEmployeeLeave', [EmployeeDeleteController::class, 'deleteEmployeeLeave']);
    Route::post('/deleteEmployeeResignation', [EmployeeDeleteController::class, 'deleteEmployeeResignation']);

});
