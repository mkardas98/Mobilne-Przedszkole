<?php

return [
    [
        'label' => 'Przedszkole',
        'icon' => '',
        'items' => [
            'home' => [
                'label' => 'Dashboard',
                'icon' => 'fas fa-home',
                'route_name' => 'teacher_home.show',
            ],
            'group' => [
                'label' => 'Grupy',
                'icon' => 'fas fa-users',
                'route_name' => 'teacher.groups.index',
            ],
        ]
    ],
];
