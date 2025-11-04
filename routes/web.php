<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::middleware('authenticate')->group(function(){
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
});


Route::middleware('logged_in')->group(function(){
    Route::get('login', [AuthController::class, 'getLogin'])->name('login');
    Route::post('login', [AuthController::class, 'postLogin'])->name('login.post');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});