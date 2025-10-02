<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('/request-code', [AuthController::class, 'requestCode']);
    Route::post('/verify-code', [AuthController::class, 'verifyCode']);
});