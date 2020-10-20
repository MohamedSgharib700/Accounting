<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => false,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => false,

    'roles_structure' => [
        'sales_manager' => [
            'users' => 'c,r,u,d',
            'pos' => 'r',
            'customers' => 'c,r,u,d',
            'balances' => 'c,r,u,d',
            'transactions' => 'c,r,u,d',
            'locations' => 'c,r,u,d'
        ],
        'area_manager' => [
            'users' => 'c,r,u,d',
            'pos' => 'r',
            'customers' => 'c,r,u,d',
            'balances' => 'c,r',
            'transactions' => 'c,r,u',
            'locations' => 'r'
        ],
        'supervisor' => [
            'users' => 'c,r',
            'pos' => 'r',
            'customers' => 'c,r,u',
            'balances' => 'c,r',
            'transactions' => 'r',
            'locations' => 'r'
        ],
        'agent' => [
            'pos' => 'r',
            'customers' => 'c,r,u',
            'balances' => 'c,r',
            'transactions' => 'c,r',
            'locations' => 'r'
        ]
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
