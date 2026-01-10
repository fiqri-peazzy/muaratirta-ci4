<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KategoriSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_kategori' => 'Galeri',
                'slug'          => 'galeri',
                'icon'          => 'bi-images',
                'deskripsi'     => 'Kumpulan foto dan galeri kegiatan',
                'is_active'     => '1',
                'urutan'        => 1,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'nama_kategori' => 'Artikel & Berita',
                'slug'          => 'artikel-berita',
                'icon'          => 'bi-newspaper',
                'deskripsi'     => 'Artikel dan berita terkini',
                'is_active'     => '1',
                'urutan'        => 2,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'nama_kategori' => 'Info Gangguan',
                'slug'          => 'info-gangguan',
                'icon'          => 'bi-exclamation-triangle',
                'deskripsi'     => 'Informasi gangguan layanan',
                'is_active'     => '1',
                'urutan'        => 3,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'nama_kategori' => 'Info Promo',
                'slug'          => 'info-promo',
                'icon'          => 'bi-megaphone',
                'deskripsi'     => 'Informasi promosi dan penawaran',
                'is_active'     => '1',
                'urutan'        => 4,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('publikasi_kategori')->insertBatch($data);
        
        echo "Kategori publikasi berhasil di-seed!\n";
    }
}