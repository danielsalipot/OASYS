<?php
use App\Http\Controllers\Staff\StaffInsertController;
use Illuminate\Support\Facades\Route;

Route::prefix('')->group(function () {
    Route::get('/InsertDepartment', [StaffInsertController::class,'InsertDepartment']);
    Route::get('/InsertPosition', [StaffInsertController::class,'InsertPosition']);
    Route::get('/InsertInterview', [StaffInsertController::class,'InsertInterview']);
    Route::get('/InsertOnboardee', [StaffInsertController::class,'InsertOnboardee']);
});

