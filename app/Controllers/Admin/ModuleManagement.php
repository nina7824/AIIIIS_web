<?php
// app/Controllers/Admin/ModuleManagement.php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class ModuleManagement extends BaseController
{
    protected $moduleModel;
    protected $permissionModel;

    public function __construct()
    {
        $this->moduleModel = model('App\Models\ModuleModel');
        $this->permissionModel = model('App\Models\PermissionModel');
    }

    public function index()
    {
        if (!$this->hasPermission('modules_manage')) {
            return redirect()->to('/dashboard')->with('error', 'You do not have permission to manage modules.');
        }

        $data = [
            'page_title' => 'Module Management',
            'breadcrumb' => 'Modules',
            'total_modules' => $this->moduleModel->countAll(),
            'active_modules' => $this->moduleModel->where('is_active', 1)->countAllResults(),
            'category_count' => $this->moduleModel->where('is_category', 1)->countAllResults()
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

    public function getCategories()
    {
        if (!$this->hasPermission('modules_manage')) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Permission denied']);
        }

        try {
            $categories = $this->moduleModel
                ->where('is_category', 1)
                ->where('is_active', 1)
                ->orderBy('name', 'ASC')
                ->findAll();

            return $this->response->setJSON([
                'status' => 'success',
                'data' => $categories,
                'count' => count($categories),
                'csrf_token' => csrf_hash()
            ]);
        } catch (\Exception $e) {
            log_message('error', 'Error in getCategories: ' . $e->getMessage());
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Failed to load categories: ' . $e->getMessage()
            ]);
        }
    }

    public function getIcons()
    {
        if (!$this->hasPermission('modules_manage')) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Permission denied']);
        }

        $icons = $this->getIconList();

        return $this->response->setJSON([
            'status' => 'success',
            'data' => $icons,
            'csrf_token' => csrf_hash()
        ]);
    }

    private function getIconList()
    {
        return [
            ['value' => 'fa-cube', 'label' => 'Cube'],
            ['value' => 'fa-folder', 'label' => 'Folder'],
            ['value' => 'fa-headset', 'label' => 'Headset'],
            ['value' => 'fa-book-open', 'label' => 'Book Open'],
            ['value' => 'fa-users', 'label' => 'Users'],
            ['value' => 'fa-user-tie', 'label' => 'User Tie'],
            ['value' => 'fa-bullhorn', 'label' => 'Bullhorn'],
            ['value' => 'fa-handshake', 'label' => 'Handshake'],
            ['value' => 'fa-file-contract', 'label' => 'File Contract'],
            ['value' => 'fa-chart-line', 'label' => 'Chart Line'],
            ['value' => 'fa-building', 'label' => 'Building'],
            ['value' => 'fa-concierge-bell', 'label' => 'Concierge Bell'],
            ['value' => 'fa-industry', 'label' => 'Industry'],
            ['value' => 'fa-file-signature', 'label' => 'File Signature'],
            ['value' => 'fa-cog', 'label' => 'Cog'],
            ['value' => 'fa-cogs', 'label' => 'Cogs'],
            ['value' => 'fa-robot', 'label' => 'Robot'],
            ['value' => 'fa-newspaper', 'label' => 'Newspaper'],
            ['value' => 'fa-rocket', 'label' => 'Rocket'],
            ['value' => 'fa-comment-dots', 'label' => 'Comment Dots'],
            ['value' => 'fa-ticket-alt', 'label' => 'Ticket'],
            ['value' => 'fa-question-circle', 'label' => 'Question Circle'],
            ['value' => 'fa-database', 'label' => 'Database'],
            ['value' => 'fa-user-edit', 'label' => 'User Edit'],
            ['value' => 'fa-user-plus', 'label' => 'User Plus'],
            ['value' => 'fa-user-minus', 'label' => 'User Minus'],
            ['value' => 'fa-user-check', 'label' => 'User Check'],
            ['value' => 'fa-users-cog', 'label' => 'Users Cog'],
            ['value' => 'fa-shield-alt', 'label' => 'Shield'],
            ['value' => 'fa-lock', 'label' => 'Lock'],
            ['value' => 'fa-unlock', 'label' => 'Unlock'],
            ['value' => 'fa-key', 'label' => 'Key'],
            ['value' => 'fa-envelope', 'label' => 'Envelope'],
            ['value' => 'fa-phone', 'label' => 'Phone'],
            ['value' => 'fa-globe', 'label' => 'Globe'],
            ['value' => 'fa-map-marker-alt', 'label' => 'Map Marker'],
            ['value' => 'fa-clock', 'label' => 'Clock'],
            ['value' => 'fa-calendar', 'label' => 'Calendar'],
            ['value' => 'fa-upload', 'label' => 'Upload'],
            ['value' => 'fa-download', 'label' => 'Download'],
            ['value' => 'fa-print', 'label' => 'Print'],
            ['value' => 'fa-search', 'label' => 'Search'],
            ['value' => 'fa-filter', 'label' => 'Filter'],
            ['value' => 'fa-sort', 'label' => 'Sort'],
            ['value' => 'fa-export', 'label' => 'Export'],
            ['value' => 'fa-import', 'label' => 'Import'],
            ['value' => 'fa-file-alt', 'label' => 'File Alt'],
            ['value' => 'fa-file-pdf', 'label' => 'PDF'],
            ['value' => 'fa-file-word', 'label' => 'Word'],
            ['value' => 'fa-file-excel', 'label' => 'Excel'],
            ['value' => 'fa-file-image', 'label' => 'Image'],
            ['value' => 'fa-file-archive', 'label' => 'Archive'],
            ['value' => 'fa-file-code', 'label' => 'Code'],
            ['value' => 'fa-chart-pie', 'label' => 'Chart Pie'],
            ['value' => 'fa-chart-bar', 'label' => 'Chart Bar'],
            ['value' => 'fa-chart-area', 'label' => 'Chart Area'],
            ['value' => 'fa-wallet', 'label' => 'Wallet'],
            ['value' => 'fa-credit-card', 'label' => 'Credit Card'],
            ['value' => 'fa-money-bill', 'label' => 'Money Bill'],
            ['value' => 'fa-piggy-bank', 'label' => 'Piggy Bank'],
        ];
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

        $parentId = $this->request->getPost('parent_id');
        $nextOrder = $this->moduleModel->getNextSortOrder($parentId);

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
            'is_category' => 'permit_empty|in_list[0,1]',
            'create_permissions' => 'permit_empty|in_list[0,1]'
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

        $existing = $this->moduleModel->where('slug', $slug)->first();
        if ($existing) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => ['slug' => 'A module with this slug already exists. Please use a different name.']
            ]);
        }

        $parentId = $this->request->getPost('parent_id');
        if ($parentId === '' || $parentId === null || $parentId === 'null') {
            $parentId = null;
        }

        $isCategory = $this->request->getPost('is_category') ?? 0;
        $createPermissions = $this->request->getPost('create_permissions') ?? 1;

        if ($isCategory == 1) {
            $parentId = null;
        }

        $sortOrder = $this->moduleModel->getNextSortOrder($parentId);

        $data = [
            'name' => $name,
            'slug' => $slug,
            'parent_id' => $parentId,
            'icon' => $this->request->getPost('icon') ?: ($isCategory == 1 ? 'fa-folder' : 'fa-cube'),
            'description' => $this->request->getPost('description') ?: '',
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
                $permissionsMessage = $permissionsCreated ? '5 default permissions created!' : 'Failed to create permissions.';
                if ($permissionsCreated) {
                    $permissions = [
                        $moduleSlug . '_view',
                        $moduleSlug . '_add',
                        $moduleSlug . '_edit',
                        $moduleSlug . '_delete',
                        $moduleSlug . '_manage'
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
            
            $actions = ['view', 'add', 'edit', 'delete', 'manage'];
            $permissions = [];
            
            foreach ($actions as $action) {
                $permissions[] = [
                    'name' => ucfirst($action) . ' ' . $moduleName,
                    'slug' => $moduleSlug . '_' . $action,
                    'module' => $moduleSlug,
                    'description' => 'Can ' . $action . ' ' . $moduleName . ' items',
                    'is_active' => 1
                ];
            }

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

            if ($inserted > 0) {
                $superAdminId = $db->table('roles')
                    ->where('slug', 'super_admin')
                    ->get()
                    ->getRow()
                    ->role_id ?? null;
                
                if ($superAdminId) {
                    $permissionIds = $db->table('permissions')
                        ->where('module', $moduleSlug)
                        ->select('permission_id')
                        ->get()
                        ->getResultArray();
                    
                    $rolePermissions = [];
                    foreach ($permissionIds as $perm) {
                        $rolePermissions[] = [
                            'role_id' => $superAdminId,
                            'permission_id' => $perm['permission_id']
                        ];
                    }
                    
                    if (!empty($rolePermissions)) {
                        $db->table('role_permissions')->insertBatch($rolePermissions);
                    }
                }
            }

            return $inserted > 0;
        } catch (\Exception $e) {
            log_message('error', 'Error creating default permissions: ' . $e->getMessage());
            return false;
        }
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
        if ($parentId === '' || $parentId === null || $parentId === 'null') {
            $parentId = null;
        }

        $isCategory = $this->request->getPost('is_category') ?? 0;
        if ($isCategory == 1) {
            $parentId = null;
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'slug' => $this->request->getPost('slug'),
            'parent_id' => $parentId,
            'icon' => $this->request->getPost('icon') ?: ($isCategory == 1 ? 'fa-folder' : 'fa-cube'),
            'description' => $this->request->getPost('description') ?: '',
            'is_active' => $this->request->getPost('is_active') ?? 1,
            'is_category' => $isCategory,
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
    // Check if user has permission
    if (!$this->hasPermission('modules_manage')) {
        return $this->response->setJSON([
            'status' => 'error', 
            'message' => 'Permission denied'
        ]);
    }

    if (!$module_id) {
        return $this->response->setJSON([
            'status' => 'error', 
            'message' => 'Module ID is required'
        ]);
    }

    // Get the module
    $module = $this->moduleModel->where('module_id', $module_id)->first();
    if (!$module) {
        return $this->response->setJSON([
            'status' => 'error', 
            'message' => 'Module not found'
        ]);
    }

    // Check if module has children
    $children = $this->moduleModel->where('parent_id', $module_id)->countAllResults();
    if ($children > 0) {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Cannot delete a category that has sub-modules. Delete or reassign sub-modules first.'
        ]);
    }

    try {
        // Delete permissions for this module
        $this->permissionModel->where('module', $module['slug'])->delete();

        // Delete the module
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
    } catch (\Exception $e) {
        log_message('error', 'Delete error: ' . $e->getMessage());
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Database error: ' . $e->getMessage()
        ]);
    }
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

    public function getSubModules($parent_id = null)
    {
        if (!$this->hasPermission('modules_manage')) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Permission denied']);
        }

        $modules = $this->moduleModel
            ->where('parent_id', $parent_id)
            ->where('is_active', 1)
            ->orderBy('sort_order', 'ASC')
            ->findAll();

        return $this->response->setJSON([
            'status' => 'success',
            'data' => $modules,
            'csrf_token' => csrf_hash()
        ]);
    }

    public function debugCategories()
    {
        try {
            $db = \Config\Database::connect();
            $query = $db->query("SELECT * FROM modules WHERE is_category = 1 ORDER BY name ASC");
            $categories = $query->getResultArray();
            $countQuery = $db->query("SELECT COUNT(*) as count FROM modules WHERE is_category = 1");
            $count = $countQuery->getRow()->count ?? 0;
            
            return $this->response->setJSON([
                'status' => 'success',
                'total_categories' => $count,
                'categories' => $categories,
                'columns' => !empty($categories) ? array_keys($categories[0]) : []
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }
}