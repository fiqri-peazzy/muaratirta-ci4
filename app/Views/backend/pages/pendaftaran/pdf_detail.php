<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Pendaftaran <?= esc($pendaftaran->no_pendaftaran) ?></title>
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

        .status-verifikasi {
            background: #cfe2ff;
            color: #084298;
        }

        .status-approved {
            background: #d1e7dd;
            color: #0f5132;
        }

        .status-rejected {
            background: #f8d7da;
            color: #842029;
        }

        .status-survey {
            background: #cff4fc;
            color: #055160;
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

        .map-info {
            background: #e7f3ff;
            padding: 10px;
            border-left: 4px solid #0d6efd;
            margin: 10px 0;
        }

        .footer-info {
            margin-top: 30px;
            padding-top: 15px;
            border-top: 1px solid #dee2e6;
            font-size: 9pt;
            color: #6c757d;
        }

        .note-box {
            background: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 10px;
            margin: 15px 0;
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
                            <strong>LOGO</strong>
                        </div>
                    <?php endif; ?>
                </td>
                <td class="company-info">
                    <h2>PERUMDA AIR MINUM MUARA TIRTA</h2>
                    <p>Jl. Contoh No. 123, Kota Bontang, Kalimantan Timur</p>
                    <p>Telp: (0548) 123456 | Email: info@muaratirta.co.id</p>
                </td>
            </tr>
        </table>
    </div>

    <!-- Title -->
    <div class="title">
        <h3>FORMULIR PENDAFTARAN PASANG BARU</h3>
        <p style="margin: 5px 0 0 0; font-size: 10pt;">No. Pendaftaran: <strong><?= esc($pendaftaran->no_pendaftaran) ?></strong></p>
    </div>

    <!-- Status -->
    <div class="section">
        <table class="info-table">
            <tr>
                <td class="label">Status Pendaftaran</td>
                <td class="value">
                    <?php
                    $statusClass = [
                        'pending' => 'pending',
                        'verifikasi' => 'verifikasi',
                        'approved' => 'approved',
                        'rejected' => 'rejected',
                        'survey' => 'survey'
                    ];
                    $statusLabel = [
                        'pending' => 'Menunggu Verifikasi',
                        'verifikasi' => 'Sedang Diverifikasi',
                        'approved' => 'Disetujui',
                        'rejected' => 'Ditolak',
                        'survey' => 'Proses Survey'
                    ];
                    ?>
                    <span class="status-badge status-<?= $statusClass[$pendaftaran->status] ?>">
                        <?= $statusLabel[$pendaftaran->status] ?>
                    </span>
                </td>
            </tr>
            <tr>
                <td class="label">Tanggal Pendaftaran</td>
                <td class="value"><?= date('d F Y, H:i', strtotime($pendaftaran->created_at)) ?> WIB</td>
            </tr>
        </table>
    </div>

    <!-- Data Pemohon -->
    <div class="section">
        <div class="section-title">DATA PEMOHON</div>
        <table class="info-table">
            <tr>
                <td class="label">Nama Lengkap</td>
                <td class="value"><?= esc($pendaftaran->nama_lengkap) ?></td>
            </tr>
            <tr>
                <td class="label">NIK</td>
                <td class="value"><?= esc($pendaftaran->nik ?: '-') ?></td>
            </tr>
            <tr>
                <td class="label">No. HP</td>
                <td class="value"><?= esc($pendaftaran->no_hp) ?></td>
            </tr>
            <tr>
                <td class="label">No. WhatsApp</td>
                <td class="value"><?= esc($pendaftaran->no_wa ?: $pendaftaran->no_hp) ?></td>
            </tr>
            <tr>
                <td class="label">Email</td>
                <td class="value"><?= esc($pendaftaran->email ?: '-') ?></td>
            </tr>
        </table>
    </div>

    <!-- Alamat Pemasangan -->
    <div class="section">
        <div class="section-title">ALAMAT PEMASANGAN</div>
        <table class="info-table">
            <tr>
                <td class="label">Alamat Lengkap</td>
                <td class="value"><?= esc($pendaftaran->alamat_pemasangan) ?></td>
            </tr>
            <tr>
                <td class="label">RT / RW</td>
                <td class="value"><?= esc($pendaftaran->rt ?: '-') ?> / <?= esc($pendaftaran->rw ?: '-') ?></td>
            </tr>
            <tr>
                <td class="label">Kelurahan</td>
                <td class="value"><?= esc($pendaftaran->kelurahan ?: '-') ?></td>
            </tr>
            <tr>
                <td class="label">Kecamatan</td>
                <td class="value"><?= esc($pendaftaran->kecamatan ?: '-') ?></td>
            </tr>
        </table>

        <?php if ($pendaftaran->latitude && $pendaftaran->longitude): ?>
            <div class="map-info">
                <strong>Koordinat Lokasi:</strong><br>
                Latitude: <?= esc($pendaftaran->latitude) ?><br>
                Longitude: <?= esc($pendaftaran->longitude) ?><br>
                <small>Link Google Maps: https://www.google.com/maps?q=<?= esc($pendaftaran->latitude) ?>,<?= esc($pendaftaran->longitude) ?></small>
            </div>
        <?php endif; ?>
    </div>

    <!-- Catatan Admin -->
    <?php if ($pendaftaran->catatan_admin || $pendaftaran->catatan_penolakan): ?>
        <div class="section">
            <div class="section-title">CATATAN</div>
            <?php if ($pendaftaran->catatan_admin): ?>
                <div class="note-box">
                    <strong>Catatan Admin:</strong><br>
                    <?= nl2br(esc((string)$pendaftaran->catatan_admin)) ?>
                </div>
            <?php endif; ?>
            <?php if ($pendaftaran->catatan_penolakan): ?>
                <div class="note-box" style="background: #f8d7da; border-left-color: #dc3545;">
                    <strong>Alasan Penolakan:</strong><br>
                    <?= nl2br(esc((string)$pendaftaran->catatan_penolakan)) ?>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <!-- Dokumen Pendukung -->
    <div class="photo-section">
        <div class="section-title">DOKUMEN PENDUKUNG</div>

        <?php if ($pendaftaran->foto_ktp): ?>
            <?php if ($foto_ktp_base64): ?>
                <div class="photo-container">
                    <div class="photo-title">Foto KTP</div>
                    <img src="<?= $foto_ktp_base64 ?>" alt="Foto KTP">
                </div>
            <?php else: ?>
                <div class="photo-container">
                    <div class="photo-title">Foto KTP</div>
                    <p style="color: #dc3545;">Foto KTP tidak tersedia</p>
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <?php if ($pendaftaran->foto_rumah): ?>
            <?php if ($foto_rumah_base64): ?>
                <div class="photo-container">
                    <div class="photo-title">Foto Rumah/Lokasi Pemasangan</div>
                    <img src="<?= $foto_rumah_base64 ?>" alt="Foto Rumah">
                </div>
            <?php else: ?>
                <div class="photo-container">
                    <div class="photo-title">Foto Rumah/Lokasi Pemasangan</div>
                    <p style="color: #dc3545;">Foto Rumah tidak tersedia</p>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>

    <!-- Footer -->
    <div class="footer-info">
        <p><strong>Catatan untuk Petugas Survey:</strong></p>
        <p>Dokumen ini merupakan data lengkap pemohon pasang baru. Pastikan untuk memverifikasi lokasi sesuai koordinat dan foto yang tertera.</p>
        <hr style="margin: 10px 0;">
        <p>Dicetak pada: <?= $printed_at ?> oleh <?= $printed_by ?></p>
    </div>
</body>

</html>