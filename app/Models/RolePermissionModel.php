<?php

namespace App\Models;

use CodeIgniter\Model;

class RolePermissionModel extends Model
{
    protected $table = 'role_permissions';
    protected $primaryKey = 'role_permission_id';
    protected $allowedFields = ['role_id', 'permission_id'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = false;
    protected $returnType = 'array';

    public function getPermissionsForRole($roleId)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('role_permissions rp');
        $builder->select('p.*');
        $builder->join('permissions p', 'p.permission_id = rp.permission_id');
        $builder->where('rp.role_id', $roleId);
        $builder->where('p.is_active', 1);
        return $builder->get()->getResultArray();
    }

    public function getPermissionSlugsForRole($roleId)
    {
        $permissions = $this->getPermissionsForRole($roleId);
        return array_column($permissions, 'slug');
    }

    public function getPermissionsByRole($roleId)
    {
        return $this->where('role_id', $roleId)->findAll();
    }

    public function assignPermissions($roleId, $permissionIds)
    {
        $this->where('role_id', $roleId)->delete();
        
        if (empty($permissionIds)) {
            return true;
        }

        $data = [];
        foreach ($permissionIds as $permissionId) {
            $data[] = [
                'role_id' => $roleId,
                'permission_id' => $permissionId
            ];
        }

        return $this->insertBatch($data);
    }

    // Helper method for whereIn queries
    public function whereIn($field, $values)
    {
        if (empty($values)) {
            return $this;
        }
        return $this->whereIn($field, $values);
    }
}