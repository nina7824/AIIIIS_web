<?php
// app/Helpers/PermissionHelper.php

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
        $user = $builder->select('role')->where('user_id', $userId)->get()->getRow();
        
        if (!$user) {
            return false;
        }
        
        // Super administrators have all permissions
        if ($user->role === 'administrator' || $user->role === 'super_admin') {
            return true;
        }
        
        // Build permission slug
        $permissionSlug = $module . '_' . $action;
        
        // Check permission in role_permissions table
        $builder = $db->table('role_permissions');
        $builder->select('permissions.slug');
        $builder->join('permissions', 'role_permissions.permission_id = permissions.permission_id');
        $builder->join('user_roles', 'user_roles.role_id = role_permissions.role_id');
        $builder->where('user_roles.user_id', $userId);
        $builder->where('permissions.slug', $permissionSlug);
        
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
        $user = $builder->select('role')->where('user_id', $userId)->get()->getRow();
        
        if (!$user) {
            return [];
        }
        
        // Administrator has all permissions
        if ($user->role === 'administrator' || $user->role === 'super_admin') {
            $builder = $db->table('permissions');
            $permissions = $builder->get()->getResultArray();
            return array_column($permissions, 'slug');
        }
        
        // Get role permissions via user_roles
        $builder = $db->table('role_permissions');
        $builder->select('permissions.slug');
        $builder->join('permissions', 'role_permissions.permission_id = permissions.permission_id');
        $builder->join('user_roles', 'user_roles.role_id = role_permissions.role_id');
        $builder->where('user_roles.user_id', $userId);
        $results = $builder->get()->getResultArray();
        
        return array_column($results, 'slug');
    }
}