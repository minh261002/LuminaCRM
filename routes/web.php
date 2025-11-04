<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::middleware('authenticate')->group(function(){
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});


Route::middleware('logged_in')->group(function(){
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('login', [AuthController::class, 'authenticate'])->name('authenticate');

    Route::get('password/forgot', [AuthController::class, 'forgotPassword'])->name('password.forgot');
    Route::post('password/email', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('password/reset/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/reset', [AuthController::class, 'resetPassword'])->name('password.update');
});
