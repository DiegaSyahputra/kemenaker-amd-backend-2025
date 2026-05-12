<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CheckupController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\PetController;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('owners', OwnerController::class);
Route::resource('pets', PetController::class);
Route::resource('checkups', CheckupController::class);
