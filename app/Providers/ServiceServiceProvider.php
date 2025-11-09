<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ServiceServiceProvider extends ServiceProvider
{
    protected $services = [
        'App\Services\Module\ModuleServiceInterface' => 'App\Services\Module\ModuleService',
        'App\Services\Permission\PermissionServiceInterface' => 'App\Services\Permission\PermissionService',
        'App\Services\Role\RoleServiceInterface' => 'App\Services\Role\RoleService',
        'App\Services\User\UserServiceInterface' => 'App\Services\User\UserService',
        'App\Services\Branch\BranchServiceInterface' => 'App\Services\Branch\BranchService',
        'App\Services\Warehouse\WarehouseServiceInterface' => 'App\Services\Warehouse\WarehouseService',
        'App\Services\BranchDelivery\BranchDeliveryServiceInterface' => 'App\Services\BranchDelivery\BranchDeliveryService',
        'App\Services\PaymentMethod\PaymentMethodServiceInterface' => 'App\Services\PaymentMethod\PaymentMethodService',
        'App\Services\CustomerType\CustomerTypeServiceInterface' => 'App\Services\CustomerType\CustomerTypeService',
        'App\Services\CustomerRegion\CustomerRegionServiceInterface' => 'App\Services\CustomerRegion\CustomerRegionService',
        'App\Services\Category\CategoryServiceInterface' => 'App\Services\Category\CategoryService',
    ];

    public function register(): void
    {
        foreach ($this->services as $interface => $service) {
            $this->app->bind($interface, $service);
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
