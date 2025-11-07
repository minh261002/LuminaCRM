<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TwoFactorController;
use App\Http\Controllers\UserAccessController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('authenticate')->group(function(){
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('profile', [UserAccessController::class, 'index'])->name('profile');
    Route::put('profile/update-password', [UserAccessController::class, 'updatePassword'])->name('profile.update-password');
    Route::get('change-password', [UserAccessController::class, 'changePassword'])->name('profile.change-password');

    // Two Factor Authentication
    Route::prefix('two-factor-authentication')->as('two-factor.')->group(function(){
        Route::get('/', [TwoFactorController::class, 'index'])->name('index');
        Route::post('/verify', [TwoFactorController::class, 'verify'])->name('verify');
        Route::get('/recovery', [TwoFactorController::class, 'recovery'])->name('recovery');
        Route::get('/recovery-codes', [TwoFactorController::class, 'showRecoveryCodes'])->name('show-recovery');
        Route::post('/regenerate-recovery', [TwoFactorController::class, 'regenerateRecoveryCodes'])->name('regenerate-recovery');
        Route::post('/disable', [TwoFactorController::class, 'disable'])->name('disable');
    });

    Route::prefix('modules')->as('module.')->group(function(){
        Route::middleware('permission:viewModule')->group(function(){
             Route::get('/', [ModuleController::class, 'index'])->name('index');
        });
        Route::middleware('permission:createModule')->group(function(){
            Route::get('/create', [ModuleController::class, 'create'])->name('create');
            Route::post('/', [ModuleController::class, 'store'])->name('store');
        });
        Route::middleware('permission:editModule')->group(function(){
            Route::get('/{id}/edit', [ModuleController::class, 'edit'])->name('edit');
            Route::put('/{id}', [ModuleController::class, 'update'])->name('update');
        });
        Route::middleware('permission:deleteModule')->group(function(){
            Route::delete('/{id}', [ModuleController::class, 'delete'])->name('delete');
        });
    });

    Route::prefix('permissions')->as('permissions.')->group(function(){
        Route::middleware('permission:viewPermission')->group(function(){
            Route::get('/', [PermissionController::class, 'index'])->name('index');
        });
        Route::middleware('permission:createPermission')->group(function(){
            Route::get('/create', [PermissionController::class, 'create'])->name('create');
            Route::post('/', [PermissionController::class, 'store'])->name('store');
        });
        Route::middleware('permission:editPermission')->group(function(){
            Route::get('/{id}/edit', [PermissionController::class, 'edit'])->name('edit');
            Route::put('/{id}', [PermissionController::class, 'update'])->name('update');
        });
        Route::middleware('permission:deletePermission')->group(function(){
            Route::delete('/{id}', [PermissionController::class, 'delete'])->name('delete');
        });
    });


    Route::prefix('roles')->as('roles.')->group(function(){
        Route::middleware('permission:viewRole')->group(function(){
            Route::get('/', [RoleController::class, 'index'])->name('index');
        });
        Route::middleware('permission:createRole')->group(function(){
            Route::get('/create', [RoleController::class, 'create'])->name('create');
            Route::post('/', [RoleController::class, 'store'])->name('store');
        });
        Route::middleware('permission:editRole')->group(function(){
            Route::get('/{id}/edit', [RoleController::class, 'edit'])->name('edit');
            Route::put('/{id}', [RoleController::class, 'update'])->name('update');
        });
        Route::middleware('permission:deleteRole')->group(function(){
            Route::delete('/{id}', [RoleController::class, 'delete'])->name('delete');
        });
    });

    Route::prefix('users')->as('users.')->group(function(){
        Route::middleware('permission:viewRole')->group(function(){
            Route::get('/', [UserController::class, 'index'])->name('index');
            Route::get('/{id}/edit', [UserController::class, 'edit'])->name('edit');
        });
        Route::middleware('permission:createRole')->group(function(){
            Route::get('/create', [UserController::class, 'create'])->name('create');
            Route::post('/', [UserController::class, 'store'])->name('store');
        });
        Route::middleware('permission:editRole')->group(function(){
            Route::put('/{id}', [UserController::class, 'update'])->name('update');
            Route::patch('/{id}/active', [UserController::class, 'active'])->name('active');
        });
        Route::middleware('permission:deleteRole')->group(function(){
            Route::delete('/{id}', [UserController::class, 'delete'])->name('delete');
        });
    });

});


Route::middleware('logged_in')->group(function(){
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('login', [AuthController::class, 'authenticate'])->name('authenticate');

    // Two Factor Login
    Route::get('two-factor/login', [AuthController::class, 'showTwoFactorLogin'])->name('two-factor.login');
    Route::post('two-factor/verify-login', [AuthController::class, 'verifyTwoFactorLogin'])->name('two-factor.verify-login');

    Route::get('password/forgot', [AuthController::class, 'forgotPassword'])->name('password.forgot');
    Route::post('password/email', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');

    Route::get('password/reset/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/reset', [AuthController::class, 'resetPassword'])->name('password.update');
});
