<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Laporan Pendaftaran</title>
    <style>
        @page {
            margin: 1.5cm 1cm;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 10pt;
        }

        .header {
            text-align: center;
            border-bottom: 3px solid #0d6efd;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .header h2 {
            margin: 5px 0;
            color: #0d6efd;
        }

        .header p {
            margin: 3px 0;
            font-size: 9pt;
        }

        .filter-info {
            background: #f8f9fa;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th {
            background: #0d6efd;
            color: white;
            padding: 8px;
            text-align: left;
            font-size: 9pt;
        }

        td {
            padding: 6px 8px;
            border-bottom: 1px solid #dee2e6;
            font-size: 9pt;
        }

        tr:nth-child(even) {
            background: #f8f9fa;
        }

        .status-badge {
            padding: 3px 8px;
            border-radius: 10px;
            font-size: 8pt;
            font-weight: bold;
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

        .footer {
            margin-top: 20px;
            padding-top: 10px;
            border-top: 1px solid #dee2e6;
            font-size: 8pt;
            color: #6c757d;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>PERUMDA AIR MINUM MUARA TIRTA</h2>
        <p>LAPORAN DATA PENDAFTARAN PASANG BARU</p>
    </div>

    <div class="filter-info">
        <strong>Status Filter:</strong> <?= $status_filter == 'all' ? 'Semua Status' : ucfirst($status_filter) ?><br>
        <strong>Total Data:</strong> <?= count($pendaftaran) ?> pendaftaran
    </div>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="15%">No. Pendaftaran</th>
                <th width="20%">Nama</th>
                <th width="25%">Alamat</th>
                <th width="12%">No. HP</th>
                <th width="10%">Tanggal</th>
                <th width="13%">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($pendaftaran as $row): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= esc($row->no_pendaftaran) ?></td>
                    <td><?= esc($row->nama_lengkap) ?></td>
                    <td><?= esc(substr($row->alamat_pemasangan, 0, 40)) ?>...</td>
                    <td><?= esc($row->no_hp) ?></td>
                    <td><?= date('d/m/Y', strtotime($row->created_at)) ?></td>
                    <td>
                        <?php
                        $statusClass = [
                            'pending' => 'pending',
                            'verifikasi' => 'verifikasi',
                            'approved' => 'approved',
                            'rejected' => 'rejected'
                        ];
                        ?>
                        <span class="status-badge status-<?= $statusClass[$row->status] ?>">
                            <?= ucfirst($row->status) ?>
                        </span>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="footer">
        Dicetak pada: <?= $printed_at ?> oleh <?= $printed_by ?>
    </div>
</body>

</html>