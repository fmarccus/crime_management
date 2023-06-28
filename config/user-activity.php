<?php

return [
    'activated'        => true, // active/inactive all logging
    'middleware'       => ['web', 'useractivity'],
    'route_path'       => 'logs',
    'admin_panel_path' => 'home',
    'delete_limit'     => 7, // default 7 days

    'model' => [
        'user' => "App\Models\User",
        'issue' => "App\Models\Issue"
    ],

    'log_events' => [
        'on_create'     => true,
        'on_edit'       => true,
        'on_delete'     => true,
        'on_login'      => true,
        'on_lockout'    => true
    ]
];
