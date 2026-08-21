<?php
// app/Controllers/Admin/Dashboard.php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        // Check if user can view dashboard
        if (!$this->hasPermission('dashboard_view')) {
            return redirect()->to($this->getDashboardUrl())->with('error', 'You do not have permission to access the dashboard.');
        }

        // Get stats based on permissions
        $stats = $this->getDashboardStats();

        $data = [
            'page_title' => 'Dashboard',
            'breadcrumb' => 'Overview',
            'stats' => $stats
        ];

        return $this->renderAdmin('admin/dashboard', $data);
    }

    private function getDashboardStats()
    {
        $stats = [];
        $db = \Config\Database::connect();

        // Get user count if user has permission
        if ($this->hasModulePermission('users', 'view')) {
            $stats['users'] = $db->table('users')->countAll();
        }

        // Get content count if user has permission
        if ($this->hasModulePermission('content', 'view')) {
            $stats['content'] = $db->table('content')->countAll();
        }

        // Get report count if user has permission
        if ($this->hasModulePermission('reports', 'view')) {
            $stats['reports'] = $db->table('reports')->countAll();
        }

        // Get analytics count if user has permission
        if ($this->hasModulePermission('analytics', 'view')) {
            $stats['analytics'] = $db->table('analytics')->countAll();
        }

        return $stats;
    }
}