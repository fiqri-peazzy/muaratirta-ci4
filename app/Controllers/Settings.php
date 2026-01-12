<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SettingModel;

class Settings extends BaseController
{
    protected $settingModel;
    protected $session;

    public function __construct()
    {
        $this->settingModel = new SettingModel();
        $this->session = \Config\Services::session();
        helper(['form', 'url', 'filesystem']);
    }

    /**
     * Display settings page
     */
    public function index()
    {
        $data = [
            'title' => 'Pengaturan Sistem',
            'settings' => $this->settingModel->getAllGrouped(),
            'groups' => [
                'company' => 'Informasi Perusahaan',
                'registration' => 'Pengaturan Pendaftaran',
                'notification' => 'Notifikasi',
                'system' => 'Sistem',
            ]
        ];

        return view('backend/pages/settings/index', $data);
    }

    /**
     * Update settings
     */
    public function update()
    {
        $postData = $this->request->getPost();

        if (empty($postData)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Tidak ada data yang diupdate'
            ]);
        }

        try {
            foreach ($postData as $key => $value) {
                // Skip CSRF token
                if ($key === csrf_token()) {
                    continue;
                }

                // Handle file upload for image type
                if (strpos($key, '_file') !== false) {
                    $actualKey = str_replace('_file', '', $key);
                    $file = $this->request->getFile($actualKey);

                    if ($file && $file->isValid() && !$file->hasMoved()) {
                        // Delete old file if exists
                        $oldValue = $this->settingModel->getSetting($actualKey);
                        if ($oldValue && file_exists(FCPATH . $oldValue)) {
                            unlink(FCPATH . $oldValue);
                        }

                        // Upload new file
                        $newName = $file->getRandomName();
                        $file->move(FCPATH . 'uploads/settings/', $newName);

                        $value = 'uploads/settings/' . $newName;
                        $this->settingModel->setSetting($actualKey, $value);
                    }
                } else {
                    // Regular field update
                    $this->settingModel->setSetting($key, $value);
                }
            }

            $this->session->setFlashdata('success', 'Pengaturan berhasil diupdate');

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Pengaturan berhasil diupdate'
            ]);
        } catch (\Exception $e) {
            log_message('error', 'Settings Update Error: ' . $e->getMessage());

            return $this->response->setJSON([
                'success' => false,
                'message' => 'Gagal update pengaturan: ' . $e->getMessage()
            ]);
        }
    }
}
