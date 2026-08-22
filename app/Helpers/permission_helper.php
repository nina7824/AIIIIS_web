<?php

if (!function_exists('has_permission')) {
    function has_permission($userId, $module, $action)
    {
        $db = \Config\Database::connect();
        
        if (is_array($userId)) {
            $userId = $userId['user_id'] ?? $userId['id'] ?? null;
        }
        
        if (!$userId) {
            return false;
        }
        
        // Get user's role
        $builder = $db->table('users');
        $user = $builder->select('user_id, role')->where('user_id', $userId)->get()->getRow();
        
        if (!$user) {
            return false;
        }
        
        // Super administrators have all permissions
        if ($user->role === 'super_admin' || $user->role === 'administrator') {
            return true;
        }
        
        // Build permission slug
        $permissionSlug = $module . '_' . $action;
        
        // Check permission via user_roles
        $builder = $db->table('user_roles ur');
        $builder->select('p.permission_id');
        $builder->join('role_permissions rp', 'rp.role_id = ur.role_id');
        $builder->join('permissions p', 'p.permission_id = rp.permission_id');
        $builder->where('ur.user_id', $userId);
        $builder->where('p.slug', $permissionSlug);
        
        $result = $builder->get()->getRow();
        
        return (bool) $result;
    }
}

if (!function_exists('get_user_permissions')) {
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
        $builder = $db->table('users');
        $user = $builder->select('user_id, role')->where('user_id', $userId)->get()->getRow();
        
        if (!$user) {
            return [];
        }
        
        // Administrator has all permissions
        if ($user->role === 'super_admin' || $user->role === 'administrator') {
            $builder = $db->table('permissions');
            $permissions = $builder->get()->getResultArray();
            return array_column($permissions, 'slug');
        }
        
        // Get permissions via user_roles
        $builder = $db->table('user_roles ur');
        $builder->select('p.slug');
        $builder->join('role_permissions rp', 'rp.role_id = ur.role_id');
        $builder->join('permissions p', 'p.permission_id = rp.permission_id');
        $builder->where('ur.user_id', $userId);
        
        $results = $builder->get()->getResultArray();
        
        return array_column($results, 'slug');
    }
}

if (!function_exists('get_modules_with_permissions')) {
    function get_modules_with_permissions($userId = null)
    {
        $db = \Config\Database::connect();
        
        if ($userId === null) {
            $session = session();
            $userId = $session->get('user_id');
        }
        
        if (!$userId) {
            return [];
        }
        
        // Get all active modules (not categories)
        $modules = $db->table('modules')
            ->where('is_active', 1)
            ->where('is_category', 0)  // Only modules, not categories
            ->orderBy('sort_order', 'ASC')
            ->get()
            ->getResultArray();
        
        $userPermissions = get_user_permissions($userId);
        $user = $db->table('users')->select('role')->where('user_id', $userId)->get()->getRow();
        $isSuperAdmin = $user && in_array($user->role, ['super_admin', 'administrator']);
        
        foreach ($modules as &$module) {
            $moduleSlug = $module['slug'];
            
            // Check each action permission
            $module['can_view'] = $isSuperAdmin || in_array($moduleSlug . '_view', $userPermissions);
            $module['can_add'] = $isSuperAdmin || in_array($moduleSlug . '_add', $userPermissions);
            $module['can_edit'] = $isSuperAdmin || in_array($moduleSlug . '_edit', $userPermissions);
            $module['can_delete'] = $isSuperAdmin || in_array($moduleSlug . '_delete', $userPermissions);
            $module['can_manage'] = $isSuperAdmin || in_array($moduleSlug . '_manage', $userPermissions);
        }
        
        return $modules;
    }
}