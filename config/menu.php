<?php

return [
    'dashboard' => [
        'title' => 'Dashboard',
        'routeName' => 'dashboard',
        'icon' => 'mdi mdi-home menu-icon',
    ],
    'product' => [
        'title' => 'Product',
        'routeName' => 'product.index',
        'icon' => 'mdi mdi-briefcase menu-icon',
    ],
    'driver' => [
        'title' => 'Driver',
        'routeName' => 'driver.index',
        'icon' => 'mdi mdi-account-group menu-icon',
    ],
    'vehicle' => [
        'title' => 'Kendaraan',
        'routeName' => 'vehicle.index',
        'icon' => 'mdi mdi-car menu-icon',
    ],
    'warehouse' => [
        'title' => 'Gudang',
        'routeName' => 'warehouse.index',
        'icon' => 'mdi mdi-domain menu-icon',
    ],
    'hub-list' => [
        'title' => 'Master Hub',
        'routeName' => 'hub.index',
        'icon' => 'mdi mdi-flag menu-icon',
    ],
    'delivery-order' => [
        'title' => 'Delivery Order',
        'routeName' => 'delivery-order.index',
        'icon' => 'mdi mdi-send menu-icon',
    ],
    'document-assignment' => [
        'title' => 'Document Assignment',
        'routeName' => 'document-assignment.index',
        'icon' => 'mdi mdi-file-document menu-icon',
    ],
    'master-setting' => [
        'title' => 'Master Setting',
        'routeName' => 'user.index',
        'additional_query' => '',
        'icon' => 'mdi mdi-settings menu-icon',
        'sub_menu' => [
            'user-list' => [
                'title' => 'User',
                'routeName' => 'user.index',
                'icon' => 'mdi mdi-account-multiple menu-icon',
            ],
            // 'member-list' => [
            //     'title' => 'Member',
            //     'routeName' => 'member.index',
            //     'icon' => 'mdi mdi-account-multiple menu-icon',
            // ],
            'role-list' => [
                'title' => 'Role',
                'routeName' => 'role.index',
                'icon' => 'mdi mdi-account-settings menu-icon',
            ],
            'permission-list' => [
                'title' => 'Permission',
                'routeName' => 'permission.index',
                'icon' => 'mdi mdi-account-settings menu-icon',
            ],
            'setting-list' => [
                'title' => 'Setting',
                'routeName' => 'settings.index',
                'icon' => 'mdi mdi-account-settings menu-icon',
            ],
        ]
    ],
    // 'user' => [
    //     'title' => 'User',
    //     'routeName' => 'user.index',
    //     'additional_query' => '',
    //     'icon' => 'mdi mdi-account-multiple menu-icon',
    // ],
    // 'role' => [
    //     'title' => 'Role',
    //     'routeName' => 'role.index',
    //     'additional_query' => '',
    //     'icon' => 'mdi mdi-account-settings menu-icon',
    // ],
    // 'permission' => [
    //     'title' => 'Permission',
    //     'routeName' => 'permission.index',
    //     'additional_query' => '',
    //     'icon' => 'mdi mdi-account-key menu-icon',
    //        'sub_menu' => [
    //            'User' => [
    //                'title' => 'Users',
    //                'routeName' => 'user.index',
    //                'icon' => 'mdi mdi-account-multiple menu-icon',
    //            ],
    //            'roles' => [
    //                'title' => 'Role',
    //                'routeName' => 'role.index',
    //                'icon' => 'mdi mdi-account-settings menu-icon',
    //            ],
    //            'permission' => [
    //                'title' => 'Permission',
    //                'routeName' => 'permission.index',
    //                'icon' => 'mdi mdi-account-key menu-icon',
    //            ],
    //        ]
    // ],
    // 'setting' => [
    //     'title' => 'Setting',
    //     'routeName' => 'settings.index',
    //     'additional_query' => '',
    //     'icon' => 'mdi mdi-settings menu-icon',
    // ],
];
