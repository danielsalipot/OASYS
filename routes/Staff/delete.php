<?php
use App\Http\Controllers\Staff\StaffDeleteController;
use Illuminate\Support\Facades\Route;

Route::prefix('')->group(function () {
    Route::post('/deleteDepartment', [StaffDeleteController::class,'deleteDepartment']);
    Route::post('/deletePosition', [StaffDeleteController::class,'deletePosition']);
    Route::get('/staffDeleteApplicant', [StaffDeleteController::class,'staffDeleteApplicant']);
    Route::post('/deleteEmployee', [StaffDeleteController::class,'deleteEmployee']);
    Route::post('/deleteInterviewSchedule', [StaffDeleteController::class,'deleteInterviewSchedule']);
});

