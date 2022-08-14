<?php
use App\Http\Controllers\Staff\JSONControllers\JsonController;
use Illuminate\Support\Facades\Route;

Route::prefix('')->group(function () {
    Route::get('/applicantjson', [JsonController::class,'applicantjson']);
    Route::get('/interviewjson', [JsonController::class,'interviewjson']);
    Route::get('/schedulejson', [JsonController::class,'schedulejson']);
    Route::get('/terminationjson', [JsonController::class,'terminationjson']);
    Route::get('/offboardingjson', [JsonController::class,'offboardingjson']);
    Route::get('/staffgetAuditJson', [JsonController::class,'getAuditJson']);
});

