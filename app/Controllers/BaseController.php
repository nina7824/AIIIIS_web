<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = ['form', 'url', 'html', 'permission', 'admin_menu'];

    /**
     * @var \App\Libraries\PermissionManager
     */
    protected $permissionManager;

    /**
     * @var array Current user data
     */
    protected $currentUser = null;

    /**
     * @var array Current user permissions
     */
    protected $userPermissions = [];

    /**
     * @var array Accessible menus for current user
     */
    protected $userMenus = [];

    /**
     * @var int Current user role ID
     */
    protected $userRoleId = null;

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        // Load permission manager
        $this->permissionManager = new \App\Libraries\PermissionManager();

        // Load current user
        $this->loadCurrentUser();

        // Load user permissions
        $this->loadUserPermissions();

        // Load user role ID
        $this->loadUserRoleId();

        // Load user menus
        $this->loadUserMenus();

        // Share user data with all views
        $this->shareUserData();
    }

    /**
     * Load current user from session
     */
    protected function loadCurrentUser()
    {
        if (session()->get('isLoggedIn')) {
            $this->currentUser = [
                'user_id' => session()->get('user_id'),
                'name' => session()->get('name'),
                'email' => session()->get('email'),
                'role' => session()->get('role'),
                'phone' => session()->get('phone'),
                'profile_image' => session()->get('profile_image'),
                'is_active' => session()->get('is_active'),
                'is_verified' => session()->get('is_verified'),
                'theme_preference' => session()->get('theme_preference') ?? 'light',
                'isLoggedIn' => true
            ];
        }
    }

    /**
     * Load user role ID
     */
    protected function loadUserRoleId()
    {
        if ($this->currentUser && isset($this->currentUser['role'])) {
            $db = \Config\Database::connect();
            $roleData = $db->table('roles')
                ->where('slug', $this->currentUser['role'])
                ->get()
                ->getRow();
            
            $this->userRoleId = $roleData ? $roleData->role_id : null;
        }
    }

    /**
     * Load user permissions
     */
  protected function loadUserPermissions()
{
    if ($this->currentUser) {
        $this->userPermissions = $this->permissionManager->getUserPermissions($this->currentUser['user_id']);
        
        // Store permissions in session for use in helpers
        session()->set('permissions', $this->userPermissions);
    }
}

    /**
     * Load user menus based on role from database
     */
 protected function loadUserMenus()
{
    if ($this->currentUser) {
        // Load admin menu helper if not already loaded
        helper('admin_menu');
        
        // Add permissions to the user data
        $userData = $this->currentUser;
        $userData['permissions'] = $this->userPermissions;
        
        // Pass the user data with permissions to get_admin_menu
        $this->userMenus = get_admin_menu($userData);
    } else {
        $this->userMenus = [];
    }
}

    /**
     * Share user data with all views
     */
    protected function shareUserData()
    {
        $view = \Config\Services::renderer();
        
        $view->setData([
            'currentUser' => $this->currentUser,
            'userPermissions' => $this->userPermissions,
            'userMenus' => $this->userMenus,
            'menus' => $this->userMenus,
            'isSuperAdmin' => $this->isSuperAdmin(),
            'notificationCount' => $this->getNotificationCount(),
            'isLoggedIn' => session()->get('isLoggedIn') ?? false,
            'userRole' => $this->currentUser['role'] ?? null,
            'userName' => $this->currentUser['name'] ?? 'User',
            'themePreference' => $this->currentUser['theme_preference'] ?? 'light',
            'userRoleId' => $this->userRoleId
        ]);
    }

    /**
     * Check if current user has a specific permission
     */
    protected function hasPermission($permissionSlug)
    {
        if (!$this->currentUser) {
            return false;
        }

        // Super Admin bypass
        if ($this->isSuperAdmin()) {
            return true;
        }

        // Check if user has the specific permission
        return in_array($permissionSlug, $this->userPermissions);
    }

    /**
     * Check if current user has module permission
     */
    protected function hasModulePermission($module, $action)
    {
        $permissionSlug = $module . '_' . $action;
        return $this->hasPermission($permissionSlug);
    }

    /**
     * Check if user has permission for a specific menu action
     */
    protected function hasMenuPermission($menuId, $action = 'view')
    {
        if (!$this->userRoleId) {
            return false;
        }
        
        // Super Admin bypass
        if ($this->isSuperAdmin()) {
            return true;
        }
        
        // Load the helper if needed
        if (!function_exists('has_menu_permission')) {
            require_once APPPATH . 'Helpers/menu_helper.php';
        }
        
        if (function_exists('has_menu_permission')) {
            return has_menu_permission($this->userRoleId, $menuId, $action);
        }
        
        return false;
    }

    /**
     * Check if user is super admin
     */
    protected function isSuperAdmin()
    {
        if (!$this->currentUser) {
            return false;
        }

        // Check if user has super_admin role from roles table
        try {
            $userRoleModel = new \App\Models\UserRoleModel();
            $roles = $userRoleModel->getRolesForUser($this->currentUser['user_id']);
            
            foreach ($roles as $role) {
                if ($role['slug'] === 'super_admin') {
                    return true;
                }
            }
        } catch (\Exception $e) {
            // If UserRoleModel doesn't exist, fallback to role field
            log_message('debug', 'UserRoleModel not available: ' . $e->getMessage());
        }
        
        // Also check direct role field
        if ($this->currentUser['role'] === 'administrator' || $this->currentUser['role'] === 'super_admin') {
            return true;
        }
        
        return false;
    }

    /**
     * Require permission or redirect
     */
    protected function requirePermission($permissionSlug, $redirectUrl = null)
    {
        if (!$this->hasPermission($permissionSlug)) {
            $redirectUrl = $redirectUrl ?? $this->getDashboardUrl();
            return redirect()->to($redirectUrl)->with('error', 'You do not have permission to access this page.');
        }
        return true;
    }

    /**
     * Require module permission or redirect
     */
    protected function requireModulePermission($module, $action, $redirectUrl = null)
    {
        $permissionSlug = $module . '_' . $action;
        return $this->requirePermission($permissionSlug, $redirectUrl);
    }

    /**
     * Require menu permission or redirect
     */
    protected function requireMenuPermission($menuId, $action = 'view', $redirectUrl = null)
    {
        if (!$this->hasMenuPermission($menuId, $action)) {
            $redirectUrl = $redirectUrl ?? $this->getDashboardUrl();
            return redirect()->to($redirectUrl)->with('error', 'You do not have permission to access this page.');
        }
        return true;
    }

    /**
     * Get dashboard URL based on user role and permissions
     * ALL USERS GO TO THE SAME DASHBOARD
     */
    protected function getDashboardUrl()
    {
        if (!$this->currentUser) {
            return '/login';
        }

        // All users go to the same dashboard
        // Role-based content is handled by the dashboard view itself
        return '/dashboard';
    }

    /**
     * Get dashboard URL by role (for redirect after login)
     * ALL USERS GO TO THE SAME DASHBOARD
     */
    protected function getDashboardUrlByRole($role)
    {
        // All users go to the same dashboard
        // Role-based content is handled by the dashboard view itself
        return '/dashboard';
    }

    /**
     * Render view with common data
     */
    protected function render($view, $data = [])
    {
        $commonData = [
            'currentUser' => $this->currentUser,
            'userPermissions' => $this->userPermissions,
            'userMenus' => $this->userMenus,
            'menus' => $this->userMenus,
            'isSuperAdmin' => $this->isSuperAdmin(),
            'notificationCount' => $this->getNotificationCount(),
            'isLoggedIn' => session()->get('isLoggedIn') ?? false,
            'userRole' => $this->currentUser['role'] ?? null,
            'userName' => $this->currentUser['name'] ?? 'User',
            'themePreference' => $this->currentUser['theme_preference'] ?? 'light',
            'userRoleId' => $this->userRoleId
        ];

        return view($view, array_merge($data, $commonData));
    }

    /**
     * Render admin layout with menus
     */
    protected function renderAdmin($view, $data = [])
    {
        // Ensure user data is available
        $userData = [
            'user_id' => $this->currentUser['user_id'] ?? null,
            'name' => $this->currentUser['name'] ?? 'User',
            'email' => $this->currentUser['email'] ?? null,
            'role' => $this->currentUser['role'] ?? 'user',
            'phone' => $this->currentUser['phone'] ?? null,
            'profile_image' => $this->currentUser['profile_image'] ?? null,
            'is_active' => $this->currentUser['is_active'] ?? 1,
            'is_verified' => $this->currentUser['is_verified'] ?? 0,
            'theme_preference' => $this->currentUser['theme_preference'] ?? 'light',
            'role_id' => $this->userRoleId
        ];

        $commonData = [
            'currentUser' => $this->currentUser,
            'user' => $userData,
            'userPermissions' => $this->userPermissions,
            'userMenus' => $this->userMenus,
            'menus' => $this->userMenus,
            'isSuperAdmin' => $this->isSuperAdmin(),
            'notificationCount' => $this->getNotificationCount(),
            'isLoggedIn' => session()->get('isLoggedIn') ?? false,
            'userRole' => $this->currentUser['role'] ?? null,
            'userName' => $this->currentUser['name'] ?? 'User',
            'themePreference' => $this->currentUser['theme_preference'] ?? 'light',
            'userRoleId' => $this->userRoleId,
            'page_title' => $data['page_title'] ?? 'Dashboard',
            'breadcrumb' => $data['breadcrumb'] ?? null,
        ];

        return view($view, array_merge($data, $commonData));
    }

    /**
     * Get notification count
     */
    protected function getNotificationCount()
    {
        if (!$this->currentUser) {
            return 0;
        }

        try {
            // Check if NotificationModel exists
            if (class_exists('\App\Models\NotificationModel')) {
                $notificationModel = new \App\Models\NotificationModel();
                return $notificationModel->where('user_id', $this->currentUser['user_id'])
                    ->where('is_read', 0)
                    ->countAllResults();
            }
        } catch (\Exception $e) {
            // Log error but don't break the application
            log_message('debug', 'NotificationModel not available: ' . $e->getMessage());
        }
        
        return 0;
    }

    /**
     * Generate random password
     */
    protected function generateRandomPassword($length = 12)
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%';
        $password = '';
        for ($i = 0; $i < $length; $i++) {
            $password .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $password;
    }

    /**
     * Check if user has any of the given permissions
     */
    protected function hasAnyPermission($permissions)
    {
        if (!is_array($permissions)) {
            $permissions = [$permissions];
        }

        foreach ($permissions as $permission) {
            if ($this->hasPermission($permission)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Check if user has all of the given permissions
     */
    protected function hasAllPermissions($permissions)
    {
        if (!is_array($permissions)) {
            $permissions = [$permissions];
        }

        foreach ($permissions as $permission) {
            if (!$this->hasPermission($permission)) {
                return false;
            }
        }

        return true;
    }
}