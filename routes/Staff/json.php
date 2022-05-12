<?php
use App\Http\Controllers\Staff\JSONControllers\JsonController;
use Illuminate\Support\Facades\Route;

Route::prefix('')->group(function () {
    Route::get('/applicantjson', [JsonController::class,'applicantjson']);
    Route::get('/interviewjson', [JsonController::class,'interviewjson']);
});

