<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Enterprise extends BaseController  // ← Must be 'Enterprise', not 'Investor'
{
    public function index()
    {
        // Check if user is logged in and is admin
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'administrator') {
            return redirect()->to('/login');
        }

        $db = \Config\Database::connect();
        
        // Get all enterprises
        $enterprises = $db->table('enterprises')
            ->orderBy('created_at', 'DESC')
            ->get()
            ->getResultArray();

        // Get sectors for filter
        $sectors = $db->query("SELECT DISTINCT sector FROM enterprises WHERE sector IS NOT NULL AND sector != '' ORDER BY sector")->getResultArray();
        $locations = $db->query("SELECT DISTINCT location FROM enterprises WHERE location IS NOT NULL AND location != '' ORDER BY location")->getResultArray();

        $data = [
            'title' => 'Enterprise Management — AIIIIS',
            'page_title' => 'Enterprise Management',
            'breadcrumb' => 'Enterprises',
            'user' => [
                'name' => session()->get('name'),
                'role' => session()->get('role'),
                'email' => session()->get('email'),
                'user_id' => session()->get('user_id')
            ],
            'enterprises' => $enterprises,
            'sectors' => $sectors,
            'locations' => $locations
        ];

        return view('admin/enterprises', $data);
    }

    public function getEnterprise($id)
    {
        // Check if user is logged in and is admin
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'administrator') {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }

        $db = \Config\Database::connect();
        $enterprise = $db->table('enterprises')->where('enterprise_id', $id)->get()->getRowArray();

        if ($enterprise) {
            return $this->response->setJSON(['success' => true, 'data' => $enterprise]);
        }

        return $this->response->setJSON(['success' => false, 'message' => 'Enterprise not found']);
    }

    public function store()
    {
        // Check if user is logged in and is admin
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'administrator') {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }

        $db = \Config\Database::connect();

        $data = [
            'user_id' => $this->request->getPost('user_id') ?: null,
            'name' => $this->request->getPost('name'),
            'registration_number' => $this->request->getPost('registration_number'),
            'sector' => $this->request->getPost('sector'),
            'sub_sector' => $this->request->getPost('sub_sector'),
            'location' => $this->request->getPost('location'),
            'latitude' => $this->request->getPost('latitude'),
            'longitude' => $this->request->getPost('longitude'),
            'contact_person' => $this->request->getPost('contact_person'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
            'website' => $this->request->getPost('website'),
            'products_services' => $this->request->getPost('products_services'),
            'employees' => $this->request->getPost('employees') ?: 0,
            'revenue' => $this->request->getPost('revenue') ?: 0,
            'investment_requirements' => $this->request->getPost('investment_requirements'),
            'is_verified' => $this->request->getPost('is_verified') ? 1 : 0,
            'status' => $this->request->getPost('status') ?: 'pending',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        if ($db->table('enterprises')->insert($data)) {
            $id = $db->insertID();
            return $this->response->setJSON(['success' => true, 'message' => 'Enterprise created successfully!', 'id' => $id]);
        }

        return $this->response->setJSON(['success' => false, 'message' => 'Failed to create enterprise']);
    }

    public function update($id)
    {
        // Check if user is logged in and is admin
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'administrator') {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }

        $db = \Config\Database::connect();

        $data = [
            'user_id' => $this->request->getPost('user_id') ?: null,
            'name' => $this->request->getPost('name'),
            'registration_number' => $this->request->getPost('registration_number'),
            'sector' => $this->request->getPost('sector'),
            'sub_sector' => $this->request->getPost('sub_sector'),
            'location' => $this->request->getPost('location'),
            'latitude' => $this->request->getPost('latitude'),
            'longitude' => $this->request->getPost('longitude'),
            'contact_person' => $this->request->getPost('contact_person'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
            'website' => $this->request->getPost('website'),
            'products_services' => $this->request->getPost('products_services'),
            'employees' => $this->request->getPost('employees') ?: 0,
            'revenue' => $this->request->getPost('revenue') ?: 0,
            'investment_requirements' => $this->request->getPost('investment_requirements'),
            'is_verified' => $this->request->getPost('is_verified') ? 1 : 0,
            'status' => $this->request->getPost('status') ?: 'pending',
            'updated_at' => date('Y-m-d H:i:s')
        ];

        if ($db->table('enterprises')->where('enterprise_id', $id)->update($data)) {
            return $this->response->setJSON(['success' => true, 'message' => 'Enterprise updated successfully!']);
        }

        return $this->response->setJSON(['success' => false, 'message' => 'Failed to update enterprise']);
    }

    public function delete($id)
    {
        // Check if user is logged in and is admin
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'administrator') {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }

        $db = \Config\Database::connect();
        
        if ($db->table('enterprises')->where('enterprise_id', $id)->delete()) {
            return $this->response->setJSON(['success' => true, 'message' => 'Enterprise deleted successfully!']);
        }

        return $this->response->setJSON(['success' => false, 'message' => 'Failed to delete enterprise']);
    }
}