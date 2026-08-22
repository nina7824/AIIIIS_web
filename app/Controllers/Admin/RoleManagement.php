<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\RoleModel;
use App\Models\PermissionModel;
use App\Models\RolePermissionModel;

class RoleManagement extends BaseController
{
    protected $roleModel;
    protected $permissionModel;
    protected $rolePermissionModel;

    public function __construct()
    {
        $this->roleModel = new RoleModel();
        $this->permissionModel = new PermissionModel();
        $this->rolePermissionModel = new RolePermissionModel();
    }

    // ============================================================
    // MAIN INDEX
    // ============================================================
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

    // ============================================================
    // GET DATA FOR DATATABLE
    // ============================================================
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

    // ============================================================
    // GET SINGLE ROLE
    // ============================================================
    // ============================================================
// GET SINGLE ROLE (for Edit Modal)
// ============================================================
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

    return $this->response->setJSON([
        'status' => 'success',
        'data' => $role,
        'csrf_token' => csrf_hash()
    ]);
}

   // ============================================================
// GET STATS
// ============================================================
public function getStats()
{
    if (!$this->hasPermission('roles_manage')) {
        return $this->response->setJSON(['status' => 'error', 'message' => 'Permission denied']);
    }

    $total = $this->roleModel->countAll();
    $active = $this->roleModel->where('is_active', 1)->countAllResults();
    $system = $this->roleModel->where('is_system', 1)->countAllResults();

    return $this->response->setJSON([
        'status' => 'success',
        'data' => [
            'total' => $total,
            'active' => $active,
            'system' => $system
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

    $db = \Config\Database::connect();
    
    // Get all modules
    $modules = $db->table('modules')
        ->where('is_active', 1)
        ->orderBy('sort_order', 'ASC')
        ->get()
        ->getResultArray();
    
    // Get all permissions
    $allPermissions = $db->table('permissions')
        ->where('is_active', 1)
        ->get()
        ->getResultArray();
    
    // Group permissions by module slug
    $permissionsByModule = [];
    foreach ($allPermissions as $perm) {
        $module = $perm['module'];
        if (!isset($permissionsByModule[$module])) {
            $permissionsByModule[$module] = [];
        }
        $permissionsByModule[$module][$perm['slug']] = $perm;
    }
    
    // Get current role permissions
    $rolePermissions = $db->table('role_permissions')
        ->where('role_id', $roleId)
        ->get()
        ->getResultArray();
    $rolePermissionIds = array_column($rolePermissions, 'permission_id');

    // Build Menu Tree with permissions
    $menuTree = [];
    $categories = [];
    $subModules = [];
    
    // Separate categories and sub-modules
    foreach ($modules as $module) {
        if ($module['is_category'] == 1) {
            $categories[$module['module_id']] = $module;
        } else {
            $parentId = $module['parent_id'] ?? 0;
            if (!isset($subModules[$parentId])) {
                $subModules[$parentId] = [];
            }
            $subModules[$parentId][] = $module;
        }
    }
    
    // Build menu tree
    foreach ($categories as $categoryId => $category) {
        if (!isset($subModules[$categoryId]) || empty($subModules[$categoryId])) {
            continue;
        }
        
        $categoryItems = [];
        foreach ($subModules[$categoryId] as $module) {
            $slug = $module['slug'];
            $item = [
                'label' => $module['name'],
                'slug' => $slug,
                'icon' => $module['icon'] ?? 'fa-cube',
                'permissions' => [],
                'submenus' => []
            ];
            
            // Add permissions for this module
            $actions = ['view', 'add', 'edit', 'delete'];
            foreach ($actions as $action) {
                $permSlug = $slug . '_' . $action;
                if (isset($permissionsByModule[$slug][$permSlug])) {
                    $perm = $permissionsByModule[$slug][$permSlug];
                    // Check if this permission is assigned to the role
                    $perm['checked'] = in_array($perm['permission_id'], $rolePermissionIds);
                    $item['permissions'][$action] = $perm;
                }
            }
            
            $categoryItems[] = $item;
        }
        
        if (!empty($categoryItems)) {
            $menuTree[] = [
                'label' => $category['name'],
                'icon' => $category['icon'] ?? 'fa-folder',
                'items' => $categoryItems
            ];
        }
    }

    // Check if this is Super Admin role
    $isSuperAdmin = ($role['slug'] === 'super_admin');

    $data = [
        'page_title' => $role['name'] . ' Permissions',
        'breadcrumb' => $role['name'] . ' / Permissions',
        'role' => $role,
        'menuTree' => $menuTree,
        'rolePermissionIds' => $rolePermissionIds,
        'allPermissions' => $allPermissions,
        'isSuperAdmin' => $isSuperAdmin  // Pass this to view
    ];

    return $this->renderAdmin('admin/roles/permissions', $data);
}
    // ============================================================
    // CREATE ROLE
    // ============================================================
  public function store()
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
    // ============================================================
    // UPDATE ROLE
    // ============================================================
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

    // ============================================================
    // DELETE ROLE
    // ============================================================
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

        if ($role['is_system'] == 1) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Cannot delete system role'
            ]);
        }

        $db = \Config\Database::connect();
        $userCount = $db->table('user_roles')->where('role_id', $roleId)->countAllResults();
        if ($userCount > 0) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Cannot delete role with assigned users.'
            ]);
        }

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

    // ============================================================
    // TOGGLE ROLE STATUS
    // ============================================================
    // ============================================================
// TOGGLE ROLE STATUS
// ============================================================
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

    if ($role['is_system'] == 1) {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Cannot toggle status of system role'
        ]);
    }

    $newStatus = $role['is_active'] == 1 ? 0 : 1;
    $result = $this->roleModel->where('role_id', $roleId)->set(['is_active' => $newStatus])->update();
    
    if ($result) {
        return $this->response->setJSON([
            'status' => 'success',
            'message' => $newStatus == 1 ? 'Role activated!' : 'Role deactivated!',
            'is_active' => $newStatus,
            'csrf_token' => csrf_hash()
        ]);
    }

    return $this->response->setJSON([
        'status' => 'error',
        'message' => 'Failed to update status'
    ]);
}
    // ============================================================
    // UPDATE PERMISSIONS
    // ============================================================
    public function updatePermissions($roleId = null)
    {
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

        $permissions = $this->request->getPost('permissions');
        
        if (is_string($permissions)) {
            $permissions = json_decode($permissions, true);
        }

        if (!is_array($permissions)) {
            $permissions = [];
        }

        $permissions = array_filter($permissions, function($value) {
            return is_numeric($value) && $value > 0;
        });
        $permissions = array_map('intval', $permissions);

        try {
            $db = \Config\Database::connect();
            $db->transStart();

            $db->table('role_permissions')
                ->where('role_id', (int)$roleId)
                ->delete();

            $insertCount = 0;
            foreach ($permissions as $permissionId) {
                $perm = $db->table('permissions')
                    ->where('permission_id', (int)$permissionId)
                    ->get()
                    ->getRow();
                
                if ($perm) {
                    $db->table('role_permissions')->insert([
                        'role_id' => (int)$roleId,
                        'permission_id' => (int)$permissionId
                    ]);
                    $insertCount++;
                }
            }

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
            
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Error updating permissions: ' . $e->getMessage()
            ])->setStatusCode(500);
        }
    }
}