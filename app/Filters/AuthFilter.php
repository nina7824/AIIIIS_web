<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthFilter implements FilterInterface
{
    /**
     * Before filter - checks if user is authenticated and active
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        // Check if user is logged in
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Please login to access this page.');
        }

        // Get user data from session
        $userId = session()->get('user_id');
        $isActive = session()->get('is_active');
        $isVerified = session()->get('is_verified');
        $role = session()->get('role');

        // Check if user exists in session
        if (!$userId) {
            session()->destroy();
            return redirect()->to('/login')->with('error', 'Session expired. Please login again.');
        }

        // Check if user is active
        if ($isActive === false || $isActive === 0) {
            session()->destroy();
            return redirect()->to('/login')->with('error', 'Your account has been deactivated. Please contact support.');
        }

        // Get current route
        $route = $request->getPath();
        $route = trim($route, '/');

        // Routes that don't require email verification
        $publicRoutes = [
            'login',
            'register',
            'authenticate',
            'createAccount',
            'logout',
            'forgot-password',
            'reset-password',
            'verify-email',
            'resend-verification',
            'change-password',
            'update-password'
        ];

        // Skip verification check for public routes
        if (in_array($route, $publicRoutes)) {
            return;
        }

        // Check if user is verified (skip for certain routes)
        $verifyRoutes = ['verify-email', 'resend-verification'];
        
        if (($isVerified === false || $isVerified === 0) && !in_array($route, $verifyRoutes)) {
            return redirect()->to('/verify-email')->with('error', 'Please verify your email address first.');
        }

        // If user is admin, allow all access
        $adminRoles = ['administrator', 'super_admin'];
        if (in_array($role, $adminRoles)) {
            return;
        }

        // Additional role-based checks can be added here
        // For example, check if user has specific role for certain routes
    }

    /**
     * After filter - does nothing
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing
    }
}