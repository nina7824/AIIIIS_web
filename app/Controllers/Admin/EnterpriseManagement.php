<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\EnterpriseModel;
use App\Models\SectorModel;
use App\Models\UserModel;

class EnterpriseManagement extends BaseController
{
    protected $enterpriseModel;
    protected $sectorModel;
    protected $userModel;

    public function __construct()
    {
        $this->enterpriseModel = new EnterpriseModel();
        $this->sectorModel = new SectorModel();
        $this->userModel = new UserModel();
    }

    /**
     * Check if current user is super admin
     * Changed from private to protected to match parent class
     */
    protected function isSuperAdmin()
    {
        $session = session();
        $role = $session->get('role') ?? '';
        $superAdminRoles = ['super_admin', 'Super Admin', 'Administrator', 'admin'];
        return in_array(strtolower($role), array_map('strtolower', $superAdminRoles));
    }

    public function index()
    {
        // Allow super admin without checking permission
        if (!$this->isSuperAdmin() && !$this->hasPermission('enterprises_view')) {
            return redirect()->to('/dashboard')->with('error', 'You do not have permission to view enterprises.');
        }

        // Get stats
        $totalEnterprises = $this->enterpriseModel->countAll();
        $activeEnterprises = $this->enterpriseModel->where('is_active', 1)->countAllResults();
        $pendingVerifications = $this->enterpriseModel->where('is_verified', 0)->countAllResults();

        $data = [
            'page_title' => 'Enterprise Management',
            'breadcrumb' => 'Enterprises',
            'total_enterprises' => $totalEnterprises,
            'active_enterprises' => $activeEnterprises,
            'pending_verifications' => $pendingVerifications,
            'stats' => [
                'total_enterprises' => $totalEnterprises,
                'active_enterprises' => $activeEnterprises,
                'pending_verifications' => $pendingVerifications,
            ]
        ];

        return $this->renderAdmin('admin/enterprises/index', $data);
    }

    public function getData()
    {
        // Allow super admin without checking permission
        if (!$this->isSuperAdmin() && !$this->hasPermission('enterprises_view')) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Permission denied']);
        }

        $page = (int) $this->request->getGet('page') ?: 1;
        $perPage = (int) $this->request->getGet('per_page') ?: 25;
        $search = $this->request->getGet('search') ?: '';
        $sortField = $this->request->getGet('sort') ?: 'enterprise_id';
        $sortDirection = $this->request->getGet('direction') ?: 'desc';

        $db = \Config\Database::connect();
        $builder = $db->table('enterprises e');
        $builder->select('e.*, s.name as sector_name');
        $builder->join('sectors s', 's.sector_id = e.sector_id', 'left');

        if (!empty($search)) {
            $builder->groupStart()
                ->like('e.enterprise_name', $search)
                ->orLike('e.name', $search)
                ->orLike('e.email', $search)
                ->orLike('e.location', $search)
                ->orLike('e.contact_person', $search)
                ->orLike('s.name', $search)
            ->groupEnd();
        }

        $countBuilder = clone $builder;
        $total = $countBuilder->countAllResults();

        $allowedSorts = ['enterprise_id', 'enterprise_name', 'name', 'email', 'location', 'is_active', 'is_verified', 'created_at'];
        if (in_array($sortField, $allowedSorts)) {
            $builder->orderBy($sortField, $sortDirection);
        } else {
            $builder->orderBy('enterprise_id', 'desc');
        }

        $offset = ($page - 1) * $perPage;
        $builder->limit($perPage, $offset);

        $enterprises = $builder->get()->getResultArray();

        // Get cluster count for each enterprise
        foreach ($enterprises as &$enterprise) {
            $clusterCount = $db->table('enterprise_clusters')
                ->where('enterprise_id', $enterprise['enterprise_id'])
                ->countAllResults();
            $enterprise['cluster_count'] = $clusterCount;
            
            // Ensure enterprise_name is set (fallback to name if needed)
            if (empty($enterprise['enterprise_name']) && !empty($enterprise['name'])) {
                $enterprise['enterprise_name'] = $enterprise['name'];
            }
        }

        return $this->response->setJSON([
            'status' => 'success',
            'data' => $enterprises,
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

    public function get($enterpriseId = null)
    {
        if (!$this->isSuperAdmin() && !$this->hasPermission('enterprises_view')) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Permission denied']);
        }

        if (!$enterpriseId) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Enterprise ID required']);
        }

        $db = \Config\Database::connect();
        $builder = $db->table('enterprises e');
        $builder->select('e.*, s.name as sector_name');
        $builder->join('sectors s', 's.sector_id = e.sector_id', 'left');
        $builder->where('e.enterprise_id', $enterpriseId);
        $enterprise = $builder->get()->getRowArray();

        if (!$enterprise) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Enterprise not found']);
        }

        // Ensure enterprise_name is set
        if (empty($enterprise['enterprise_name']) && !empty($enterprise['name'])) {
            $enterprise['enterprise_name'] = $enterprise['name'];
        }

        return $this->response->setJSON([
            'status' => 'success',
            'data' => $enterprise,
            'csrf_token' => csrf_hash()
        ]);
    }

    public function getStats()
    {
        if (!$this->isSuperAdmin() && !$this->hasPermission('enterprises_view')) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Permission denied']);
        }

        $total = $this->enterpriseModel->countAll();
        $active = $this->enterpriseModel->where('is_active', 1)->countAllResults();
        $pending = $this->enterpriseModel->where('is_verified', 0)->countAllResults();

        return $this->response->setJSON([
            'status' => 'success',
            'data' => [
                'total' => $total,
                'active' => $active,
                'pending' => $pending
            ],
            'csrf_token' => csrf_hash()
        ]);
    }

    public function getSectors()
    {
        if (!$this->isSuperAdmin() && !$this->hasPermission('enterprises_view')) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Permission denied']);
        }

        $sectors = $this->sectorModel->where('is_active', 1)->orderBy('name', 'ASC')->findAll();

        return $this->response->setJSON([
            'status' => 'success',
            'data' => $sectors,
            'csrf_token' => csrf_hash()
        ]);
    }

    public function create()
    {
        if (!$this->isSuperAdmin() && !$this->hasPermission('enterprises_add')) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Permission denied']);
        }

        $rules = [
            'enterprise_name' => 'required|min_length[3]|max_length[200]',
            'email' => 'required|valid_email|is_unique[enterprises.email]',
            'phone' => 'permit_empty|max_length[20]',
            'location' => 'permit_empty|max_length[100]',
            'sector_id' => 'permit_empty|is_natural',
            'description' => 'permit_empty|max_length[1000]',
            'website' => 'permit_empty|valid_url|max_length[200]',
            'user_id' => 'permit_empty|is_natural',
            'is_active' => 'permit_empty|in_list[0,1]',
            'is_verified' => 'permit_empty|in_list[0,1]'
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $this->validator->getErrors()
            ]);
        }

        $data = [
            'enterprise_name' => $this->request->getPost('enterprise_name'),
            'name' => $this->request->getPost('enterprise_name'), // Also set name field
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
            'location' => $this->request->getPost('location'),
            'sector_id' => $this->request->getPost('sector_id') ?: null,
            'description' => $this->request->getPost('description'),
            'website' => $this->request->getPost('website'),
            'user_id' => $this->request->getPost('user_id') ?: null,
            'is_active' => $this->request->getPost('is_active') ?? 1,
            'is_verified' => $this->request->getPost('is_verified') ?? 0,
        ];

        if ($this->enterpriseModel->save($data)) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Enterprise created successfully!',
                'csrf_token' => csrf_hash()
            ]);
        }

        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Failed to create enterprise'
        ]);
    }

    public function update($enterpriseId = null)
    {
        if (!$this->isSuperAdmin() && !$this->hasPermission('enterprises_edit')) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Permission denied']);
        }

        if (!$enterpriseId) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Enterprise ID required']);
        }

        $enterprise = $this->enterpriseModel->where('enterprise_id', $enterpriseId)->first();
        if (!$enterprise) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Enterprise not found']);
        }

        $rules = [
            'enterprise_name' => 'required|min_length[3]|max_length[200]',
            'email' => 'required|valid_email|is_unique[enterprises.email,enterprise_id,' . $enterpriseId . ']',
            'phone' => 'permit_empty|max_length[20]',
            'location' => 'permit_empty|max_length[100]',
            'sector_id' => 'permit_empty|is_natural',
            'description' => 'permit_empty|max_length[1000]',
            'website' => 'permit_empty|valid_url|max_length[200]',
            'user_id' => 'permit_empty|is_natural',
            'is_active' => 'permit_empty|in_list[0,1]',
            'is_verified' => 'permit_empty|in_list[0,1]'
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $this->validator->getErrors()
            ]);
        }

        $data = [
            'enterprise_name' => $this->request->getPost('enterprise_name'),
            'name' => $this->request->getPost('enterprise_name'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
            'location' => $this->request->getPost('location'),
            'sector_id' => $this->request->getPost('sector_id') ?: null,
            'description' => $this->request->getPost('description'),
            'website' => $this->request->getPost('website'),
            'user_id' => $this->request->getPost('user_id') ?: null,
            'is_active' => $this->request->getPost('is_active') ?? 1,
            'is_verified' => $this->request->getPost('is_verified') ?? 0
        ];

        if ($this->enterpriseModel->where('enterprise_id', $enterpriseId)->set($data)->update()) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Enterprise updated successfully!',
                'csrf_token' => csrf_hash()
            ]);
        }

        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Failed to update enterprise'
        ]);
    }

    public function delete($enterpriseId = null)
    {
        if (!$this->isSuperAdmin() && !$this->hasPermission('enterprises_delete')) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Permission denied']);
        }

        if (!$enterpriseId) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Enterprise ID required']);
        }

        $enterprise = $this->enterpriseModel->where('enterprise_id', $enterpriseId)->first();
        if (!$enterprise) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Enterprise not found']);
        }

        // Check if enterprise has clusters
        $db = \Config\Database::connect();
        $clusterCount = $db->table('enterprise_clusters')
            ->where('enterprise_id', $enterpriseId)
            ->countAllResults();

        if ($clusterCount > 0) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Cannot delete enterprise with assigned clusters. Remove clusters first.'
            ]);
        }

        if ($this->enterpriseModel->where('enterprise_id', $enterpriseId)->delete()) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Enterprise deleted successfully!',
                'csrf_token' => csrf_hash()
            ]);
        }

        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Failed to delete enterprise'
        ]);
    }

    public function toggleStatus($enterpriseId = null)
    {
        if (!$this->isSuperAdmin() && !$this->hasPermission('enterprises_edit')) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Permission denied']);
        }

        if (!$enterpriseId) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Enterprise ID required']);
        }

        $enterprise = $this->enterpriseModel->where('enterprise_id', $enterpriseId)->first();
        if (!$enterprise) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Enterprise not found']);
        }

        $newStatus = $enterprise['is_active'] == 1 ? 0 : 1;
        if ($this->enterpriseModel->where('enterprise_id', $enterpriseId)->set(['is_active' => $newStatus])->update()) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => $newStatus ? 'Enterprise activated!' : 'Enterprise deactivated!',
                'is_active' => $newStatus,
                'csrf_token' => csrf_hash()
            ]);
        }

        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Failed to update status'
        ]);
    }

    public function verify($enterpriseId = null)
    {
        if (!$this->isSuperAdmin() && !$this->hasPermission('enterprises_verify')) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Permission denied']);
        }

        if (!$enterpriseId) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Enterprise ID required']);
        }

        $enterprise = $this->enterpriseModel->where('enterprise_id', $enterpriseId)->first();
        if (!$enterprise) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Enterprise not found']);
        }

        $newStatus = $enterprise['is_verified'] == 1 ? 0 : 1;
        if ($this->enterpriseModel->where('enterprise_id', $enterpriseId)->set(['is_verified' => $newStatus])->update()) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => $newStatus ? 'Enterprise verified!' : 'Enterprise unverified!',
                'is_verified' => $newStatus,
                'csrf_token' => csrf_hash()
            ]);
        }

        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Failed to update verification status'
        ]);
    }
}