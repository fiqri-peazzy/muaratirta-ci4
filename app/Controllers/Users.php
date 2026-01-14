<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Users extends BaseController
{
    protected $userModel;
    protected $session;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->session = \Config\Services::session();
        helper(['form', 'url', 'auth', 'filesystem']);
    }

    /**
     * Display list users
     */
    public function index()
    {
        $perPage = 20;
        $level = $this->request->getGet('level');
        $status = $this->request->getGet('status');
        $search = $this->request->getGet('search');

        $builder = $this->userModel->orderBy('created_at', 'DESC');

        // Filter by level
        if ($level && $level !== 'all') {
            $builder->where('level', $level);
        }

        // Filter by status
        if ($status !== null && $status !== 'all') {
            $builder->where('is_active', $status);
        }

        // Search
        if ($search) {
            $builder->groupStart()
                ->like('username', $search)
                ->orLike('email', $search)
                ->orLike('nm_lengkap', $search)
                ->orLike('no_hp', $search)
                ->groupEnd();
        }

        $data = [
            'title' => 'Manajemen User',
            'users' => $builder->paginate($perPage),
            'pager' => $this->userModel->pager,
            'level_filter' => $level ?? 'all',
            'status_filter' => $status ?? 'all',
            'search' => $search,
            'stats' => [
                'total' => $this->userModel->countAll(),
                'admin' => $this->userModel->where('level', '1')->countAllResults(),
                'cs' => $this->userModel->where('level', '2')->countAllResults(),
                'publikasi' => $this->userModel->where('level', '3')->countAllResults(),
                'active' => $this->userModel->where('is_active', '1')->countAllResults(),
                'inactive' => $this->userModel->where('is_active', '0')->countAllResults(),
            ]
        ];

        return view('backend/pages/users/index', $data);
    }

    /**
     * Show create form
     */
    public function create()
    {
        $data = [
            'title' => 'Tambah User',
            'validation' => \Config\Services::validation()
        ];

        return view('backend/pages/users/create', $data);
    }

    /**
     * Store new user
     */
    public function store()
    {
        // Validation rules
        $rules = [
            'username' => 'required|min_length[3]|max_length[100]|is_unique[users.username]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
            'password_confirm' => 'required|matches[password]',
            'nm_lengkap' => 'required|min_length[3]|max_length[250]',
            'no_hp' => 'permit_empty|max_length[25]',
            'level' => 'required|in_list[1,2,3]',
            'profile_pict' => 'permit_empty|max_size[profile_pict,2048]|is_image[profile_pict]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Handle file upload
        $profilePict = null;
        $file = $this->request->getFile('profile_pict');

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $profilePict = $file->getRandomName();
            $file->move(FCPATH . 'uploads/profile/', $profilePict);

            // Resize image
            $this->resizeImage(FCPATH . 'uploads/profile/' . $profilePict, 300, 300);
        }

        // Prepare data
        $data = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
            'nm_lengkap' => $this->request->getPost('nm_lengkap'),
            'no_hp' => $this->request->getPost('no_hp'),
            'level' => $this->request->getPost('level'),
            'profile_pict' => $profilePict,
            'is_active' => '1',
        ];

        if ($this->userModel->insert($data)) {
            $this->session->setFlashdata('success', 'User berhasil ditambahkan');
            return redirect()->to('/users');
        }

        $this->session->setFlashdata('error', 'Gagal menambahkan user');
        return redirect()->back()->withInput();
    }

    /**
     * Show edit form
     */
    public function edit($id)
    {
        $user = $this->userModel->find($id);

        if (!$user) {
            $this->session->setFlashdata('error', 'User tidak ditemukan');
            return redirect()->to('/users');
        }

        $data = [
            'title' => 'Edit User',
            'user' => $user,
            'validation' => \Config\Services::validation()
        ];

        return view('backend/pages/users/edit', $data);
    }

    /**
     * Update user
     */
    public function update($id)
    {
        $user = $this->userModel->find($id);

        if (!$user) {
            $this->session->setFlashdata('error', 'User tidak ditemukan');
            return redirect()->to('/users');
        }

        // Validation rules
        $rules = [
            'username' => "required|min_length[3]|max_length[100]|is_unique[users.username,id,{$id}]",
            'email' => "required|valid_email|is_unique[users.email,id,{$id}]",
            'nm_lengkap' => 'required|min_length[3]|max_length[250]',
            'no_hp' => 'permit_empty|max_length[25]',
            'level' => 'required|in_list[1,2,3]',
            'profile_pict' => 'permit_empty|max_size[profile_pict,2048]|is_image[profile_pict]',
        ];

        // If password is provided, validate it
        if ($this->request->getPost('password')) {
            $rules['password'] = 'min_length[6]';
            $rules['password_confirm'] = 'matches[password]';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Handle file upload
        $profilePict = $user->profile_pict;
        $file = $this->request->getFile('profile_pict');

        if ($file && $file->isValid() && !$file->hasMoved()) {
            // Delete old file
            if ($user->profile_pict && file_exists(FCPATH . 'uploads/profile/' . $user->profile_pict)) {
                unlink(FCPATH . 'uploads/profile/' . $user->profile_pict);
            }

            $profilePict = $file->getRandomName();
            $file->move(FCPATH . 'uploads/profile/', $profilePict);

            // Resize image
            $this->resizeImage(FCPATH . 'uploads/profile/' . $profilePict, 300, 300);
        }

        // Prepare data
        $data = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'nm_lengkap' => $this->request->getPost('nm_lengkap'),
            'no_hp' => $this->request->getPost('no_hp'),
            'level' => $this->request->getPost('level'),
            'profile_pict' => $profilePict,
        ];

        // Update password if provided
        if ($this->request->getPost('password')) {
            $data['password'] = $this->request->getPost('password');
        }

        if ($this->userModel->skipValidation(true)->update($id, $data)) {
            $this->session->setFlashdata('success', 'User berhasil diupdate');
            return redirect()->to('/users');
        }

        $this->session->setFlashdata('error', 'Gagal mengupdate user');
        return redirect()->back()->withInput();
    }

    /**
     * Delete user
     */
    public function delete($id)
    {
        $user = $this->userModel->find($id);

        if (!$user) {
            $this->session->setFlashdata('error', 'User tidak ditemukan');
            return redirect()->to('/users');
        }

        // Prevent deleting own account
        if ($id == user_id()) {
            $this->session->setFlashdata('error', 'Tidak dapat menghapus akun sendiri');
            return redirect()->to('/users');
        }

        // Delete profile picture
        if ($user->profile_pict && file_exists(FCPATH . 'uploads/profile/' . $user->profile_pict)) {
            unlink(FCPATH . 'uploads/profile/' . $user->profile_pict);
        }

        // Hard delete
        if ($this->userModel->delete($id, true)) {
            $this->session->setFlashdata('success', 'User berhasil dihapus');
        } else {
            $this->session->setFlashdata('error', 'Gagal menghapus user');
        }

        return redirect()->to('/users');
    }

    /**
     * Toggle user status (active/inactive)
     */
    public function toggleStatus($id)
    {
        $user = $this->userModel->find($id);

        if (!$user) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'User tidak ditemukan'
            ]);
        }

        // Prevent deactivating own account
        if ($id == user_id()) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Tidak dapat menonaktifkan akun sendiri'
            ]);
        }

        $newStatus = $user->is_active == '1' ? '0' : '1';

        if ($this->userModel->update($id, ['is_active' => $newStatus])) {
            $statusText = $newStatus == '1' ? 'diaktifkan' : 'dinonaktifkan';
            return $this->response->setJSON([
                'success' => true,
                'message' => "User berhasil {$statusText}",
                'new_status' => $newStatus
            ]);
        }

        return $this->response->setJSON([
            'success' => false,
            'message' => 'Gagal mengubah status user'
        ]);
    }

    /**
     * Resize image helper
     */
    private function resizeImage($filePath, $maxWidth, $maxHeight)
    {
        $image = \Config\Services::image()
            ->withFile($filePath)
            ->resize($maxWidth, $maxHeight, true, 'height')
            ->save($filePath);

        return $image;
    }
}
