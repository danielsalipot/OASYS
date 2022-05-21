<?php
use App\Http\Controllers\Staff\StaffDeleteController;
use Illuminate\Support\Facades\Route;

Route::prefix('')->group(function () {
    Route::get('/staffDeleteApplicant', [StaffDeleteController::class,'staffDeleteApplicant']);
});

