<?php

use App\Http\Controllers\Admin\AdminJSONController;

Route::prefix('')->group(function () {
    Route::post('/orientationJson', [AdminJSONController::class, 'orientationJson']);
    Route::GET('/assessmentEmployeeList', [AdminJSONController::class, 'assessmentEmployeeList']);
    Route::GET('/regularizationEmployeeList', [AdminJSONController::class, 'regularizationEmployeeList']);
    Route::GET('/getEmployeeAssessment/{quarter}/{id}',[AdminJSONController::class, 'getEmployeeAssessment']);
    Route::GET('/attendanceTodayJSON', [AdminJSONController::class, 'attendanceTodayJSON']);
    Route::GET('/getEmployeeOverallAttendance', [AdminJSONController::class, 'getEmployeeOverallAttendance']);
    Route::GET('/getAuditJson', [AdminJSONController::class, 'getAuditJson']);
    Route::GET('/getEmployeeActivitiesJson', [AdminJSONController::class, 'getEmployeeActivitiesJson']);
});
