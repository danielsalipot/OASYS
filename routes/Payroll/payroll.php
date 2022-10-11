<?php

use App\Http\Controllers\Employee\EmployeeController;
use App\Http\Controllers\Payroll\PayrollController;
use App\Http\Controllers\PagesController;
use App\Http\Middleware\PreventBackHistory;

Route::prefix('payroll')->group(function () {
    Route::get('/home', [PayrollController::class, 'payroll'])->middleware('prevent-back-history');
    Route::get('/history', [PayrollController::class, 'History'])->middleware('prevent-back-history');
    Route::get('/history/payslip', [PayrollController::class, 'display_payslip'])->middleware('prevent-back-history');
    Route::get('/salary', [PayrollController::class, 'employeelist'])->middleware('prevent-back-history');
    Route::get('/deduction', [PayrollController::class, 'deduction'])->middleware('prevent-back-history');
    Route::get('/contributions', [PayrollController::class, 'contributions'])->middleware('prevent-back-history');
    Route::get('/bonus', [PayrollController::class, 'bonus'])->middleware('prevent-back-history');
    Route::get('/doublepay', [PayrollController::class, 'doublepay'])->middleware('prevent-back-history');
    Route::get('/payslip_land', [PayrollController::class, 'payslip_land'])->middleware('prevent-back-history');


    Route::get('/cashadvance', [PayrollController::class, 'cashadvance'])->middleware('prevent-back-history');
    Route::get('/overtime', [PayrollController::class, 'overtime'])->middleware('prevent-back-history');
    Route::get('/holidays', [PayrollController::class, 'holidays'])->middleware('prevent-back-history');
    Route::get('/leave', [PayrollController::class, 'leave'])->middleware('prevent-back-history');
    Route::get('/audittrail', [PayrollController::class, 'audittrail'])->middleware('prevent-back-history');
    Route::get('/approval', [PayrollController::class, 'approval'])->middleware('prevent-back-history');

    Route::get('/manual', [PayrollController::class, 'payrollManual'])->middleware('prevent-back-history');

    Route::get('/progress/{btn}', [PayrollController::class, 'progress'])->middleware('prevent-back-history');
    Route::get('/employee/profile/{id}', [EmployeeController::class, 'profile'])->middleware('prevent-back-history');
});
