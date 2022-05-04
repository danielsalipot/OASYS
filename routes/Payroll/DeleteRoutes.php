<?php

use App\Http\Controllers\Payroll\PayrollDeleteController;

Route::prefix('')->group(function () {
    // Deduction DELETE ROUTE
    Route::get('/removeDeduction/{id}', [PayrollDeleteController::class,'DeleteDeduction']);

    // Cash Advance DELETE ROUTE
    Route::get('/removeCashAdvance/{id}', [PayrollDeleteController::class,'DeleteCashAdvance']);

    // Overtime DELETE ROUTE
    Route::get('/removeOvertime', [PayrollDeleteController::class,'DeleteOvertime']);

    // Bonus DELETE ROUTE
    Route::get('/removeDeleteBonus/{id}', [PayrollDeleteController::class,'DeleteBonus']);

    // Multi Pay DELETE ROUTE
    Route::get('/removeMultiPay/{id}', [PayrollDeleteController::class,'DeleteMultiPay']);

    // Holiday DELETE ROUTE
    Route::get('/removeHoliday/{id}', [PayrollDeleteController::class,'DeleteHoliday']);
    Route::get('/removeHolidayAllAttendance/{id}', [PayrollDeleteController::class,'DeleteHolidayAllAttendance']);
    Route::get('/removeHolidayAttendance/{hid}/{aid}', [PayrollDeleteController::class,'DeleteHolidayAttendance']);

    //Leave DELETE ROUTE
    Route::get('/removeLeave/{lid}/{aid}', [PayrollDeleteController::class,'DeleteLeave']);

});
