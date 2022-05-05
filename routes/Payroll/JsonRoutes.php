<?php

use App\Http\Controllers\Payroll\JsonControllers\PayrollJSONController;
use App\Http\Controllers\Payroll\JsonControllers\ComputationController;

Route::prefix('')->group(function () {
    // Payroll Page JSON ROUTE
    Route::get('/payrolljson', [ComputationController::class,'payroll']);


    //Employee List JSON ROUTE
    Route::get('/fetchSingleEmployee', [PayrollJSONController::class,'fetchSingleEmployee']);


    // Deduction JSON ROUTE
    Route::get('/deductionjson', [PayrollJSONController::class,'Deduction']);


    //Cash Adavance JSON ROUTE
    Route::get('/cashadvancejson', [PayrollJSONController::class,'CashAdvance']);


    // Overtime JSON ROUTE
    Route::get('/overtimejson', [PayrollJSONController::class,'Overtime']);
    Route::get('/getPaidOvertime', [PayrollJSONController::class,'getPaidOvertime']);



    // Bonus JSON ROUTE
    Route::get('/bonusjson', [PayrollJSONController::class,'Bonus']);


    // Double Pay JSON ROUTE
    Route::get('/doublepayjson', [PayrollJSONController::class,'DoublePay']);


    // Contribution JSON ROUTE
    Route::get('/contributionsjson', [PayrollJSONController::class,'contributions']);
    Route::get('/pagibigjson', [PayrollJSONController::class,'pagibig']);
    Route::get('/philhealthjson', [PayrollJSONController::class,'philhealth']);


    // Message JSON ROUTE
    Route::get('/messagejson/{r_id}',[PayrollJSONController::class,'Message']);
    Route::get('/chatemployeelistjson', [PayrollJSONController::class,'ChatEmployeeDetails']);


    // Notification JSON ROUTE
    Route::get('/notificationjson', [PayrollJSONController::class,'Notification']);

    // Holiday JSON ROUTE
    Route::get('/holidayJson', [PayrollJSONController::class,'holidayJson']);
    Route::get('/holidayJsonAttendance', [PayrollJSONController::class,'holidayJsonAttendance']);
    Route::get('/holidayAllJson', [PayrollJSONController::class,'holidayAllAttendanceJson']);

                                /////////////////////
                                ////// OTHERS ///////
                                /////////////////////
    Route::get('/thirteenthmonthjson', [PayrollJSONController::class,'thirteenthMonthJSON']);

    Route::get('/fetchattendancejson', [PayrollJSONController::class,'fetchAttedance']);

    Route::get('/employeelistjson', [PayrollJSONController::class,'EmployeeDetails']);



    Route::get('/leaveJson', [PayrollJSONController::class,'leaveJson']);
});
