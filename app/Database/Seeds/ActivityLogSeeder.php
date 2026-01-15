<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ActivityLogSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'user_id' => 1,
                'user_name' => 'Admin System',
                'activity_type' => 'create',
                'module' => 'pengaduan',
                'description' => 'Pengaduan baru dari pelanggan ID: PGD/20260116/0001',
                'status' => 'success',
                'ip_address' => '127.0.0.1',
                'user_agent' => 'Mozilla/5.0',
                'created_at' => date('Y-m-d H:i:s', strtotime('-2 hours'))
            ],
            [
                'user_id' => 1,
                'user_name' => 'Admin System',
                'activity_type' => 'update',
                'module' => 'pengaduan',
                'description' => 'Status pengaduan PGD/20260116/0001 diubah menjadi selesai',
                'status' => 'success',
                'ip_address' => '127.0.0.1',
                'user_agent' => 'Mozilla/5.0',
                'created_at' => date('Y-m-d H:i:s', strtotime('-1 hour'))
            ],
            [
                'user_id' => 1,
                'user_name' => 'Admin System',
                'activity_type' => 'create',
                'module' => 'artikel',
                'description' => 'Artikel baru dipublikasikan: Tips Hemat Air',
                'status' => 'success',
                'ip_address' => '127.0.0.1',
                'user_agent' => 'Mozilla/5.0',
                'created_at' => date('Y-m-d H:i:s', strtotime('-30 minutes'))
            ],
            [
                'user_id' => 1,
                'user_name' => 'Admin System',
                'activity_type' => 'update',
                'module' => 'pendaftaran',
                'description' => 'Pendaftaran pelanggan baru disetujui',
                'status' => 'success',
                'ip_address' => '127.0.0.1',
                'user_agent' => 'Mozilla/5.0',
                'created_at' => date('Y-m-d H:i:s', strtotime('-15 minutes'))
            ],
            [
                'user_id' => 1,
                'user_name' => 'Admin System',
                'activity_type' => 'login',
                'module' => 'auth',
                'description' => 'User login ke sistem',
                'status' => 'success',
                'ip_address' => '127.0.0.1',
                'user_agent' => 'Mozilla/5.0',
                'created_at' => date('Y-m-d H:i:s', strtotime('-5 minutes'))
            ],
            [
                'user_id' => 1,
                'user_name' => 'Admin System',
                'activity_type' => 'create',
                'module' => 'pengaduan',
                'description' => 'Pengaduan baru: Kebocoran pipa di Jl. Merdeka',
                'status' => 'pending',
                'ip_address' => '127.0.0.1',
                'user_agent' => 'Mozilla/5.0',
                'created_at' => date('Y-m-d H:i:s')
            ],
        ];

        // Insert data
        $this->db->table('activity_logs')->insertBatch($data);

        echo "Activity logs seeded successfully!\n";
    }
}
