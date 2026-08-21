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
// app/Config/Routes.php
$routes->get('admin/sync-menus', 'Admin\Roles::syncAllMenus');
// ============================================================
// ========== CHATBOT ROUTES (No auth required) ==========
// ============================================================
$routes->post('chatbot/process', 'Chatbot::process');
$routes->get('chatbot/status', 'Chatbot::status');
$routes->get('chatbot/clear-cache', 'Chatbot::clearCache');

// Direct Auth Routes (clean URLs)
$routes->get('login', 'Auth::login');
$routes->post('authenticate', 'Auth::authenticate');
$routes->get('logout', 'Auth::logout');
$routes->get('register', 'Auth::register');
$routes->post('register', 'Auth::createAccount');

// Auth Routes Group (for other auth routes)
$routes->group('auth', function($routes) {
    $routes->get('login', 'Auth::login');
    $routes->post('authenticate', 'Auth::authenticate');
    $routes->get('logout', 'Auth::logout');
    $routes->get('register', 'Auth::register');
    $routes->post('register', 'Auth::createAccount');
    $routes->get('verify-email/(:any)', 'Auth::verifyEmail/$1');
    $routes->get('change-password', 'Auth::changePassword');
    $routes->post('update-password', 'Auth::updatePassword');
    $routes->get('resend-verification', 'Auth::resendVerification');
    $routes->post('resend-verification', 'Auth::resendVerification');
    $routes->get('forgot-password', 'Auth::forgotPassword');
    $routes->post('forgot-password', 'Auth::sendResetLink');
    $routes->get('reset-password/(:any)', 'Auth::resetPassword/$1');
    $routes->post('reset-password/(:any)', 'Auth::updateResetPassword/$1');
});

// ============================================================
// ========== DASHBOARD ROUTES ==========
// ============================================================
// Main dashboard for all authenticated users
$routes->get('dashboard', 'Dashboard::index');
$routes->get('dashboard/getStats', 'Dashboard::getStats');

// ============================================================
// ========== ADMIN ROUTES (Permission: admin) ==========
// ============================================================

$routes->group('admin', ['namespace' => 'App\Controllers\Admin', 'filter' => 'permission:admin'], function($routes) {
    // Redirect admin/dashboard to main dashboard
    $routes->get('dashboard', function() {
        return redirect()->to('/dashboard');
    });
    
    // ============================================================
    // USER MANAGEMENT
    // ============================================================
    $routes->group('users', ['permission' => 'users_manage'], function($routes) {
        $routes->get('/', 'UserManagement::index');
        $routes->get('create', 'UserManagement::create');
        $routes->post('create', 'UserManagement::store');
        $routes->get('edit/(:num)', 'UserManagement::edit/$1');
        $routes->post('edit/(:num)', 'UserManagement::update/$1');
        $routes->get('delete/(:num)', 'UserManagement::delete/$1');
        $routes->get('view/(:num)', 'UserManagement::view/$1');
        $routes->post('toggle-status/(:num)', 'UserManagement::toggleStatus/$1');
        $routes->get('getData', 'UserManagement::getData');
        $routes->get('get/(:num)', 'UserManagement::get/$1');
        $routes->get('getStats', 'UserManagement::getStats');
        $routes->get('getUserPermissions/(:num)', 'UserManagement::getUserPermissions/$1');
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
        $routes->get('delete/(:num)', 'RoleManagement::delete/$1');
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
        $routes->get('edit/(:num)', 'PermissionManagement::edit/$1');
        $routes->get('getData', 'PermissionManagement::getData');
        $routes->get('get/(:num)', 'PermissionManagement::get/$1');
        $routes->get('getStats', 'PermissionManagement::getStats');
        $routes->get('getModules', 'PermissionManagement::getModules');
        $routes->post('create', 'PermissionManagement::create');
        $routes->post('update/(:num)', 'PermissionManagement::update/$1');
        $routes->post('delete/(:num)', 'PermissionManagement::delete/$1');
        $routes->post('toggle-status/(:num)', 'PermissionManagement::toggleStatus/$1');
    });
    
    // ============================================================
// MODULE MANAGEMENT
// ============================================================
$routes->group('modules', ['permission' => 'modules_manage'], function($routes) {
    $routes->get('/', 'ModuleManagement::index');
    $routes->get('create', 'ModuleManagement::create');
    $routes->get('edit/(:num)', 'ModuleManagement::edit/$1');
    $routes->get('reorder', 'ModuleManagement::reorder');
    $routes->get('getData', 'ModuleManagement::getData');
    $routes->get('get/(:num)', 'ModuleManagement::get/$1');
    $routes->get('getStats', 'ModuleManagement::getStats');
    $routes->get('getNextSortOrder', 'ModuleManagement::getNextSortOrder'); // Add this
    
    // FIX: Change 'create' to 'store' to match JavaScript
    $routes->post('store', 'ModuleManagement::store'); // This matches the JS call
    $routes->post('create', 'ModuleManagement::store'); // Keep alias for backward compatibility
    
    $routes->post('update/(:num)', 'ModuleManagement::update/$1');
    $routes->post('delete/(:num)', 'ModuleManagement::delete/$1');
    $routes->post('toggle-status/(:num)', 'ModuleManagement::toggleStatus/$1');
    $routes->post('reorder', 'ModuleManagement::reorder');
    $routes->post('update-order', 'ModuleManagement::updateOrder');
    $routes->post('generateSlug', 'ModuleManagement::generateSlug');
});
    // ============================================================
    // ENTERPRISE MANAGEMENT - FIXED: Remove 'admin/enterprises' from route
    // ============================================================
    $routes->group('enterprises', ['permission' => 'enterprises_manage'], function($routes) {
        $routes->get('/', 'EnterpriseManagement::index');
        $routes->get('getData', 'EnterpriseManagement::getData');
        $routes->get('get/(:num)', 'EnterpriseManagement::get/$1');
        $routes->get('getStats', 'EnterpriseManagement::getStats');
        $routes->get('getSectors', 'EnterpriseManagement::getSectors');
        $routes->post('create', 'EnterpriseManagement::create');
        $routes->post('update/(:num)', 'EnterpriseManagement::update/$1');
        $routes->post('delete/(:num)', 'EnterpriseManagement::delete/$1');
        $routes->post('toggle-status/(:num)', 'EnterpriseManagement::toggleStatus/$1');
        $routes->post('verify/(:num)', 'EnterpriseManagement::verify/$1');
    });
    
    // ============================================================
    // INVESTOR MANAGEMENT
    // ============================================================
    $routes->group('investors', ['permission' => 'investor_manage'], function($routes) {
        $routes->get('/', 'InvestorManagement::index');
        $routes->get('create', 'InvestorManagement::create');
        $routes->post('create', 'InvestorManagement::store');
        $routes->get('edit/(:num)', 'InvestorManagement::edit/$1');
        $routes->post('edit/(:num)', 'InvestorManagement::update/$1');
        $routes->get('delete/(:num)', 'InvestorManagement::delete/$1');
        $routes->get('view/(:num)', 'InvestorManagement::view/$1');
        $routes->post('verify/(:num)', 'InvestorManagement::verify/$1');
        $routes->get('verify', 'InvestorManagement::verifyList');
        $routes->get('portfolio', 'InvestorManagement::portfolio');
        $routes->get('getData', 'InvestorManagement::getData');
        $routes->get('get/(:num)', 'InvestorManagement::get/$1');
        $routes->get('getStats', 'InvestorManagement::getStats');
    });
    
    // ============================================================
    // SERVICES MANAGEMENT
    // ============================================================
    $routes->group('services', ['permission' => 'services_manage'], function($routes) {
        $routes->get('/', 'ServiceManagement::index');
        $routes->get('create', 'ServiceManagement::create');
        $routes->post('create', 'ServiceManagement::store');
        $routes->get('edit/(:num)', 'ServiceManagement::edit/$1');
        $routes->post('edit/(:num)', 'ServiceManagement::update/$1');
        $routes->get('delete/(:num)', 'ServiceManagement::delete/$1');
        $routes->get('categories', 'ServiceManagement::categories');
        $routes->post('categories', 'ServiceManagement::updateCategories');
        $routes->get('requests', 'ServiceManagement::requests');
        $routes->post('requests/(:num)', 'ServiceManagement::updateRequest/$1');
        $routes->get('getData', 'ServiceManagement::getData');
        $routes->get('get/(:num)', 'ServiceManagement::get/$1');
        $routes->get('getStats', 'ServiceManagement::getStats');
    });
    
    // ============================================================
    // REPORTS MANAGEMENT
    // ============================================================
    $routes->group('reports', ['permission' => 'reports_manage'], function($routes) {
        $routes->get('/', 'ReportManagement::index');
        $routes->get('analytics', 'ReportManagement::analytics');
        $routes->get('export', 'ReportManagement::export');
        $routes->post('export', 'ReportManagement::downloadExport');
        $routes->get('sectors', 'ReportManagement::sectors');
        $routes->get('custom', 'ReportManagement::custom');
        $routes->post('custom', 'ReportManagement::generateCustom');
        $routes->get('getData', 'ReportManagement::getData');
        $routes->get('getStats', 'ReportManagement::getStats');
    });
    
    // ============================================================
    // MATCHMAKING MANAGEMENT
    // ============================================================
    $routes->group('matchmaking', ['permission' => 'matchmaking_manage'], function($routes) {
        $routes->get('/', 'MatchmakingManagement::index');
        $routes->get('create', 'MatchmakingManagement::create');
        $routes->post('create', 'MatchmakingManagement::store');
        $routes->get('edit/(:num)', 'MatchmakingManagement::edit/$1');
        $routes->post('edit/(:num)', 'MatchmakingManagement::update/$1');
        $routes->get('delete/(:num)', 'MatchmakingManagement::delete/$1');
        $routes->get('active', 'MatchmakingManagement::active');
        $routes->get('history', 'MatchmakingManagement::history');
        $routes->get('getData', 'MatchmakingManagement::getData');
        $routes->get('get/(:num)', 'MatchmakingManagement::get/$1');
        $routes->get('getStats', 'MatchmakingManagement::getStats');
    });
    
    // ============================================================
    // SECTORS MANAGEMENT
    // ============================================================
    $routes->group('sectors', ['permission' => 'sectors_manage'], function($routes) {
        $routes->get('/', 'SectorManagement::index');
        $routes->get('create', 'SectorManagement::create');
        $routes->post('create', 'SectorManagement::store');
        $routes->get('edit/(:num)', 'SectorManagement::edit/$1');
        $routes->post('edit/(:num)', 'SectorManagement::update/$1');
        $routes->get('delete/(:num)', 'SectorManagement::delete/$1');
        $routes->get('clusters', 'SectorManagement::clusters');
        $routes->get('analysis', 'SectorManagement::analysis');
        $routes->get('getData', 'SectorManagement::getData');
        $routes->get('get/(:num)', 'SectorManagement::get/$1');
        $routes->get('getStats', 'SectorManagement::getStats');
    });
    
    // ============================================================
    // DEALS MANAGEMENT
    // ============================================================
    $routes->group('deals', ['permission' => 'deals_manage'], function($routes) {
        $routes->get('/', 'DealManagement::index');
        $routes->get('create', 'DealManagement::create');
        $routes->post('create', 'DealManagement::store');
        $routes->get('edit/(:num)', 'DealManagement::edit/$1');
        $routes->post('edit/(:num)', 'DealManagement::update/$1');
        $routes->get('delete/(:num)', 'DealManagement::delete/$1');
        $routes->get('view/(:num)', 'DealManagement::view/$1');
        $routes->get('active', 'DealManagement::active');
        $routes->get('tracking', 'DealManagement::tracking');
        $routes->post('status/(:num)', 'DealManagement::updateStatus/$1');
        $routes->get('getData', 'DealManagement::getData');
        $routes->get('get/(:num)', 'DealManagement::get/$1');
        $routes->get('getStats', 'DealManagement::getStats');
    });
    
    // ============================================================
    // ANALYTICS MANAGEMENT
    // ============================================================
    $routes->group('analytics', ['permission' => 'analytics_manage'], function($routes) {
        $routes->get('/', 'AnalyticsManagement::index');
        $routes->get('detailed', 'AnalyticsManagement::detailed');
        $routes->get('predictive', 'AnalyticsManagement::predictive');
        $routes->get('builder', 'AnalyticsManagement::builder');
        $routes->post('builder', 'AnalyticsManagement::saveDashboard');
        $routes->get('export', 'AnalyticsManagement::export');
        $routes->post('export', 'AnalyticsManagement::downloadExport');
        $routes->get('getData', 'AnalyticsManagement::getData');
        $routes->get('getStats', 'AnalyticsManagement::getStats');
    });
    
    // ============================================================
    // SETTINGS
    // ============================================================
    $routes->group('settings', ['permission' => 'settings_manage'], function($routes) {
        $routes->get('/', 'SettingsManagement::index');
        $routes->post('/', 'SettingsManagement::update');
        $routes->get('modules', 'SettingsManagement::modules');
        $routes->post('modules', 'SettingsManagement::updateModules');
        $routes->get('api', 'SettingsManagement::api');
        $routes->post('api', 'SettingsManagement::updateApi');
        $routes->get('backup', 'SettingsManagement::backup');
        $routes->post('backup', 'SettingsManagement::createBackup');
        $routes->get('restore', 'SettingsManagement::restore');
        $routes->post('restore', 'SettingsManagement::restoreBackup');
        $routes->get('getData', 'SettingsManagement::getData');
        $routes->get('getStats', 'SettingsManagement::getStats');
    });
});