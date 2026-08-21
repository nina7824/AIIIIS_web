<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\RoleModel;
use App\Models\ModuleModel;
use App\Models\PermissionModel;
use App\Models\RolePermissionModel;
use App\Models\UserRoleModel;

class UserManagement extends BaseController
{
    protected $userModel;
    protected $roleModel;
    protected $moduleModel;
    protected $permissionModel;
    protected $rolePermissionModel;
    protected $userRoleModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->roleModel = new RoleModel();
        $this->moduleModel = new ModuleModel();
        $this->permissionModel = new PermissionModel();
        $this->rolePermissionModel = new RolePermissionModel();
        $this->userRoleModel = new UserRoleModel();
    }

    public function index()
    {
        if (!$this->hasPermission('users_manage')) {
            return redirect()->to('/dashboard')->with('error', 'You do not have permission to manage users.');
        }

        $data = [
            'page_title' => 'User Management',
            'breadcrumb' => 'Users',
            'total_users' => $this->userModel->countAll(),
            'active_users' => $this->userModel->where('is_active', 1)->countAllResults()
        ];

        return $this->renderAdmin('admin/users/index', $data);
    }

    public function getData()
    {
        if (!$this->hasPermission('users_manage')) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Permission denied']);
        }

        $page = (int) $this->request->getGet('page') ?: 1;
        $perPage = (int) $this->request->getGet('per_page') ?: 25;
        $search = $this->request->getGet('search') ?: '';
        $sortField = $this->request->getGet('sort') ?: 'user_id';
        $sortDirection = $this->request->getGet('direction') ?: 'desc';

        $db = \Config\Database::connect();
        $builder = $db->table('users u');
        $builder->select('u.*, GROUP_CONCAT(r.name SEPARATOR ", ") as role_names, GROUP_CONCAT(r.slug SEPARATOR ",") as role_slugs');
        $builder->join('user_roles ur', 'ur.user_id = u.user_id', 'left');
        $builder->join('roles r', 'r.role_id = ur.role_id', 'left');
        $builder->groupBy('u.user_id');

        if (!empty($search)) {
            $builder->groupStart()
                ->like('u.name', $search)
                ->orLike('u.email', $search)
                ->orLike('u.phone', $search)
            ->groupEnd();
        }

        $countBuilder = clone $builder;
        $total = $countBuilder->countAllResults();

        $allowedSorts = ['user_id', 'name', 'email', 'phone', 'is_active'];
        if (in_array($sortField, $allowedSorts)) {
            $builder->orderBy($sortField, $sortDirection);
        } else {
            $builder->orderBy('user_id', 'desc');
        }

        $offset = ($page - 1) * $perPage;
        $builder->limit($perPage, $offset);

        $users = $builder->get()->getResultArray();

        return $this->response->setJSON([
            'status' => 'success',
            'data' => $users,
            'pagination' => [
                'current_page' => $page,
                'per_page' => $perPage,
                'total' => $total,
                'last_page' => ceil($total / $perPage),
                'from' => $total > 0 ? $offset + 1 : 0,
                'to' => $total > 0 ? min($offset + $perPage, $total) : 0
            ],
            'csrf_token' => csrf_hash()
        ]);
    }

  public function getUserPermissions($userId = null)
{
    if (!$this->hasPermission('users_manage')) {
        return $this->response->setJSON(['status' => 'error', 'message' => 'Permission denied']);
    }

    if (!$userId) {
        return $this->response->setJSON(['status' => 'error', 'message' => 'User ID required']);
    }

    $user = $this->userModel->where('user_id', $userId)->first();
    if (!$user) {
        return $this->response->setJSON(['status' => 'error', 'message' => 'User not found']);
    }

    // Get user's roles using the model method
    $userRoles = $this->userRoleModel->getRolesForUser($userId);
    $roleIds = array_column($userRoles, 'role_id');

    // Get all modules
    $modules = $this->moduleModel->where('is_active', 1)->orderBy('sort_order', 'ASC')->findAll();

    // Get all permissions
    $allPermissions = $this->permissionModel->where('is_active', 1)->findAll();

    // Get user's permissions through roles
    $userPermissions = [];
    if (!empty($roleIds)) {
        $userPermissions = $this->rolePermissionModel
            ->whereIn('role_id', $roleIds)
            ->findAll();
        $userPermissions = array_column($userPermissions, 'permission_id');
    }

    // Get user's roles with permissions
    $rolesWithPermissions = [];
    foreach ($roleIds as $roleId) {
        $role = $this->roleModel->where('role_id', $roleId)->first();
        if ($role) {
            $perms = $this->rolePermissionModel->where('role_id', $roleId)->findAll();
            $rolesWithPermissions[] = [
                'role_id' => $roleId,
                'role_name' => $role['name'],
                'permissions' => array_column($perms, 'permission_id')
            ];
        }
    }

    return $this->response->setJSON([
        'status' => 'success',
        'data' => [
            'user' => $user,
            'user_roles' => $roleIds,
            'user_permissions' => $userPermissions,
            'modules' => $modules,
            'all_permissions' => $allPermissions,
            'roles_with_permissions' => $rolesWithPermissions
        ],
        'csrf_token' => csrf_hash()
    ]);
}

public function updateUserPermissions($userId = null)
{
    if (!$this->hasPermission('users_manage')) {
        return $this->response->setJSON(['status' => 'error', 'message' => 'Permission denied']);
    }

    if (!$userId) {
        return $this->response->setJSON(['status' => 'error', 'message' => 'User ID required']);
    }

    $user = $this->userModel->where('user_id', $userId)->first();
    if (!$user) {
        return $this->response->setJSON(['status' => 'error', 'message' => 'User not found']);
    }

    $roles = $this->request->getPost('roles');
    if ($roles !== null) {
        $roles = json_decode($roles, true);
        if (is_array($roles)) {
            // Use the assignRoles method
            $this->userRoleModel->assignRoles($userId, $roles);
        }
    }

    return $this->response->setJSON([
        'status' => 'success',
        'message' => 'User permissions updated successfully!',
        'csrf_token' => csrf_hash()
    ]);
}
    public function get($userId = null)
    {
        if (!$this->hasPermission('users_manage')) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Permission denied']);
        }

        if (!$userId) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'User ID required']);
        }

        $user = $this->userModel->where('user_id', $userId)->first();
        if (!$user) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'User not found']);
        }

        return $this->response->setJSON([
            'status' => 'success',
            'data' => $user,
            'csrf_token' => csrf_hash()
        ]);
    }

    public function getStats()
    {
        if (!$this->hasPermission('users_manage')) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Permission denied']);
        }

        $total = $this->userModel->countAll();
        $active = $this->userModel->where('is_active', 1)->countAllResults();

        return $this->response->setJSON([
            'status' => 'success',
            'data' => [
                'total' => $total,
                'active' => $active
            ],
            'csrf_token' => csrf_hash()
        ]);
    }

    public function toggleStatus($userId = null)
    {
        if (!$this->hasPermission('users_manage')) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Permission denied']);
        }

        if (!$userId) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'User ID required']);
        }

        $user = $this->userModel->where('user_id', $userId)->first();
        if (!$user) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'User not found']);
        }

        $newStatus = $user['is_active'] == 1 ? 0 : 1;
        if ($this->userModel->where('user_id', $userId)->set(['is_active' => $newStatus])->update()) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'User status updated!',
                'is_active' => $newStatus,
                'csrf_token' => csrf_hash()
            ]);
        }

        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Failed to update status'
        ]);
    }
}