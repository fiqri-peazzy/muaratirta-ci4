<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBagianTable extends Migration
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
            'kd_bagian' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'unique' => true,
                'comment' => 'Kode unik bagian (BGN-XXXX)',
            ],
            'nama_bagian' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ],
            'parent_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
                'comment' => 'ID parent untuk sub bagian',
            ],
            'urutan' => [
                'type' => 'INT',
                'constraint' => 3,
                'default' => 0,
                'comment' => 'Urutan tampil',
            ],
            'deskripsi' => [
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
        $this->forge->createTable('bagian');

        // Insert default data
        $data = [
            ['kd_bagian' => 'BGN-4864', 'nama_bagian' => 'Direksi', 'urutan' => 1, 'parent_id' => null],
            ['kd_bagian' => 'BGN-6713', 'nama_bagian' => 'Satuan Pengawas Internal', 'urutan' => 2, 'parent_id' => null],
            ['kd_bagian' => 'BGN-2568', 'nama_bagian' => 'Teknik Dan Pengembangan', 'urutan' => 3, 'parent_id' => null],
            ['kd_bagian' => 'BGN-8727', 'nama_bagian' => 'Hubungan Langganan', 'urutan' => 4, 'parent_id' => null],
            ['kd_bagian' => 'BGN-2686', 'nama_bagian' => 'Administrasi Umum Dan Keuangan', 'urutan' => 5, 'parent_id' => null],
            ['kd_bagian' => 'BGN-3751', 'nama_bagian' => 'Staff Ahli', 'urutan' => 6, 'parent_id' => null],
        ];

        $this->db->table('bagian')->insertBatch($data);
    }

    public function down()
    {
        $this->forge->dropTable('bagian');
    }
}
