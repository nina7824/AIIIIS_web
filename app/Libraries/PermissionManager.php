<?php

namespace App\Libraries;

use App\Models\UserRoleModel;
use App\Models\RolePermissionModel;
use App\Models\PermissionModel;

class PermissionManager
{
    protected $userRoleModel;
    protected $rolePermissionModel;
    protected $permissionModel;

    public function __construct()
    {
        $this->userRoleModel = new UserRoleModel();
        $this->rolePermissionModel = new RolePermissionModel();
        $this->permissionModel = new PermissionModel();
    }

    public function getUserPermissions($userId)
    {
        // Check if user is super admin first
        if ($this->isSuperAdmin($userId)) {
            return $this->getAllPermissions();
        }

        // Get roles for user
        $roles = $this->userRoleModel->getRolesForUser($userId);
        $roleIds = array_column($roles, 'role_id');

        if (empty($roleIds)) {
            return [];
        }

        // Get permissions from roles - NO is_active check
        $db = \Config\Database::connect();
        $builder = $db->table('role_permissions rp');
        $builder->select('p.slug');
        $builder->join('permissions p', 'p.permission_id = rp.permission_id');
        $builder->whereIn('rp.role_id', $roleIds);
        
        $permissions = $builder->get()->getResultArray();
        
        return array_column($permissions, 'slug');
    }

    public function getAllPermissions()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('permissions');
        $builder->select('slug');
        
        $permissions = $builder->get()->getResultArray();
        return array_column($permissions, 'slug');
    }

    public function hasPermission($userId, $permissionSlug)
    {
        // Super admin has all permissions
        if ($this->isSuperAdmin($userId)) {
            return true;
        }

        $permissions = $this->getUserPermissions($userId);
        return in_array($permissionSlug, $permissions);
    }

    public function isSuperAdmin($userId)
    {
        try {
            $db = \Config\Database::connect();
            
            // Get user roles - NO is_active check
            $userRoles = $db->table('user_roles')
                ->where('user_id', $userId)
                ->get()
                ->getResultArray();
            
            $roleIds = array_column($userRoles, 'role_id');
            
            if (empty($roleIds)) {
                return false;
            }
            
            // Check if any role is super_admin - NO is_active check
            $superAdminRoles = $db->table('roles')
                ->whereIn('role_id', $roleIds)
                ->where('slug', 'super_admin')
                ->get()
                ->getResultArray();
            
            return !empty($superAdminRoles);
            
        } catch (\Exception $e) {
            log_message('error', 'Error checking super admin: ' . $e->getMessage());
            return false;
        }
    }
}