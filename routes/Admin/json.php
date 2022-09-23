<?php

use App\Http\Controllers\Admin\AdminJSONController;
use App\Http\Controllers\Admin\AttendanceGraphJSON;


Route::prefix('')->group(function () {
    Route::post('/orientationJson', [AdminJSONController::class, 'orientationJson']);
    Route::GET('/assessmentEmployeeList', [AdminJSONController::class, 'assessmentEmployeeList']);
    Route::GET('/regularizationEmployeeList', [AdminJSONController::class, 'regularizationEmployeeList']);
    Route::GET('/getEmployeeAssessment/{quarter}/{id}',[AdminJSONController::class, 'getEmployeeAssessment']);
    Route::GET('/attendanceTodayJSON', [AdminJSONController::class, 'attendanceTodayJSON']);
    Route::GET('/getEmployeeOverallAttendance', [AdminJSONController::class, 'getEmployeeOverallAttendance']);
    Route::GET('/getAuditJson', [AdminJSONController::class, 'getAuditJson']);
    Route::GET('/getEmployeeActivitiesJson', [AdminJSONController::class, 'getEmployeeActivitiesJson']);
    Route::GET('/getEmployeeOverallAttendanceFiltered', [AdminJSONController::class, 'getEmployeeOverallAttendanceFiltered']);

    Route::GET('/getFilteredAttendanceGraph/{i}/{from_date}/{to_date}', [AttendanceGraphJSON::class, 'getFilteredAttendanceGraph']);

    Route::GET('/getQuarterlyAttendance/{employee_id}/{from_date}/{to_date}', [AdminJSONController::class, 'getQuarterlyAttendance']);
});
