<?php
use App\Http\Controllers\Staff\StaffUpdateController;
use Illuminate\Support\Facades\Route;

Route::prefix('')->group(function () {
    Route::get('/EmployeeDepartmentUpdate', [StaffUpdateController::class,'EmployeeDepartmentUpdate']);
    Route::get('/EmployeePositionUpdate', [StaffUpdateController::class,'EmployeePositionUpdate']);
    Route::get('/WithResponseInterview', [StaffUpdateController::class,'WithResponseInterview']);
    Route::get('/NoResponseInterview', [StaffUpdateController::class,'NoResponseInterview']);
    Route::get('/UpdateSchedule', [StaffUpdateController::class,'UpdateSchedule']);
});

