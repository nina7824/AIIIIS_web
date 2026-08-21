<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\RoleModel;
use App\Models\PermissionModel;
use App\Models\RolePermissionModel;
use App\Models\ModuleModel;  // Add this

class RoleManagement extends BaseController
{
    protected $roleModel;
    protected $permissionModel;
    protected $rolePermissionModel;
    protected $moduleModel;  // Add this

    public function __construct()
    {
        $this->roleModel = new RoleModel();
        $this->permissionModel = new PermissionModel();
        $this->rolePermissionModel = new RolePermissionModel();
        $this->moduleModel = new ModuleModel();  // Add this
    }

    public function index()
    {
        if (!$this->hasPermission('roles_manage')) {
            return redirect()->to('/dashboard')->with('error', 'You do not have permission to manage roles.');
        }

        $data = [
            'page_title' => 'Role Management',
            'breadcrumb' => 'Roles',
            'total_roles' => $this->roleModel->countAll(),
            'active_roles' => $this->roleModel->where('is_active', 1)->countAllResults()
        ];

        return $this->renderAdmin('admin/roles/index', $data);
    }

    public function getData()
    {
        if (!$this->hasPermission('roles_manage')) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Permission denied']);
        }

        $page = (int) $this->request->getGet('page') ?: 1;
        $perPage = (int) $this->request->getGet('per_page') ?: 100;
        $search = $this->request->getGet('search') ?: '';
        $sortField = $this->request->getGet('sort') ?: 'role_id';
        $sortDirection = $this->request->getGet('direction') ?: 'asc';

        $builder = $this->roleModel;

        if (!empty($search)) {
            $builder->like('name', $search)
                    ->orLike('slug', $search)
                    ->orLike('description', $search);
        }

        $total = $builder->countAllResults(false);
        $offset = ($page - 1) * $perPage;
        $builder->orderBy($sortField, $sortDirection);
        $builder->limit($perPage, $offset);

        $roles = $builder->findAll();

        return $this->response->setJSON([
            'status' => 'success',
            'data' => $roles,
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

    public function get($roleId = null)
    {
        if (!$this->hasPermission('roles_manage')) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Permission denied']);
        }

        if (!$roleId) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Role ID required']);
        }

        $role = $this->roleModel->where('role_id', $roleId)->first();
        if (!$role) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Role not found']);
        }

        // Get role permissions
        $permissions = $this->rolePermissionModel->where('role_id', $roleId)->findAll();
        $role['permissions'] = array_column($permissions, 'permission_id');

        return $this->response->setJSON([
            'status' => 'success',
            'data' => $role,
            'csrf_token' => csrf_hash()
        ]);
    }

    public function getStats()
    {
        if (!$this->hasPermission('roles_manage')) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Permission denied']);
        }

        $total = $this->roleModel->countAll();
        $active = $this->roleModel->where('is_active', 1)->countAllResults();

        return $this->response->setJSON([
            'status' => 'success',
            'data' => [
                'total' => $total,
                'active' => $active
            ],
            'csrf_token' => csrf_hash()
        ]);
    }
public function permissions($roleId = null)
{
    if (!$this->hasPermission('roles_manage')) {
        return redirect()->to('/dashboard')->with('error', 'You do not have permission to manage roles.');
    }

    if (!$roleId) {
        return redirect()->to('/admin/roles')->with('error', 'Role ID required.');
    }

    $role = $this->roleModel->where('role_id', $roleId)->first();
    if (!$role) {
        return redirect()->to('/admin/roles')->with('error', 'Role not found.');
    }

    // Get all modules with their permissions
    $modules = $this->moduleModel->where('is_active', 1)->orderBy('sort_order', 'ASC')->findAll();
    
    // Get all permissions
    $allPermissions = $this->permissionModel->where('is_active', 1)->findAll();
    
    // Get current role permissions
    $rolePermissions = $this->rolePermissionModel->where('role_id', $roleId)->findAll();
    $rolePermissionIds = array_column($rolePermissions, 'permission_id');

    // Group permissions by module
    $modulePermissions = [];
    foreach ($modules as $module) {
        $modulePermissions[$module['slug']] = [
            'module' => $module,
            'permissions' => array_filter($allPermissions, function($perm) use ($module) {
                return $perm['module'] === $module['slug'];
            })
        ];
    }

    $data = [
        'page_title' => $role['name'] . ' Permissions',  // This will be used by the layout
        'breadcrumb' => $role['name'] . ' / Permissions',
        'role' => $role,
        'modules' => $modules,
        'modulePermissions' => $modulePermissions,
        'rolePermissionIds' => $rolePermissionIds,
        'allPermissions' => $allPermissions
    ];

    return $this->renderAdmin('admin/roles/permissions', $data);
}

    public function create()
    {
        if (!$this->hasPermission('roles_manage')) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Permission denied']);
        }

        $rules = [
            'name' => 'required|min_length[3]|max_length[100]',
            'slug' => 'required|min_length[3]|max_length[100]|is_unique[roles.slug]',
            'description' => 'permit_empty|max_length[500]',
            'is_active' => 'permit_empty|in_list[0,1]'
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $this->validator->getErrors()
            ]);
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'slug' => $this->request->getPost('slug'),
            'description' => $this->request->getPost('description'),
            'is_active' => $this->request->getPost('is_active') ?? 1
        ];

        if ($this->roleModel->save($data)) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Role created successfully!',
                'csrf_token' => csrf_hash()
            ]);
        }

        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Failed to create role'
        ]);
    }

    public function update($roleId = null)
    {
        if (!$this->hasPermission('roles_manage')) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Permission denied']);
        }

        if (!$roleId) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Role ID required']);
        }

        $role = $this->roleModel->where('role_id', $roleId)->first();
        if (!$role) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Role not found']);
        }

        $rules = [
            'name' => 'required|min_length[3]|max_length[100]',
            'slug' => 'required|min_length[3]|max_length[100]|is_unique[roles.slug,role_id,' . $roleId . ']',
            'description' => 'permit_empty|max_length[500]',
            'is_active' => 'permit_empty|in_list[0,1]'
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $this->validator->getErrors()
            ]);
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'slug' => $this->request->getPost('slug'),
            'description' => $this->request->getPost('description'),
            'is_active' => $this->request->getPost('is_active') ?? 1
        ];

        if ($this->roleModel->where('role_id', $roleId)->set($data)->update()) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Role updated successfully!',
                'csrf_token' => csrf_hash()
            ]);
        }

        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Failed to update role'
        ]);
    }

    public function delete($roleId = null)
    {
        if (!$this->hasPermission('roles_manage')) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Permission denied']);
        }

        if (!$roleId) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Role ID required']);
        }

        $role = $this->roleModel->where('role_id', $roleId)->first();
        if (!$role) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Role not found']);
        }

        // Check if role is system role
        if ($role['is_system'] == 1) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Cannot delete system role'
            ]);
        }

        // Check if role has users
        $db = \Config\Database::connect();
        $userCount = $db->table('user_roles')->where('role_id', $roleId)->countAllResults();
        if ($userCount > 0) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Cannot delete role with assigned users. Remove users from this role first.'
            ]);
        }

        // Delete role permissions first
        $this->rolePermissionModel->where('role_id', $roleId)->delete();

        if ($this->roleModel->where('role_id', $roleId)->delete()) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Role deleted successfully!',
                'csrf_token' => csrf_hash()
            ]);
        }

        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Failed to delete role'
        ]);
    }

    public function toggleStatus($roleId = null)
    {
        if (!$this->hasPermission('roles_manage')) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Permission denied']);
        }

        if (!$roleId) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Role ID required']);
        }

        $role = $this->roleModel->where('role_id', $roleId)->first();
        if (!$role) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Role not found']);
        }

        // Check if role is system role
        if ($role['is_system'] == 1) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Cannot toggle status of system role'
            ]);
        }

        $newStatus = $role['is_active'] == 1 ? 0 : 1;
        if ($this->roleModel->where('role_id', $roleId)->set(['is_active' => $newStatus])->update()) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Role status updated!',
                'is_active' => $newStatus,
                'csrf_token' => csrf_hash()
            ]);
        }

        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Failed to update status'
        ]);
    }


 public function updatePermissions($roleId = null)
{
    // Check permission
    if (!$this->hasPermission('roles_manage')) {
        return $this->response->setJSON([
            'status' => 'error', 
            'message' => 'Permission denied'
        ])->setStatusCode(403);
    }

    if (!$roleId) {
        return $this->response->setJSON([
            'status' => 'error', 
            'message' => 'Role ID required'
        ])->setStatusCode(400);
    }

    $role = $this->roleModel->where('role_id', $roleId)->first();
    if (!$role) {
        return $this->response->setJSON([
            'status' => 'error', 
            'message' => 'Role not found'
        ])->setStatusCode(404);
    }

    // Get permissions from POST
    $permissions = $this->request->getPost('permissions');
    
    // If permissions is a JSON string, decode it
    if (is_string($permissions)) {
        $permissions = json_decode($permissions, true);
    }

    // If permissions is null or empty, set to empty array
    if (!is_array($permissions)) {
        $permissions = [];
    }

    // Filter and sanitize permissions - ensure they are integers
    $permissions = array_filter($permissions, function($value) {
        return is_numeric($value) && $value > 0;
    });
    $permissions = array_map('intval', $permissions);

    try {
        // Get database instance
        $db = \Config\Database::connect();
        
        // Start transaction
        $db->transStart();

        // Delete existing permissions using direct query
        $db->table('role_permissions')
            ->where('role_id', (int)$roleId)
            ->delete();

        // Insert new permissions using direct queries
        $insertCount = 0;
        foreach ($permissions as $permissionId) {
            // Validate permission exists
            $perm = $db->table('permissions')
                ->where('permission_id', (int)$permissionId)
                ->get()
                ->getRow();
            
            if ($perm) {
                // Use direct insert with array data
                $db->table('role_permissions')->insert([
                    'role_id' => (int)$roleId,
                    'permission_id' => (int)$permissionId
                ]);
                $insertCount++;
            }
        }

        // Complete transaction
        $db->transComplete();

        if ($db->transStatus() === true) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Role permissions updated successfully!',
                'permissions_count' => $insertCount,
                'csrf_token' => csrf_hash()
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Transaction failed: Could not update permissions'
            ])->setStatusCode(500);
        }
    } catch (\Exception $e) {
        log_message('error', 'UpdatePermissions Error: ' . $e->getMessage());
        log_message('error', 'UpdatePermissions Trace: ' . $e->getTraceAsString());
        
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Error updating permissions: ' . $e->getMessage()
        ])->setStatusCode(500);
    }
}
}