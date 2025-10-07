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
Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
    // Send / route to login page
    Route::get('/', function () {
        return redirect()->route('auth.login');
    });

    // Show login form
    Route::get('login', [LoginController::class, 'show_login'])->name('login');
});