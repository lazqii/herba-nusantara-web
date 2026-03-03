<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TanamanController;

// Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::middleware(['ceklevel:admin'])->group(function () {
        Route::resource('tanaman', TanamanController::class);
    });

    Route::middleware(['ceklevel:admin,kasir'])->group(function () {
    });

});