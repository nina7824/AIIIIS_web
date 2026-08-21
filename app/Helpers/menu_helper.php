<?php
// app/Helpers/menu_helper.php

if (!function_exists('get_dynamic_menu')) {
    /**
     * Get dynamic menu from database based on user role
     * 
     * @param array|string $user User data or role string
     * @return array
     */
    function get_dynamic_menu($user)
    {
        $db = \Config\Database::connect();
        
        // Get user role
        $role = null;
        $roleId = null;
        
        if (is_array($user)) {
            $role = $user['role'] ?? null;
            $userId = $user['user_id'] ?? null;
            
            // Get role ID from roles table
            if ($role) {
                $roleData = $db->table('roles')
                    ->where('slug', $role)
                    ->get()
                    ->getRow();
                
                if ($roleData) {
                    $roleId = $roleData->role_id;
                }
            }
        } else {
            $role = $user;
            $roleData = $db->table('roles')
                ->where('slug', $role)
                ->get()
                ->getRow();
            
            if ($roleData) {
                $roleId = $roleData->role_id;
            }
        }
        
        if (!$roleId) {
            return [];
        }
        
        // Get all menus with permissions for this role
        $builder = $db->table('menus m');
        $builder->select('m.*, mrp.can_view, mrp.can_add, mrp.can_edit, mrp.can_delete, mo.slug as module_slug, mo.name as module_name');
        $builder->join('menu_role_permissions mrp', 'm.menu_id = mrp.menu_id', 'left');
        $builder->join('modules mo', 'm.module_id = mo.module_id', 'left');
        $builder->where('mrp.role_id', $roleId);
        $builder->where('mrp.can_view', 1);
        $builder->where('m.is_active', 1);
        $builder->orderBy('m.sort_order', 'ASC');
        
        $menus = $builder->get()->getResultArray();
        
        // Build menu tree
        $menuTree = [];
        $menuMap = [];
        
        // First pass: create menu items
        foreach ($menus as $menu) {
            $menuId = $menu['menu_id'];
            
            $menuItem = [
                'menu_id' => $menuId,
                'label' => $menu['label'],
                'icon' => $menu['icon'],
                'route' => $menu['route'],
                'module' => $menu['module_slug'],
                'module_name' => $menu['module_name'],
                'parent_id' => $menu['parent_id'],
                'sort_order' => $menu['sort_order'],
                'is_submenu' => $menu['is_submenu'],
                'can_view' => $menu['can_view'],
                'can_add' => $menu['can_add'],
                'can_edit' => $menu['can_edit'],
                'can_delete' => $menu['can_delete'],
                'submenus' => []
            ];
            
            $menuMap[$menuId] = $menuItem;
        }
        
        // Second pass: build hierarchical structure
        foreach ($menuMap as $menuId => $menuItem) {
            if ($menuItem['parent_id'] === null) {
                // This is a parent menu
                $menuTree[] = &$menuMap[$menuId];
            } else {
                // This is a child menu
                if (isset($menuMap[$menuItem['parent_id']])) {
                    $menuMap[$menuItem['parent_id']]['submenus'][] = &$menuMap[$menuId];
                }
            }
        }
        
        // Clean up empty parent menus (no submenus)
        $menuTree = array_filter($menuTree, function($menu) {
            if ($menu['route'] === '#') {
                return !empty($menu['submenus']);
            }
            return true;
        });
        
        return array_values($menuTree);
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

if (!function_exists('has_menu_permission')) {
    /**
     * Check if user has permission for a specific menu
     * 
     * @param int $roleId
     * @param int $menuId
     * @param string $action (view, add, edit, delete)
     * @return bool
     */
    function has_menu_permission($roleId, $menuId, $action = 'view')
    {
        $db = \Config\Database::connect();
        
        $builder = $db->table('menu_role_permissions');
        $builder->where('role_id', $roleId);
        $builder->where('menu_id', $menuId);
        $permission = $builder->get()->getRowArray();
        
        if (!$permission) {
            return false;
        }
        
        $actionField = 'can_' . $action;
        return isset($permission[$actionField]) && $permission[$actionField] == 1;
    }
}

if (!function_exists('get_user_menus')) {
    /**
     * Get menus for the current user with their permissions
     * 
     * @param array $user
     * @return array
     */
    function get_user_menus($user)
    {
        return get_dynamic_menu($user);
    }
}