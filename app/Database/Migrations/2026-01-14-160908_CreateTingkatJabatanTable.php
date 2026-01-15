<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTingkatJabatanTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nama_tingkat' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'comment' => 'Nama tingkat jabatan (Direktur, Manajer, dll)',
            ],
            'level' => [
                'type' => 'INT',
                'constraint' => 3,
                'comment' => '1=tertinggi, semakin besar semakin rendah',
            ],
            'keterangan' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'is_active' => [
                'type' => 'ENUM',
                'constraint' => ['0', '1'],
                'default' => '1',
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
        // $this->forge->addKey('level');
        $this->forge->createTable('tingkat_jabatan');

        // Insert default data
        $data = [
            ['nama_tingkat' => 'Kuasa Pemilik Modal', 'level' => 1, 'keterangan' => 'Walikota'],
            ['nama_tingkat' => 'Dewan Pengawas', 'level' => 2, 'keterangan' => 'Pengawas perusahaan'],
            ['nama_tingkat' => 'Direktur', 'level' => 3, 'keterangan' => 'Pimpinan tertinggi operasional'],
            ['nama_tingkat' => 'Kepala Satuan', 'level' => 4, 'keterangan' => 'Kepala satuan pengawas'],
            ['nama_tingkat' => 'Manajer', 'level' => 5, 'keterangan' => 'Kepala bagian/divisi'],
            ['nama_tingkat' => 'Asisten Manajer', 'level' => 6, 'keterangan' => 'Asisten kepala bagian'],
            ['nama_tingkat' => 'Kepala Bidang', 'level' => 7, 'keterangan' => 'Kepala sub bagian'],
            ['nama_tingkat' => 'Staff Ahli', 'level' => 8, 'keterangan' => 'Tenaga ahli'],
            ['nama_tingkat' => 'Staff', 'level' => 9, 'keterangan' => 'Staff pelaksana'],
        ];

        $this->db->table('tingkat_jabatan')->insertBatch($data);
    }

    public function down()
    {
        $this->forge->dropTable('tingkat_jabatan');
    }
}
