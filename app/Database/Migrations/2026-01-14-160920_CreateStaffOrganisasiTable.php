<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateStaffOrganisasiTable extends Migration
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
            'nip' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
                'comment' => 'Nomor Induk Pegawai',
            ],
            'nm_lengkap' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ],
            'gelar_depan' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
            ],
            'gelar_belakang' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'bagian_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'comment' => 'FK ke tabel bagian',
            ],
            'tingkat_jabatan_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'comment' => 'FK ke tabel tingkat_jabatan',
            ],
            'jabatan_spesifik' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'comment' => 'Nama jabatan lengkap (Manajer Teknik, dll)',
            ],
            'profile_pict' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'no_hp' => [
                'type' => 'VARCHAR',
                'constraint' => 25,
                'null' => true,
            ],
            'status_kepegawaian' => [
                'type' => 'ENUM',
                'constraint' => ['PNS', 'PPPK', 'Kontrak', 'Honorer'],
                'default' => 'PNS',
            ],
            'urutan_tampil' => [
                'type' => 'INT',
                'constraint' => 3,
                'default' => 0,
                'comment' => 'Urutan dalam 1 bagian & level',
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
        $this->forge->addForeignKey('bagian_id', 'bagian', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('tingkat_jabatan_id', 'tingkat_jabatan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('staff_organisasi');
    }

    public function down()
    {
        $this->forge->dropTable('staff_organisasi');
    }
}
