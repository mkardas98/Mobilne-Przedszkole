<?php

return [
    [
        'label' => 'CMS',
        'icon' => '',
        'items' => [
            'index' => [
                'label' => 'admin.nav.index',
                'icon' => 'home',
                'route_name' => 'director.home',
            ],
            'const_field' => [
                'label' => 'admin.const_field.plural',
                'icon' => 'anchor',
                'route_name' => 'director.home',
            ],
            'nav_item' => [
                'label' => 'admin.nav_item.plural',
                'icon' => 'menu',
                'route_name' => 'director.home',
                'items' => [
                    'nav_item_main' => [
                        'label' => 'admin.navs.main',
                        'icon' => 'arrow-up-left',
                        'route_name' => 'director.home',
                        'params' => 'main'
                    ],
                    'nav_item_footer' => [
                        'label' => 'admin.navs.footer',
                        'icon' => 'arrow-up-left',
                        'route_name' => 'director.home',
                        'params' => 'footer'
                    ],
                ]
            ],
        ]
    ],
];
