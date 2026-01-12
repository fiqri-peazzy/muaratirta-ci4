<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Default route
$routes->get('/', 'Home::index', ['as' => 'home']);

$routes->group('pasang-baru', ['namespace' => 'App\Controllers'], function ($routes) {

    $routes->get('', 'PasangBaru::index', ['as' => 'pasang_baru']);
    $routes->post('submit', 'PasangBaru::submit', ['as' => 'pasang_baru.submit']);
    $routes->get('sukses', 'PasangBaru::sukses', ['as' => 'pasang_baru.sukses']);
    $routes->get('tracking', 'PasangBaru::tracking', ['as' => 'pasang_baru.tracking']);
    $routes->post('check-status', 'PasangBaru::checkStatus', ['as' => 'pasang_baru.check_status']);
});

// Authentication Routes
$routes->group('', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('login', 'Auth::index', ['as' => 'login']);
    $routes->post('login', 'Auth::attemptLogin', ['as' => 'login.attempt']);
    $routes->get('logout', 'Auth::logout', ['as' => 'logout']);
    $routes->get('forgot-password', 'Auth::forgotPassword', ['as' => 'forgot_password']);
    $routes->post('reset-password', 'Auth::resetPassword', ['as' => 'reset_password']);
});

// Protected Admin Routes
$routes->group('', ['filter' => 'auth', 'namespace' => 'App\Controllers'], function ($routes) {
    // Dashboard
    $routes->get('dashboard', 'Dashboard::index', ['as' => 'dashboard']);

    // Profile
    $routes->get('profile', 'Profile::index', ['as' => 'profile']);
    $routes->post('profile/update', 'Profile::update', ['as' => 'profile.update']);
    $routes->post('profile/change-password', 'Profile::changePassword', ['as' => 'profile.change_password']);

    // User Management (Admin Only)
    $routes->group('users', ['filter' => 'auth:1'], function ($routes) {
        $routes->get('', 'Users::index', ['as' => 'users.index']);
        $routes->get('create', 'Users::create', ['as' => 'users.create']);
        $routes->post('store', 'Users::store', ['as' => 'users.store']);
        $routes->get('edit/(:num)', 'Users::edit/$1', ['as' => 'users.edit']);
        $routes->post('update/(:num)', 'Users::update/$1', ['as' => 'users.update']);
        $routes->get('delete/(:num)', 'Users::delete/$1', ['as' => 'users.delete']);
        $routes->post('toggle-status/(:num)', 'Users::toggleStatus/$1', ['as' => 'users.toggle_status']);
    });

    // Pengaduan (Admin & CS)
    $routes->group('pengaduan', ['filter' => 'auth:1,2'], function ($routes) {
        $routes->get('', 'Pengaduan::index', ['as' => 'pengaduan.index']);
        $routes->get('detail/(:num)', 'Pengaduan::detail/$1', ['as' => 'pengaduan.detail']);
        $routes->post('update-status/(:num)', 'Pengaduan::updateStatus/$1', ['as' => 'pengaduan.update_status']);
    });

    $routes->group('pendaftaran', ['filter' => 'auth:1,2'], function ($routes) {
        $routes->get('', 'Pendaftaran::index', ['as' => 'pendaftaran.index']);
        $routes->get('detail/(:num)', 'Pendaftaran::detail/$1', ['as' => 'pendaftaran.detail']);
        $routes->post('update-status/(:num)', 'Pendaftaran::updateStatus/$1', ['as' => 'pendaftaran.update_status']);

        $routes->get('export-pdf/(:num)', 'Pendaftaran::exportPdf/$1', ['as' => 'pendaftaran.export_pdf']);
        $routes->get('export-bulk-pdf', 'Pendaftaran::exportBulkPdf', ['as' => 'pendaftaran.export_bulk_pdf']);
    });

    // Publikasi - Kategori Management (Admin Only)
    $routes->group('publikasi', ['filter' => 'auth:1'], function ($routes) {
        // Kategori
        $routes->get('kategori', 'Publikasi::kategori', ['as' => 'publikasi.kategori']);
        $routes->get('kategori/create', 'Publikasi::kategoriCreate', ['as' => 'publikasi.kategori.create']);
        $routes->post('kategori/store', 'Publikasi::kategoriStore', ['as' => 'publikasi.kategori.store']);
        $routes->get('kategori/edit/(:num)', 'Publikasi::kategoriEdit/$1', ['as' => 'publikasi.kategori.edit']);
        $routes->post('kategori/update/(:num)', 'Publikasi::kategoriUpdate/$1', ['as' => 'publikasi.kategori.update']);
        $routes->get('kategori/delete/(:num)', 'Publikasi::kategoriDelete/$1', ['as' => 'publikasi.kategori.delete']);
        $routes->post('kategori/toggle/(:num)', 'Publikasi::kategoriToggle/$1', ['as' => 'publikasi.kategori.toggle']);
    });

    // Artikel/Konten Management (Admin & Publikasi)
    $routes->group('artikel', ['filter' => 'auth:1,3'], function ($routes) {
        $routes->get('', 'Artikel::index', ['as' => 'artikel.index']);
        $routes->get('create', 'Artikel::create', ['as' => 'artikel.create']);
        $routes->post('store', 'Artikel::store', ['as' => 'artikel.store']);
        $routes->get('edit/(:num)', 'Artikel::edit/$1', ['as' => 'artikel.edit']);
        $routes->post('update/(:num)', 'Artikel::update/$1', ['as' => 'artikel.update']);
        $routes->get('delete/(:num)', 'Artikel::delete/$1', ['as' => 'artikel.delete']);

        // AJAX routes
        $routes->post('upload-image', 'Artikel::uploadImage', ['as' => 'artikel.upload_image']);
        $routes->post('delete-galeri/(:num)', 'Artikel::deleteGaleriImage/$1', ['as' => 'artikel.delete_galeri']);
    });

    $routes->group('settings', ['filter' => 'auth:1'], function ($routes) {
        $routes->get('', 'Settings::index', ['as' => 'settings.index']);
        $routes->post('update', 'Settings::update', ['as' => 'settings.update']);
    });
});
