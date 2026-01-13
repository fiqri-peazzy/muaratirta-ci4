<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePengaduanTable extends Migration
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
            'no_pengaduan' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'unique' => true,
                'comment' => 'Nomor unik pengaduan (auto generate)',
            ],
            'id_pel' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
                'comment' => 'ID Pelanggan (opsional)',
            ],
            'nm_lengkap' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ],
            'alamat' => [
                'type' => 'TEXT',
            ],
            'no_hp' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'kategori' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'default' => 'umum',
                'comment' => 'Kategori pengaduan',
            ],
            'isi_pengaduan' => [
                'type' => 'LONGTEXT',
            ],
            'foto' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
                'comment' => 'Foto pendukung pengaduan',
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['pending', 'proses', 'selesai', 'ditolak'],
                'default' => 'pending',
            ],
            'prioritas' => [
                'type' => 'ENUM',
                'constraint' => ['rendah', 'sedang', 'tinggi', 'urgent'],
                'default' => 'sedang',
            ],
            'handled_by' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
                'comment' => 'ID user yang menangani',
            ],
            'handled_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'catatan_admin' => [
                'type' => 'TEXT',
                'null' => true,
                'comment' => 'Catatan dari admin/CS',
            ],
            'tanggapan' => [
                'type' => 'TEXT',
                'null' => true,
                'comment' => 'Tanggapan terhadap pengaduan',
            ],
            'resolved_at' => [
                'type' => 'DATETIME',
                'null' => true,
                'comment' => 'Tanggal penyelesaian',
            ],
            'ip_address' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
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
        $this->forge->addForeignKey('handled_by', 'users', 'id', 'CASCADE', 'SET NULL');
        $this->forge->createTable('pengaduan');
    }

    public function down()
    {
        $this->forge->dropTable('pengaduan');
    }
}
