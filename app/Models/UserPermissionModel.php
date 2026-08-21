<?php

namespace App\Models;

use CodeIgniter\Model;

class UserPermissionModel extends Model
{
    protected $table = 'user_permissions';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'permission_id', 'is_allowed'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = false;

    /**
     * Get all permissions for a user
     */
    public function getPermissionsForUser($userId)
    {
        return $this->where('user_id', $userId)
            ->join('permissions', 'permissions.permission_id = user_permissions.permission_id')
            ->findAll();
    }

    /**
     * Get all permission slugs for a user
     */
    public function getPermissionSlugsForUser($userId)
    {
        $permissions = $this->where('user_id', $userId)
            ->join('permissions', 'permissions.permission_id = user_permissions.permission_id')
            ->findAll();
        
        return array_column($permissions, 'slug');
    }

    /**
     * Check if user has a specific permission
     */
    public function userHasPermission($userId, $permissionSlug)
    {
        $permission = $this->where('user_id', $userId)
            ->join('permissions', 'permissions.permission_id = user_permissions.permission_id')
            ->where('permissions.slug', $permissionSlug)
            ->where('user_permissions.is_allowed', 1)
            ->first();
        
        return $permission !== null;
    }

    /**
     * Grant permission to user
     */
    public function grantPermission($userId, $permissionId)
    {
        $existing = $this->where('user_id', $userId)
            ->where('permission_id', $permissionId)
            ->first();

        if ($existing) {
            return $this->update($existing['id'], ['is_allowed' => 1]);
        }

        return $this->insert([
            'user_id' => $userId,
            'permission_id' => $permissionId,
            'is_allowed' => 1
        ]);
    }

    /**
     * Revoke permission from user
     */
    public function revokePermission($userId, $permissionId)
    {
        $existing = $this->where('user_id', $userId)
            ->where('permission_id', $permissionId)
            ->first();

        if ($existing) {
            return $this->update($existing['id'], ['is_allowed' => 0]);
        }

        return $this->insert([
            'user_id' => $userId,
            'permission_id' => $permissionId,
            'is_allowed' => 0
        ]);
    }

    /**
     * Sync permissions for a user
     */
    public function syncPermissions($userId, array $permissionIds)
    {
        $this->where('user_id', $userId)->delete();

        if (!empty($permissionIds)) {
            $data = [];
            foreach ($permissionIds as $permissionId) {
                $data[] = [
                    'user_id' => $userId,
                    'permission_id' => $permissionId,
                    'is_allowed' => 1
                ];
            }
            return $this->insertBatch($data);
        }

        return true;
    }

    /**
     * Get granted permissions for a user
     */
    public function getGrantedPermissionsForUser($userId)
    {
        return $this->where('user_id', $userId)
            ->where('is_allowed', 1)
            ->join('permissions', 'permissions.permission_id = user_permissions.permission_id')
            ->findAll();
    }

    /**
     * Get denied permissions for a user
     */
    public function getDeniedPermissionsForUser($userId)
    {
        return $this->where('user_id', $userId)
            ->where('is_allowed', 0)
            ->join('permissions', 'permissions.permission_id = user_permissions.permission_id')
            ->findAll();
    }

    /**
     * Delete all permissions for a user
     */
    public function deleteAllForUser($userId)
    {
        return $this->where('user_id', $userId)->delete();
    }

    /**
     * Check if user has any of the given permissions
     */
    public function userHasAnyPermission($userId, array $permissionSlugs)
    {
        if (empty($permissionSlugs)) {
            return false;
        }

        $count = $this->where('user_id', $userId)
            ->join('permissions', 'permissions.permission_id = user_permissions.permission_id')
            ->whereIn('permissions.slug', $permissionSlugs)
            ->where('user_permissions.is_allowed', 1)
            ->countAllResults();

        return $count > 0;
    }

    /**
     * Check if user has all of the given permissions
     */
    public function userHasAllPermissions($userId, array $permissionSlugs)
    {
        if (empty($permissionSlugs)) {
            return true;
        }

        $count = $this->where('user_id', $userId)
            ->join('permissions', 'permissions.permission_id = user_permissions.permission_id')
            ->whereIn('permissions.slug', $permissionSlugs)
            ->where('user_permissions.is_allowed', 1)
            ->countAllResults();

        return $count === count($permissionSlugs);
    }

    /**
     * Bulk grant permissions to a user
     */
    public function bulkGrantPermissions($userId, array $permissionIds)
    {
        $data = [];
        foreach ($permissionIds as $permissionId) {
            $data[] = [
                'user_id' => $userId,
                'permission_id' => $permissionId,
                'is_allowed' => 1
            ];
        }
        
        if (!empty($data)) {
            return $this->insertBatch($data, true);
        }
        
        return true;
    }

    /**
     * Bulk revoke permissions from a user
     */
    public function bulkRevokePermissions($userId, array $permissionIds)
    {
        if (empty($permissionIds)) {
            return true;
        }

        return $this->where('user_id', $userId)
            ->whereIn('permission_id', $permissionIds)
            ->set(['is_allowed' => 0])
            ->update();
    }
}