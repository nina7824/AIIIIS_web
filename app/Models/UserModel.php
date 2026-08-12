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
        'is_verified',
        'verification_token',
        'default_password',
        'must_change_password',
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

    // Hash password before insert
    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPasswordOnUpdate'];

    protected function hashPassword(array $data)
    {
        if (isset($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        }
        return $data;
    }

    protected function hashPasswordOnUpdate(array $data)
    {
        if (isset($data['data']['password']) && !empty($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        }
        return $data;
    }

    /**
     * Verify user email with token
     */
    public function verifyUser($token)
    {
        return $this->where('verification_token', $token)
                    ->set(['is_verified' => 1, 'verification_token' => null])
                    ->update();
    }

    /**
     * Change user password and clear must_change_password flag
     */
    public function changePassword($userId, $newPassword)
    {
        return $this->update($userId, [
            'password' => $newPassword,
            'must_change_password' => 0,
            'default_password' => null
        ]);
    }

    /**
     * Get user by verification token
     */
    public function getUserByToken($token)
    {
        return $this->where('verification_token', $token)->first();
    }

    /**
     * Get user by email
     */
    public function getUserByEmail($email)
    {
        return $this->where('email', $email)->first();
    }

    /**
     * Check if user is verified
     */
    public function isVerified($userId)
    {
        $user = $this->find($userId);
        return $user && $user['is_verified'] == 1;
    }

    /**
     * Check if user must change password
     */
    public function mustChangePassword($userId)
    {
        $user = $this->find($userId);
        return $user && $user['must_change_password'] == 1;
    }

    /**
     * Get users by role
     */
    public function getUsersByRole($role)
    {
        return $this->where('role', $role)->findAll();
    }

    /**
     * Get active users count
     */
    public function getActiveUsersCount()
    {
        return $this->where('is_active', 1)->countAllResults();
    }

    /**
     * Get verified users count
     */
    public function getVerifiedUsersCount()
    {
        return $this->where('is_verified', 1)->countAllResults();
    }

    /**
     * Get users by role with count
     */
    public function getUsersByRoleWithCount()
    {
        return $this->select('role, COUNT(*) as count')
                    ->groupBy('role')
                    ->findAll();
    }

    /**
     * Get user with details based on role
     */
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

    /**
     * Get recent users with limit
     */
    public function getRecentUsers($limit = 10)
    {
        return $this->orderBy('created_at', 'DESC')
                    ->limit($limit)
                    ->findAll();
    }

    /**
     * Search users by name or email
     */
    public function searchUsers($keyword)
    {
        return $this->like('name', $keyword)
                    ->orLike('email', $keyword)
                    ->findAll();
    }

    /**
     * Activate or deactivate user
     */
    public function toggleUserStatus($userId, $status)
    {
        return $this->update($userId, ['is_active' => $status]);
    }

    /**
     * Update last login timestamp
     */
    public function updateLastLogin($userId)
    {
        return $this->update($userId, ['last_login' => date('Y-m-d H:i:s')]);
    }
}