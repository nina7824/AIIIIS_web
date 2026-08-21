<?php
// app/Filters/PermissionFilter.php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class PermissionFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Get user data from session
        $userId = session()->get('user_id');
        $role = session()->get('role');
        
        // If not logged in, redirect to login
        if (!$userId) {
            return redirect()->to('/login')->with('error', 'Please login first.');
        }

        // SUPER ADMIN - Bypass ALL permission checks
        if ($role === 'super_admin') {
            return; // Allow access to everything
        }

        // ADMINISTRATOR - Bypass most permission checks
        if ($role === 'administrator') {
            // Check if specific permission is required
            $permission = $arguments[0] ?? null;
            if ($permission) {
                // For administrators, check if they have the permission
                if (!$this->hasPermission($userId, $permission)) {
                    // If they don't have the specific permission, allow them anyway
                    // (administrators have access to most things)
                    return;
                }
            }
            return; // Allow access
        }

        // For other roles, check permissions
        $permission = $arguments[0] ?? null;
        if ($permission) {
            if (!$this->hasPermission($userId, $permission)) {
                return redirect()->to('/dashboard')->with('error', 'You do not have permission to access this page.');
            }
        }

        return;
    }

    private function hasPermission($userId, $permissionSlug)
    {
        $db = \Config\Database::connect();
        
        // Check if user has the permission through their roles
        $builder = $db->table('user_roles ur');
        $builder->select('role_permissions.permission_id');
        $builder->join('role_permissions', 'ur.role_id = role_permissions.role_id');
        $builder->join('permissions', 'role_permissions.permission_id = permissions.permission_id');
        $builder->where('ur.user_id', $userId);
        $builder->where('permissions.slug', $permissionSlug);
        $result = $builder->get()->getRow();
        
        return (bool) $result;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing
    }
}