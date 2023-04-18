<?php

return [
    [
        'href' => 'dashboard',
        'text' => '',
        'is_multi' => false,
        'icon' => 'fas fa-chart-bar',
    ],
    [
        'href' => [
            [
                'href' => 'users.index',
                'text' => 'menu.user.index',
                'icon' => 'fa fa-users',
            ],
            [
                'href' => 'regions.index',
                'text' => 'menu.region.index',
                'icon' => 'fa fa-map-marker',
            ],
            [
                'href' => 'schedules.index',
                'text' => 'menu.schedules.index',
                'icon' => 'fa fa-calendar',
            ],
//            [
//                'section_text' => 'menu.settings.ecard',
//                'icon' => 'pocztowki',
//                'links' => ['ecard.render', 'ecard-theme.render'],
//                'permission' => [
//                    PermissionEnums::getPermission('ecard',PermissionEnums::READ_ACTION),
//                    PermissionEnums::getPermission('ecard-theme',PermissionEnums::READ_ACTION)
//                ],
//                'section_list' => [
//                    [
//                        'href' => 'ecard.render',
//                        'text' => 'menu.settings.ecard-photos',
//                        'permission' => PermissionEnums::getPermission('ecard',PermissionEnums::READ_ACTION),
//                    ],
//                    [
//                        'href' => 'ecard-theme.render',
//                        'text' => 'menu.settings.ecard-theme',
//                        'permission' => PermissionEnums::getPermission('ecard-theme',PermissionEnums::READ_ACTION),
//                    ],
//                ],
//            ],
        ],
        'text' => '',
        'is_multi' => true,
    ],
];
