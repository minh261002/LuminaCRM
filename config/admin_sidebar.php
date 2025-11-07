<?php

return [
    //    [
    //        'active' => ['users.*'],
    //        'show' => ['users.*'],
    //        'title' => 'Thông báo',
    //        'icon' => 'ti ti-bell fs-2',
    //        'permission' => ['viewUser', 'createUser', 'editUser', 'deleteUser'],
    //        'children' => [
    //            [
    //                'title' => 'Thêm mới',
    //                'route' => 'users.create',
    //                'icon' => 'ti ti-plus fs-3 me-2',
    //                'permission' => 'createUser'
    //            ],
    //            [
    //                'title' => 'Danh sách',
    //                'route' => 'users.index',
    //                'icon' => 'ti ti-list fs-3 me-2',
    //                'permission' => 'viewUser'
    //            ]
    //        ]
    //    ],
    [
        'active' => ['branches.*', 'warehouses.*', 'branch-deliveries.*', 'payment-methods.*'],
        'show' => ['branches.*', 'warehouses.*', 'branch-deliveries.*', 'payment-methods.*'],
        'title' => 'Cấu hình',
        'icon' => 'ti ti-settings-code fs-2',
        'permission' => [
            'viewBranch', 'createBranch', 'editBranch', 'deleteBranch',
            'viewWarehouse', 'createWarehouse', 'editWarehouse',
            'deleteWarehouse', 'viewBranchDelivery', 'createBranchDelivery', 'editBranchDelivery', 'deleteBranchDelivery', 'viewPaymentMethod', 'createPaymentMethod', 'editPaymentMethod', 'deletePaymentMethod',
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
        ],
    ],
    //    [
    //        'active' => ['users.*'],
    //        'show' => ['users.*'],
    //        'title' => 'Hợp đồng & Báo giá',
    //        'icon' => 'ti ti-clipboard-text fs-2',
    //        'permission' => ['viewUser', 'createUser', 'editUser', 'deleteUser'],
    //        'children' => [
    //            [
    //                'title' => 'Thêm mới',
    //                'route' => 'users.create',
    //                'icon' => 'ti ti-plus fs-3 me-2',
    //                'permission' => 'createUser'
    //            ],
    //            [
    //                'title' => 'Danh sách',
    //                'route' => 'users.index',
    //                'icon' => 'ti ti-list fs-3 me-2',
    //                'permission' => 'viewUser'
    //            ]
    //        ]
    //    ],
    //    [
    //        'active' => ['users.*'],
    //        'show' => ['users.*'],
    //        'title' => 'Thanh toán',
    //        'icon' => 'ti ti-credit-card fs-2',
    //        'permission' => ['viewUser', 'createUser', 'editUser', 'deleteUser'],
    //        'children' => [
    //            [
    //                'title' => 'Thêm mới',
    //                'route' => 'users.create',
    //                'icon' => 'ti ti-plus fs-3 me-2',
    //                'permission' => 'createUser'
    //            ],
    //            [
    //                'title' => 'Danh sách',
    //                'route' => 'users.index',
    //                'icon' => 'ti ti-list fs-3 me-2',
    //                'permission' => 'viewUser'
    //            ]
    //        ]
    //    ],
    //    [
    //        'active' => ['users.*'],
    //        'show' => ['users.*'],
    //        'title' => 'Nhà cung cấp',
    //        'icon' => 'ti ti-truck fs-2',
    //        'permission' => ['viewUser', 'createUser', 'editUser', 'deleteUser'],
    //        'children' => [
    //            [
    //                'title' => 'Thêm mới',
    //                'route' => 'users.create',
    //                'icon' => 'ti ti-plus fs-3 me-2',
    //                'permission' => 'createUser'
    //            ],
    //            [
    //                'title' => 'Danh sách',
    //                'route' => 'users.index',
    //                'icon' => 'ti ti-list fs-3 me-2',
    //                'permission' => 'viewUser'
    //            ]
    //        ]
    //    ],
    //    [
    //        'active' => ['users.*'],
    //        'show' => ['users.*'],
    //        'title' => 'Sản phẩm',
    //        'icon' => 'ti ti-box fs-2',
    //        'permission' => ['viewUser', 'createUser', 'editUser', 'deleteUser'],
    //        'children' => [
    //            [
    //                'title' => 'Thêm mới',
    //                'route' => 'users.create',
    //                'icon' => 'ti ti-plus fs-3 me-2',
    //                'permission' => 'createUser'
    //            ],
    //            [
    //                'title' => 'Danh sách',
    //                'route' => 'users.index',
    //                'icon' => 'ti ti-list fs-3 me-2',
    //                'permission' => 'viewUser'
    //            ]
    //        ]
    //    ],
    //    [
    //        'active' => ['users.*'],
    //        'show' => ['users.*'],
    //        'title' => 'Đơn hàng',
    //        'icon' => 'ti ti-shopping-bag fs-2',
    //        'permission' => ['viewUser', 'createUser', 'editUser', 'deleteUser'],
    //        'children' => [
    //            [
    //                'title' => 'Thêm mới',
    //                'route' => 'users.create',
    //                'icon' => 'ti ti-plus fs-3 me-2',
    //                'permission' => 'createUser'
    //            ],
    //            [
    //                'title' => 'Danh sách',
    //                'route' => 'users.index',
    //                'icon' => 'ti ti-list fs-3 me-2',
    //                'permission' => 'viewUser'
    //            ]
    //        ]
    //    ],
    //    [
    //        'active' => ['users.*'],
    //        'show' => ['users.*'],
    //        'title' => 'Hoa hồng',
    //        'icon' => 'ti ti-percentage fs-2',
    //        'permission' => ['viewUser', 'createUser', 'editUser', 'deleteUser'],
    //        'children' => [
    //            [
    //                'title' => 'Thêm mới',
    //                'route' => 'users.create',
    //                'icon' => 'ti ti-plus fs-3 me-2',
    //                'permission' => 'createUser'
    //            ],
    //            [
    //                'title' => 'Danh sách',
    //                'route' => 'users.index',
    //                'icon' => 'ti ti-list fs-3 me-2',
    //                'permission' => 'viewUser'
    //            ]
    //        ]
    //    ],
    //    [
    //        'active' => ['users.*'],
    //        'show' => ['users.*'],
    //        'title' => 'Kho hàng',
    //        'icon' => 'ti ti-building-warehouse fs-2',
    //        'permission' => ['viewUser', 'createUser', 'editUser', 'deleteUser'],
    //        'children' => [
    //            [
    //                'title' => 'Thêm mới',
    //                'route' => 'users.create',
    //                'icon' => 'ti ti-plus fs-3 me-2',
    //                'permission' => 'createUser'
    //            ],
    //            [
    //                'title' => 'Danh sách',
    //                'route' => 'users.index',
    //                'icon' => 'ti ti-list fs-3 me-2',
    //                'permission' => 'viewUser'
    //            ]
    //        ]
    //    ],
    //    [
    //        'active' => ['users.*'],
    //        'show' => ['users.*'],
    //        'title' => 'Khách hàng',
    //        'icon' => 'ti ti-users fs-2',
    //        'permission' => ['viewUser', 'createUser', 'editUser', 'deleteUser'],
    //        'children' => [
    //            [
    //                'title' => 'Thêm mới',
    //                'route' => 'users.create',
    //                'icon' => 'ti ti-plus fs-3 me-2',
    //                'permission' => 'createUser'
    //            ],
    //            [
    //                'title' => 'Danh sách',
    //                'route' => 'users.index',
    //                'icon' => 'ti ti-list fs-3 me-2',
    //                'permission' => 'viewUser'
    //            ]
    //        ]
    //    ],
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
    //    [
    //        'active' => ['users.*'],
    //        'show' => ['users.*'],
    //        'title' => 'Cài đặt',
    //        'icon' => 'ti ti-settings-code fs-2',
    //        'permission' => ['viewUser', 'createUser', 'editUser', 'deleteUser'],
    //        'children' => [
    //            [
    //                'title' => 'Thêm mới',
    //                'route' => 'users.create',
    //                'icon' => 'ti ti-plus fs-3 me-2',
    //                'permission' => 'createUser'
    //            ],
    //            [
    //                'title' => 'Danh sách',
    //                'route' => 'users.index',
    //                'icon' => 'ti ti-list fs-3 me-2',
    //                'permission' => 'viewUser'
    //            ]
    //        ]
    //    ],
    //    [
    //        'active' => ['users.*'],
    //        'show' => ['users.*'],
    //        'title' => 'Sự kiện',
    //        'icon' => 'ti ti-calendar-event fs-2',
    //        'permission' => ['viewUser', 'createUser', 'editUser', 'deleteUser'],
    //        'children' => [
    //            [
    //                'title' => 'Thêm mới',
    //                'route' => 'users.create',
    //                'icon' => 'ti ti-plus fs-3 me-2',
    //                'permission' => 'createUser'
    //            ],
    //            [
    //                'title' => 'Danh sách',
    //                'route' => 'users.index',
    //                'icon' => 'ti ti-list fs-3 me-2',
    //                'permission' => 'viewUser'
    //            ]
    //        ]
    //    ],
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
