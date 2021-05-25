<?php

return [
    [
        'label' => 'Przedszkole',
        'icon' => '',
        'items' => [
            'home' => [
                'label' => 'Dashboard',
                'icon' => 'fas fa-home',
                'route_name' => 'director_home.show',
            ],
            'group' => [
                'label' => 'Grupy',
                'icon' => 'fas fa-users',
                'route_name' => 'index.show',
            ],
            'pupils' => [
                'label' => 'Uczniowie',
                'icon' => 'fas fa-child',
                'route_name' => 'index.show',
            ],
            'announcements' => [
                'label' => 'Ogłoszenia',
                'icon' => 'fas fa-bullhorn',
                'route_name' => 'index.show',
            ],
            'foods' => [
                'label' => 'Jadłospis',
                'icon' => 'fas fa-utensils',
                'route_name' => 'index.show',
            ],

        ]
    ],
    [
        'label' => 'Stona przedszkola',
        'icon' => '',
        'items' => [
            'main_page' => [
                'label' => 'Strona główna przeszkola',
                'icon' => 'fas fa-laptop-house',
                'route_name' => 'index.show',
            ],
            'kindergarten_data' => [
                'label' => 'Dane przedszkola',
                'icon' => 'fas fa-info-circle',
                'route_name' => 'index.show',
            ],
            'gallery' => [
                'label' => 'Galeria',
                'icon' => 'fas fa-images',
                'route_name' => 'index.show',
            ],
            'news' => [
                'label' => 'Aktualności',
                'icon' => 'fas fa-newspaper',
                'route_name' => 'index.show',
            ],
        ]
    ],
    [
        'label' => 'Użytkownicy',
        'icon' => '',
        'items' => [
            'users' => [
                'label' => 'Zarządzanie użytkownikami',
                'icon' => 'fas fa-user-cog',
                'route_name' => 'index.show',
            ],
        ]
    ],
];
