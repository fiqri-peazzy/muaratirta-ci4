<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateChatAssistantTables extends Migration
{
    public function up()
    {
        // Table chat_faq
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'pertanyaan' => [
                'type'       => 'VARCHAR',
                'constraint' => '500',
            ],
            'jawaban' => [
                'type' => 'TEXT',
            ],
            'kategori' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
            ],
            'is_active' => [
                'type'       => 'ENUM',
                'constraint' => ['0', '1'],
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
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('chat_faq');

        // Table chat_info
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'judul' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'kategori' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
            ],
            'konten' => [
                'type' => 'TEXT',
            ],
            'is_active' => [
                'type'       => 'ENUM',
                'constraint' => ['0', '1'],
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
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('chat_info');

        // Table chat_history
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'session_id' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
            ],
            'user_message' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'bot_response' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'intent' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('chat_history');

        // Seed initial data
        $db = \Config\Database::connect();

        $db->table('chat_faq')->insertBatch([
            [
                'pertanyaan' => 'Bagaimana cara mendaftar pelanggan baru?',
                'jawaban'    => 'Untuk mendaftar sebagai pelanggan baru PDAM Muaratirta, Anda perlu: 1) Datang ke kantor PDAM dengan membawa KTP dan KK, 2) Isi formulir pendaftaran, 3) Bayar biaya penyambungan. Proses pemasangan biasanya 3-7 hari kerja.',
                'kategori'   => 'Pendaftaran',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'pertanyaan' => 'Apa saja syarat pendaftaran pelanggan baru?',
                'jawaban'    => 'Syarat pendaftaran: 1) KTP asli dan fotocopy, 2) Kartu Keluarga (KK) asli dan fotocopy, 3) Surat kepemilikan rumah atau surat kontrak, 4) Biaya penyambungan sesuai ketentuan yang berlaku.',
                'kategori'   => 'Pendaftaran',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'pertanyaan' => 'Bagaimana cara cek tagihan air?',
                'jawaban'    => 'Anda bisa cek tagihan dengan cara: 1) Gunakan fitur cek tagihan di chat ini dengan memasukkan nomor pelanggan, 2) Datang langsung ke kantor PDAM, 3) Atau hubungi customer service kami.',
                'kategori'   => 'Tagihan',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'pertanyaan' => 'Dimana bisa membayar tagihan air?',
                'jawaban'    => 'Pembayaran tagihan bisa dilakukan di: 1) Kantor PDAM Muaratirta, 2) Bank BRI, BNI, Mandiri yang bekerja sama, 3) Minimarket (Indomaret/Alfamart), 4) Aplikasi mobile banking.',
                'kategori'   => 'Pembayaran',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'pertanyaan' => 'Bagaimana cara mengajukan pengaduan?',
                'jawaban'    => 'Anda bisa mengajukan pengaduan melalui: 1) Chat assistant ini dengan memilih menu pengaduan, 2) Datang langsung ke kantor PDAM, 3) Telepon ke customer service kami di (0435)xxxxxx.',
                'kategori'   => 'Pengaduan',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);

        $db->table('chat_info')->insertBatch([
            [
                'judul'      => 'Tarif Kelompok I (0-10 m3)',
                'kategori'   => 'Tarif',
                'konten'     => 'Untuk pemakaian 0-10 m3 per bulan dikenakan tarif Rp 1.500 per m3. Ditambah biaya administrasi dan pemeliharaan.',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'judul'      => 'Tarif Kelompok II (11-20 m3)',
                'kategori'   => 'Tarif',
                'konten'     => 'Untuk pemakaian 11-20 m3 per bulan dikenakan tarif Rp 2.000 per m3. Ditambah biaya administrasi dan pemeliharaan.',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'judul'      => 'Tarif Kelompok III (>20 m3)',
                'kategori'   => 'Tarif',
                'konten'     => 'Untuk pemakaian lebih dari 20 m3 per bulan dikenakan tarif Rp 2.500 per m3. Ditambah biaya administrasi dan pemeliharaan.',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'judul'      => 'Jam Operasional',
                'kategori'   => 'Layanan',
                'konten'     => 'Kantor PDAM Muaratirta buka Senin-Jumat pukul 08.00-16.00 WITA. Sabtu pukul 08.00-12.00 WITA. Minggu dan hari libur nasional tutup.',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'judul'      => 'Kontak Customer Service',
                'kategori'   => 'Layanan',
                'konten'     => 'Customer Service PDAM Muaratirta dapat dihubungi di: Telepon: (0435) xxxxxx, WhatsApp: 08xx-xxxx-xxxx, Email: cs@muaratirta.go.id',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropTable('chat_faq');
        $this->forge->dropTable('chat_info');
        $this->forge->dropTable('chat_history');
    }
}
