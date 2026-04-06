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
        Route::resource('category', \App\Http\Controllers\CategoryController::class);
        
        // Dataset Contributions Routes
        Route::get('contributions/pending', [\App\Http\Controllers\ContributionWebController::class, 'pendingIndex'])->name('contributions.pending');
        Route::get('contributions/approved', [\App\Http\Controllers\ContributionWebController::class, 'approvedIndex'])->name('contributions.approved');
        
        Route::post('contributions/{id}/approve', [\App\Http\Controllers\ContributionWebController::class, 'approve'])->name('contributions.approve');
        Route::post('contributions/{id}/reject', [\App\Http\Controllers\ContributionWebController::class, 'reject'])->name('contributions.reject');
        Route::post('contributions/{id}/revert', [\App\Http\Controllers\ContributionWebController::class, 'revert'])->name('contributions.revert');
        Route::post('contributions/reject-all', [\App\Http\Controllers\ContributionWebController::class, 'rejectAll'])->name('contributions.reject_all');
        
        Route::get('contributions/download', [\App\Http\Controllers\ContributionWebController::class, 'downloadDataset'])->name('contributions.download');
        Route::get('configs/model', [\App\Http\Controllers\AppConfigWebController::class, 'index'])->name('configs.model.index');
        Route::post('configs/model', [\App\Http\Controllers\AppConfigWebController::class, 'update'])->name('configs.model.update');
    });

    Route::middleware(['ceklevel:admin,kasir'])->group(function () {
    });

});