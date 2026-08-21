<?php

namespace App\Models;

use CodeIgniter\Model;

class UserRoleModel extends Model
{
    protected $table = 'user_roles';
    protected $primaryKey = 'user_role_id';
    protected $allowedFields = ['user_id', 'role_id'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = false;
    protected $returnType = 'array';

    public function getRolesForUser($userId)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('user_roles ur');
        $builder->select('r.*');
        $builder->join('roles r', 'r.role_id = ur.role_id');
        $builder->where('ur.user_id', $userId);
        
        // NO is_active check - just get all roles
        return $builder->get()->getResultArray();
    }

    public function assignRole($userId, $roleId)
    {
        // Remove existing role
        $this->where('user_id', $userId)->delete();
        
        if ($roleId) {
            return $this->insert([
                'user_id' => $userId,
                'role_id' => $roleId
            ]);
        }
        
        return true;
    }

    public function getUserRole($userId)
    {
        $row = $this->where('user_id', $userId)->first();
        return $row ? $row['role_id'] : null;
    }
}