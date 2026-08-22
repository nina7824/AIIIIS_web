<?php
if (!function_exists('get_admin_menu')) {
    /**
     * Get dynamic admin menu based on user permissions
     * 
     * @param mixed $user User ID or user data array
     * @return array Menu structure
     */
    function get_admin_menu($user = null)
    {
        $db = \Config\Database::connect();
        $session = session();
        
        // Get user ID
        if ($user === null) {
            $userId = $session->get('user_id');
        } elseif (is_array($user)) {
            $userId = $user['user_id'] ?? $user['id'] ?? null;
        } else {
            $userId = $user;
        }
        
        if (!$userId) {
            return [get_default_menu()];
        }
        
        // Get user's role from database
        $userData = $db->table('users')->select('role')->where('user_id', $userId)->get()->getRow();
        $role = $userData->role ?? 'enterprise';
        
        // Get permissions from session
        $userPermissions = $session->get('permissions') ?? [];
        
        // If session has no permissions, load them
        if (empty($userPermissions)) {
            $pm = new \App\Libraries\PermissionManager();
            $userPermissions = $pm->getUserPermissions($userId);
            $session->set('permissions', $userPermissions);
        }
        
        // Check if Super Admin (from session or database)
        $isSuperAdmin = in_array($role, ['super_admin', 'administrator']);
        
        // If Super Admin, get ALL permissions
        if ($isSuperAdmin) {
            $allPermissions = $db->table('permissions')
                ->select('slug')
                ->where('is_active', 1)
                ->get()
                ->getResultArray();
            $userPermissions = array_column($allPermissions, 'slug');
            $session->set('permissions', $userPermissions);
        }
        
        // Get ALL active modules
        $allModules = $db->table('modules')
            ->where('is_active', 1)
            ->orderBy('sort_order', 'ASC')
            ->get()
            ->getResultArray();
        
        // Separate categories and sub-modules
        $categories = [];
        $subModules = [];
        
        foreach ($allModules as $module) {
            if ($module['is_category'] == 1) {
                $categories[$module['module_id']] = $module;
            } else {
                $parentId = $module['parent_id'] ?? 0;
                if (!isset($subModules[$parentId])) {
                    $subModules[$parentId] = [];
                }
                $subModules[$parentId][] = $module;
            }
        }
        
        // Build menu
        $menu = [];
        
        // Dashboard always first (always visible)
        $menu[] = [
            'icon' => 'fa-tachometer-alt',
            'label' => 'Dashboard',
            'route' => '/dashboard',
            'active' => ['dashboard']
        ];
        
        // Build categories with submenus - ONLY if user has permissions
        $hasAnyPermission = false;
        
        foreach ($categories as $categoryId => $category) {
            if (!isset($subModules[$categoryId]) || empty($subModules[$categoryId])) {
                continue;
            }
            
            $hasCategoryPermission = false;
            $submenus = [];
            
            foreach ($subModules[$categoryId] as $subModule) {
                $slug = $subModule['slug'];
                
                // Check if user has view permission for this module
                $canView = $isSuperAdmin || 
                           in_array($slug . '_view', $userPermissions) || 
                           in_array($slug . '_manage', $userPermissions);
                
                if ($canView) {
                    $hasCategoryPermission = true;
                    $hasAnyPermission = true;
                    $submenus[] = [
                        'label' => $subModule['name'],
                        'route' => '/admin/' . $slug,
                        'icon' => $subModule['icon'] ?? 'fa-circle'
                    ];
                }
            }
            
            if ($hasCategoryPermission && !empty($submenus)) {
                $menu[] = [
                    'icon' => $category['icon'] ?? 'fa-folder',
                    'label' => $category['name'],
                    'route' => '#',
                    'active' => ['admin/' . $category['slug']],
                    'submenus' => $submenus
                ];
            }
        }
        
        // If user has NO permissions at all (except dashboard), return only dashboard
        // This prevents the fallback User Management from showing
        if (!$hasAnyPermission) {
            return [get_default_menu()];
        }
        
        return $menu;
    }
}


if (!function_exists('get_default_menu')) {
    /**
     * Default menu when no permissions are found
     */
    function get_default_menu()
    {
        return [
            'icon' => 'fa-tachometer-alt',
            'label' => 'Dashboard',
            'route' => '/dashboard',
            'active' => ['dashboard']
        ];
    }
}

if (!function_exists('get_user_permissions')) {
    /**
     * Get all permissions for a user
     */
    function get_user_permissions($userId)
    {
        $db = \Config\Database::connect();
        
        if (is_array($userId)) {
            $userId = $userId['user_id'] ?? $userId['id'] ?? null;
        }
        
        if (!$userId) {
            return [];
        }
        
        // Get user's role
        $user = $db->table('users')->select('role')->where('user_id', $userId)->get()->getRow();
        
        if (!$user) {
            return [];
        }
        
        // Super admin has all permissions
        if (in_array($user->role, ['super_admin', 'administrator'])) {
            $permissions = $db->table('permissions')
                ->where('is_active', 1)
                ->get()
                ->getResultArray();
            return array_column($permissions, 'slug');
        }
        
        // Get permissions via user_roles
        $permissions = $db->table('user_roles ur')
            ->select('p.slug')
            ->distinct()
            ->join('role_permissions rp', 'rp.role_id = ur.role_id')
            ->join('permissions p', 'p.permission_id = rp.permission_id')
            ->where('ur.user_id', $userId)
            ->where('p.is_active', 1)
            ->get()
            ->getResultArray();
        
        $permissionSlugs = array_column($permissions, 'slug');
        
        // Log for debugging
        log_message('debug', 'User ' . $userId . ' has ' . count($permissionSlugs) . ' permissions');
        
        return $permissionSlugs;
    }
}


if (!function_exists('has_permission')) {
    /**
     * Check if a user has a specific permission
     */
    function has_permission($userId, $slug)
    {
        $permissions = get_user_permissions($userId);
        return in_array($slug, $permissions);
    }
}

if (!function_exists('user_can')) {
    /**
     * Quick check for current user's permission
     */
    function user_can($slug)
    {
        $session = session();
        $userId = $session->get('user_id');
        $role = $session->get('role');
        
        // Super admin has all permissions
        if (in_array($role, ['super_admin', 'administrator'])) {
            return true;
        }
        
        $permissions = $session->get('permissions') ?? [];
        return in_array($slug, $permissions);
    }
}

if (!function_exists('can_view')) {
    /**
     * Check if user can view a module
     */
    function can_view($moduleSlug)
    {
        return user_can($moduleSlug . '_view') || user_can($moduleSlug . '_manage');
    }
}

if (!function_exists('can_add')) {
    /**
     * Check if user can add to a module
     */
    function can_add($moduleSlug)
    {
        return user_can($moduleSlug . '_add') || user_can($moduleSlug . '_manage');
    }
}

if (!function_exists('can_edit')) {
    /**
     * Check if user can edit a module
     */
    function can_edit($moduleSlug)
    {
        return user_can($moduleSlug . '_edit') || user_can($moduleSlug . '_manage');
    }
}

if (!function_exists('can_delete')) {
    /**
     * Check if user can delete from a module
     */
    function can_delete($moduleSlug)
    {
        return user_can($moduleSlug . '_delete') || user_can($moduleSlug . '_manage');
    }
}

if (!function_exists('can_manage')) {
    /**
     * Check if user can manage a module
     */
    function can_manage($moduleSlug)
    {
        return user_can($moduleSlug . '_manage');
    }
}

if (!function_exists('is_menu_active')) {
    /**
     * Check if a menu item is active based on current URI
     */
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

if (!function_exists('render_sidebar_menu')) {
    /**
     * Render sidebar menu HTML
     */
    function render_sidebar_menu()
    {
        $menu = get_admin_menu();
        $currentUri = service('uri')->getPath();
        
        $html = '<ul class="sidebar-menu">';
        
        foreach ($menu as $item) {
            if (isset($item['submenus']) && !empty($item['submenus'])) {
                // Category with submenus
                $html .= '<li class="sidebar-item">';
                $html .= '<a href="#" class="sidebar-link has-dropdown">';
                $html .= '<i class="' . $item['icon'] . '"></i>';
                $html .= '<span>' . $item['label'] . '</span>';
                $html .= '<i class="fa fa-chevron-down pull-right"></i>';
                $html .= '</a>';
                $html .= '<ul class="sidebar-dropdown">';
                
                foreach ($item['submenus'] as $sub) {
                    $active = is_menu_active($sub['route'], $currentUri) ? 'active' : '';
                    $html .= '<li>';
                    $html .= '<a href="' . site_url($sub['route']) . '" class="' . $active . '">';
                    $html .= '<i class="' . $sub['icon'] . '"></i>';
                    $html .= $sub['label'];
                    $html .= '</a>';
                    $html .= '</li>';
                }
                
                $html .= '</ul>';
                $html .= '</li>';
            } else {
                // Single menu item
                $active = is_menu_active($item['route'], $currentUri) ? 'active' : '';
                $html .= '<li class="sidebar-item">';
                $html .= '<a href="' . site_url($item['route']) . '" class="sidebar-link ' . $active . '">';
                $html .= '<i class="' . $item['icon'] . '"></i>';
                $html .= '<span>' . $item['label'] . '</span>';
                $html .= '</a>';
                $html .= '</li>';
            }
        }
        
        $html .= '</ul>';
        
        return $html;
    }
}