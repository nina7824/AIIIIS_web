<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class RoleFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Check if user is logged in
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Please login to access this page.');
        }

        // Get allowed roles from arguments
        $allowedRoles = $arguments ?? [];
        
        if (empty($allowedRoles)) {
            return;
        }

        $userRole = session()->get('role');
        $userRoles = session()->get('roles') ?? [];

        // Check if user has any of the allowed roles
        $hasRole = false;
        foreach ($userRoles as $role) {
            if (in_array($role['slug'], $allowedRoles)) {
                $hasRole = true;
                break;
            }
        }

        // Also check the legacy role field
        if (!$hasRole && in_array($userRole, $allowedRoles)) {
            $hasRole = true;
        }

        if (!$hasRole) {
            $dashboardUrl = $this->getDashboardUrl($userRole);
            return redirect()->to($dashboardUrl)->with('error', 'You do not have the required role to access this page.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing
    }

    private function getDashboardUrl($role)
    {
        $roleUrls = [
            'super_admin' => '/admin/dashboard',
            'administrator' => '/admin/dashboard',
            'nirda_expert' => '/expert/dashboard',
            'enterprise' => '/enterprise/dashboard',
            'investor' => '/investor/dashboard',
            'government' => '/government/dashboard',
            'analyst' => '/analyst/dashboard'
        ];

        return $roleUrls[$role] ?? '/dashboard';
    }
}