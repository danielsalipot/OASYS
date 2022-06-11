<?php

use App\Http\Controllers\Employee\EmployeeInsertController;
use Illuminate\Support\Facades\Route;

Route::prefix('')->group(function () {
    Route::post('/TimeInInsert', [EmployeeInsertController::class,'TimeInInsert']);

    Route::post('/TimeOutInsert', [EmployeeInsertController::class,'TimeOutInsert']);
});
