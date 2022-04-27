<?php

use App\Http\Controllers\Payroll\PayrollController;

Route::prefix('payroll')->group(function () {
    Route::get('/home', [PayrollController::class, 'payroll']);
    Route::get('/history', [PayrollController::class, 'History']);
    Route::get('/history/payslip', [PayrollController::class, 'display_payslip']);
    Route::get('/employeelist', [PayrollController::class, 'employeelist']);
    Route::get('/deduction', [PayrollController::class, 'deduction']);
    Route::get('/contributions', [PayrollController::class, 'contributions']);
    Route::get('/bonus', [PayrollController::class, 'bonus']);
    Route::get('/doublepay', [PayrollController::class, 'doublepay']);
    Route::get('/message', [PayrollController::class, 'message']);
    Route::get('/notification', [PayrollController::class, 'notification']);
    Route::get('/cashadvance', [PayrollController::class, 'cashadvance']);
    Route::get('/overtime', [PayrollController::class, 'overtime']);
});
