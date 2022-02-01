<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DaysController;
use App\Http\Controllers\PackagesController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('/', DashboardController::class)->name('dashboard');
    Route::get('/offline', DashboardController::class)->name('dashboard');

    Route::prefix('packages')->group(function() {
        Route::get('/', [PackagesController::class, 'index'])->name('packages.index');
        Route::get('/{package}', [PackagesController::class, 'edit'])->name('packages.show');
    });

    Route::get('/day', DaysController::class)->name('day');
});

require __DIR__.'/auth.php';

