<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RolePermissionController;
use App\Http\Controllers\Admin\AuthenticatedSessionController;
use App\Http\Controllers\Admin\CategoryController;

Route::prefix('admin')->name('admin.')->middleware(['auth','verified'])->group(function () {
    //CategoryController
    Route::resource('categories', CategoryController::class);

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('dashboard');
    });

    Route::controller(RolePermissionController::class)->group(function () {
        Route::get('manage-role','index')->name('manage-role');
        Route::get('manage-role/{id}/access','access')->name('manage-role.access');
        Route::put('manage-role/{id}/access','accessUpdate')->name('update-access');
    });

});
