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
        'active' => ['branches.*'],
        'show' => ['branches.*'],
        'title' => 'Chi nhánh',
        'icon' => 'ti ti-building fs-2',
        'permission' => ['viewBranch', 'createBranch', 'editBranch', 'deleteBranch'],
        'children' => [
            [
                'title' => 'Thêm mới',
                'route' => 'branches.create',
                'icon' => 'ti ti-plus fs-3 me-2',
                'permission' => 'createBranch',
            ],
            [
                'title' => 'Danh sách',
                'route' => 'branches.index',
                'icon' => 'ti ti-list fs-3 me-2',
                'permission' => 'viewBranch',
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
