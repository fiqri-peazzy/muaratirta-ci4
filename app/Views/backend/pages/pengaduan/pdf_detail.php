<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Pengaduan <?= esc($pengaduan->no_pengaduan) ?></title>
    <style>
        @page {
            margin: 2cm 1.5cm;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 11pt;
            line-height: 1.4;
        }

        .header {
            border-bottom: 3px solid #0d6efd;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .header table {
            width: 100%;
        }

        .logo {
            width: 80px;
            height: auto;
        }

        .company-info {
            text-align: right;
        }

        .company-info h2 {
            margin: 0;
            color: #0d6efd;
            font-size: 18pt;
        }

        .company-info p {
            margin: 2px 0;
            font-size: 9pt;
            color: #666;
        }

        .title {
            text-align: center;
            margin: 20px 0;
            padding: 10px;
            background: #f8f9fa;
            border-radius: 5px;
        }

        .title h3 {
            margin: 0;
            color: #0d6efd;
        }

        .section {
            margin-bottom: 20px;
        }

        .section-title {
            background: #0d6efd;
            color: white;
            padding: 8px 12px;
            margin-bottom: 10px;
            font-weight: bold;
            border-radius: 3px;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        .info-table td {
            padding: 6px 10px;
            border-bottom: 1px solid #dee2e6;
        }

        .info-table td.label {
            width: 35%;
            font-weight: bold;
            color: #495057;
        }

        .info-table td.value {
            color: #212529;
        }

        .status-badge {
            display: inline-block;
            padding: 5px 15px;
            border-radius: 15px;
            font-weight: bold;
            font-size: 10pt;
        }

        .status-pending {
            background: #fff3cd;
            color: #856404;
        }

        .status-proses {
            background: #cfe2ff;
            color: #084298;
        }

        .status-selesai {
            background: #d1e7dd;
            color: #0f5132;
        }

        .status-ditolak {
            background: #f8d7da;
            color: #842029;
        }

        .prioritas-badge {
            display: inline-block;
            padding: 5px 15px;
            border-radius: 15px;
            font-weight: bold;
            font-size: 10pt;
        }

        .prioritas-rendah {
            background: #e2e3e5;
            color: #41464b;
        }

        .prioritas-sedang {
            background: #cff4fc;
            color: #055160;
        }

        .prioritas-tinggi {
            background: #fff3cd;
            color: #856404;
        }

        .prioritas-urgent {
            background: #f8d7da;
            color: #842029;
        }

        .pengaduan-content {
            background: #f8f9fa;
            padding: 15px;
            border-left: 4px solid #0d6efd;
            margin: 15px 0;
            white-space: pre-wrap;
            word-wrap: break-word;
        }

        .photo-section {
            margin-top: 20px;
            page-break-inside: avoid;
        }

        .photo-container {
            text-align: center;
            margin-bottom: 15px;
            page-break-inside: avoid;
        }

        .photo-container img {
            max-width: 100%;
            height: auto;
            border: 2px solid #dee2e6;
            border-radius: 5px;
            margin-top: 5px;
        }

        .photo-title {
            font-weight: bold;
            color: #0d6efd;
            margin-bottom: 5px;
            font-size: 12pt;
        }

        .response-box {
            background: #d1e7dd;
            border-left: 4px solid #198754;
            padding: 10px;
            margin: 15px 0;
        }

        .note-box {
            background: #cfe2ff;
            border-left: 4px solid #0d6efd;
            padding: 10px;
            margin: 15px 0;
        }

        .footer-info {
            margin-top: 30px;
            padding-top: 15px;
            border-top: 1px solid #dee2e6;
            font-size: 9pt;
            color: #6c757d;
        }

        .kategori-badge {
            background: #e2e3e5;
            padding: 5px 10px;
            border-radius: 10px;
            font-weight: bold;
            color: #41464b;
        }

        .contact-info {
            background: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 10px;
            margin: 15px 0;
        }

        .timeline {
            margin: 15px 0;
        }

        .timeline-item {
            padding: 10px;
            background: #f8f9fa;
            border-left: 3px solid #0d6efd;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <div class="header">
        <table>
            <tr>
                <td style="width: 100px;">
                    <?php if ($logo_base64): ?>
                        <img src="<?= $logo_base64 ?>" class="logo" alt="Logo">
                    <?php else: ?>
                        <div style="width: 80px; height: 80px; background: #0d6efd; color: white; display: flex; align-items: center; justify-content: center; border-radius: 5px;">
                            <strong style="font-size: 14pt;">LOGO</strong>
                        </div>
                    <?php endif; ?>
                </td>
                <td class="company-info">
                    <h2><?= get_setting('company_name', 'PERUMDA AIR MINUM MUARA TIRTA') ?></h2>
                    <p><?= get_setting('company_address', 'Jl. Contoh No. 123, Kota Bontang, Kalimantan Timur') ?></p>
                    <p>Telp: <?= get_setting('company_phone', '(0548) 123456') ?> | Email: <?= get_setting('company_email', 'info@muaratirta.co.id') ?></p>
                </td>
            </tr>
        </table>
    </div>

    <!-- Title -->
    <div class="title">
        <h3>LAPORAN PENGADUAN PELANGGAN</h3>
        <p style="margin: 5px 0 0 0; font-size: 10pt;">No. Pengaduan: <strong><?= esc($pengaduan->no_pengaduan) ?></strong></p>
    </div>

    <!-- Status & Prioritas -->
    <div class="section">
        <table class="info-table">
            <tr>
                <td class="label">Status Pengaduan</td>
                <td class="value">
                    <?php
                    $statusLabel = [
                        'pending' => 'Menunggu Ditangani',
                        'proses' => 'Sedang Diproses',
                        'selesai' => 'Selesai',
                        'ditolak' => 'Ditolak'
                    ];
                    // Safety check for status
                    $currentStatus = $pengaduan->status ?? 'pending';
                    $statusText = $statusLabel[$currentStatus] ?? 'Menunggu Ditangani';
                    ?>
                    <span class="status-badge status-<?= $currentStatus ?>">
                        <?= $statusText ?>
                    </span>
                </td>
            </tr>
            <tr>
                <td class="label">Tingkat Prioritas</td>
                <td class="value">
                    <?php
                    $currentPrioritas = $pengaduan->prioritas ?? 'sedang';
                    ?>
                    <span class="prioritas-badge prioritas-<?= $currentPrioritas ?>">
                        <?= strtoupper($currentPrioritas) ?>
                    </span>
                </td>
            </tr>
            <tr>
                <td class="label">Tanggal Pengaduan</td>
                <td class="value"><?= date('d F Y, H:i', strtotime($pengaduan->created_at)) ?> WIB</td>
            </tr>
            <tr>
                <td class="label">Kategori</td>
                <td class="value">
                    <?php
                    $categories = [
                        'umum' => 'Umum',
                        'teknis' => 'Teknis',
                        'administrasi' => 'Administrasi',
                        'tagihan' => 'Tagihan',
                        'kualitas_air' => 'Kualitas Air',
                        'kebocoran' => 'Kebocoran',
                        'sambungan_baru' => 'Sambungan Baru',
                        'lainnya' => 'Lainnya'
                    ];
                    ?>
                    <span class="kategori-badge"><?= $categories[$pengaduan->kategori] ?? $pengaduan->kategori ?></span>
                </td>
            </tr>
        </table>
    </div>

    <!-- Data Pengadu -->
    <div class="section">
        <div class="section-title">DATA PENGADU</div>
        <table class="info-table">
            <tr>
                <td class="label">Nama Lengkap</td>
                <td class="value"><?= esc($pengaduan->nm_lengkap) ?></td>
            </tr>
            <tr>
                <td class="label">ID Pelanggan</td>
                <td class="value"><?= esc($pengaduan->id_pel ?: '-') ?></td>
            </tr>
            <tr>
                <td class="label">No. HP / WhatsApp</td>
                <td class="value"><?= esc($pengaduan->no_hp) ?></td>
            </tr>
            <tr>
                <td class="label">Email</td>
                <td class="value"><?= esc($pengaduan->email ?: '-') ?></td>
            </tr>
            <tr>
                <td class="label">Alamat</td>
                <td class="value"><?= esc($pengaduan->alamat) ?></td>
            </tr>
        </table>
    </div>

    <!-- Kontak Info untuk Petugas -->
    <div class="contact-info">
        <strong>📞 Informasi Kontak Pengadu:</strong><br>
        • WhatsApp: +62<?= ltrim((string) esc($pengaduan->no_hp), '0') ?><br>
        <?php if ($pengaduan->email): ?>
            • Email: <?= esc($pengaduan->email) ?><br>
        <?php endif; ?>
        <small>Gunakan informasi ini untuk menghubungi pengadu terkait tindak lanjut pengaduan.</small>
    </div>

    <!-- Isi Pengaduan -->
    <div class="section">
        <div class="section-title">ISI PENGADUAN</div>
        <div class="pengaduan-content">
            <?= nl2br((string) esc($pengaduan->isi_pengaduan)) ?>
        </div>
    </div>

    <!-- Tanggapan Admin -->
    <?php if ($pengaduan->tanggapan): ?>
        <div class="section">
            <div class="section-title">TANGGAPAN</div>
            <div class="response-box">
                <strong>Tanggapan untuk Pengadu:</strong><br>
                <?= nl2br((string) esc($pengaduan->tanggapan)) ?>
            </div>
        </div>
    <?php endif; ?>

    <!-- Catatan Admin -->
    <?php if ($pengaduan->catatan_admin): ?>
        <div class="section">
            <div class="section-title">CATATAN INTERNAL</div>
            <div class="note-box">
                <strong>Catatan Admin:</strong><br>
                <?= nl2br((string) esc($pengaduan->catatan_admin)) ?>
            </div>
        </div>
    <?php endif; ?>

    <!-- Timeline Penanganan -->
    <?php if ($pengaduan->handled_by): ?>
        <div class="section">
            <div class="section-title">RIWAYAT PENANGANAN</div>
            <div class="timeline">
                <div class="timeline-item">
                    <strong>Pengaduan Diterima</strong><br>
                    <small><?= date('d F Y, H:i', strtotime($pengaduan->created_at)) ?> WIB</small>
                </div>
                <div class="timeline-item">
                    <strong>Ditangani oleh: <?= esc($pengaduan->handler_name ?? 'Admin') ?></strong><br>
                    <small><?= date('d F Y, H:i', strtotime($pengaduan->handled_at)) ?> WIB</small>
                </div>
                <?php if ($pengaduan->resolved_at): ?>
                    <div class="timeline-item">
                        <strong>Status: Diselesaikan</strong><br>
                        <small><?= date('d F Y, H:i', strtotime($pengaduan->resolved_at)) ?> WIB</small>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>

    <!-- Foto Pendukung -->
    <?php if ($foto_base64): ?>
        <div class="photo-section">
            <div class="section-title">FOTO PENDUKUNG</div>
            <div class="photo-container">
                <div class="photo-title">Dokumentasi Pengaduan</div>
                <img src="<?= $foto_base64 ?>" alt="Foto Pendukung">
            </div>
        </div>
    <?php else: ?>
        <div class="section">
            <div class="section-title">FOTO PENDUKUNG</div>
            <p style="text-align: center; color: #6c757d; font-style: italic;">Tidak ada foto pendukung</p>
        </div>
    <?php endif; ?>

    <!-- Footer -->
    <div class="footer-info">
        <p><strong>Catatan untuk Petugas:</strong></p>
        <p>
            Dokumen ini merupakan laporan lengkap pengaduan pelanggan. Pastikan untuk menindaklanjuti sesuai dengan
            prioritas dan kategori pengaduan. Hubungi pengadu untuk konfirmasi atau informasi tambahan jika diperlukan.
        </p>
        <hr style="margin: 10px 0;">
        <table style="width: 100%;">
            <tr>
                <td style="width: 50%;">
                    <strong>Dicetak pada:</strong><br>
                    <?= $printed_at ?>
                </td>
                <td style="width: 50%; text-align: right;">
                    <strong>Dicetak oleh:</strong><br>
                    <?= $printed_by ?>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>