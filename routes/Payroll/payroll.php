<?php

use App\Http\Controllers\Employee\EmployeeController;
use App\Http\Controllers\Payroll\PayrollController;
use App\Http\Controllers\PagesController;

Route::prefix('payroll')->group(function () {
    Route::get('/home', [PayrollController::class, 'payroll']);
    Route::get('/history', [PayrollController::class, 'History']);
    Route::get('/history/payslip', [PayrollController::class, 'display_payslip']);
    Route::get('/salary', [PayrollController::class, 'employeelist']);
    Route::get('/deduction', [PayrollController::class, 'deduction']);
    Route::get('/contributions', [PayrollController::class, 'contributions']);
    Route::get('/bonus', [PayrollController::class, 'bonus']);
    Route::get('/doublepay', [PayrollController::class, 'doublepay']);
    Route::get('/payslip_land', [PayrollController::class, 'payslip_land']);


    Route::get('/cashadvance', [PayrollController::class, 'cashadvance']);
    Route::get('/overtime', [PayrollController::class, 'overtime']);
    Route::get('/holidays', [PayrollController::class, 'holidays']);
    Route::get('/leave', [PayrollController::class, 'leave']);
    Route::get('/audittrail', [PayrollController::class, 'audittrail']);
    Route::get('/approval', [PayrollController::class, 'approval']);

    Route::get('/manual', [PayrollController::class, 'payrollManual']);

    Route::get('/progress/{btn}', [PayrollController::class, 'progress']);
    Route::get('/employee/profile/{id}', [EmployeeController::class, 'profile']);
});
