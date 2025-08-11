<?php
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\SendOtpController;
use App\Http\Controllers\Admin\CustomResetPasswordController;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest'])->group(function (){
//    Route::controller(LoginController::class)->group(function (){
//        Route::get('login', 'login')->name('adb-login');
//    });
    Route::post('/forgot-password', [SendOtpController::class, 'sendOtp'])->name('password.email');
    Route::post('/reset-password', [CustomResetPasswordController::class, 'store'])->name('password.update');
});




