<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;
use App\Models\UserModel;

class Auth extends BaseController
{
    protected $userModel;
    protected $session;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->session = \Config\Services::session();
        helper(['form', 'url']);
    }

    /**
     * Display login page
     */
    public function index()
    {
        // Redirect if already logged in
        if ($this->session->get('is_logged_in')) {
            return redirect()->route('dashboard');
        }

        $data = [
            'title' => 'Login - PERUMDA AIR MINUM MUARA TIRTA',
            'validation' => \Config\Services::validation()
        ];

        return view('auth/login', $data);
    }

    /**
     * Process login
     */
    public function attemptLogin()
    {
        // Validation rules
        $rules = [
            'login'    => [
                'label'  => 'Username/Email',
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Username atau Email wajib diisi'
                ]
            ],
            'password' => [
                'label'  => 'Password',
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Password wajib diisi'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $login    = $this->request->getPost('login');
        $password = $this->request->getPost('password');

        // Find user by username or email
        $user = $this->userModel->findByUsernameOrEmail($login);

        if (!$user) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Username/Email tidak ditemukan');
        }

        // Check if account is active
        if ($user->is_active != '1') {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Akun Anda tidak aktif. Hubungi administrator.');
        }

        // Verify password
        if (!$this->userModel->verifyPassword($user, $password)) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Password salah');
        }

        // Login success - Set session
        $sessionData = [
            'user_id'      => $user->id,
            'username'     => $user->username,
            'email'        => $user->email,
            'nm_lengkap'   => $user->nm_lengkap,
            'profile_pict' => $user->profile_pict ?? 'default.png',
            'level'        => $user->level,
            'level_name'   => $this->userModel->getLevelName($user->level),
            'is_logged_in' => true
        ];

        $this->session->set($sessionData);

        // Regenerate session ID for security
        $this->session->regenerate();

        // Log login activity (optional)
        log_message('info', 'User login: ' . $user->username . ' (ID: ' . $user->id . ')');

        return redirect()->route('dashboard')
            ->with('success', 'Selamat datang, ' . $user->nm_lengkap . '!');
    }

    /**
     * Logout
     */
    public function logout()
    {
        // Log logout activity
        $username = $this->session->get('username');
        log_message('info', 'User logout: ' . $username);

        // Destroy session
        $this->session->destroy();

        return redirect()->route('login')
            ->with('success', 'Anda berhasil logout');
    }
}
