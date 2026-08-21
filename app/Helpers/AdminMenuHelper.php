<?php

if (!function_exists('get_admin_menu')) {
    /**
     * Get admin menu based on user role and permissions
     * 
     * @param array|string $user User data or role string
     * @return array
     */
    function get_admin_menu($user)
    {
        // Load menu configuration
        $menus = \Config\Menus::getMenus();
        
        // Get user ID if user data is provided
        $userId = null;
        $role = null;
        
        if (is_array($user)) {
            $userId = $user['user_id'] ?? $user['id'] ?? null;
            $role = $user['role'] ?? null;
        } else {
            $role = $user;
            // Try to get user ID from session
            $session = \Config\Services::session();
            $userId = $session->get('user_id');
        }
        
        // Filter menus based on permissions
        return filter_menu_by_permissions($userId, $menus, $role);
    }
}

if (!function_exists('filter_menu_by_permissions')) {
    /**
     * Filter menus based on user permissions
     * 
     * @param int|null $userId
     * @param array $menus
     * @param string|null $role
     * @return array
     */
    function filter_menu_by_permissions($userId, $menus, $role = null)
    {
        if (!$userId) {
            // If no user ID, return basic public menus
            return array_filter($menus, function($menu) {
                return isset($menu['public']) && $menu['public'] === true;
            });
        }
        
        $filteredMenus = [];
        
        foreach ($menus as $menu) {
            $module = $menu['module'] ?? null;
            $hasAccess = true;
            
            // Check if menu requires specific permissions
            if ($module && isset($menu['permissions'])) {
                $hasAccess = false;
                foreach ($menu['permissions'] as $perm) {
                    if (has_permission($userId, $module, $perm)) {
                        $hasAccess = true;
                        break;
                    }
                }
            }
            
            // If menu has no module or permissions, check if it's public
            if (!$module && !isset($menu['permissions'])) {
                $hasAccess = isset($menu['public']) && $menu['public'] === true;
            }
            
            if ($hasAccess) {
                // Check submenus
                if (isset($menu['submenus']) && !empty($menu['submenus'])) {
                    $filteredSubmenus = [];
                    foreach ($menu['submenus'] as $submenu) {
                        $subModule = $submenu['module'] ?? $module ?? null;
                        $subHasAccess = true;
                        
                        if ($subModule && isset($submenu['permissions'])) {
                            $subHasAccess = false;
                            foreach ($submenu['permissions'] as $perm) {
                                if (has_permission($userId, $subModule, $perm)) {
                                    $subHasAccess = true;
                                    break;
                                }
                            }
                        }
                        
                        if ($subHasAccess) {
                            $filteredSubmenus[] = $submenu;
                        }
                    }
                    
                    if (!empty($filteredSubmenus)) {
                        $menu['submenus'] = $filteredSubmenus;
                        $filteredMenus[] = $menu;
                    }
                } else {
                    $filteredMenus[] = $menu;
                }
            }
        }
        
        return $filteredMenus;
    }
}

if (!function_exists('is_menu_active')) {
    /**
     * Check if a menu item is active
     * 
     * @param array|string $activePaths
     * @param string $currentUri
     * @return bool
     */
    function is_menu_active($activePaths, $currentUri)
    {
        if (is_string($activePaths)) {
            $activePaths = [$activePaths];
        }
        
        foreach ($activePaths as $path) {
            if (strpos($currentUri, $path) !== false) {
                return true;
            }
        }
        
        return false;
    }
}