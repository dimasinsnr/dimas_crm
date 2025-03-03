<?php

use Illuminate\Support\Facades\Route;
use Modules\Login\Controllers\LoginController;
use Modules\Login\Controllers\RegisterController;

Route::get('/', [LoginController::class, 'create'])->name('login');

Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [RegisterController::class, 'create']);
    Route::post('/register', [RegisterController::class, 'store']);
    Route::get('/login', [LoginController::class, 'create']);
    Route::post('/session', [LoginController::class, 'store']);
	// Route::get('/login/forgot-password', [ResetController::class, 'create']);
	// Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
	// Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
	// Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');
});