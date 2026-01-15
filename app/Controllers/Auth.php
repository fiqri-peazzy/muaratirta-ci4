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

    /**
     * Display forgot password page
     */
    public function forgotPassword()
    {
        $data = [
            'title' => 'Lupa Password - PERUMDA AIR MINUM MUARA TIRTA'
        ];

        return view('auth/forgot_password', $data);
    }

    /**
     * Send OTP to email
     */
    public function sendResetOTP()
    {
        $rules = [
            'email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Email wajib diisi',
                    'valid_email' => 'Format email tidak valid'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $email = $this->request->getPost('email');

        // Check if email exists
        $user = $this->userModel->where('email', $email)->first();
        if (!$user) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Email tidak terdaftar dalam sistem');
        }

        // Generate OTP
        $passwordResetModel = new \App\Models\PasswordResetModel();
        $otp = $passwordResetModel->createResetToken($email);

        if (!$otp) {
            return redirect()->back()
                ->with('error', 'Gagal membuat kode OTP. Silakan coba lagi');
        }

        // Send email
        $emailService = \Config\Services::email();
        $emailService->setTo($email);
        $emailService->setSubject('Reset Password - PERUMDA AIR MINUM MUARA TIRTA');

        $message = view('emails/reset_password_otp', [
            'name' => $user->nm_lengkap,
            'otp' => $otp
        ]);

        $emailService->setMessage($message);

        if ($emailService->send()) {
            // Store email in session for verification
            $this->session->set('reset_email', $email);

            return redirect()->route('verify_otp')
                ->with('success', 'Kode OTP telah dikirim ke email Anda. Silakan cek inbox atau folder spam.');
        } else {
            return redirect()->back()
                ->with('error', 'Gagal mengirim email. Silakan coba lagi');
        }
    }

    /**
     * Display verify OTP page
     */
    public function verifyOTP()
    {
        if (!$this->session->get('reset_email')) {
            return redirect()->route('forgot_password')
                ->with('error', 'Sesi telah berakhir. Silakan ulangi proses reset password');
        }

        $data = [
            'title' => 'Verifikasi OTP - PERUMDA AIR MINUM MUARA TIRTA',
            'email' => $this->session->get('reset_email')
        ];

        return view('auth/verify_otp', $data);
    }

    /**
     * Process OTP verification
     */
    public function processVerifyOTP()
    {
        $email = $this->session->get('reset_email');
        if (!$email) {
            return redirect()->route('forgot_password')
                ->with('error', 'Sesi telah berakhir');
        }

        $rules = [
            'otp' => [
                'label' => 'Kode OTP',
                'rules' => 'required|exact_length[6]|numeric',
                'errors' => [
                    'required' => 'Kode OTP wajib diisi',
                    'exact_length' => 'Kode OTP harus 6 digit',
                    'numeric' => 'Kode OTP harus berupa angka'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->with('errors', $this->validator->getErrors());
        }

        $otp = $this->request->getPost('otp');
        $passwordResetModel = new \App\Models\PasswordResetModel();

        if ($passwordResetModel->verifyToken($email, $otp)) {
            // OTP valid, redirect to reset password page
            $this->session->set('otp_verified', true);
            return redirect()->route('reset_password_form')
                ->with('success', 'Kode OTP berhasil diverifikasi');
        } else {
            return redirect()->back()
                ->with('error', 'Kode OTP tidak valid atau sudah kadaluarsa');
        }
    }

    /**
     * Display reset password form
     */
    public function resetPasswordForm()
    {
        if (!$this->session->get('otp_verified')) {
            return redirect()->route('forgot_password')
                ->with('error', 'Silakan verifikasi OTP terlebih dahulu');
        }

        $data = [
            'title' => 'Reset Password - PERUMDA AIR MINUM MUARA TIRTA'
        ];

        return view('auth/reset_password', $data);
    }

    /**
     * Process reset password
     */
    public function resetPassword()
    {
        if (!$this->session->get('otp_verified')) {
            return redirect()->route('forgot_password')
                ->with('error', 'Silakan verifikasi OTP terlebih dahulu');
        }

        $rules = [
            'password' => [
                'label' => 'Password Baru',
                'rules' => 'required|min_length[6]',
                'errors' => [
                    'required' => 'Password baru wajib diisi',
                    'min_length' => 'Password minimal 6 karakter'
                ]
            ],
            'password_confirm' => [
                'label' => 'Konfirmasi Password',
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => 'Konfirmasi password wajib diisi',
                    'matches' => 'Konfirmasi password tidak cocok'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->with('errors', $this->validator->getErrors());
        }

        $email = $this->session->get('reset_email');
        $password = $this->request->getPost('password');

        // Update password
        $user = $this->userModel->where('email', $email)->first();
        if ($user) {
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $this->userModel->update($user->id, ['password' => $hashedPassword]);

            // Delete reset token
            $passwordResetModel = new \App\Models\PasswordResetModel();
            $passwordResetModel->deleteToken($email);

            // Clear session
            $this->session->remove(['reset_email', 'otp_verified']);

            return redirect()->route('login')
                ->with('success', 'Password berhasil direset. Silakan login dengan password baru Anda');
        }

        return redirect()->back()
            ->with('error', 'Gagal mereset password. Silakan coba lagi');
    }
}
