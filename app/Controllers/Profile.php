<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Profile extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        helper(['form', 'url']);
    }

    public function index()
    {
        $userId = session()->get('user_id');
        $user = $this->userModel->find($userId);

        if (!$user) {
            return redirect()->route('login')->with('error', 'Sesi anda telah berakhir. Silakan login kembali.');
        }

        $data = [
            'title' => 'Profile',
            'pageTitle' => 'Pengaturan Akun',
            'user' => $user,
            'validation' => \Config\Services::validation()
        ];

        return view('backend/pages/profile/index', $data);
    }

    public function update()
    {
        $userId = session()->get('user_id');

        // Validation rules
        $rules = [
            'nm_lengkap' => [
                'label' => 'Nama Lengkap',
                'rules' => 'required|min_length[3]|max_length[250]',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'min_length' => '{field} minimal {param} karakter.',
                    'max_length' => '{field} maksimal {param} karakter.'
                ]
            ],
            'email' => [
                'label' => 'Email',
                'rules' => "required|valid_email|is_unique[users.email,id,$userId]",
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'valid_email' => '{field} tidak valid.',
                    'is_unique' => '{field} sudah digunakan oleh pengguna lain.'
                ]
            ],
            'username' => [
                'label' => 'Username',
                'rules' => "required|min_length[3]|max_length[100]|is_unique[users.username,id,$userId]",
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'min_length' => '{field} minimal {param} karakter.',
                    'is_unique' => '{field} sudah digunakan.'
                ]
            ],
            'no_hp' => [
                'label' => 'No. Handphone',
                'rules' => 'permit_empty|max_length[25]',
                'errors' => [
                    'max_length' => '{field} terlalu panjang.'
                ]
            ],
            'profile_image' => [
                'label' => 'Foto Profil',
                'rules' => 'permit_empty|is_image[profile_image]|mime_in[profile_image,image/jpg,image/jpeg,image/png]|max_size[profile_image,2048]',
                'errors' => [
                    'is_image' => 'File harus berupa gambar.',
                    'mime_in' => 'Format gambar harus JPG, JPEG, atau PNG.',
                    'max_size' => 'Ukuran gambar maksimal 2MB.'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Get Input
        $data = [
            'nm_lengkap' => $this->request->getPost('nm_lengkap'),
            'email' => $this->request->getPost('email'),
            'username' => $this->request->getPost('username'),
            'no_hp' => $this->request->getPost('no_hp'),
        ];

        // Handle File Upload
        $file = $this->request->getFile('profile_image');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('uploads/profile', $newName);
            $data['profile_pict'] = $newName;

            // Optional: Delete old image if it's not default
            $oldUser = $this->userModel->find($userId);
            if ($oldUser->profile_pict && $oldUser->profile_pict != 'default.png') {
                $oldPath = 'uploads/profile/' . $oldUser->profile_pict;
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }
        }

        if ($this->userModel->update($userId, $data)) {
            // Update session data
            session()->set([
                'nm_lengkap' => $data['nm_lengkap'],
                'email' => $data['email'],
                'username' => $data['username'],
                'profile_pict' => $data['profile_pict'] ?? session()->get('profile_pict')
            ]);

            return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
        } else {
            return redirect()->back()->with('error', 'Gagal memperbarui profil.');
        }
    }

    public function changePassword()
    {
        $userId = session()->get('user_id');
        $user = $this->userModel->find($userId);

        $rules = [
            'current_password' => [
                'label' => 'Password Saat Ini',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi.'
                ]
            ],
            'new_password' => [
                'label' => 'Password Baru',
                'rules' => 'required|min_length[6]',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'min_length' => '{field} minimal {param} karakter.'
                ]
            ],
            'confirm_password' => [
                'label' => 'Konfirmasi Password',
                'rules' => 'required|matches[new_password]',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'matches' => '{field} tidak cocok dengan Password Baru.'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $currentPassword = $this->request->getPost('current_password');
        $newPassword = $this->request->getPost('new_password');

        // Verify current password
        if (!$this->userModel->verifyPassword($user, $currentPassword)) {
            return redirect()->back()->with('error', 'Password saat ini salah.');
        }

        // Update password
        // The Model's beforeUpdate callback will handle hashing
        if ($this->userModel->update($userId, ['password' => $newPassword])) {
            return redirect()->back()->with('success', 'Password berhasil diubah.');
        } else {
            return redirect()->back()->with('error', 'Gagal mengubah password.');
        }
    }
}
