<?php

namespace App\Models;

use CodeIgniter\Model;

class PermissionModel extends Model
{
    protected $table = 'permissions';
    protected $primaryKey = 'permission_id';
    protected $allowedFields = ['name', 'slug', 'module', 'description', 'is_active'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $returnType = 'array';

    public function getPermissionsWithModule()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('permissions p');
        $builder->select('p.*, m.name as module_name, m.icon as module_icon');
        $builder->join('modules m', 'm.slug = p.module', 'left');
        $builder->orderBy('p.module', 'ASC');
        $builder->orderBy('p.name', 'ASC');
        return $builder->get()->getResultArray();
    }

    public function getPermissionsByModule($module)
    {
        return $this->where('module', $module)->where('is_active', 1)->findAll();
    }

    public function getPermissionsByRole($roleId)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('permissions p');
        $builder->select('p.*');
        $builder->join('role_permissions rp', 'rp.permission_id = p.permission_id', 'inner');
        $builder->where('rp.role_id', $roleId);
        $builder->where('p.is_active', 1);
        return $builder->get()->getResultArray();
    }
}