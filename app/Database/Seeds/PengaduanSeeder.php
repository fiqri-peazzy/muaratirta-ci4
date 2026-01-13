<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PengaduanSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');
        $kategoriList = ['umum', 'teknis', 'administrasi', 'tagihan', 'kualitas_air', 'kebocoran', 'sambungan_baru', 'lainnya'];
        $statusList = ['pending', 'proses', 'selesai', 'ditolak'];
        $prioritasList = ['rendah', 'sedang', 'tinggi', 'urgent'];

        for ($i = 0; $i < 10; $i++) {
            $status = $statusList[array_rand($statusList)];
            $kategori = $kategoriList[array_rand($kategoriList)];
            $prioritas = $prioritasList[array_rand($prioritasList)];

            // Format nomor pengaduan: PGD/YYYYMMDD/XXXX
            $date = date('Ymd');
            $no_pengaduan = 'PGD/' . $date . '/' . str_pad($i + 1, 4, '0', STR_PAD_LEFT);

            $data = [
                'no_pengaduan'  => $no_pengaduan,
                'id_pel'        => $faker->boolean(70) ? '120' . $faker->numerify('#########') : null,
                'nm_lengkap'    => $faker->name,
                'alamat'        => $faker->address,
                'no_hp'         => '08' . $faker->numerify('##########'),
                'email'         => $faker->email,
                'kategori'      => $kategori,
                'isi_pengaduan' => $this->getMockIsiPengaduan($kategori),
                'status'        => $status,
                'prioritas'     => $prioritas,
                'handled_by'    => ($status !== 'pending') ? 1 : null, // Assuming user ID 1 exists
                'handled_at'    => ($status !== 'pending') ? date('Y-m-d H:i:s', strtotime('-1 day')) : null,
                'tanggapan'     => ($status === 'selesai' || $status === 'proses') ? 'Petugas kami sedang menuju lokasi untuk pengecekan.' : null,
                'catatan_admin' => ($status === 'ditolak') ? 'Data pelanggan tidak sesuai atau wilayah di luar jangkauan.' : null,
                'resolved_at'   => ($status === 'selesai') ? date('Y-m-d H:i:s') : null,
                'ip_address'    => $faker->ipv4,
                'user_agent'    => $faker->userAgent,
                'created_at'    => date('Y-m-d H:i:s', strtotime('-' . rand(1, 5) . ' days')),
                'updated_at'    => date('Y-m-d H:i:s'),
            ];

            $this->db->table('pengaduan')->insert($data);
        }
    }

    private function getMockIsiPengaduan($kategori)
    {
        $messages = [
            'umum'           => 'Saya ingin bertanya mengenai jam operasional kantor pusat PDAM.',
            'teknis'         => 'Pipa di depan rumah saya sepertinya tersumbat, aliran air sangat kecil sejak pagi.',
            'administrasi'   => 'Saya ingin mengubah nama pemilik sambungan air, dokumen apa saja yang diperlukan?',
            'tagihan'        => 'Tagihan bulan ini melonjak drastis padahal pemakaian normal, mohon dicek meternya.',
            'kualitas_air'   => 'Air yang mengalir ke rumah saya berwarna keruh dan berbau kaporit sangat tajam.',
            'kebocoran'      => 'Ada kebocoran pipa besar di jalan utama dekat rumah saya, air terbuang banyak ke jalan.',
            'sambungan_baru' => 'Kapan pendaftaran sambungan baru untuk daerah perumahan asri dibuka kembali?',
            'lainnya'        => 'Mohon tingkatkan pelayanan di aplikasi mobile, sering terjadi error saat cek tagihan.',
        ];

        return $messages[$kategori] ?? 'Mohon bantuan terkait layanan PDAM.';
    }
}
