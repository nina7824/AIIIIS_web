<?php
// app/Helpers/admin_menu_helper.php

if (!function_exists('get_admin_menu')) {
    /**
     * Get admin sidebar menu dynamically based on user role and permissions
     * 
     * @param string|array $user User data or role string
     * @return array Menu items with submenus
     */
    function get_admin_menu($user)
    {
        // Extract role from user data
        $role = is_array($user) ? ($user['role'] ?? 'enterprise') : $user;
        
        // Get permissions from session
        $permissions = session()->get('permissions') ?? [];
        
        // If user array has permissions, use those instead
        if (is_array($user) && isset($user['permissions'])) {
            $permissions = $user['permissions'];
        }
        
        // ============================================================
        // CHECK IF USER IS SUPER ADMIN
        // ============================================================
        $isSuperAdmin = false;
        $superAdminRoles = ['super_admin', 'Super Admin', 'Administrator', 'admin'];
        
        // Check if role is in super admin list
        if (is_string($role)) {
            $isSuperAdmin = in_array(strtolower($role), array_map('strtolower', $superAdminRoles));
        }
        
        // Also check if user array has role
        if (is_array($user) && isset($user['role'])) {
            $isSuperAdmin = in_array(strtolower($user['role']), array_map('strtolower', $superAdminRoles));
        }
        
        // ============================================================
        // IF SUPER ADMIN - GRANT ALL PERMISSIONS
        // ============================================================
        if ($isSuperAdmin) {
            // Get all permission slugs from database
            try {
                $db = \Config\Database::connect();
                
                // Check if permissions table exists
                $tables = $db->listTables();
                if (in_array('permissions', $tables)) {
                    // Check if is_active column exists
                    $fields = $db->getFieldData('permissions');
                    $fieldNames = array_column($fields, 'name');
                    $hasIsActive = in_array('is_active', $fieldNames);
                    
                    // Build query
                    $builder = $db->table('permissions')->select('slug');
                    
                    // Only use is_active if column exists
                    if ($hasIsActive) {
                        $builder->where('is_active', 1);
                    }
                    
                    $allPermissions = $builder->get()->getResultArray();
                    $allPermissionSlugs = array_column($allPermissions, 'slug');
                    $permissions = array_merge($permissions, $allPermissionSlugs);
                }
            } catch (\Exception $e) {
                // Log error but continue
                log_message('error', 'Error fetching permissions in menu: ' . $e->getMessage());
            }
            
            // Add all default permissions for super admin
            $permissions = array_merge($permissions, [
                'dashboard_view',
                'users_view', 'users_manage', 'users_add', 'users_edit', 'users_delete',
                'permissions_view', 'permissions_manage',
                'roles_view', 'roles_manage',
                'modules_view', 'modules_manage',
                'enterprises_view', 'enterprises_manage', 'enterprises_add', 'enterprises_edit', 'enterprises_delete', 'enterprises_verify',
                'clusters_view', 'clusters_manage', 'clusters_add', 'clusters_edit', 'clusters_delete', 'clusters_assign', 'clusters_analytics_view',
                'services_view', 'services_manage', 'services_add', 'services_edit', 'services_delete',
                'investors_view', 'investors_manage', 'investors_add', 'investors_edit', 'investors_delete', 'investors_verify',
                'reports_view', 'reports_manage', 'reports_add', 'reports_edit', 'reports_delete',
                'matchmaking_view', 'matchmaking_manage', 'matchmaking_add', 'matchmaking_edit', 'matchmaking_delete',
                'sectors_view', 'sectors_manage', 'sectors_add', 'sectors_edit', 'sectors_delete',
                'deals_view', 'deals_manage', 'deals_add', 'deals_edit', 'deals_delete',
                'analytics_view', 'analytics_manage', 'analytics_export',
                'settings_view', 'settings_manage', 'settings_edit',
                'support_view', 'support_manage', 'support_add', 'support_edit', 'support_delete',
                'chat_view', 'chat_manage',
                'faq_view', 'faq_manage',
                'knowledge_base_view', 'knowledge_base_manage',
                'enterprise_ranking_view', 'enterprise_ranking_manage',
                'service_categories_view', 'service_categories_manage',
                'service_providers_view', 'service_providers_manage',
                'service_requests_view', 'service_requests_manage',
                'service_bookings_view', 'service_bookings_manage',
                'service_reviews_view', 'service_reviews_manage'
            ]);
            
            // Remove duplicates
            $permissions = array_unique($permissions);
        }
        // ============================================================
        
        // Build dynamic menu based on permissions
        $menu = [];
        
        // ============================================================
        // DASHBOARD
        // ============================================================
        if (in_array('dashboard_view', $permissions) || $isSuperAdmin) {
            $menu[] = [
                'icon' => 'fa-tachometer-alt', 
                'label' => 'Dashboard', 
                'route' => '/dashboard', 
                'active' => ['dashboard']
            ];
        }
        
        // ============================================================
        // USER MANAGEMENT
        // ============================================================
        if (in_array('users_view', $permissions) || in_array('users_manage', $permissions) || $isSuperAdmin) {
            $submenus = [];
            
            if (in_array('users_view', $permissions) || $isSuperAdmin) {
                $submenus[] = ['label' => 'All Users', 'route' => '/admin/users', 'icon' => 'fa-users'];
            }
            if (in_array('users_add', $permissions) || $isSuperAdmin) {
                $submenus[] = ['label' => 'Add User', 'route' => '/admin/users/create', 'icon' => 'fa-user-plus'];
            }
            if (in_array('users_edit', $permissions) || $isSuperAdmin) {
                $submenus[] = ['label' => 'Edit Users', 'route' => '/admin/users', 'icon' => 'fa-edit'];
            }
            if (in_array('users_delete', $permissions) || $isSuperAdmin) {
                $submenus[] = ['label' => 'Delete Users', 'route' => '/admin/users', 'icon' => 'fa-trash'];
            }
            if (in_array('roles_view', $permissions) || in_array('roles_manage', $permissions) || $isSuperAdmin) {
                $submenus[] = ['label' => 'Roles', 'route' => '/admin/roles', 'icon' => 'fa-user-shield'];
            }
            
            if (!empty($submenus)) {
                $menu[] = [
                    'icon' => 'fa-users-cog', 
                    'label' => 'User Management', 
                    'route' => '#', 
                    'active' => ['admin/users', 'admin/roles'],
                    'submenus' => $submenus
                ];
            }
        }
        
        // ============================================================
        // PERMISSIONS
        // ============================================================
        if (in_array('permissions_view', $permissions) || in_array('permissions_manage', $permissions) || $isSuperAdmin) {
            $menu[] = [
                'icon' => 'fa-lock', 
                'label' => 'Permissions', 
                'route' => '/admin/permissions', 
                'active' => ['admin/permissions']
            ];
        }
        
        // ============================================================
        // MODULES
        // ============================================================
        if (in_array('modules_view', $permissions) || in_array('modules_manage', $permissions) || $isSuperAdmin) {
            $menu[] = [
                'icon' => 'fa-cubes', 
                'label' => 'Modules', 
                'route' => '/admin/modules', 
                'active' => ['admin/modules']
            ];
        }
        
        // ============================================================
        // ENTERPRISES
        // ============================================================
        if (in_array('enterprises_view', $permissions) || in_array('enterprises_manage', $permissions) || $isSuperAdmin) {
            $submenus = [];
            
            if (in_array('enterprises_view', $permissions) || $isSuperAdmin) {
                $submenus[] = ['label' => 'All Enterprises', 'route' => '/admin/enterprises', 'icon' => 'fa-list'];
            }
            if (in_array('enterprises_add', $permissions) || $isSuperAdmin) {
                $submenus[] = ['label' => 'Add Enterprise', 'route' => '/admin/enterprises/create', 'icon' => 'fa-plus'];
            }
            if (in_array('enterprises_edit', $permissions) || $isSuperAdmin) {
                $submenus[] = ['label' => 'Edit Enterprises', 'route' => '/admin/enterprises', 'icon' => 'fa-edit'];
            }
            if (in_array('enterprises_delete', $permissions) || $isSuperAdmin) {
                $submenus[] = ['label' => 'Delete Enterprises', 'route' => '/admin/enterprises', 'icon' => 'fa-trash'];
            }
            if (in_array('enterprises_verify', $permissions) || $isSuperAdmin) {
                $submenus[] = ['label' => 'Verify Enterprises', 'route' => '/admin/enterprises/verify', 'icon' => 'fa-check-circle'];
            }
            if (in_array('enterprise_ranking_view', $permissions) || in_array('enterprise_ranking_manage', $permissions) || $isSuperAdmin) {
                $submenus[] = ['label' => 'Ranking', 'route' => '/admin/enterprises/ranking', 'icon' => 'fa-trophy'];
            }
            if (in_array('clusters_view', $permissions) || in_array('clusters_manage', $permissions) || $isSuperAdmin) {
                $submenus[] = ['label' => 'Clusters', 'route' => '/admin/enterprises/clusters', 'icon' => 'fa-object-group'];
            }
            if (in_array('clusters_add', $permissions) || $isSuperAdmin) {
                $submenus[] = ['label' => 'Add Cluster', 'route' => '/admin/enterprises/clusters/create', 'icon' => 'fa-plus'];
            }
            if (in_array('clusters_edit', $permissions) || $isSuperAdmin) {
                $submenus[] = ['label' => 'Edit Clusters', 'route' => '/admin/enterprises/clusters', 'icon' => 'fa-edit'];
            }
            if (in_array('clusters_delete', $permissions) || $isSuperAdmin) {
                $submenus[] = ['label' => 'Delete Clusters', 'route' => '/admin/enterprises/clusters', 'icon' => 'fa-trash'];
            }
            if (in_array('clusters_assign', $permissions) || $isSuperAdmin) {
                $submenus[] = ['label' => 'Assign Enterprises', 'route' => '/admin/enterprises/clusters/assign', 'icon' => 'fa-users'];
            }
            if (in_array('clusters_analytics_view', $permissions) || $isSuperAdmin) {
                $submenus[] = ['label' => 'Cluster Analytics', 'route' => '/admin/enterprises/clusters/analytics', 'icon' => 'fa-chart-pie'];
            }
            
            if (!empty($submenus)) {
                $menu[] = [
                    'icon' => 'fa-building', 
                    'label' => 'Enterprises', 
                    'route' => '#', 
                    'active' => ['admin/enterprises'],
                    'submenus' => $submenus
                ];
            }
        }
        
        // ============================================================
        // SERVICES
        // ============================================================
        if (in_array('services_view', $permissions) || in_array('services_manage', $permissions) || $isSuperAdmin) {
            $submenus = [];
            if (in_array('services_view', $permissions) || $isSuperAdmin) {
                $submenus[] = ['label' => 'All Services', 'route' => '/admin/services', 'icon' => 'fa-list'];
            }
            if (in_array('services_add', $permissions) || $isSuperAdmin) {
                $submenus[] = ['label' => 'Add Service', 'route' => '/admin/services/create', 'icon' => 'fa-plus'];
            }
            if (in_array('services_edit', $permissions) || $isSuperAdmin) {
                $submenus[] = ['label' => 'Edit Services', 'route' => '/admin/services', 'icon' => 'fa-edit'];
            }
            if (in_array('services_delete', $permissions) || $isSuperAdmin) {
                $submenus[] = ['label' => 'Delete Services', 'route' => '/admin/services', 'icon' => 'fa-trash'];
            }
            if (in_array('service_categories_view', $permissions) || in_array('service_categories_manage', $permissions) || $isSuperAdmin) {
                $submenus[] = ['label' => 'Categories', 'route' => '/admin/services/categories', 'icon' => 'fa-tags'];
            }
            if (in_array('service_providers_view', $permissions) || in_array('service_providers_manage', $permissions) || $isSuperAdmin) {
                $submenus[] = ['label' => 'Providers', 'route' => '/admin/services/providers', 'icon' => 'fa-user-md'];
            }
            if (in_array('service_requests_view', $permissions) || in_array('service_requests_manage', $permissions) || $isSuperAdmin) {
                $submenus[] = ['label' => 'Requests', 'route' => '/admin/services/requests', 'icon' => 'fa-tasks'];
            }
            if (in_array('service_bookings_view', $permissions) || in_array('service_bookings_manage', $permissions) || $isSuperAdmin) {
                $submenus[] = ['label' => 'Bookings', 'route' => '/admin/services/bookings', 'icon' => 'fa-calendar-check'];
            }
            if (in_array('service_reviews_view', $permissions) || in_array('service_reviews_manage', $permissions) || $isSuperAdmin) {
                $submenus[] = ['label' => 'Reviews', 'route' => '/admin/services/reviews', 'icon' => 'fa-star'];
            }
            if (!empty($submenus)) {
                $menu[] = [
                    'icon' => 'fa-concierge-bell', 
                    'label' => 'Services', 
                    'route' => '#', 
                    'active' => ['admin/services'],
                    'submenus' => $submenus
                ];
            }
        }
        
        // ============================================================
        // INVESTORS
        // ============================================================
        if (in_array('investors_view', $permissions) || in_array('investors_manage', $permissions) || $isSuperAdmin) {
            $submenus = [];
            if (in_array('investors_view', $permissions) || $isSuperAdmin) {
                $submenus[] = ['label' => 'All Investors', 'route' => '/admin/investors', 'icon' => 'fa-list'];
            }
            if (in_array('investors_add', $permissions) || $isSuperAdmin) {
                $submenus[] = ['label' => 'Add Investor', 'route' => '/admin/investors/create', 'icon' => 'fa-plus'];
            }
            if (in_array('investors_verify', $permissions) || $isSuperAdmin) {
                $submenus[] = ['label' => 'Verify Investors', 'route' => '/admin/investors/verify', 'icon' => 'fa-check-circle'];
            }
            if (in_array('investors_edit', $permissions) || $isSuperAdmin) {
                $submenus[] = ['label' => 'Edit Investors', 'route' => '/admin/investors', 'icon' => 'fa-edit'];
            }
            if (in_array('investors_delete', $permissions) || $isSuperAdmin) {
                $submenus[] = ['label' => 'Delete Investors', 'route' => '/admin/investors', 'icon' => 'fa-trash'];
            }
            if (!empty($submenus)) {
                $menu[] = [
                    'icon' => 'fa-user-tie', 
                    'label' => 'Investors', 
                    'route' => '#', 
                    'active' => ['admin/investors'],
                    'submenus' => $submenus
                ];
            }
        }
        
        // ============================================================
        // REPORTS
        // ============================================================
        if (in_array('reports_view', $permissions) || in_array('reports_manage', $permissions) || $isSuperAdmin) {
            $submenus = [];
            if (in_array('reports_view', $permissions) || $isSuperAdmin) {
                $submenus[] = ['label' => 'View Reports', 'route' => '/admin/reports', 'icon' => 'fa-chart-bar'];
            }
            if (in_array('reports_add', $permissions) || $isSuperAdmin) {
                $submenus[] = ['label' => 'Add Report', 'route' => '/admin/reports/create', 'icon' => 'fa-plus'];
            }
            if (in_array('reports_edit', $permissions) || $isSuperAdmin) {
                $submenus[] = ['label' => 'Edit Reports', 'route' => '/admin/reports', 'icon' => 'fa-edit'];
            }
            if (in_array('reports_delete', $permissions) || $isSuperAdmin) {
                $submenus[] = ['label' => 'Delete Reports', 'route' => '/admin/reports', 'icon' => 'fa-trash'];
            }
            if (!empty($submenus)) {
                $menu[] = [
                    'icon' => 'fa-chart-bar', 
                    'label' => 'Reports', 
                    'route' => '#', 
                    'active' => ['admin/reports'],
                    'submenus' => $submenus
                ];
            }
        }
        
        // ============================================================
        // MATCHMAKING
        // ============================================================
        if (in_array('matchmaking_view', $permissions) || in_array('matchmaking_manage', $permissions) || $isSuperAdmin) {
            $submenus = [];
            if (in_array('matchmaking_view', $permissions) || $isSuperAdmin) {
                $submenus[] = ['label' => 'Find Matches', 'route' => '/admin/matchmaking', 'icon' => 'fa-search'];
            }
            if (in_array('matchmaking_add', $permissions) || $isSuperAdmin) {
                $submenus[] = ['label' => 'Create Match', 'route' => '/admin/matchmaking/create', 'icon' => 'fa-plus'];
            }
            if (in_array('matchmaking_edit', $permissions) || $isSuperAdmin) {
                $submenus[] = ['label' => 'Edit Match', 'route' => '/admin/matchmaking', 'icon' => 'fa-edit'];
            }
            if (in_array('matchmaking_delete', $permissions) || $isSuperAdmin) {
                $submenus[] = ['label' => 'Delete Match', 'route' => '/admin/matchmaking', 'icon' => 'fa-trash'];
            }
            if (!empty($submenus)) {
                $menu[] = [
                    'icon' => 'fa-handshake', 
                    'label' => 'Match Making', 
                    'route' => '#', 
                    'active' => ['admin/matchmaking'],
                    'submenus' => $submenus
                ];
            }
        }
        
        // ============================================================
        // SECTORS
        // ============================================================
        if (in_array('sectors_view', $permissions) || in_array('sectors_manage', $permissions) || $isSuperAdmin) {
            $submenus = [];
            if (in_array('sectors_view', $permissions) || $isSuperAdmin) {
                $submenus[] = ['label' => 'All Sectors', 'route' => '/admin/sectors', 'icon' => 'fa-list'];
            }
            if (in_array('sectors_add', $permissions) || $isSuperAdmin) {
                $submenus[] = ['label' => 'Add Sector', 'route' => '/admin/sectors/create', 'icon' => 'fa-plus'];
            }
            if (in_array('sectors_edit', $permissions) || $isSuperAdmin) {
                $submenus[] = ['label' => 'Edit Sectors', 'route' => '/admin/sectors', 'icon' => 'fa-edit'];
            }
            if (in_array('sectors_delete', $permissions) || $isSuperAdmin) {
                $submenus[] = ['label' => 'Delete Sectors', 'route' => '/admin/sectors', 'icon' => 'fa-trash'];
            }
            if (!empty($submenus)) {
                $menu[] = [
                    'icon' => 'fa-industry', 
                    'label' => 'Sectors', 
                    'route' => '#', 
                    'active' => ['admin/sectors'],
                    'submenus' => $submenus
                ];
            }
        }
        
        // ============================================================
        // DEALS
        // ============================================================
        if (in_array('deals_view', $permissions) || in_array('deals_manage', $permissions) || $isSuperAdmin) {
            $submenus = [];
            if (in_array('deals_view', $permissions) || $isSuperAdmin) {
                $submenus[] = ['label' => 'All Deals', 'route' => '/admin/deals', 'icon' => 'fa-list'];
            }
            if (in_array('deals_add', $permissions) || $isSuperAdmin) {
                $submenus[] = ['label' => 'Create Deal', 'route' => '/admin/deals/create', 'icon' => 'fa-plus'];
            }
            if (in_array('deals_edit', $permissions) || $isSuperAdmin) {
                $submenus[] = ['label' => 'Edit Deal', 'route' => '/admin/deals', 'icon' => 'fa-edit'];
            }
            if (in_array('deals_delete', $permissions) || $isSuperAdmin) {
                $submenus[] = ['label' => 'Delete Deal', 'route' => '/admin/deals', 'icon' => 'fa-trash'];
            }
            if (!empty($submenus)) {
                $menu[] = [
                    'icon' => 'fa-file-signature', 
                    'label' => 'Deals', 
                    'route' => '#', 
                    'active' => ['admin/deals'],
                    'submenus' => $submenus
                ];
            }
        }
        
        // ============================================================
        // ANALYTICS
        // ============================================================
        if (in_array('analytics_view', $permissions) || in_array('analytics_manage', $permissions) || $isSuperAdmin) {
            $submenus = [];
            if (in_array('analytics_view', $permissions) || $isSuperAdmin) {
                $submenus[] = ['label' => 'Overview', 'route' => '/admin/analytics', 'icon' => 'fa-home'];
            }
            if (in_array('analytics_export', $permissions) || $isSuperAdmin) {
                $submenus[] = ['label' => 'Export Analytics', 'route' => '/admin/analytics/export', 'icon' => 'fa-file-export'];
            }
            if (!empty($submenus)) {
                $menu[] = [
                    'icon' => 'fa-chart-line', 
                    'label' => 'Analytics', 
                    'route' => '#', 
                    'active' => ['admin/analytics'],
                    'submenus' => $submenus
                ];
            }
        }
        
        // ============================================================
        // SETTINGS
        // ============================================================
        if (in_array('settings_view', $permissions) || in_array('settings_manage', $permissions) || $isSuperAdmin) {
            $submenus = [];
            if (in_array('settings_view', $permissions) || $isSuperAdmin) {
                $submenus[] = ['label' => 'System Settings', 'route' => '/admin/settings', 'icon' => 'fa-sliders-h'];
            }
            if (in_array('settings_edit', $permissions) || $isSuperAdmin) {
                $submenus[] = ['label' => 'Edit Settings', 'route' => '/admin/settings', 'icon' => 'fa-edit'];
            }
            if (!empty($submenus)) {
                $menu[] = [
                    'icon' => 'fa-cog', 
                    'label' => 'Settings', 
                    'route' => '#', 
                    'active' => ['admin/settings'],
                    'submenus' => $submenus
                ];
            }
        }
        
        // ============================================================
        // SUPPORT
        // ============================================================
        if (in_array('support_view', $permissions) || in_array('support_manage', $permissions) || $isSuperAdmin) {
            $submenus = [];
            if (in_array('support_view', $permissions) || $isSuperAdmin) {
                $submenus[] = ['label' => 'Tickets', 'route' => '/admin/support', 'icon' => 'fa-ticket-alt'];
            }
            if (in_array('support_add', $permissions) || $isSuperAdmin) {
                $submenus[] = ['label' => 'Create Ticket', 'route' => '/admin/support/create', 'icon' => 'fa-plus'];
            }
            if (in_array('support_edit', $permissions) || $isSuperAdmin) {
                $submenus[] = ['label' => 'Edit Tickets', 'route' => '/admin/support', 'icon' => 'fa-edit'];
            }
            if (in_array('support_delete', $permissions) || $isSuperAdmin) {
                $submenus[] = ['label' => 'Delete Tickets', 'route' => '/admin/support', 'icon' => 'fa-trash'];
            }
            if (in_array('chat_view', $permissions) || in_array('chat_manage', $permissions) || $isSuperAdmin) {
                $submenus[] = ['label' => 'Live Chat', 'route' => '/admin/support/chat', 'icon' => 'fa-comment-dots'];
            }
            if (in_array('faq_view', $permissions) || in_array('faq_manage', $permissions) || $isSuperAdmin) {
                $submenus[] = ['label' => 'FAQ', 'route' => '/admin/support/faq', 'icon' => 'fa-question-circle'];
            }
            if (in_array('knowledge_base_view', $permissions) || in_array('knowledge_base_manage', $permissions) || $isSuperAdmin) {
                $submenus[] = ['label' => 'Knowledge Base', 'route' => '/admin/support/knowledge-base', 'icon' => 'fa-book'];
            }
            if (!empty($submenus)) {
                $menu[] = [
                    'icon' => 'fa-headset', 
                    'label' => 'Support', 
                    'route' => '#', 
                    'active' => ['admin/support'],
                    'submenus' => $submenus
                ];
            }
        }
        
        // ============================================================
        // FALLBACK - If no menu items, show at least Dashboard
        // ============================================================
        if (empty($menu)) {
            $menu[] = ['icon' => 'fa-tachometer-alt', 'label' => 'Dashboard', 'route' => '/dashboard', 'active' => ['dashboard']];
        }
        
        return $menu;
    }
}

if (!function_exists('is_menu_active')) {
    function is_menu_active($route, $currentUri)
    {
        if (is_array($route)) {
            foreach ($route as $r) {
                if (strpos($currentUri, $r) !== false) {
                    return true;
                }
            }
            return false;
        }
        
        if (!is_string($route)) {
            return false;
        }
        
        return strpos($currentUri, $route) !== false;
    }
}