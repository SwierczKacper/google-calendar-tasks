<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', DashboardController::class)->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

