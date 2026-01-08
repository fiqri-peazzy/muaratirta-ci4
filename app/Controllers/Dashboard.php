<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function __construct()
    {
        helper(['auth', 'url']);
    }

    /**
     * Display dashboard page
     */
    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'pageTitle' => 'Dashboard Overview',
            'breadcrumbs' => 'Halaman Utama'
        ];

        return view('backend/pages/dashboard', $data);
    }
}