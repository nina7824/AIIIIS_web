<?php

namespace Config;

use CodeIgniter\Config\Services;

$routes = Services::routes();

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

// ============================================================
// ========== PUBLIC ROUTES (No auth required) ==========
// ============================================================

// Home
$routes->get('/', 'Home::index');
$routes->get('service/(:any)', 'Home::service/$1');
$routes->post('user/update-theme', 'User::updateTheme');

// ============================================================
// ========== AUTH ROUTES ==========
// ============================================================
$routes->group('auth', function($routes) {
    $routes->get('login', 'Auth::login');
    $routes->post('authenticate', 'Auth::authenticate');
    $routes->get('logout', 'Auth::logout');
    $routes->get('register', 'Auth::register');
    $routes->post('register', 'Auth::createAccount');
});

// ============================================================
// ========== DIRECT ROUTES (Optional, for clean URLs) ==========
// ============================================================
$routes->get('login', 'Auth::login');
$routes->post('authenticate', 'Auth::authenticate');
$routes->get('logout', 'Auth::logout');
$routes->get('register', 'Auth::register');
$routes->post('register', 'Auth::createAccount');

// ============================================================
// ========== DASHBOARD ROUTES ==========
// ============================================================
$routes->get('dashboard', 'Dashboard::index');
$routes->get('dashboard/getStats', 'Dashboard::getStats');

// ============================================================
// ========== ADMIN ROUTES (Protected) ==========
// ============================================================
$routes->group('admin', ['namespace' => 'App\Controllers\Admin', 'filter' => 'permission:admin'], function($routes) {
    
    // Redirect admin/dashboard to main dashboard
    $routes->get('dashboard', function() {
        return redirect()->to('/dashboard');
    });
    
   // ============================================================
// USER MANAGEMENT
// ============================================================
$routes->group('admin/users', ['permission' => 'users_manage'], function($routes) {
    $routes->get('/', 'UserManagement::index');
    $routes->get('getData', 'UserManagement::getData');
    $routes->get('get/(:num)', 'UserManagement::get/$1');
    $routes->get('getStats', 'UserManagement::getStats');
    $routes->get('getUserPermissions/(:num)', 'UserManagement::getUserPermissions/$1');
    
    // POST endpoints for AJAX
    $routes->post('create', 'UserManagement::store');
    $routes->post('update/(:num)', 'UserManagement::update/$1');
    $routes->post('delete/(:num)', 'UserManagement::delete/$1');
    $routes->post('toggle-status/(:num)', 'UserManagement::toggleStatus/$1');
    $routes->post('updateUserPermissions/(:num)', 'UserManagement::updateUserPermissions/$1');
});
    
    // ============================================================
    // ROLE MANAGEMENT
    // ============================================================
  $routes->group('roles', ['permission' => 'roles_manage'], function($routes) {
    $routes->get('/', 'RoleManagement::index');
    $routes->get('create', 'RoleManagement::create');
    $routes->post('create', 'RoleManagement::store');
    $routes->get('edit/(:num)', 'RoleManagement::edit/$1');
    $routes->post('edit/(:num)', 'RoleManagement::update/$1');
    // Change this line from GET to POST
    $routes->post('delete/(:num)', 'RoleManagement::delete/$1');  // ← CHANGED
    $routes->get('view/(:num)', 'RoleManagement::view/$1');
    $routes->post('toggle-status/(:num)', 'RoleManagement::toggleStatus/$1');
    $routes->get('getData', 'RoleManagement::getData');
    $routes->get('get/(:num)', 'RoleManagement::get/$1');
    $routes->get('getStats', 'RoleManagement::getStats');
    $routes->get('permissions/(:num)', 'RoleManagement::permissions/$1');
    $routes->post('updatePermissions/(:num)', 'RoleManagement::updatePermissions/$1');
});
    
    // ============================================================
    // PERMISSION MANAGEMENT
    // ============================================================
    $routes->group('permissions', ['permission' => 'permissions_manage'], function($routes) {
        $routes->get('/', 'PermissionManagement::index');
        $routes->get('create', 'PermissionManagement::create');
        $routes->post('create', 'PermissionManagement::store');
        $routes->get('edit/(:num)', 'PermissionManagement::edit/$1');
        $routes->post('edit/(:num)', 'PermissionManagement::update/$1');
        $routes->get('delete/(:num)', 'PermissionManagement::delete/$1');
        $routes->post('toggle-status/(:num)', 'PermissionManagement::toggleStatus/$1');
        $routes->get('getData', 'PermissionManagement::getData');
        $routes->get('get/(:num)', 'PermissionManagement::get/$1');
        $routes->get('getStats', 'PermissionManagement::getStats');
        $routes->get('getModules', 'PermissionManagement::getModules');
    });
    
    // ============================================================
// MODULE MANAGEMENT
// ============================================================
$routes->group('modules', ['permission' => 'modules_manage'], function($routes) {
    $routes->get('/', 'ModuleManagement::index');
    $routes->get('create', 'ModuleManagement::create');
    $routes->post('create', 'ModuleManagement::store');
    $routes->get('edit/(:num)', 'ModuleManagement::edit/$1');
    $routes->post('edit/(:num)', 'ModuleManagement::update/$1');
    $routes->get('delete/(:num)', 'ModuleManagement::delete/$1');
    $routes->post('toggle-status/(:num)', 'ModuleManagement::toggleStatus/$1');
    $routes->get('getData', 'ModuleManagement::getData');
    $routes->get('get/(:num)', 'ModuleManagement::get/$1');
    $routes->get('getStats', 'ModuleManagement::getStats');
    $routes->get('getCategories', 'ModuleManagement::getCategories');
    $routes->get('getIcons', 'ModuleManagement::getIcons');
    $routes->get('debugCategories', 'ModuleManagement::debugCategories');
    $routes->get('getNextSortOrder', 'ModuleManagement::getNextSortOrder');
    $routes->post('store', 'ModuleManagement::store');
    $routes->post('update/(:num)', 'ModuleManagement::update/$1');
    $routes->post('delete/(:num)', 'ModuleManagement::delete/$1');
    $routes->post('reorder', 'ModuleManagement::reorder');
    $routes->post('update-order', 'ModuleManagement::updateOrder');
    $routes->post('generateSlug', 'ModuleManagement::generateSlug');
});
    
    // ============================================================
    // ENTERPRISE MANAGEMENT
    // ============================================================
    $routes->group('enterprises', ['permission' => 'enterprises_manage'], function($routes) {
        $routes->get('/', 'EnterpriseManagement::index');
        $routes->get('create', 'EnterpriseManagement::create');
        $routes->post('create', 'EnterpriseManagement::store');
        $routes->get('edit/(:num)', 'EnterpriseManagement::edit/$1');
        $routes->post('edit/(:num)', 'EnterpriseManagement::update/$1');
        $routes->get('delete/(:num)', 'EnterpriseManagement::delete/$1');
        $routes->get('view/(:num)', 'EnterpriseManagement::view/$1');
        $routes->post('toggle-status/(:num)', 'EnterpriseManagement::toggleStatus/$1');
        $routes->post('verify/(:num)', 'EnterpriseManagement::verify/$1');
        $routes->get('getData', 'EnterpriseManagement::getData');
        $routes->get('get/(:num)', 'EnterpriseManagement::get/$1');
        $routes->get('getStats', 'EnterpriseManagement::getStats');
        $routes->get('getSectors', 'EnterpriseManagement::getSectors');
    });
});

// ============================================================
// ========== TEST ROUTES ==========
// ============================================================
$routes->get('test-menu', function() {
    // Load the helper
    helper('admin_menu');
    
    $userId = session()->get('user_id');
    $session = session();
    
    echo "<h1>Menu Debug</h1>";
    
    // Check session
    echo "<h2>Session Data:</h2>";
    echo "<pre>";
    print_r($session->get());
    echo "</pre>";
    
    // Check database modules
    $db = \Config\Database::connect();
    $modules = $db->table('modules')
        ->where('is_active', 1)
        ->orderBy('sort_order', 'ASC')
        ->get()
        ->getResultArray();
    
    echo "<h2>Database Modules (" . count($modules) . "):</h2>";
    echo "<pre>";
    print_r($modules);
    echo "</pre>";
    
    // Check permissions
    $permissions = $db->table('permissions')
        ->where('is_active', 1)
        ->get()
        ->getResultArray();
    
    echo "<h2>Permissions (" . count($permissions) . "):</h2>";
    echo "<pre>";
    print_r(array_slice($permissions, 0, 20));
    echo "</pre>";
    
    // Get menu
    $menu = get_admin_menu($userId);
    
    echo "<h2>Menu Output:</h2>";
    echo "<pre>";
    print_r($menu);
    echo "</pre>";
});

$routes->get('debug-session', function() {
    echo "<h1>Session Debug</h1>";
    echo "<pre>";
    print_r(session()->get());
    echo "</pre>";
    
    echo "<h2>Helper Functions Available:</h2>";
    echo "<p>get_admin_menu: " . (function_exists('get_admin_menu') ? '✅' : '❌') . "</p>";
    echo "<p>can_view: " . (function_exists('can_view') ? '✅' : '❌') . "</p>";
});

$routes->get('debug-modules', function() {
    $db = \Config\Database::connect();
    
    // Check modules
    $modules = $db->table('modules')
        ->where('is_active', 1)
        ->orderBy('sort_order', 'ASC')
        ->get()
        ->getResultArray();
    
    echo "<h1>Modules Debug</h1>";
    echo "<p><strong>Total Modules:</strong> " . count($modules) . "</p>";
    
    echo "<h2>All Modules:</h2>";
    echo "<pre>";
    print_r($modules);
    echo "</pre>";
    
    echo "<h2>Categories:</h2>";
    $categories = $db->table('modules')
        ->where('is_active', 1)
        ->where('is_category', 1)
        ->get()
        ->getResultArray();
    echo "<pre>";
    print_r($categories);
    echo "</pre>";
    
    echo "<h2>Sub-Modules:</h2>";
    $subModules = $db->table('modules')
        ->where('is_active', 1)
        ->where('is_category', 0)
        ->get()
        ->getResultArray();
    echo "<pre>";
    print_r($subModules);
    echo "</pre>";
});