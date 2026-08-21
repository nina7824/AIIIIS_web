<?php
// app/Config/Menus.php

namespace Config;

class Menus
{
    public static function getMenus()
    {
        return [
            // Dashboard - accessible to all authenticated users
            [
                'label' => 'Dashboard',
                'icon' => 'fa-home',
                'route' => 'admin/dashboard',
                'module' => 'dashboard',
                'active' => ['dashboard'],
                'permissions' => ['view']
            ],
            
            // User Management - only for admins and users with permission
            [
                'label' => 'Users',
                'icon' => 'fa-users',
                'route' => '#',
                'module' => 'users',
                'active' => ['users'],
                'permissions' => ['view'],
                'submenus' => [
                    [
                        'label' => 'All Users',
                        'route' => 'admin/users',
                        'module' => 'users',
                        'permissions' => ['view']
                    ],
                    [
                        'label' => 'Add User',
                        'route' => 'admin/users/add',
                        'module' => 'users',
                        'permissions' => ['add']
                    ],
                    [
                        'label' => 'Roles & Permissions',
                        'route' => 'admin/users/roles',
                        'module' => 'users',
                        'permissions' => ['edit', 'view']
                    ]
                ]
            ],
            
            // Content Management
            [
                'label' => 'Content',
                'icon' => 'fa-file-alt',
                'route' => '#',
                'module' => 'content',
                'active' => ['content'],
                'permissions' => ['view'],
                'submenus' => [
                    [
                        'label' => 'All Content',
                        'route' => 'admin/content',
                        'module' => 'content',
                        'permissions' => ['view']
                    ],
                    [
                        'label' => 'Add Content',
                        'route' => 'admin/content/add',
                        'module' => 'content',
                        'permissions' => ['add']
                    ],
                    [
                        'label' => 'Categories',
                        'route' => 'admin/content/categories',
                        'module' => 'content',
                        'permissions' => ['view', 'edit']
                    ]
                ]
            ],
            
            // Reports - accessible to most roles
            [
                'label' => 'Reports',
                'icon' => 'fa-chart-bar',
                'route' => '#',
                'module' => 'reports',
                'active' => ['reports'],
                'permissions' => ['view'],
                'submenus' => [
                    [
                        'label' => 'Analytics',
                        'route' => 'admin/reports/analytics',
                        'module' => 'analytics',
                        'permissions' => ['view']
                    ],
                    [
                        'label' => 'Export Data',
                        'route' => 'admin/reports/export',
                        'module' => 'export',
                        'permissions' => ['export']
                    ]
                ]
            ],
            
            // Settings - only for admins
            [
                'label' => 'Settings',
                'icon' => 'fa-cog',
                'route' => '#',
                'module' => 'settings',
                'active' => ['settings'],
                'permissions' => ['view'],
                'submenus' => [
                    [
                        'label' => 'System Settings',
                        'route' => 'admin/settings',
                        'module' => 'settings',
                        'permissions' => ['view', 'edit']
                    ],
                    [
                        'label' => 'Module Management',
                        'route' => 'admin/settings/modules',
                        'module' => 'modules',
                        'permissions' => ['view', 'manage']
                    ]
                ]
            ],
            
            // Notifications - accessible to most roles
            [
                'label' => 'Notifications',
                'icon' => 'fa-bell',
                'route' => 'admin/notifications',
                'module' => 'notifications',
                'active' => ['notifications'],
                'permissions' => ['view']
            ],
            
            // Analytics - separate module for data analysis
            [
                'label' => 'Analytics',
                'icon' => 'fa-chart-line',
                'route' => 'admin/analytics',
                'module' => 'analytics',
                'active' => ['analytics'],
                'permissions' => ['view']
            ],
            
            // API Management - only for admins
            [
                'label' => 'API',
                'icon' => 'fa-code',
                'route' => 'admin/api',
                'module' => 'api',
                'active' => ['api'],
                'permissions' => ['manage']
            ]
        ];
    }
}