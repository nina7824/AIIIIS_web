<?php

if (!function_exists('get_user_menu')) {
    function get_user_menu($role)
    {
        // Base menus for all users
        $baseMenus = [
            [
                'icon' => 'fa-tachometer-alt',
                'label' => 'Dashboard',
                'route' => 'dashboard',
                'active' => 'dashboard'
            ]
        ];

        // Role-specific menus
        $roleMenus = [
            'administrator' => [
                [
                    'icon' => 'fa-users-cog',
                    'label' => 'User Management',
                    'route' => 'admin/users',
                    'active' => 'admin/users'
                ],
                [
                    'icon' => 'fa-building',
                    'label' => 'All Enterprises',
                    'route' => 'admin/enterprises',
                    'active' => 'admin/enterprises'
                ],
                [
                    'icon' => 'fa-chart-pie',
                    'label' => 'Analytics',
                    'route' => 'admin/analytics',
                    'active' => 'admin/analytics'
                ],
                [
                    'icon' => 'fa-cog',
                    'label' => 'System Settings',
                    'route' => 'admin/settings',
                    'active' => 'admin/settings'
                ]
            ],
            'nirda_expert' => [
                [
                    'icon' => 'fa-building',
                    'label' => 'Enterprise Directory',
                    'route' => 'expert/enterprises',
                    'active' => 'expert/enterprises'
                ],
                [
                    'icon' => 'fa-check-circle',
                    'label' => 'Verification Queue',
                    'route' => 'expert/verifications',
                    'active' => 'expert/verifications'
                ],
                [
                    'icon' => 'fa-handshake',
                    'label' => 'Advisory Requests',
                    'route' => 'expert/advisory',
                    'active' => 'expert/advisory'
                ],
                [
                    'icon' => 'fa-calendar-check',
                    'label' => 'Visit Reports',
                    'route' => 'expert/visits',
                    'active' => 'expert/visits'
                ],
                [
                    'icon' => 'fa-chart-line',
                    'label' => 'Engagement Analytics',
                    'route' => 'expert/analytics',
                    'active' => 'expert/analytics'
                ]
            ],
            'enterprise' => [
                [
                    'icon' => 'fa-id-card',
                    'label' => 'My Profile',
                    'route' => 'enterprise/profile',
                    'active' => 'enterprise/profile'
                ],
                [
                    'icon' => 'fa-trophy',
                    'label' => 'My Ranking',
                    'route' => 'enterprise/ranking',
                    'active' => 'enterprise/ranking'
                ],
                [
                    'icon' => 'fa-handshake',
                    'label' => 'Investment Matches',
                    'route' => 'enterprise/matches',
                    'active' => 'enterprise/matches'
                ],
                [
                    'icon' => 'fa-file-alt',
                    'label' => 'Business Plan',
                    'route' => 'enterprise/business-plan',
                    'active' => 'enterprise/business-plan'
                ],
                [
                    'icon' => 'fa-headset',
                    'label' => 'Expert Support',
                    'route' => 'enterprise/support',
                    'active' => 'enterprise/support'
                ]
            ],
            'investor' => [
                [
                    'icon' => 'fa-user-tie',
                    'label' => 'My Profile',
                    'route' => 'investor/profile',
                    'active' => 'investor/profile'
                ],
                [
                    'icon' => 'fa-search',
                    'label' => 'Find Enterprises',
                    'route' => 'investor/search',
                    'active' => 'investor/search'
                ],
                [
                    'icon' => 'fa-handshake',
                    'label' => 'My Matches',
                    'route' => 'investor/matches',
                    'active' => 'investor/matches'
                ],
                [
                    'icon' => 'fa-file-signature',
                    'label' => 'Deal Tracking',
                    'route' => 'investor/deals',
                    'active' => 'investor/deals'
                ],
                [
                    'icon' => 'fa-chart-pie',
                    'label' => 'Portfolio View',
                    'route' => 'investor/portfolio',
                    'active' => 'investor/portfolio'
                ]
            ],
            'government' => [
                [
                    'icon' => 'fa-landmark',
                    'label' => 'Policy Dashboard',
                    'route' => 'government/dashboard',
                    'active' => 'government/dashboard'
                ],
                [
                    'icon' => 'fa-map-marked-alt',
                    'label' => 'Industrial Map',
                    'route' => 'government/map',
                    'active' => 'government/map'
                ],
                [
                    'icon' => 'fa-chart-bar',
                    'label' => 'Sector Reports',
                    'route' => 'government/reports',
                    'active' => 'government/reports'
                ],
                [
                    'icon' => 'fa-file-pdf',
                    'label' => 'Policy Intelligence',
                    'route' => 'government/policy',
                    'active' => 'government/policy'
                ]
            ],
            'analyst' => [
                [
                    'icon' => 'fa-chart-line',
                    'label' => 'Analytics Dashboard',
                    'route' => 'analyst/dashboard',
                    'active' => 'analyst/dashboard'
                ],
                [
                    'icon' => 'fa-database',
                    'label' => 'Data Explorer',
                    'route' => 'analyst/data',
                    'active' => 'analyst/data'
                ],
                [
                    'icon' => 'fa-file-export',
                    'label' => 'Export Reports',
                    'route' => 'analyst/export',
                    'active' => 'analyst/export'
                ]
            ]
        ];

        // Merge base menus with role-specific menus
        $menus = array_merge($baseMenus, $roleMenus[$role] ?? []);

        return $menus;
    }
}