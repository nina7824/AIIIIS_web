<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'user_id';
    protected $allowedFields = [
        'name', 
        'email', 
        'password', 
        'role', 
        'profile_image', 
        'phone',
        'is_active', 
        'last_login'
    ];
    protected $returnType = 'array';
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'name' => 'required|min_length[3]|max_length[100]',
        'email' => 'required|valid_email|is_unique[users.email]',
        'password' => 'required|min_length[8]',
        'role' => 'required|in_list[administrator,nirda_expert,enterprise,investor,government,analyst]'
    ];

    protected $validationMessages = [
        'email' => [
            'is_unique' => 'This email is already registered. Please use a different email or log in.'
        ],
        'password' => [
            'min_length' => 'Password must be at least 8 characters long.'
        ]
    ];

    public function getUserByRole($role)
    {
        return $this->where('role', $role)->findAll();
    }

    public function getUserWithDetails($userId)
    {
        $user = $this->find($userId);
        if (!$user) {
            return null;
        }

        // Load additional details based on role
        switch ($user['role']) {
            case 'enterprise':
                $enterpriseModel = model('App\Models\EnterpriseModel');
                $details = $enterpriseModel->where('user_id', $userId)->first();
                break;
            case 'investor':
                $investorModel = model('App\Models\InvestorModel');
                $details = $investorModel->where('user_id', $userId)->first();
                break;
            case 'nirda_expert':
                $expertModel = model('App\Models\ExpertModel');
                $details = $expertModel->where('user_id', $userId)->first();
                break;
            default:
                $details = null;
        }

        $user['details'] = $details;
        return $user;
    }
}