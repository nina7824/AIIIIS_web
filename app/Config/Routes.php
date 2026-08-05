<?php

namespace Config;

$routes = Services::routes();

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

// Auth Routes
$routes->get('login', 'Auth::login');
$routes->post('login/authenticate', 'Auth::authenticate');
$routes->get('logout', 'Auth::logout');
$routes->get('register', 'Auth::register');
$routes->post('register', 'Auth::createAccount');

// Home
$routes->get('/', 'Home::index');

// Role-based Dashboard
$routes->get('dashboard', 'Dashboard::index');

// ========== TEST ROUTES ==========
$routes->get('test', 'Test::index');
$routes->get('test/dashboard-data', 'Test::dashboard_data');

// Admin Routes
$routes->group('admin', ['namespace' => 'App\Controllers\Admin'], function($routes) {
    $routes->get('dashboard', 'Dashboard::index');
    $routes->get('users', 'Dashboard::users');
    $routes->get('enterprises', 'Dashboard::enterprises');
    $routes->get('investors', 'Dashboard::investors');
    $routes->get('matches', 'Dashboard::matches');
    $routes->get('matches/view/(:num)', 'Dashboard::viewMatch/$1');
    $routes->post('matches/update/(:num)', 'Dashboard::updateMatchStatus/$1');
    $routes->get('matches/delete/(:num)', 'Dashboard::deleteMatch/$1');
    $routes->get('deals', 'Dashboard::deals');
    $routes->get('analytics', 'Dashboard::analytics');
    $routes->get('settings', 'Dashboard::settings');
    $routes->post('settings/update', 'Dashboard::updateSettings');
});
// Investor Routes
$routes->group('investor', ['namespace' => 'App\Controllers\Investor'], function($routes) {
    $routes->get('dashboard', 'Dashboard::index');
    $routes->get('profile', 'Dashboard::profile');
    $routes->get('matches', 'Dashboard::matches');
    $routes->get('deals', 'Dashboard::deals');
    $routes->get('search', 'Dashboard::search');
    $routes->get('portfolio', 'Dashboard::portfolio');
    $routes->post('save-enterprise', 'Dashboard::saveEnterprise');
    $routes->post('request-introduction', 'Dashboard::requestIntroduction');
});