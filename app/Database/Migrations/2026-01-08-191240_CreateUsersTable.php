<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersTable extends Migration
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
            'username' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'unique'     => true,
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => '150',
                'unique'     => true,
            ],
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'nm_lengkap' => [
                'type'       => 'VARCHAR',
                'constraint' => '250',
            ],
            'no_hp' => [
                'type'       => 'VARCHAR',
                'constraint' => '25',
                'null'       => true,
            ],
            'profile_pict' => [
                'type'       => 'VARCHAR',
                'constraint' => '250',
                'null'       => true,
                'default'    => 'default.png',
            ],
            'level' => [
                'type'       => 'ENUM',
                'constraint' => ['1', '2', '3'],
                'default'    => '3',
                'comment'    => '1=Admin, 2=CS, 3=Publikasi',
            ],
            'is_active' => [
                'type'       => 'ENUM',
                'constraint' => ['1', '0'],
                'default'    => '1',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        
        $this->forge->createTable('users', true);
    }

    public function down()
    {
        $this->forge->dropTable('users', true);
    }
}