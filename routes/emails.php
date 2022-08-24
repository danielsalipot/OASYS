<?php

use App\Http\Controllers\ForgotPasswordController;
use Illuminate\Support\Facades\Route;


Route::prefix('')->group(function () {
    Route::POST('/sendForgotPassword', [ForgotPasswordController::class, 'sendForgotPassword']);
});
