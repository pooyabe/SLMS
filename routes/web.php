<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


/**
 * ------------
 * Login Routes
 * ------------
 * 
 */
Route::group(['prefix' => 'auth', 'as' => 'auth.', 'middleware' => 'guest'], function () {
    // Send / route to login page
    Route::get('/', function () {
        return redirect()->route('auth.login');
    });

    // Show login form
    Route::get('login', [LoginController::class, 'show_login'])->name('login');
    // Get phone and send OTP SMS
    Route::post('login', [LoginController::class, 'get_phone'])->name('getphone');


    // Show Validation form
    Route::get('verifycode', [LoginController::class, 'show_verify_code'])->name('showverifycode');
    // Verify code
    Route::post('verifycode', [LoginController::class, 'verify_code'])->name('verifycode');
});
// Writing the logout route here, because we dont want the guest middleware affect it
Route::post('auth/logout', [LoginController::class, 'logout'])->name('auth.logout')->middleware('auth:sanctum');


/**
 * ------------
 * Dashboard Routes
 * ------------
 * 
 */
Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.'], function () {
    // Show the admin panel main page
    Route::get('/', function () {
        return view('dashboard.main');
    })->name('main');
});
