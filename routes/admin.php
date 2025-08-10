<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\SendOtpController;
use App\Http\Controllers\Admin\CustomResetPasswordController;


Route::controller(AdminLoginController::class)->middleware(['guest'])->group(function () {
   Route::get('/adb-login', 'create')->name('adb-login');
});

Route::post('/forgot-password', [SendOtpController::class, 'sendOtp'])
    ->middleware('guest')
    ->name('password.email');

Route::post('/reset-password', [CustomResetPasswordController::class, 'store'])
    ->middleware(['guest'])
    ->name('password.update');
