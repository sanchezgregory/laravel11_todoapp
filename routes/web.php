<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
//Route::view('/', 'welcome');
Route::redirect('/', 'dashboard');

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware(['auth']);


Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
