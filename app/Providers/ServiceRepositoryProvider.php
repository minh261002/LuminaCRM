<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ServiceRepositoryProvider extends ServiceProvider
{
    protected $repositories = [
        'App\Repositories\BaseRepositoryInterface' => 'App\Repositories\BaseRepository',
        'App\Repositories\Module\ModuleRepositoryInterface' => 'App\Repositories\Module\ModuleRepository',
        'App\Repositories\Permission\PermissionRepositoryInterface' => 'App\Repositories\Permission\PermissionRepository',
        'App\Repositories\Role\RoleRepositoryInterface' => 'App\Repositories\Role\RoleRepository',
        'App\Repositories\User\UserRepositoryInterface' => 'App\Repositories\User\UserRepository',
        'App\Repositories\Branch\BranchRepositoryInterface' => 'App\Repositories\Branch\BranchRepository',
        'App\Repositories\Warehouse\WarehouseRepositoryInterface' => 'App\Repositories\Warehouse\WarehouseRepository',
        'App\Repositories\BranchDelivery\BranchDeliveryRepositoryInterface' => 'App\Repositories\BranchDelivery\BranchDeliveryRepository',
        'App\Repositories\PaymentMethod\PaymentMethodRepositoryInterface' => 'App\Repositories\PaymentMethod\PaymentMethodRepository',
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        foreach ($this->repositories as $interface => $repository) {
            $this->app->bind($interface, $repository);
        }
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
