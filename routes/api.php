<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\NRP\FetchOveralFormController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('/request-code', [AuthController::class, 'requestCode']);
    Route::post('/verify-code', [AuthController::class, 'verifyCode']);
});

Route::group([
    'as' => 'nrp.',
    'prefix' => 'nrp',
    'middleware' => 'auth:sanctum'
], function () {

    // Fetch states list
    Route::post('/fetch-states', [FetchOveralFormController::class, 'FetchStates']);

    // Fetch Stations based on state
    Route::post('/fetch-stations', [FetchOveralFormController::class, 'FetchStations']);
});
