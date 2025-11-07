<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\BranchDeliveryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TwoFactorController;
use App\Http\Controllers\UserAccessController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WarehouseController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::middleware('authenticate')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('profile', [UserAccessController::class, 'index'])->name('profile');
    Route::put('profile/update-password', [UserAccessController::class, 'updatePassword'])->name('profile.update-password');
    Route::get('change-password', [UserAccessController::class, 'changePassword'])->name('profile.change-password');

    Route::prefix('two-factor-authentication')->as('two-factor.')->group(function () {
        Route::get('/', [TwoFactorController::class, 'index'])->name('index');
        Route::post('/verify', [TwoFactorController::class, 'verify'])->name('verify');
        Route::get('/recovery', [TwoFactorController::class, 'recovery'])->name('recovery');
        Route::get('/recovery-codes', [TwoFactorController::class, 'showRecoveryCodes'])->name('show-recovery');
        Route::post('/regenerate-recovery', [TwoFactorController::class, 'regenerateRecoveryCodes'])->name('regenerate-recovery');
        Route::post('/disable', [TwoFactorController::class, 'disable'])->name('disable');
    });

    Route::prefix('modules')->as('module.')->group(function () {
        Route::middleware('permission:viewModule')->group(function () {
            Route::get('/', [ModuleController::class, 'index'])->name('index');
        });
        Route::middleware('permission:createModule')->group(function () {
            Route::get('/create', [ModuleController::class, 'create'])->name('create');
            Route::post('/', [ModuleController::class, 'store'])->name('store');
        });
        Route::middleware('permission:editModule')->group(function () {
            Route::get('/{id}/edit', [ModuleController::class, 'edit'])->name('edit');
            Route::put('/{id}', [ModuleController::class, 'update'])->name('update');
        });
        Route::middleware('permission:deleteModule')->group(function () {
            Route::delete('/{id}', [ModuleController::class, 'delete'])->name('delete');
        });
    });

    Route::prefix('permissions')->as('permissions.')->group(function () {
        Route::middleware('permission:viewPermission')->group(function () {
            Route::get('/', [PermissionController::class, 'index'])->name('index');
        });
        Route::middleware('permission:createPermission')->group(function () {
            Route::get('/create', [PermissionController::class, 'create'])->name('create');
            Route::post('/', [PermissionController::class, 'store'])->name('store');
        });
        Route::middleware('permission:editPermission')->group(function () {
            Route::get('/{id}/edit', [PermissionController::class, 'edit'])->name('edit');
            Route::put('/{id}', [PermissionController::class, 'update'])->name('update');
        });
        Route::middleware('permission:deletePermission')->group(function () {
            Route::delete('/{id}', [PermissionController::class, 'delete'])->name('delete');
        });
    });

    Route::prefix('roles')->as('roles.')->group(function () {
        Route::middleware('permission:viewRole')->group(function () {
            Route::get('/', [RoleController::class, 'index'])->name('index');
        });
        Route::middleware('permission:createRole')->group(function () {
            Route::get('/create', [RoleController::class, 'create'])->name('create');
            Route::post('/', [RoleController::class, 'store'])->name('store');
        });
        Route::middleware('permission:editRole')->group(function () {
            Route::get('/{id}/edit', [RoleController::class, 'edit'])->name('edit');
            Route::put('/{id}', [RoleController::class, 'update'])->name('update');
        });
        Route::middleware('permission:deleteRole')->group(function () {
            Route::delete('/{id}', [RoleController::class, 'delete'])->name('delete');
        });
    });

    Route::prefix('users')->as('users.')->group(function () {
        Route::middleware('permission:viewUser')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('index');
            Route::get('/{id}/edit', [UserController::class, 'edit'])->name('edit');
        });
        Route::middleware('permission:createUser')->group(function () {
            Route::get('/create', [UserController::class, 'create'])->name('create');
            Route::post('/', [UserController::class, 'store'])->name('store');
        });
        Route::middleware('permission:editUser')->group(function () {
            Route::put('/', [UserController::class, 'update'])->name('update');
            Route::patch('/{id}/active', [UserController::class, 'active'])->name('active');
        });
        Route::middleware('permission:deleteUser')->group(function () {
            Route::delete('/{id}', [UserController::class, 'delete'])->name('delete');
        });
    });

    Route::prefix('branches')->as('branches.')->group(function () {
        Route::middleware('permission:viewBranch')->group(function () {
            Route::get('/', [BranchController::class, 'index'])->name('index');
            Route::get('/{id}/edit', [BranchController::class, 'edit'])->name('edit');
        });
        Route::middleware('permission:createBranch')->group(function () {
            Route::get('/create', [BranchController::class, 'create'])->name('create');
            Route::post('/', [BranchController::class, 'store'])->name('store');
        });
        Route::middleware('permission:editBranch')->group(function () {
            Route::put('/', [BranchController::class, 'update'])->name('update');
            Route::patch('/{id}/active', [BranchController::class, 'active'])->name('active');
        });
        Route::middleware('permission:deleteBranch')->group(function () {
            Route::delete('/{id}', [BranchController::class, 'delete'])->name('delete');
        });
    });

    Route::prefix('warehouses')->as('warehouses.')->group(function () {
        Route::middleware('permission:viewWarehouse')->group(function () {
            Route::get('/', [WarehouseController::class, 'index'])->name('index');
            Route::get('/{id}/edit', [WarehouseController::class, 'edit'])->name('edit');
        });
        Route::middleware('permission:createWarehouse')->group(function () {
            Route::get('/create', [WarehouseController::class, 'create'])->name('create');
            Route::post('/', [WarehouseController::class, 'store'])->name('store');
        });
        Route::middleware('permission:editWarehouse')->group(function () {
            Route::put('/', [WarehouseController::class, 'update'])->name('update');
            Route::patch('/{id}/active', [WarehouseController::class, 'active'])->name('active');
        });
        Route::middleware('permission:deleteWarehouse')->group(function () {
            Route::delete('/{id}', [WarehouseController::class, 'delete'])->name('delete');
        });
    });

    Route::prefix('branch-deliveries')->as('branch-deliveries.')->group(function () {
        Route::middleware('permission:viewBranchDelivery')->group(function () {
            Route::get('/', [BranchDeliveryController::class, 'index'])->name('index');
            Route::get('/{id}/edit', [BranchDeliveryController::class, 'edit'])->name('edit');
        });
        Route::middleware('permission:createBranchDelivery')->group(function () {
            Route::get('/create', [BranchDeliveryController::class, 'create'])->name('create');
            Route::post('/', [BranchDeliveryController::class, 'store'])->name('store');
        });
        Route::middleware('permission:editBranchDelivery')->group(function () {
            Route::put('/', [BranchDeliveryController::class, 'update'])->name('update');
            Route::patch('/{id}/active', [BranchDeliveryController::class, 'active'])->name('active');
        });
        Route::middleware('permission:deleteBranchDelivery')->group(function () {
            Route::delete('/{id}', [BranchDeliveryController::class, 'delete'])->name('delete');
        });
    });

    Route::prefix('payment-methods')->as('payment-methods.')->group(function () {
        Route::middleware('permission:viewPaymentMethod')->group(function () {
            Route::get('/', [PaymentMethodController::class, 'index'])->name('index');
            Route::get('/{id}/edit', [PaymentMethodController::class, 'edit'])->name('edit');
        });
        Route::middleware('permission:createPaymentMethod')->group(function () {
            Route::get('/create', [PaymentMethodController::class, 'create'])->name('create');
            Route::post('/', [PaymentMethodController::class, 'store'])->name('store');
        });
        Route::middleware('permission:editPaymentMethod')->group(function () {
            Route::put('/', [PaymentMethodController::class, 'update'])->name('update');
            Route::patch('/{id}/active', [PaymentMethodController::class, 'active'])->name('active');
        });
        Route::middleware('permission:deletePaymentMethod')->group(function () {
            Route::delete('/{id}', [PaymentMethodController::class, 'delete'])->name('delete');
        });
    });

    Route::prefix('customer-types')->as('customer-types.')->group(function () {
        Route::middleware('permission:viewPaymentMethod')->group(function () {
            Route::get('/', [PaymentMethodController::class, 'index'])->name('index');
            Route::get('/{id}/edit', [PaymentMethodController::class, 'edit'])->name('edit');
        });
        Route::middleware('permission:createPaymentMethod')->group(function () {
            Route::get('/create', [PaymentMethodController::class, 'create'])->name('create');
            Route::post('/', [PaymentMethodController::class, 'store'])->name('store');
        });
        Route::middleware('permission:editPaymentMethod')->group(function () {
            Route::put('/', [PaymentMethodController::class, 'update'])->name('update');
            Route::patch('/{id}/active', [PaymentMethodController::class, 'active'])->name('active');
        });
        Route::middleware('permission:deletePaymentMethod')->group(function () {
            Route::delete('/{id}', [PaymentMethodController::class, 'delete'])->name('delete');
        });
    });

    Route::prefix('customer-regions')->as('customer-regions.')->group(function () {
        Route::middleware('permission:viewPaymentMethod')->group(function () {
            Route::get('/', [PaymentMethodController::class, 'index'])->name('index');
            Route::get('/{id}/edit', [PaymentMethodController::class, 'edit'])->name('edit');
        });
        Route::middleware('permission:createPaymentMethod')->group(function () {
            Route::get('/create', [PaymentMethodController::class, 'create'])->name('create');
            Route::post('/', [PaymentMethodController::class, 'store'])->name('store');
        });
        Route::middleware('permission:editPaymentMethod')->group(function () {
            Route::put('/', [PaymentMethodController::class, 'update'])->name('update');
            Route::patch('/{id}/active', [PaymentMethodController::class, 'active'])->name('active');
        });
        Route::middleware('permission:deletePaymentMethod')->group(function () {
            Route::delete('/{id}', [PaymentMethodController::class, 'delete'])->name('delete');
        });
    });
});

Route::middleware('logged_in')->group(function () {
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('login', [AuthController::class, 'authenticate'])->name('authenticate');

    Route::get('two-factor/login', [AuthController::class, 'showTwoFactorLogin'])->name('two-factor.login');
    Route::post('two-factor/verify-login', [AuthController::class, 'verifyTwoFactorLogin'])->name('two-factor.verify-login');

    Route::get('password/forgot', [AuthController::class, 'forgotPassword'])->name('password.forgot');
    Route::post('password/email', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');

    Route::get('password/reset/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/reset', [AuthController::class, 'resetPassword'])->name('password.update');
});

Route::prefix('api')->as('api.')->group(function () {
    Route::get('provinces', [LocationController::class, 'provinces'])->name('provinces');
    Route::get('wards', [LocationController::class, 'wards'])->name('wards');
});

Route::get('clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');

    return 'Cache is cleared';
});
