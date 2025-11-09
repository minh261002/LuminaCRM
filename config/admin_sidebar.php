<?php

return [
    [
        'active' => ['branches.*', 'warehouses.*', 'branch-deliveries.*', 'payment-methods.*', 'categories.*'],
        'show' => ['branches.*', 'warehouses.*', 'branch-deliveries.*', 'payment-methods.*', 'categories.*'],
        'title' => 'Cấu hình',
        'icon' => 'ti ti-settings-code fs-2',
        'permission' => [
            'viewBranch', 'createBranch', 'editBranch', 'deleteBranch',
            'viewWarehouse', 'createWarehouse', 'editWarehouse', 'deleteWarehouse',
            'viewBranchDelivery', 'createBranchDelivery', 'editBranchDelivery', 'deleteBranchDelivery',
            'viewPaymentMethod', 'createPaymentMethod', 'editPaymentMethod', 'deletePaymentMethod',
            'viewCategory', 'createCategory', 'editCategory', 'deleteCategory',
        ],
        'children' => [
            [
                'title' => 'Chi nhánh',
                'route' => 'branches.index',
                'icon' => 'ti ti-building fs-3 me-2',
                'permission' => 'viewBranch',
            ],
            [
                'title' => 'Kho hàng',
                'route' => 'warehouses.index',
                'icon' => 'ti ti-building-warehouse fs-3 me-2',
                'permission' => 'viewWarehouse',
            ],
            [
                'title' => 'Địa điểm giao hàng',
                'route' => 'branch-deliveries.index',
                'icon' => 'ti ti-location fs-3 me-2',
                'permission' => 'viewBranchDelivery',
            ],
            [
                'title' => 'Phương thức thanh toán',
                'route' => 'payment-methods.index',
                'icon' => 'ti ti-credit-card fs-3 me-2',
                'permission' => 'viewPaymentMethod',
            ],
            [
                'title' => 'Danh mục sản phẩm',
                'route' => 'categories.index',
                'icon' => 'ti ti-align-box-left-stretch fs-3 me-2',
                'permission' => 'viewCategory',
            ],
        ],
    ],
    [
        'active' => ['customers.*', 'customer-types.*', 'customer-regions.*'],
        'show' => ['customers.*', 'customer-types.*', 'customer-regions.*'],
        'title' => 'Khách hàng',
        'icon' => 'ti ti-users fs-2',
        'permission' => ['viewCustomer', 'createCustomer', 'editCustomer', 'deleteCustomer',
            'viewCustomerType', 'createCustomerType', 'editCustomerType', 'deleteCustomerType',
            'viewCustomerRegion', 'createCustomerRegion', 'editCustomerRegion', 'deleteCustomerRegion',
        ],
        'children' => [
            [
                'title' => 'Phân khúc kinh doanh',
                'route' => 'customer-types.index',
                'icon' => 'ti ti-table-alias fs-3 me-2',
                'permission' => 'viewCustomerType',
            ],
            [
                'title' => 'Phân vùng địa lý',
                'route' => 'customer-regions.index',
                'icon' => 'ti ti-world fs-3 me-2',
                'permission' => 'viewCustomerRegion',
            ],
            [
                'title' => 'Khách hàng',
                'route' => 'customers.create',
                'icon' => 'ti ti-users fs-3 me-2',
                'permission' => 'createCustomer',
            ],
        ],
    ],
    [
        'active' => ['users.*'],
        'show' => ['users.*'],
        'title' => 'Nhân viên',
        'icon' => 'ti ti-user fs-2',
        'permission' => ['viewUser', 'createUser', 'editUser', 'deleteUser'],
        'children' => [
            [
                'title' => 'Thêm mới',
                'route' => 'users.create',
                'icon' => 'ti ti-plus fs-3 me-2',
                'permission' => 'createUser',
            ],
            [
                'title' => 'Danh sách',
                'route' => 'users.index',
                'icon' => 'ti ti-list fs-3 me-2',
                'permission' => 'viewUser',
            ],
        ],
    ],
    [
        'active' => ['roles.*'],
        'show' => ['roles.*'],
        'title' => 'Vai trò',
        'icon' => 'ti ti-code fs-2',
        'permission' => ['viewRole', 'createRole', 'editRole', 'deleteRole'],
        'children' => [
            [
                'title' => 'Thêm mới',
                'route' => 'roles.create',
                'icon' => 'ti ti-plus fs-3 me-2',
                'permission' => 'createRole',
            ],
            [
                'title' => 'Danh sách',
                'route' => 'roles.index',
                'icon' => 'ti ti-list fs-3 me-2',
                'permission' => 'viewRole',
            ],
        ],
    ],
    [
        'active' => ['permissions.*'],
        'show' => ['permissions.*'],
        'title' => 'Phân quyền',
        'icon' => 'ti ti-code fs-2',
        'permission' => ['viewPermission', 'createPermission', 'editPermission', 'deletePermission'],
        'children' => [
            [
                'title' => 'Thêm mới',
                'route' => 'permissions.create',
                'icon' => 'ti ti-plus fs-3 me-2',
                'permission' => 'createPermission',
            ],
            [
                'title' => 'Danh sách',
                'route' => 'permissions.index',
                'icon' => 'ti ti-list fs-3 me-2',
                'permission' => 'viewPermission',
            ],
        ],
    ],
    [
        'active' => ['module.*'],
        'show' => ['module.*'],
        'title' => 'Module hệ thống',
        'icon' => 'ti ti-code fs-2',
        'permission' => ['viewModule', 'createModule', 'editModule', 'deleteModule'],
        'children' => [
            [
                'title' => 'Thêm mới',
                'route' => 'module.create',
                'icon' => 'ti ti-plus fs-3 me-2',
                'permission' => 'createModule',
            ],
            [
                'title' => 'Danh sách',
                'route' => 'module.index',
                'icon' => 'ti ti-list fs-3 me-2',
                'permission' => 'viewModule',
            ],
        ],
    ],
];
