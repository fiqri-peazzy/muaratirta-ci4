<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Default route
$routes->get('/', 'Auth::index');

// Authentication Routes
$routes->group('', ['namespace' => 'App\Controllers'], function($routes) {
    $routes->get('login', 'Auth::index', ['as' => 'login']);
    $routes->post('login', 'Auth::attemptLogin', ['as' => 'login.attempt']);
    $routes->get('logout', 'Auth::logout', ['as' => 'logout']);
    
    // Forgot Password (untuk phase berikutnya)
    $routes->get('forgot-password', 'Auth::forgotPassword', ['as' => 'forgot_password']);
    $routes->post('reset-password', 'Auth::resetPassword', ['as' => 'reset_password']);
});

// Protected Admin Routes
$routes->group('', ['filter' => 'auth', 'namespace' => 'App\Controllers'], function($routes) {
    // Dashboard
    $routes->get('dashboard', 'Dashboard::index', ['as' => 'dashboard']);
    
    // Profile
    $routes->get('profile', 'Profile::index', ['as' => 'profile']);
    $routes->post('profile/update', 'Profile::update', ['as' => 'profile.update']);
    $routes->post('profile/change-password', 'Profile::changePassword', ['as' => 'profile.change_password']);
    
    // User Management (Admin Only)
    $routes->group('users', ['filter' => 'auth:1'], function($routes) {
        $routes->get('', 'Users::index', ['as' => 'users.index']);
        $routes->get('create', 'Users::create', ['as' => 'users.create']);
        $routes->post('store', 'Users::store', ['as' => 'users.store']);
        $routes->get('edit/(:num)', 'Users::edit/$1', ['as' => 'users.edit']);
        $routes->post('update/(:num)', 'Users::update/$1', ['as' => 'users.update']);
        $routes->get('delete/(:num)', 'Users::delete/$1', ['as' => 'users.delete']);
        $routes->post('toggle-status/(:num)', 'Users::toggleStatus/$1', ['as' => 'users.toggle_status']);
    });
    
    // Pengaduan (Admin & CS)
    $routes->group('pengaduan', ['filter' => 'auth:1,2'], function($routes) {
        $routes->get('', 'Pengaduan::index', ['as' => 'pengaduan.index']);
        $routes->get('detail/(:num)', 'Pengaduan::detail/$1', ['as' => 'pengaduan.detail']);
        $routes->post('update-status/(:num)', 'Pengaduan::updateStatus/$1', ['as' => 'pengaduan.update_status']);
    });
    
    $routes->group('artikel', ['filter' => 'auth:1,3'], function($routes) {
        $routes->get('', 'Artikel::index', ['as' => 'artikel.index']);
        $routes->get('create', 'Artikel::create', ['as' => 'artikel.create']);
        $routes->post('store', 'Artikel::store', ['as' => 'artikel.store']);
        $routes->get('edit/(:num)', 'Artikel::edit/$1', ['as' => 'artikel.edit']);
        $routes->post('update/(:num)', 'Artikel::update/$1', ['as' => 'artikel.update']);
        $routes->get('delete/(:num)', 'Artikel::delete/$1', ['as' => 'artikel.delete']);
    });
    
    $routes->group('pengumuman', ['filter' => 'auth:1,3'], function($routes) {
        $routes->get('', 'Pengumuman::index', ['as' => 'pengumuman.index']);
        $routes->get('create', 'Pengumuman::create', ['as' => 'pengumuman.create']);
        $routes->post('store', 'Pengumuman::store', ['as' => 'pengumuman.store']);
        $routes->get('edit/(:num)', 'Pengumuman::edit/$1', ['as' => 'pengumuman.edit']);
        $routes->post('update/(:num)', 'Pengumuman::update/$1', ['as' => 'pengumuman.update']);
        $routes->get('delete/(:num)', 'Pengumuman::delete/$1', ['as' => 'pengumuman.delete']);
    });
    
    $routes->group('settings', ['filter' => 'auth:1'], function($routes) {
        $routes->get('', 'Settings::index', ['as' => 'settings.index']);
        $routes->post('update', 'Settings::update', ['as' => 'settings.update']);
    });
});