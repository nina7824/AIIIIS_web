<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\RoleModel;
use App\Models\PermissionModel;
use App\Models\RolePermissionModel;

class Roles extends BaseController
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

    public function index()
    {
        // Check permission
        $this->requirePermission('manage_roles');

        $data = [
            'title' => 'Manage Roles — AIIIIS',
            'roles' => $this->roleModel->getRolesWithCount(),
            'modules' => \Config\Permissions::$modules
        ];

        return $this->render('admin/roles/index', $data);
    }

    public function create()
    {
        $this->requirePermission('manage_roles');

        if ($this->request->getMethod() === 'post') {
            $rules = [
                'name' => 'required|min_length[3]|max_length[50]',
                'slug' => 'required|min_length[3]|max_length[50]|is_unique[roles.slug]',
                'description' => 'permit_empty|max_length[255]'
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()
                    ->with('errors', $this->validator->getErrors())
                    ->withInput();
            }

            $data = [
                'name' => $this->request->getPost('name'),
                'slug' => $this->request->getPost('slug'),
                'description' => $this->request->getPost('description'),
                'is_system' => 0
            ];

            if ($this->roleModel->save($data)) {
                $roleId = $this->roleModel->insertID();
                
                // Assign permissions if any
                $permissions = $this->request->getPost('permissions') ?? [];
                if (!empty($permissions)) {
                    $this->rolePermissionModel->syncPermissions($roleId, $permissions);
                    
                    // Auto-sync menus for this role
                    $this->syncRoleMenus($roleId);
                }

                return redirect()->to('/admin/roles')
                    ->with('success', 'Role created successfully.');
            }

            return redirect()->back()
                ->with('error', 'Failed to create role.')
                ->withInput();
        }

        $data = [
            'title' => 'Create Role — AIIIIS',
            'permissions' => $this->permissionModel->getGroupedByModule(),
            'modules' => \Config\Permissions::$modules
        ];

        return $this->render('admin/roles/create', $data);
    }

 public function edit($id)
{
    $this->requirePermission('manage_roles');

    $role = $this->roleModel->find($id);
    if (!$role) {
        return redirect()->to('/admin/roles')->with('error', 'Role not found.');
    }

    if ($this->request->getMethod() === 'post') {
        $rules = [
            'name' => 'required|min_length[3]|max_length[50]',
            'description' => 'permit_empty|max_length[255]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->with('errors', $this->validator->getErrors())
                ->withInput();
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description')
        ];

        if ($this->roleModel->update($id, $data)) {
            // Update permissions
            $permissions = $this->request->getPost('permissions') ?? [];
            $this->rolePermissionModel->syncPermissions($id, $permissions);
            
            // Auto-sync menus for this role
            $this->syncRoleMenus($id);

            return redirect()->to('/admin/roles')
                ->with('success', 'Role updated successfully.');
        }

        return redirect()->back()
            ->with('error', 'Failed to update role.')
            ->withInput();
    }

    // Get role permissions
    $rolePermissions = $this->rolePermissionModel->getPermissionsForRole($id);
    $rolePermissionIds = array_column($rolePermissions, 'permission_id');

    $db = \Config\Database::connect();
    
    // ============================================================
    // STEP 1: Get ALL menus (regardless of permissions)
    // ============================================================
    $menus = $db->table('menus m')
        ->select('m.*, 
            COALESCE(mrp.can_view, 0) as can_view, 
            COALESCE(mrp.can_add, 0) as can_add, 
            COALESCE(mrp.can_edit, 0) as can_edit, 
            COALESCE(mrp.can_delete, 0) as can_delete')
        ->join('menu_role_permissions mrp', 'm.menu_id = mrp.menu_id AND mrp.role_id = ' . $id, 'left')
        ->where('m.is_active', 1)
        ->orderBy('m.sort_order', 'ASC')
        ->get()
        ->getResultArray();

    // ============================================================
    // STEP 2: Ensure all menus have menu_role_permissions entries
    // ============================================================
    foreach ($menus as $menu) {
        $existing = $db->table('menu_role_permissions')
            ->where('menu_id', $menu['menu_id'])
            ->where('role_id', $id)
            ->get()
            ->getRow();
        
        if (!$existing) {
            // Insert default entry if missing
            $db->table('menu_role_permissions')->insert([
                'menu_id' => $menu['menu_id'],
                'role_id' => $id,
                'can_view' => 0,
                'can_add' => 0,
                'can_edit' => 0,
                'can_delete' => 0
            ]);
            // Update the current menu's permissions
            $menu['can_view'] = 0;
            $menu['can_add'] = 0;
            $menu['can_edit'] = 0;
            $menu['can_delete'] = 0;
        }
    }

    // ============================================================
    // STEP 3: Build menu tree
    // ============================================================
    $menuTree = $this->buildMenuTreeForPermissions($menus);

    $data = [
        'title' => 'Edit Role — AIIIIS',
        'role' => $role,
        'permissions' => $this->permissionModel->getGroupedByModule(),
        'rolePermissions' => $rolePermissionIds,
        'modules' => \Config\Permissions::$modules,
        'isSystemRole' => $role['is_system'] == 1,
        'menuTree' => $menuTree,
        'roleName' => $role['name'],
        'isSuperAdmin' => $this->isSuperAdmin() // Pass super admin status to view
    ];

    return $this->render('admin/roles/edit', $data);
}
    public function delete($id)
    {
        $this->requirePermission('manage_roles');

        if ($this->roleModel->isSystemRole($id)) {
            return redirect()->to('/admin/roles')
                ->with('error', 'System roles cannot be deleted.');
        }

        if ($this->roleModel->delete($id)) {
            return redirect()->to('/admin/roles')
                ->with('success', 'Role deleted successfully.');
        }

        return redirect()->to('/admin/roles')
            ->with('error', 'Failed to delete role.');
    }

    public function view($id)
    {
        $this->requirePermission('manage_roles');

        $role = $this->roleModel->find($id);
        if (!$role) {
            return redirect()->to('/admin/roles')->with('error', 'Role not found.');
        }

        $permissions = $this->rolePermissionModel->getPermissionsForRole($id);
        $users = $this->roleModel->getUsers($id);

        $data = [
            'title' => 'View Role — AIIIIS',
            'role' => $role,
            'permissions' => $permissions,
            'users' => $users,
            'modules' => \Config\Permissions::$modules
        ];

        return $this->render('admin/roles/view', $data);
    }

    /**
     * Update permissions via AJAX from the permissions page
     */
  public function updatePermissions($roleId)
{
    $request = \Config\Services::request();
    $permissions = $request->getPost('permissions');
    $permissions = json_decode($permissions, true) ?? [];
    
    $db = \Config\Database::connect();
    $db->transStart();
    
    // Get the role
    $role = $db->table('roles')->where('role_id', $roleId)->get()->getRow();
    if (!$role) {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Role not found'
        ]);
    }
    
    // ============================================================
    // STEP 1: Update role_permissions (module permissions)
    // ============================================================
    
    // Get all permission IDs for this role
    $existingPerms = $db->table('role_permissions')
        ->select('permission_id')
        ->where('role_id', $roleId)
        ->get()
        ->getResultArray();
    $existingPermIds = array_column($existingPerms, 'permission_id');
    
    // Delete permissions that are no longer checked
    $toDelete = array_diff($existingPermIds, $permissions);
    if (!empty($toDelete)) {
        $db->table('role_permissions')
            ->where('role_id', $roleId)
            ->whereIn('permission_id', $toDelete)
            ->delete();
    }
    
    // Add new permissions
    $toAdd = array_diff($permissions, $existingPermIds);
    foreach ($toAdd as $permId) {
        $db->table('role_permissions')->insert([
            'role_id' => $roleId,
            'permission_id' => $permId
        ]);
    }
    
    // ============================================================
    // STEP 2: Sync menu_role_permissions based on view permissions
    // ============================================================
    
    // Get all view permissions for this role
    $viewPerms = $db->table('role_permissions rp')
        ->select('p.module, p.slug')
        ->join('permissions p', 'rp.permission_id = p.permission_id')
        ->where('rp.role_id', $roleId)
        ->where('p.slug LIKE', '%_view')
        ->get()
        ->getResultArray();
    
    // Get all modules that have view permissions
    $modulesWithView = [];
    foreach ($viewPerms as $perm) {
        if (!empty($perm['module'])) {
            $modulesWithView[] = $perm['module'];
        } else {
            $slug = $perm['slug'];
            $module = str_replace('_view', '', $slug);
            $module = str_replace('view_', '', $module);
            if (!empty($module)) {
                $modulesWithView[] = $module;
            }
        }
    }
    $modulesWithView = array_unique($modulesWithView);
    
    // Get all menus
    $allMenus = $db->table('menus')
        ->where('is_active', 1)
        ->get()
        ->getResultArray();
    
    // For each menu, check if the role should see it
    foreach ($allMenus as $menu) {
        $shouldSee = in_array($menu['slug'], $modulesWithView);
        
        $existing = $db->table('menu_role_permissions')
            ->where('menu_id', $menu['menu_id'])
            ->where('role_id', $roleId)
            ->get()
            ->getRow();
        
        if ($existing) {
            if ($existing->can_view != ($shouldSee ? 1 : 0)) {
                $db->table('menu_role_permissions')
                    ->where('menu_id', $menu['menu_id'])
                    ->where('role_id', $roleId)
                    ->update(['can_view' => $shouldSee ? 1 : 0]);
            }
        } else {
            $db->table('menu_role_permissions')->insert([
                'menu_id' => $menu['menu_id'],
                'role_id' => $roleId,
                'can_view' => $shouldSee ? 1 : 0,
                'can_add' => 0,
                'can_edit' => 0,
                'can_delete' => 0
            ]);
        }
    }
    
    $db->transComplete();
    
    if ($db->transStatus() === false) {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Failed to update permissions'
        ]);
    }
    
    return $this->response->setJSON([
        'status' => 'success',
        'message' => 'Permissions updated successfully!'
    ]);
}
    /**
     * Sync menu_role_permissions with role_permissions for a specific role
     * 
     * @param int $roleId
     * @return void
     */
    private function syncRoleMenus($roleId)
    {
        $db = \Config\Database::connect();
        
        // Get the role
        $role = $db->table('roles')->where('role_id', $roleId)->get()->getRow();
        if (!$role) {
            return;
        }
        
        // Skip super_admin and administrator (they see everything)
        if (in_array($role->slug, ['super_admin', 'administrator'])) {
            return;
        }
        
        // Get all view permissions for this role
        $viewPerms = $db->table('role_permissions rp')
            ->select('p.module, p.slug')
            ->join('permissions p', 'rp.permission_id = p.permission_id')
            ->where('rp.role_id', $roleId)
            ->where('p.slug LIKE', '%_view')
            ->get()
            ->getResultArray();
        
        // Get all modules that have view permissions
        $modulesWithView = [];
        foreach ($viewPerms as $perm) {
            if (!empty($perm['module'])) {
                $modulesWithView[] = $perm['module'];
            } else {
                // Fallback: extract from slug
                $slug = $perm['slug'];
                $module = str_replace('_view', '', $slug);
                $module = str_replace('view_', '', $module);
                if (!empty($module)) {
                    $modulesWithView[] = $module;
                }
            }
        }
        $modulesWithView = array_unique($modulesWithView);
        
        // Get all menus
        $allMenus = $db->table('menus')
            ->where('is_active', 1)
            ->get()
            ->getResultArray();
        
        // For each menu, check if the role should see it
        foreach ($allMenus as $menu) {
            $shouldSee = in_array($menu['slug'], $modulesWithView);
            
            $existing = $db->table('menu_role_permissions')
                ->where('menu_id', $menu['menu_id'])
                ->where('role_id', $roleId)
                ->get()
                ->getRow();
            
            if ($existing) {
                if ($existing->can_view != ($shouldSee ? 1 : 0)) {
                    $db->table('menu_role_permissions')
                        ->where('menu_id', $menu['menu_id'])
                        ->where('role_id', $roleId)
                        ->update(['can_view' => $shouldSee ? 1 : 0]);
                }
            } else {
                $db->table('menu_role_permissions')->insert([
                    'menu_id' => $menu['menu_id'],
                    'role_id' => $roleId,
                    'can_view' => $shouldSee ? 1 : 0,
                    'can_add' => 0,
                    'can_edit' => 0,
                    'can_delete' => 0
                ]);
            }
        }
    }

    /**
     * Sync all roles' menus
     */
    public function syncAllMenus()
    {
        $db = \Config\Database::connect();
        $roles = $db->table('roles')->get()->getResultArray();
        
        foreach ($roles as $role) {
            $this->syncRoleMenus($role['role_id']);
        }
        
        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'All menus synced successfully!'
        ]);
    }


/**
 * Build menu tree for permissions page
 */
private function buildMenuTreeForPermissions($items, $parentId = null)
{
    $branch = [];
    
    foreach ($items as $item) {
        if ($item['parent_id'] == $parentId) {
            $children = $this->buildMenuTreeForPermissions($items, $item['menu_id']);
            
            $menuItem = [
                'menu_id' => $item['menu_id'],
                'label' => $item['label'],
                'slug' => $item['slug'],
                'icon' => $item['icon'],
                'route' => $item['route'],
                'parent_id' => $item['parent_id'],
                'permissions' => [
                    'can_view' => (int)$item['can_view'],
                    'can_add' => (int)$item['can_add'],
                    'can_edit' => (int)$item['can_edit'],
                    'can_delete' => (int)$item['can_delete']
                ]
            ];
            
            if (!empty($children)) {
                $menuItem['submenus'] = $children;
            }
            
            $branch[] = $menuItem;
        }
    }
    
    return $branch;
}
}