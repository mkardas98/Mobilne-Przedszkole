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
                'route_name' => 'director.groups.index',
            ],
            'pupils' => [
                'label' => 'Dzieci',
                'icon' => 'fas fa-child',
                'route_name' => 'director.kids.index',
            ],
            'announcements' => [
                'label' => 'Ogłoszenia',
                'icon' => 'fas fa-bullhorn',
                'route_name' => 'director.announcements.index',
            ],
            'eat_menu' => [
                'label' => 'Jadłospis',
                'icon' => 'fas fa-utensils',
                'route_name' => 'director.eat_menu.index',
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
            'gallery' => [
                'label' => 'Galeria',
                'icon' => 'fas fa-images',
                'route_name' => 'director.gallery.index',
            ],
            'news' => [
                'label' => 'Aktualności',
                'icon' => 'fas fa-newspaper',
                'route_name' => 'director.news.index',
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
                'route_name' => 'director.users.index',
            ],
        ]
    ],
    [
        'label' => 'Konfiguracja',
        'icon' => '',
        'items' => [
            'kindergarten_data' => [
                'label' => 'Dane przedszkola',
                'icon' => 'fas fa-info-circle',
                'route_name' => 'director.kindergarten_data.edit',
            ],
            'mail' => [
                'label' => 'SMTP - Email',
                'icon' => 'fas fa-envelope-open-text',
                'route_name' => 'director.configuration.email',
            ],
        ]
    ],

];
