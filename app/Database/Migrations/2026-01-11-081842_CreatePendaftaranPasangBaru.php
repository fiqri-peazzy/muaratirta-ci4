<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePendaftaranPasangBaru extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'no_pendaftaran' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'unique'     => true,
            ],
            // Data Pemohon
            'nama_lengkap' => [
                'type'       => 'VARCHAR',
                'constraint' => '200',
            ],
            'nik' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
                'null'       => true,
            ],
            // Alamat Pemasangan
            'alamat_pemasangan' => [
                'type' => 'TEXT',
            ],
            'rt' => [
                'type'       => 'VARCHAR',
                'constraint' => '5',
                'null'       => true,
            ],
            'rw' => [
                'type'       => 'VARCHAR',
                'constraint' => '5',
                'null'       => true,
            ],
            'kelurahan' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
            ],
            'kecamatan' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
            ],
            // Koordinat Lokasi (GPS)
            'latitude' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => true,
            ],
            'longitude' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => true,
            ],
            // Kontak
            'no_hp' => [
                'type'       => 'VARCHAR',
                'constraint' => '16',
            ],
            'no_wa' => [
                'type'       => 'VARCHAR',
                'constraint' => '16',
                'null'       => true,
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
            ],
            // Upload Files
            'foto_ktp' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'foto_rumah' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            // Konfirmasi Biaya (HANYA CHECKBOX - TIDAK ADA PAYMENT)
            'setuju_biaya' => [
                'type'       => 'ENUM',
                'constraint' => ['0', '1'],
                'default'    => '0',
                'comment'    => 'User setuju dengan biaya admin Rp 20.000',
            ],
            // Status & Tindak Lanjut
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['pending', 'verifikasi', 'approved', 'survey', 'rejected'],
                'default'    => 'pending',
            ],
            'tindak_lanjut' => [
                'type'       => 'ENUM',
                'constraint' => ['0', '1'],
                'default'    => '0',
                'comment'    => 'Admin sudah tindak lanjut atau belum',
            ],
            'catatan_admin' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'catatan_penolakan' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            // Verifikasi
            'verified_by' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
            'verified_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            // Survey
            'surveyed_by' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
            'surveyed_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'catatan_survey' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            // Tracking
            'ip_address' => [
                'type'       => 'VARCHAR',
                'constraint' => '45',
                'null'       => true,
            ],
            'user_agent' => [
                'type' => 'TEXT',
                'null' => true,
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


        $this->forge->createTable('pendaftaran_pasang_baru', true);
    }

    public function down()
    {
        $this->forge->dropTable('pendaftaran_pasang_baru', true);
    }
}
