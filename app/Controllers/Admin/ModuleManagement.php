<?php
// app/Controllers/Admin/ModuleManagement.php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ModuleModel;
use App\Models\PermissionModel;

class ModuleManagement extends BaseController
{
    protected $moduleModel;
    protected $permissionModel;

    public function __construct()
    {
        $this->moduleModel = new ModuleModel();
        $this->permissionModel = new PermissionModel();
    }

    public function index()
    {
        if (!$this->hasPermission('modules_manage')) {
            return redirect()->to('/dashboard')->with('error', 'You do not have permission to manage modules.');
        }

        $data = [
            'page_title' => 'Module Management',
            'breadcrumb' => 'Modules',
            'modules' => $this->moduleModel->getModulesWithPermissions(),
            'categories' => $this->moduleModel->getCategories(),
            'total_modules' => $this->moduleModel->countAll(),
            'active_modules' => $this->moduleModel->where('is_active', 1)->countAllResults(),
            'category_count' => count($this->moduleModel->getCategories())
        ];

        return $this->renderAdmin('admin/modules/index', $data);
    }

    public function getData()
    {
        $role = $this->currentUser['role'] ?? session()->get('role');
        if ($role !== 'super_admin' && !$this->hasPermission('modules_manage')) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Permission denied']);
        }

        $page = (int) $this->request->getGet('page') ?: 1;
        $perPage = (int) $this->request->getGet('per_page') ?: 25;
        $search = $this->request->getGet('search') ?: '';
        $sortField = $this->request->getGet('sort') ?: 'sort_order';
        $sortDirection = $this->request->getGet('direction') ?: 'asc';

        $db = \Config\Database::connect();
        $builder = $db->table('modules m');
        $builder->select('m.*, 
            (SELECT COUNT(*) FROM permissions p WHERE p.module = m.slug) as permission_count,
            (SELECT name FROM modules WHERE module_id = m.parent_id) as parent_name');

        if (!empty($search)) {
            $builder->groupStart()
                ->like('m.name', $search)
                ->orLike('m.slug', $search)
                ->orLike('m.description', $search)
            ->groupEnd();
        }

        $countBuilder = clone $builder;
        $total = $countBuilder->countAllResults();

        $allowedSorts = ['module_id', 'name', 'slug', 'description', 'permission_count', 'is_active', 'sort_order'];
        if (in_array($sortField, $allowedSorts)) {
            $builder->orderBy($sortField, $sortDirection);
        } else {
            $builder->orderBy('sort_order', 'asc');
        }

        $offset = ($page - 1) * $perPage;
        $builder->limit($perPage, $offset);

        $modules = $builder->get()->getResultArray();

        $response = [
            'status' => 'success',
            'data' => $modules,
            'pagination' => [
                'current_page' => $page,
                'per_page' => $perPage,
                'total' => $total,
                'last_page' => ceil($total / $perPage),
                'from' => $total > 0 ? $offset + 1 : 0,
                'to' => $total > 0 ? min($offset + $perPage, $total) : 0
            ],
            'csrf_token' => csrf_hash()
        ];

        return $this->response->setJSON($response);
    }

    public function get($module_id = null)
    {
        $role = $this->currentUser['role'] ?? session()->get('role');
        if ($role !== 'super_admin' && !$this->hasPermission('modules_manage')) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Permission denied']);
        }

        if (!$module_id) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Module ID is required']);
        }

        $module = $this->moduleModel->where('module_id', $module_id)->first();
        
        if (!$module) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Module not found']);
        }

        $module['permission_count'] = $this->permissionModel->where('module', $module['slug'])->countAllResults();

        return $this->response->setJSON([
            'status' => 'success',
            'data' => $module,
            'csrf_token' => csrf_hash()
        ]);
    }

    public function getStats()
    {
        $role = $this->currentUser['role'] ?? session()->get('role');
        if ($role !== 'super_admin' && !$this->hasPermission('modules_manage')) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Permission denied']);
        }

        $total = $this->moduleModel->countAll();
        $active = $this->moduleModel->where('is_active', 1)->countAllResults();
        $categories = $this->moduleModel->where('is_category', 1)->countAllResults();

        return $this->response->setJSON([
            'status' => 'success',
            'data' => [
                'total' => $total,
                'active' => $active,
                'categories' => $categories
            ],
            'csrf_token' => csrf_hash()
        ]);
    }

    public function generateSlug()
    {
        if (!$this->hasPermission('modules_manage')) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Permission denied']);
        }

        $name = $this->request->getPost('name');
        if (!$name) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Name is required']);
        }

        $slug = $this->moduleModel->generateSlug($name);

        return $this->response->setJSON([
            'status' => 'success',
            'slug' => $slug,
            'csrf_token' => csrf_hash()
        ]);
    }

    public function getNextSortOrder()
    {
        if (!$this->hasPermission('modules_manage')) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Permission denied']);
        }

        $nextOrder = $this->moduleModel->getNextSortOrder();

        return $this->response->setJSON([
            'status' => 'success',
            'sort_order' => $nextOrder,
            'csrf_token' => csrf_hash()
        ]);
    }

    public function store()
    {
        if (!$this->hasPermission('modules_manage')) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Permission denied']);
        }

        $rules = [
            'name' => 'required|min_length[3]|max_length[100]',
            'slug' => 'permit_empty|min_length[3]|max_length[100]',
            'parent_id' => 'permit_empty|numeric',
            'icon' => 'permit_empty|min_length[2]|max_length[50]',
            'description' => 'permit_empty|max_length[500]',
            'is_active' => 'permit_empty|in_list[0,1]',
            'is_category' => 'permit_empty|in_list[0,1]'
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $this->validator->getErrors()
            ]);
        }

        $name = $this->request->getPost('name');
        $slug = $this->request->getPost('slug');
        
        if (empty($slug)) {
            $slug = $this->moduleModel->generateSlug($name);
        }
        
        $sortOrder = $this->request->getPost('sort_order');
        if ($sortOrder === null || $sortOrder === '' || $sortOrder == 0) {
            $sortOrder = $this->moduleModel->getNextSortOrder();
        }

        $parentId = $this->request->getPost('parent_id');
        if ($parentId === '') $parentId = null;

        $isCategory = $this->request->getPost('is_category') ?? 0;
        $createPermissions = $this->request->getPost('create_permissions') ?? 0;

        $data = [
            'name' => $name,
            'slug' => $slug,
            'parent_id' => $parentId,
            'icon' => $this->request->getPost('icon') ?: 'fa-cube',
            'description' => $this->request->getPost('description'),
            'is_active' => $this->request->getPost('is_active') ?? 1,
            'is_category' => $isCategory,
            'sort_order' => $sortOrder
        ];

        if ($this->moduleModel->save($data)) {
            $moduleId = $this->moduleModel->insertID();
            $moduleSlug = $slug;
            $moduleName = $name;
            
            $permissionsCreated = false;
            $permissionsMessage = '';
            $permissions = [];
            
            if ($createPermissions == 1 && $isCategory == 0) {
                $permissionsCreated = $this->createDefaultPermissions($moduleSlug, $moduleName);
                $permissionsMessage = $permissionsCreated ? '4 default permissions created!' : 'Failed to create permissions.';
                if ($permissionsCreated) {
                    $permissions = [
                        $moduleSlug . '_view',
                        $moduleSlug . '_add',
                        $moduleSlug . '_edit',
                        $moduleSlug . '_delete'
                    ];
                }
            }

            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Module created successfully!',
                'module_id' => $moduleId,
                'slug' => $moduleSlug,
                'sort_order' => $sortOrder,
                'permissions_created' => $permissionsCreated,
                'permissions_message' => $permissionsMessage,
                'permissions' => $permissions,
                'csrf_token' => csrf_hash()
            ]);
        }

        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Failed to create module. Please try again.'
        ]);
    }

    private function createDefaultPermissions($moduleSlug, $moduleName)
    {
        try {
            $db = \Config\Database::connect();
            $permissions = [
                ['name' => 'View ' . $moduleName, 'slug' => $moduleSlug . '_view', 'module' => $moduleSlug, 'description' => 'View ' . $moduleName . ' items'],
                ['name' => 'Add ' . $moduleName, 'slug' => $moduleSlug . '_add', 'module' => $moduleSlug, 'description' => 'Add new ' . $moduleName],
                ['name' => 'Edit ' . $moduleName, 'slug' => $moduleSlug . '_edit', 'module' => $moduleSlug, 'description' => 'Edit ' . $moduleName],
                ['name' => 'Delete ' . $moduleName, 'slug' => $moduleSlug . '_delete', 'module' => $moduleSlug, 'description' => 'Delete ' . $moduleName]
            ];

            $inserted = 0;
            foreach ($permissions as $perm) {
                $existing = $db->table('permissions')
                    ->where('slug', $perm['slug'])
                    ->get()
                    ->getRow();
                
                if (!$existing) {
                    $db->table('permissions')->insert($perm);
                    $inserted++;
                }
            }

            return $inserted > 0;
        } catch (\Exception $e) {
            log_message('error', 'Error creating default permissions: ' . $e->getMessage());
            return false;
        }
    }

    public function edit($module_id)
    {
        if (!$this->hasPermission('modules_manage')) {
            return redirect()->to('/dashboard')->with('error', 'You do not have permission to edit modules.');
        }

        $module = $this->moduleModel->where('module_id', $module_id)->first();
        if (!$module) {
            return redirect()->to('/admin/modules')->with('error', 'Module not found.');
        }

        $data = [
            'page_title' => 'Edit Module',
            'breadcrumb' => 'Edit Module',
            'module' => $module,
            'categories' => $this->moduleModel->getCategories()
        ];

        return $this->renderAdmin('admin/modules/edit', $data);
    }

    public function update($module_id = null)
    {
        if (!$this->hasPermission('modules_manage')) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Permission denied']);
        }

        if (!$module_id) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Module ID is required']);
        }

        $module = $this->moduleModel->where('module_id', $module_id)->first();
        if (!$module) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Module not found']);
        }

        $rules = [
            'name' => 'required|min_length[3]|max_length[100]',
            'slug' => 'required|min_length[3]|max_length[100]|is_unique[modules.slug,module_id,' . $module_id . ']',
            'parent_id' => 'permit_empty|numeric',
            'icon' => 'permit_empty|min_length[2]|max_length[50]',
            'description' => 'permit_empty|max_length[500]',
            'sort_order' => 'permit_empty|numeric',
            'is_active' => 'permit_empty|in_list[0,1]',
            'is_category' => 'permit_empty|in_list[0,1]'
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $this->validator->getErrors()
            ]);
        }

        $parentId = $this->request->getPost('parent_id');
        if ($parentId === '') $parentId = null;

        $data = [
            'name' => $this->request->getPost('name'),
            'slug' => $this->request->getPost('slug'),
            'parent_id' => $parentId,
            'icon' => $this->request->getPost('icon') ?: 'fa-cube',
            'description' => $this->request->getPost('description'),
            'is_active' => $this->request->getPost('is_active') ?? 1,
            'is_category' => $this->request->getPost('is_category') ?? 0,
            'sort_order' => $this->request->getPost('sort_order') ?? 0
        ];

        if ($this->moduleModel->where('module_id', $module_id)->set($data)->update()) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Module updated successfully!',
                'csrf_token' => csrf_hash()
            ]);
        }

        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Failed to update module. Please try again.'
        ]);
    }

    public function delete($module_id = null)
    {
        if (!$this->hasPermission('modules_manage')) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Permission denied']);
        }

        if (!$module_id) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Module ID is required']);
        }

        $module = $this->moduleModel->where('module_id', $module_id)->first();
        if (!$module) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Module not found']);
        }

        $permissions = $this->permissionModel->where('module', $module['slug'])->countAllResults();
        if ($permissions > 0) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Cannot delete module with existing permissions (' . $permissions . '). Please delete the permissions first.'
            ]);
        }

        if ($this->moduleModel->where('module_id', $module_id)->delete()) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Module deleted successfully!',
                'csrf_token' => csrf_hash()
            ]);
        }

        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Failed to delete module. Please try again.'
        ]);
    }

    public function toggleStatus($module_id = null)
    {
        if (!$this->hasPermission('modules_manage')) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Permission denied']);
        }

        if (!$module_id) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Module ID is required']);
        }

        $module = $this->moduleModel->where('module_id', $module_id)->first();
        if (!$module) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Module not found']);
        }

        $newStatus = $module['is_active'] == 1 ? 0 : 1;
        if ($this->moduleModel->where('module_id', $module_id)->set(['is_active' => $newStatus])->update()) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Module status updated successfully!',
                'is_active' => $newStatus,
                'csrf_token' => csrf_hash()
            ]);
        }

        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Failed to update module status'
        ]);
    }

    public function reorder()
    {
        if (!$this->hasPermission('modules_manage')) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Permission denied']);
        }

        $orders = $this->request->getPost('orders');
        if (is_string($orders)) {
            $orders = json_decode($orders, true);
        }

        if (!$orders || !is_array($orders)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'No order data provided or invalid format'
            ]);
        }

        try {
            $db = \Config\Database::connect();
            $db->transStart();

            foreach ($orders as $item) {
                if (!isset($item['id']) || !isset($item['order'])) {
                    continue;
                }
                $this->moduleModel
                    ->where('module_id', $item['id'])
                    ->set(['sort_order' => (int)$item['order']])
                    ->update();
            }

            $db->transComplete();

            if ($db->transStatus() === true) {
                return $this->response->setJSON([
                    'status' => 'success',
                    'message' => 'Modules reordered successfully!',
                    'csrf_token' => csrf_hash()
                ]);
            } else {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Database transaction failed'
                ]);
            }
        } catch (\Exception $e) {
            log_message('error', 'Reorder error: ' . $e->getMessage());
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Failed to reorder modules: ' . $e->getMessage()
            ]);
        }
    }
}