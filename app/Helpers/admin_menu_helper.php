<?php

if (!function_exists('get_admin_menu')) {
    /**
     * Get admin sidebar menu based on user role
     * 
     * @param string $role User role
     * @return array Menu items
     */
    function get_admin_menu($role)
    {
        // Admin menus (full access - Administrator)
        if ($role === 'administrator') {
            return [
                [
                    'icon' => 'fa-tachometer-alt',
                    'label' => 'Dashboard',
                    'route' => 'admin/dashboard',
                    'active' => 'admin/dashboard'
                ],
                [
                    'icon' => 'fa-users-cog',
                    'label' => 'User Management',
                    'route' => 'admin/users',
                    'active' => 'admin/users'
                ],
                [
                    'icon' => 'fa-building',
                    'label' => 'Enterprises',
                    'route' => 'admin/enterprises',
                    'active' => 'admin/enterprises'
                ],
                [
                    'icon' => 'fa-user-tie',
                    'label' => 'Investors',
                    'route' => 'admin/investors',
                    'active' => 'admin/investors'
                ],
                [
                    'icon' => 'fa-handshake',
                    'label' => 'Matches',
                    'route' => 'admin/matches',
                    'active' => 'admin/matches'
                ],
                [
                    'icon' => 'fa-file-signature',
                    'label' => 'Deals',
                    'route' => 'admin/deals',
                    'active' => 'admin/deals'
                ],
                [
                    'icon' => 'fa-chart-pie',
                    'label' => 'Analytics',
                    'route' => 'admin/analytics',
                    'active' => 'admin/analytics'
                ],
                [
                    'icon' => 'fa-cog',
                    'label' => 'Settings',
                    'route' => 'admin/settings',
                    'active' => 'admin/settings'
                ]
            ];
        }

        // NIRDA Expert menus
        if ($role === 'nirda_expert') {
            return [
                [
                    'icon' => 'fa-tachometer-alt',
                    'label' => 'Dashboard',
                    'route' => 'expert/dashboard',
                    'active' => 'expert/dashboard'
                ],
                [
                    'icon' => 'fa-building',
                    'label' => 'Enterprises',
                    'route' => 'expert/enterprises',
                    'active' => 'expert/enterprises'
                ],
                [
                    'icon' => 'fa-check-circle',
                    'label' => 'Verifications',
                    'route' => 'expert/verifications',
                    'active' => 'expert/verifications'
                ],
                [
                    'icon' => 'fa-handshake',
                    'label' => 'Advisory',
                    'route' => 'expert/advisory',
                    'active' => 'expert/advisory'
                ],
                [
                    'icon' => 'fa-calendar-check',
                    'label' => 'Visit Reports',
                    'route' => 'expert/visits',
                    'active' => 'expert/visits'
                ]
            ];
        }

        // Enterprise menus
        if ($role === 'enterprise') {
            return [
                [
                    'icon' => 'fa-tachometer-alt',
                    'label' => 'Dashboard',
                    'route' => 'enterprise/dashboard',
                    'active' => 'enterprise/dashboard'
                ],
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
                    'label' => 'Matches',
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
                    'label' => 'Support',
                    'route' => 'enterprise/support',
                    'active' => 'enterprise/support'
                ]
            ];
        }

        // Investor menus
        if ($role === 'investor') {
            return [
                [
                    'icon' => 'fa-tachometer-alt',
                    'label' => 'Dashboard',
                    'route' => 'investor/dashboard',
                    'active' => 'investor/dashboard'
                ],
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
                    'label' => 'Portfolio',
                    'route' => 'investor/portfolio',
                    'active' => 'investor/portfolio'
                ]
            ];
        }

        // Government menus
        if ($role === 'government') {
            return [
                [
                    'icon' => 'fa-tachometer-alt',
                    'label' => 'Dashboard',
                    'route' => 'government/dashboard',
                    'active' => 'government/dashboard'
                ],
                [
                    'icon' => 'fa-landmark',
                    'label' => 'Policy Dashboard',
                    'route' => 'government/policy',
                    'active' => 'government/policy'
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
                    'route' => 'government/intelligence',
                    'active' => 'government/intelligence'
                ]
            ];
        }
// Enterprise menus
if ($role === 'enterprise') {
    return [
        ['icon' => 'fa-tachometer-alt', 'label' => 'Dashboard', 'route' => 'enterprise/dashboard', 'active' => 'enterprise/dashboard'],
        ['icon' => 'fa-id-card', 'label' => 'My Profile', 'route' => 'enterprise/profile', 'active' => 'enterprise/profile'],
        ['icon' => 'fa-trophy', 'label' => 'My Ranking', 'route' => 'enterprise/ranking', 'active' => 'enterprise/ranking'],
        ['icon' => 'fa-handshake', 'label' => 'Matches', 'route' => 'enterprise/matches', 'active' => 'enterprise/matches'],
        ['icon' => 'fa-rocket', 'label' => 'Investment', 'route' => 'enterprise/investment', 'active' => 'enterprise/investment'],
        ['icon' => 'fa-chalkboard-teacher', 'label' => 'Advisory', 'route' => 'enterprise/advisory', 'active' => 'enterprise/advisory'],
        ['icon' => 'fa-headset', 'label' => 'Helpdesk', 'route' => 'enterprise/helpdesk', 'active' => 'enterprise/helpdesk'],
        ['icon' => 'fa-bell', 'label' => 'Notifications', 'route' => 'enterprise/notifications', 'active' => 'enterprise/notifications'],
        ['icon' => 'fa-calendar-check', 'label' => 'Engagements', 'route' => 'enterprise/engagements', 'active' => 'enterprise/engagements']
    ];
}
        // Analyst menus
        if ($role === 'analyst') {
            return [
                [
                    'icon' => 'fa-tachometer-alt',
                    'label' => 'Dashboard',
                    'route' => 'analyst/dashboard',
                    'active' => 'analyst/dashboard'
                ],
                [
                    'icon' => 'fa-chart-line',
                    'label' => 'Analytics',
                    'route' => 'analyst/analytics',
                    'active' => 'analyst/analytics'
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
            ];
        }

        // Default (fallback)
        return [
            [
                'icon' => 'fa-tachometer-alt',
                'label' => 'Dashboard',
                'route' => 'dashboard',
                'active' => 'dashboard'
            ]
        ];
    }
}

if (!function_exists('is_menu_active')) {
    /**
     * Check if a menu item is active based on current URI
     * 
     * @param string $route The route to check
     * @param string $currentUri The current URI
     * @return bool
     */
    function is_menu_active($route, $currentUri)
    {
        return strpos($currentUri, $route) !== false;
    }
}