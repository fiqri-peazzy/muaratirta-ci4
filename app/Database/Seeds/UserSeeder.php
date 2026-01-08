<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'username'     => 'admin',
                'email'        => 'admin@muaratirta.go.id',
                'password'     => password_hash('admin123', PASSWORD_BCRYPT),
                'nm_lengkap'   => 'Administrator',
                'no_hp'        => '081234567890',
                'profile_pict' => 'default.png',
                'level'        => '1',
                'is_active'    => '1',
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ],
            [
                'username'     => 'cs_user',
                'email'        => 'cs@muaratirta.go.id',
                'password'     => password_hash('cs123456', PASSWORD_BCRYPT),
                'nm_lengkap'   => 'Customer Service',
                'no_hp'        => '081234567891',
                'profile_pict' => 'default.png',
                'level'        => '2',
                'is_active'    => '1',
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ],
            [
                'username'     => 'publikasi',
                'email'        => 'publikasi@muaratirta.go.id',
                'password'     => password_hash('pub123456', PASSWORD_BCRYPT),
                'nm_lengkap'   => 'Tim Publikasi',
                'no_hp'        => '081234567892',
                'profile_pict' => 'default.png',
                'level'        => '3',
                'is_active'    => '1',
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ],
        ];

        // Insert data
        $this->db->table('users')->insertBatch($data);

        echo "Users seeded successfully!\n";
        echo "===========================\n";
        echo "Admin:\n";
        echo "  Username: admin\n";
        echo "  Password: admin123\n";
        echo "  Level: Admin (1)\n\n";
        
        echo "Customer Service:\n";
        echo "  Username: cs_user\n";
        echo "  Password: cs123456\n";
        echo "  Level: CS (2)\n\n";
        
        echo "Publikasi:\n";
        echo "  Username: publikasi\n";
        echo "  Password: pub123456\n";
        echo "  Level: Publikasi (3)\n";
    }
}