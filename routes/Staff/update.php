<?php
use App\Http\Controllers\Staff\StaffUpdateController;
use Illuminate\Support\Facades\Route;

Route::prefix('')->group(function () {
    Route::get('/EmployeeDepartmentUpdate', [StaffUpdateController::class,'EmployeeDepartmentUpdate']);
    Route::get('/EmployeePositionUpdate', [StaffUpdateController::class,'EmployeePositionUpdate']);
});

