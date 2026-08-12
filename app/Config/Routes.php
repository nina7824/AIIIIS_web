<?php

namespace Config;

$routes = Services::routes();

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

// ========== AUTH ROUTES ==========
$routes->get('login', 'Auth::login');
$routes->post('login/authenticate', 'Auth::authenticate');



$routes->get('logout', 'Auth::logout');
$routes->get('register', 'Auth::register');
$routes->post('register', 'Auth::createAccount');
$routes->get('verify-email/(:any)', 'Auth::verifyEmail/$1');
$routes->get('change-password', 'Auth::changePassword');
$routes->post('update-password', 'Auth::updatePassword');
$routes->get('resend-verification', 'Auth::resendVerification');
$routes->post('resend-verification', 'Auth::resendVerification');
$routes->get('forgot-password', 'Auth::forgotPassword'); 
// ========== HOME ==========
$routes->get('/', 'Home::index');
$routes->get('service/(:any)', 'Home::service/$1');

// ========== DASHBOARD ==========
$routes->get('dashboard', 'Dashboard::index');

// ========== ENTERPRISE PUBLIC ROUTES ==========
$routes->group('enterprises', function($routes) {
    $routes->get('/', 'Enterprise::index');
    $routes->get('directory', 'Enterprise::directory');
    $routes->get('verification', 'Enterprise::verification');
    $routes->get('gis', 'Enterprise::gis');
    $routes->get('clusters', 'Enterprise::clusters');
    $routes->get('ranking', 'Enterprise::ranking');
});

// ========== TEST ROUTES ==========
$routes->get('test', 'Test::index');
$routes->get('test/dashboard-data', 'Test::dashboard_data');



// ========== ADMIN ENTERPRISE ROUTES ==========
$routes->group('admin/enterprises', ['namespace' => 'App\Controllers\Admin'], function($routes) {
    $routes->get('', 'Enterprise::index');
    $routes->get('get/(:num)', 'Enterprise::getEnterprise/$1');
    $routes->post('store', 'Enterprise::store');
    $routes->post('update/(:num)', 'Enterprise::update/$1');
    $routes->delete('delete/(:num)', 'Enterprise::delete/$1');
});

// ========== ADMIN INVESTOR ROUTES ==========
$routes->group('admin/investors', ['namespace' => 'App\Controllers\Admin'], function($routes) {
    $routes->get('', 'Investor::index');
    $routes->get('get/(:num)', 'Investor::getInvestor/$1');
    $routes->post('store', 'Investor::store');
    $routes->post('update/(:num)', 'Investor::update/$1');
    $routes->delete('delete/(:num)', 'Investor::delete/$1');
});

// ========== ADMIN ROUTES ==========
$routes->group('admin', ['namespace' => 'App\Controllers\Admin'], function($routes) {
    $routes->get('dashboard', 'Dashboard::index');
    $routes->get('users', 'Dashboard::users');
    $routes->get('matches', 'Dashboard::matches');
    $routes->get('matches/view/(:num)', 'Dashboard::viewMatch/$1');
    $routes->post('matches/update/(:num)', 'Dashboard::updateMatchStatus/$1');
    $routes->get('matches/delete/(:num)', 'Dashboard::deleteMatch/$1');
    $routes->get('deals', 'Dashboard::deals');
    $routes->get('analytics', 'Dashboard::analytics');
    $routes->get('settings', 'Dashboard::settings');
    $routes->post('settings/update', 'Dashboard::updateSettings');
});

// ========== INVESTOR ROUTES ==========
$routes->group('investor', ['namespace' => 'App\Controllers\Investor'], function($routes) {
    $routes->get('dashboard', 'Dashboard::index');
    $routes->get('profile', 'Dashboard::profile');
    $routes->get('edit-profile', 'Dashboard::editProfile');
    $routes->post('update-profile', 'Dashboard::updateProfile');
    $routes->get('matches', 'Dashboard::matches');
    $routes->get('deals', 'Dashboard::deals');
    $routes->get('search', 'Dashboard::search');
    $routes->get('portfolio', 'Dashboard::portfolio');
    $routes->post('save-enterprise', 'Dashboard::saveEnterprise');
    $routes->post('request-introduction', 'Dashboard::requestIntroduction');
});

// ========== ENTERPRISE USER ROUTES ==========
$routes->group('enterprise', ['namespace' => 'App\Controllers\Enterprise'], function($routes) {
    $routes->get('dashboard', 'Dashboard::index');
    $routes->get('profile', 'Dashboard::profile');
    $routes->get('edit-profile', 'Dashboard::editProfile');
    $routes->post('update-profile', 'Dashboard::updateProfile');
    $routes->get('investment', 'Dashboard::investment');
    $routes->post('submit-investment', 'Dashboard::submitInvestment');
    $routes->get('matches', 'Dashboard::matches');
    $routes->get('advisory', 'Dashboard::advisory');
    $routes->post('request-advisory', 'Dashboard::requestAdvisory');
    $routes->get('helpdesk', 'Dashboard::helpdesk');
    $routes->post('submit-helpdesk', 'Dashboard::submitHelpdesk');
    $routes->get('notifications', 'Dashboard::notifications');
    $routes->get('engagements', 'Dashboard::engagements');
    $routes->get('ranking', 'Dashboard::ranking');
});
// ========== CHATBOT ROUTES ==========
$routes->post('chatbot/process', 'ChatbotController::process');
$routes->get('chat/getMessages', 'ChatbotController::getMessages');
$routes->get('chat/getUnreadCount', 'ChatbotController::getUnreadCount');

// ========== SUPPORT ROUTES ==========
$routes->get('support/dashboard', 'Support::dashboard');
$routes->get('support/getSessions', 'Support::getSessions');
$routes->get('support/getSessionMessages/(:any)', 'Support::getSessionMessages/$1');
$routes->post('support/sendReply', 'Support::sendReply');
$routes->get('support/getStats', 'Support::getStats');