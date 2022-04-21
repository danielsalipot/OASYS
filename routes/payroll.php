<?php

use App\Http\Controllers\PayrollController;

Route::prefix('payroll')->group(function () {
    Route::get('/home', [PayrollController::class, 'payroll']);
    Route::get('/employeelist', [PayrollController::class, 'employeelist']);
    Route::get('/deduction', [PayrollController::class, 'deduction']);
    Route::get('/deductiontype', [PayrollController::class, 'deductiontype']);
    Route::get('/bonus', [PayrollController::class, 'bonus']);
    Route::get('/doublepay', [PayrollController::class, 'doublepay']);
    Route::get('/message', [PayrollController::class, 'message']);
    Route::get('/notification', [PayrollController::class, 'notification']);
    Route::get('/cashadvance', [PayrollController::class, 'cashadvance']);
    Route::get('/overtime', [PayrollController::class, 'overtime']);


});
