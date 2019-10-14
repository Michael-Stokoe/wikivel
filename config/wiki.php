<?php

return [
    'activity_log' => [
        'days_to_show' => 3,
    ],

    'sidebar' => [
        'wikis_to_show' => 5,
        'spaces_to_show' => 5,
        'pages_to_show' => 5,
    ],

    'recent_activity' => [
        'page_size' => 10,
    ],

    'search' => [
        'result_limit' => 5,
    ],

    'users' => [
        [
            'email' => 'superadmin@wiki.app',
            'name' => 'Super Admin',
            'password' => 'password',
            'display_picture' => null,
            'roles' => ['super_admin', 'admin', 'user'],
        ],
        [
            'email' => 'michael@consil.co.uk',
            'name' => 'Michael Stokoe',
            'password' => 'consilpass1',
            'display_picture' => null,
            'roles' => ['admin', 'user'],
        ]
    ],

    'roles' => [
        'super_admin' => [
            'name' => 'super_admin',
            'permissionGroups' => [
                'view',
                'show',
                'edit',
                'delete'
            ],
        ],

        'admin' => [
            'name' => 'admin',
            'permissionGroups' => [
                'view',
                'show',
                'edit',
                'delete'
            ],
        ],

        'user' => [
            'name' => 'user',
            'permissionGroups' => [
                'view',
                'show',
                'edit'
            ],
        ],
    ],

    'permissions' => [
        'view' => [
            'view_index',
            'view_wiki',
            'view_page',
            'view_space',
            'view_images'
        ],

        'show' => [
            'show_index',
            'show_wiki',
            'show_page',
            'show_space',
            'show_images'
        ],

        'edit' => [
            'edit_index',
            'edit_wiki',
            'edit_page',
            'edit_space',
            'edit_images'
        ],

        'delete' => [
            'delete_index',
            'delete_wiki',
            'delete_page',
            'delete_space',
            'delete_images'
        ],
    ],
];
