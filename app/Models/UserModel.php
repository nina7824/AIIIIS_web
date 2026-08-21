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

    // ============================================================
    // ========== EXISTING METHODS ==========
    // ============================================================

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

    // ============================================================
    // ========== NEW PERMISSION METHODS ==========
    // ============================================================

    /**
     * Get user with their roles
     */
    public function getUserWithRoles($userId)
    {
        $user = $this->find($userId);
        if (!$user) {
            return null;
        }

        $userRoleModel = new UserRoleModel();
        $user['roles'] = $userRoleModel->getRolesForUser($userId);

        return $user;
    }

    /**
     * Get user with their permissions
     */
    public function getUserWithPermissions($userId)
    {
        $user = $this->find($userId);
        if (!$user) {
            return null;
        }

        $userPermissionModel = new UserPermissionModel();
        $user['permissions'] = $userPermissionModel->getGrantedPermissionsForUser($userId);

        return $user;
    }

    /**
     * Get user with roles and permissions
     */
    public function getUserWithRolesAndPermissions($userId)
    {
        $user = $this->find($userId);
        if (!$user) {
            return null;
        }

        $userRoleModel = new UserRoleModel();
        $userPermissionModel = new UserPermissionModel();

        $user['roles'] = $userRoleModel->getRolesForUser($userId);
        $user['permissions'] = $userPermissionModel->getGrantedPermissionsForUser($userId);

        return $user;
    }

    /**
     * Get all users with their roles
     */
    public function getAllUsersWithRoles()
    {
        $users = $this->findAll();
        $userRoleModel = new UserRoleModel();

        foreach ($users as &$user) {
            $user['roles'] = $userRoleModel->getRolesForUser($user['user_id']);
        }

        return $users;
    }

    /**
     * Get all users with their permissions
     */
    public function getAllUsersWithPermissions()
    {
        $users = $this->findAll();
        $userPermissionModel = new UserPermissionModel();

        foreach ($users as &$user) {
            $user['permissions'] = $userPermissionModel->getGrantedPermissionsForUser($user['user_id']);
        }

        return $users;
    }

    /**
     * Check if user has a specific role
     */
    public function userHasRole($userId, $roleSlug)
    {
        $userRoleModel = new UserRoleModel();
        $roles = $userRoleModel->getRolesForUser($userId);

        foreach ($roles as $role) {
            if ($role['slug'] === $roleSlug) {
                return true;
            }
        }

        return false;
    }

    /**
     * Check if user has any of the given roles
     */
    public function userHasAnyRole($userId, array $roleSlugs)
    {
        $userRoleModel = new UserRoleModel();
        $roles = $userRoleModel->getRolesForUser($userId);

        foreach ($roles as $role) {
            if (in_array($role['slug'], $roleSlugs)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Check if user has a specific permission
     */
    public function userHasPermission($userId, $permissionSlug)
    {
        $userPermissionModel = new UserPermissionModel();
        return $userPermissionModel->userHasPermission($userId, $permissionSlug);
    }

    /**
     * Check if user has any of the given permissions
     */
    public function userHasAnyPermission($userId, array $permissionSlugs)
    {
        $userPermissionModel = new UserPermissionModel();
        return $userPermissionModel->userHasAnyPermission($userId, $permissionSlugs);
    }

    /**
     * Check if user has all of the given permissions
     */
    public function userHasAllPermissions($userId, array $permissionSlugs)
    {
        $userPermissionModel = new UserPermissionModel();
        return $userPermissionModel->userHasAllPermissions($userId, $permissionSlugs);
    }

    /**
     * Get user's permission slugs
     */
    public function getUserPermissionSlugs($userId)
    {
        $userPermissionModel = new UserPermissionModel();
        return $userPermissionModel->getPermissionSlugsForUser($userId);
    }

    /**
     * Assign a role to a user
     */
    public function assignRole($userId, $roleId)
    {
        $userRoleModel = new UserRoleModel();
        return $userRoleModel->assignRole($userId, $roleId);
    }

    /**
     * Add a role to a user (keep existing roles)
     */
    public function addRoleToUser($userId, $roleId)
    {
        $userRoleModel = new UserRoleModel();
        return $userRoleModel->addRoleToUser($userId, $roleId);
    }

    /**
     * Grant a permission to a user
     */
    public function grantPermission($userId, $permissionId)
    {
        $userPermissionModel = new UserPermissionModel();
        return $userPermissionModel->grantPermission($userId, $permissionId);
    }

    /**
     * Revoke a permission from a user
     */
    public function revokePermission($userId, $permissionId)
    {
        $userPermissionModel = new UserPermissionModel();
        return $userPermissionModel->revokePermission($userId, $permissionId);
    }

    /**
     * Sync user's permissions
     */
    public function syncUserPermissions($userId, array $permissionIds)
    {
        $userPermissionModel = new UserPermissionModel();
        return $userPermissionModel->syncPermissions($userId, $permissionIds);
    }

    /**
     * Get users by role ID
     */
    public function getUsersByRoleId($roleId)
    {
        $userRoleModel = new UserRoleModel();
        $userRoles = $userRoleModel->where('role_id', $roleId)->findAll();
        $userIds = array_column($userRoles, 'user_id');

        if (empty($userIds)) {
            return [];
        }

        return $this->whereIn('user_id', $userIds)->findAll();
    }

    /**
     * Get users with a specific permission
     */
    public function getUsersWithPermission($permissionId)
    {
        $userPermissionModel = new UserPermissionModel();
        $userPermissions = $userPermissionModel
            ->where('permission_id', $permissionId)
            ->where('is_allowed', 1)
            ->findAll();
        
        $userIds = array_column($userPermissions, 'user_id');

        if (empty($userIds)) {
            return [];
        }

        return $this->whereIn('user_id', $userIds)->findAll();
    }

    /**
     * Get users with their primary role (for display)
     */
    public function getUsersWithPrimaryRole()
    {
        $users = $this->findAll();
        $userRoleModel = new UserRoleModel();

        foreach ($users as &$user) {
            $roles = $userRoleModel->getRolesForUser($user['user_id']);
            $user['primary_role'] = !empty($roles) ? $roles[0] : null;
            $user['role_name'] = $user['primary_role']['name'] ?? 'Unassigned';
            $user['role_slug'] = $user['primary_role']['slug'] ?? 'unassigned';
        }

        return $users;
    }

    /**
     * Get user count by role
     */
    public function getUserCountByRole()
    {
        $userRoleModel = new UserRoleModel();
        
        return $userRoleModel
            ->select('roles.name, roles.slug, COUNT(user_roles.id) as count')
            ->join('roles', 'roles.role_id = user_roles.role_id')
            ->groupBy('roles.role_id')
            ->findAll();
    }

    /**
     * Get user statistics
     */
    public function getUserStatistics()
    {
        $total = $this->countAll();
        $active = $this->where('is_active', 1)->countAllResults();
        $verified = $this->where('is_verified', 1)->countAllResults();
        $inactive = $this->where('is_active', 0)->countAllResults();

        return [
            'total' => $total,
            'active' => $active,
            'inactive' => $inactive,
            'verified' => $verified,
            'unverified' => $total - $verified,
            'by_role' => $this->getUserCountByRole()
        ];
    }

    /**
     * Get users with pagination and role filter
     */
    public function getFilteredUsers($roleSlug = null, $limit = 10, $offset = 0)
    {
        $this->select('users.*');

        if ($roleSlug) {
            $this->join('user_roles', 'user_roles.user_id = users.user_id')
                 ->join('roles', 'roles.role_id = user_roles.role_id')
                 ->where('roles.slug', $roleSlug);
        }

        return $this->orderBy('users.created_at', 'DESC')
                    ->limit($limit, $offset)
                    ->findAll();
    }

    /**
     * Get filtered users count
     */
    public function getFilteredUsersCount($roleSlug = null)
    {
        if ($roleSlug) {
            return $this->join('user_roles', 'user_roles.user_id = users.user_id')
                        ->join('roles', 'roles.role_id = user_roles.role_id')
                        ->where('roles.slug', $roleSlug)
                        ->countAllResults();
        }

        return $this->countAllResults();
    }

    /**
     * Create user with role assignment
     */
    public function createUserWithRole($userData, $roleId)
    {
        $this->db->transStart();

        // Create user
        $userId = $this->insert($userData, true);

        if ($userId) {
            // Assign role
            $userRoleModel = new UserRoleModel();
            $userRoleModel->assignRole($userId, $roleId);
        }

        $this->db->transComplete();

        return $userId;
    }

    /**
     * Update user with role
     */
    public function updateUserWithRole($userId, $userData, $roleId = null)
    {
        $this->db->transStart();

        // Update user
        $updated = $this->update($userId, $userData);

        if ($updated && $roleId !== null) {
            // Update role
            $userRoleModel = new UserRoleModel();
            $userRoleModel->assignRole($userId, $roleId);
        }

        $this->db->transComplete();

        return $updated;
    }

    /**
     * Delete user with all related data
     */
    public function deleteUserWithRelations($userId)
    {
        $this->db->transStart();

        // Delete user permissions
        $userPermissionModel = new UserPermissionModel();
        $userPermissionModel->deleteAllForUser($userId);

        // Delete user roles
        $userRoleModel = new UserRoleModel();
        $userRoleModel->where('user_id', $userId)->delete();

        // Delete user
        $deleted = $this->delete($userId);

        $this->db->transComplete();

        return $deleted;
    }
}