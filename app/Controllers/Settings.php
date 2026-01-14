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
        // Ensure contact settings exist
        $this->seedContactSettings();

        $data = [
            'title' => 'Pengaturan Sistem',
            'settings' => $this->settingModel->getAllGrouped(),
            'groups' => [
                'company' => 'Informasi Perusahaan',
                'contact' => 'Pengaturan Kontak',
                'registration' => 'Pengaturan Pendaftaran',
                'notification' => 'Notifikasi',
                'system' => 'Sistem',
            ]
        ];

        return view('backend/pages/settings/index', $data);
    }

    /**
     * Seed contact settings if they don't exist
     */
    private function seedContactSettings()
    {
        $settings = [
            // Email Settings
            [
                'key' => 'contact_email_cs',
                'value' => 'cs@muaratirta.co.id',
                'type' => 'text',
                'label' => 'Email Customer Service',
                'description' => 'Email untuk layanan pelanggan',
                'group' => 'contact',
                'options' => null
            ],
            [
                'key' => 'contact_email_pr',
                'value' => 'pdam@muaratirta.co.id',
                'type' => 'text',
                'label' => 'Email Public Relation',
                'description' => 'Email untuk hubungan masyarakat',
                'group' => 'contact',
                'options' => null
            ],
            [
                'key' => 'contact_email_perumda',
                'value' => 'perumda@muaratirta.co.id',
                'type' => 'text',
                'label' => 'Email Perumda',
                'description' => 'Email resmi perumda',
                'group' => 'contact',
                'options' => null
            ],
            [
                'key' => 'contact_email_it',
                'value' => 'admin@muaratirta.co.id',
                'type' => 'text',
                'label' => 'Email IT Support',
                'description' => 'Email untuk dukungan teknis',
                'group' => 'contact',
                'options' => null
            ],
            // WhatsApp CS
            [
                'key' => 'contact_wa_cs',
                'value' => 'https://wa.me/6282292754405',
                'type' => 'text',
                'label' => 'Link WhatsApp CS',
                'description' => 'Link WA Customer Service (Format: https://wa.me/62...)',
                'group' => 'contact',
                'options' => null
            ],
            // WhatsApp Humas
            [
                'key' => 'contact_name_humas',
                'value' => 'Dedi Kiayi Demak',
                'type' => 'text',
                'label' => 'Nama Kontak Humas',
                'description' => 'Nama petugas Humas',
                'group' => 'contact',
                'options' => null
            ],
            [
                'key' => 'contact_wa_humas',
                'value' => 'https://wa.me/6281244782662',
                'type' => 'text',
                'label' => 'Link WhatsApp Humas',
                'description' => 'Link WA Humas',
                'group' => 'contact',
                'options' => null
            ],
            // WhatsApp Billing
            [
                'key' => 'contact_name_billing',
                'value' => 'Recky Pianaung',
                'type' => 'text',
                'label' => 'Nama Kontak Penagihan',
                'description' => 'Nama petugas penagihan',
                'group' => 'contact',
                'options' => null
            ],
            [
                'key' => 'contact_wa_billing',
                'value' => 'https://wa.me/6281244697154',
                'type' => 'text',
                'label' => 'Link WhatsApp Penagihan',
                'description' => 'Link WA Penagihan',
                'group' => 'contact',
                'options' => null
            ],
            // Location
            [
                'key' => 'contact_address',
                'value' => 'Jl. Drs. Achmad Nadjamuddin, Limba U Dua, Kota Sel., Kota Gorontalo, Gorontalo 96138',
                'type' => 'textarea',
                'label' => 'Alamat Kantor',
                'description' => 'Alamat lengkap kantor',
                'group' => 'contact',
                'options' => null
            ],
            [
                'key' => 'contact_maps_url',
                'value' => 'https://maps.google.com/maps?q=perumda+air+minum+muara+tirta&t=k&z=16&ie=UTF8&iwloc=&output=embed',
                'type' => 'textarea',
                'label' => 'URL Google Maps Embed',
                'description' => 'URL src dari iframe Google Maps',
                'group' => 'contact',
                'options' => null
            ],
        ];

        foreach ($settings as $setting) {
            // Check if exists
            if (!$this->settingModel->where('key', $setting['key'])->first()) {
                $this->settingModel->insert($setting);
            }
        }
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
