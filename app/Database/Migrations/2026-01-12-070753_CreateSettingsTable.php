<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSettingsTable extends Migration
{
    public function up()
    {
        // Drop table if exists to handle failed migration retry
        $this->forge->dropTable('settings', true);

        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'key' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'unique' => true,
            ],
            'value' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'type' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'default' => 'text',
                'comment' => 'text, textarea, number, email, url, image, select',
            ],
            'label' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'group' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'default' => 'general',
            ],
            'options' => [
                'type' => 'TEXT',
                'null' => true,
                'comment' => 'JSON format for select options',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        // $this->forge->addKey('key');
        $this->forge->createTable('settings');

        // Insert default settings
        $data = [
            // Company Info
            [
                'key' => 'company_name',
                'value' => 'PERUMDA AIR MINUM MUARA TIRTA',
                'type' => 'text',
                'label' => 'Nama Perusahaan',
                'description' => 'Nama lengkap perusahaan',
                'group' => 'company',
                'options' => null,
            ],
            [
                'key' => 'company_address',
                'value' => 'Jl. Contoh No. 123, Kota Bontang, Kalimantan Timur',
                'type' => 'textarea',
                'label' => 'Alamat Perusahaan',
                'description' => 'Alamat lengkap kantor',
                'group' => 'company',
                'options' => null,
            ],
            [
                'key' => 'company_phone',
                'value' => '(0548) 123456',
                'type' => 'text',
                'label' => 'Telepon',
                'description' => 'Nomor telepon kantor',
                'group' => 'company',
                'options' => null,
            ],
            [
                'key' => 'company_email',
                'value' => 'info@muaratirta.co.id',
                'type' => 'email',
                'label' => 'Email',
                'description' => 'Email resmi perusahaan',
                'group' => 'company',
                'options' => null,
            ],
            [
                'key' => 'company_website',
                'value' => 'https://muaratirta.co.id',
                'type' => 'url',
                'label' => 'Website',
                'description' => 'URL website perusahaan',
                'group' => 'company',
                'options' => null,
            ],
            [
                'key' => 'company_logo',
                'value' => null,
                'type' => 'image',
                'label' => 'Logo Perusahaan',
                'description' => 'Upload logo untuk kop surat dan PDF',
                'group' => 'company',
                'options' => null,
            ],

            // Registration Settings
            [
                'key' => 'registration_enabled',
                'value' => '1',
                'type' => 'select',
                'label' => 'Status Pendaftaran',
                'description' => 'Aktifkan/nonaktifkan form pendaftaran baru',
                'group' => 'registration',
                'options' => json_encode(['1' => 'Aktif', '0' => 'Nonaktif']),
            ],
            [
                'key' => 'registration_message',
                'value' => 'Pendaftaran pasang baru sedang dibuka!',
                'type' => 'textarea',
                'label' => 'Pesan Pendaftaran',
                'description' => 'Pesan yang ditampilkan di halaman pendaftaran',
                'group' => 'registration',
                'options' => null,
            ],
            [
                'key' => 'registration_max_file_size',
                'value' => '2048',
                'type' => 'number',
                'label' => 'Maksimal Ukuran File (KB)',
                'description' => 'Ukuran maksimal file foto yang diupload',
                'group' => 'registration',
                'options' => null,
            ],

            // Notification Settings
            [
                'key' => 'notification_email_enabled',
                'value' => '1',
                'type' => 'select',
                'label' => 'Email Notifikasi',
                'description' => 'Kirim email otomatis ke pemohon',
                'group' => 'notification',
                'options' => json_encode(['1' => 'Aktif', '0' => 'Nonaktif']),
            ],
            [
                'key' => 'notification_admin_email',
                'value' => 'admin@muaratirta.co.id',
                'type' => 'email',
                'label' => 'Email Admin',
                'description' => 'Email untuk notifikasi admin',
                'group' => 'notification',
                'options' => null,
            ],

            // System Settings
            [
                'key' => 'system_maintenance',
                'value' => '0',
                'type' => 'select',
                'label' => 'Mode Maintenance',
                'description' => 'Aktifkan mode maintenance sistem',
                'group' => 'system',
                'options' => json_encode(['1' => 'Aktif', '0' => 'Nonaktif']),
            ],
            [
                'key' => 'system_timezone',
                'value' => 'Asia/Makassar',
                'type' => 'select',
                'label' => 'Timezone',
                'description' => 'Zona waktu sistem',
                'group' => 'system',
                'options' => json_encode([
                    'Asia/Jakarta' => 'WIB (Jakarta)',
                    'Asia/Makassar' => 'WITA (Makassar)',
                    'Asia/Jayapura' => 'WIT (Jayapura)',
                ]),
            ],
        ];

        $this->db->table('settings')->insertBatch($data);
    }

    public function down()
    {
        $this->forge->dropTable('settings');
    }
}
