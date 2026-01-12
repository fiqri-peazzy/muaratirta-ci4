<?= $this->extend('backend/layouts/app-layout') ?>

<?= $this->section('styles') ?>
<style>
    .badge-status {
        padding: 0.5rem 1rem;
        border-radius: 0.5rem;
        font-weight: 600;
    }

    .stats-card {
        border-left: 4px solid;
        cursor: pointer;
        transition: all 0.3s;
    }

    .stats-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 1rem 2rem rgba(0, 0, 0, 0.1);
    }

    .table img {
        border-radius: 0.5rem;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="section">
    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card stats-card" style="border-left-color: #ffc107;" onclick="filterStatus('pending')">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-1">Pending</h6>
                            <h3 class="mb-0 text-warning"><?= $stats['pending'] ?></h3>
                        </div>
                        <i class="bi bi-hourglass-split fs-1 text-warning"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stats-card" style="border-left-color: #0dcaf0;" onclick="filterStatus('verifikasi')">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-1">Verifikasi</h6>
                            <h3 class="mb-0 text-info"><?= $stats['verifikasi'] ?></h3>
                        </div>
                        <i class="bi bi-clock-history fs-1 text-info"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stats-card" style="border-left-color: #198754;" onclick="filterStatus('approved')">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-1">Disetujui</h6>
                            <h3 class="mb-0 text-success"><?= $stats['approved'] ?></h3>
                        </div>
                        <i class="bi bi-check-circle fs-1 text-success"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stats-card" style="border-left-color: #dc3545;" onclick="filterStatus('rejected')">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-1">Ditolak</h6>
                            <h3 class="mb-0 text-danger"><?= $stats['rejected'] ?></h3>
                        </div>
                        <i class="bi bi-x-circle fs-1 text-danger"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter & Search -->
    <div class="card">
        <div class="card-body">
            <form method="GET" action="<?= base_url('pendaftaran') ?>" class="row g-3">
                <div class="col-md-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select" onchange="this.form.submit()">
                        <option value="all" <?= $status_filter == 'all' ? 'selected' : '' ?>>Semua Status</option>
                        <option value="pending" <?= $status_filter == 'pending' ? 'selected' : '' ?>>Pending</option>
                        <option value="verifikasi" <?= $status_filter == 'verifikasi' ? 'selected' : '' ?>>Verifikasi</option>
                        <option value="approved" <?= $status_filter == 'approved' ? 'selected' : '' ?>>Disetujui</option>
                        <option value="rejected" <?= $status_filter == 'rejected' ? 'selected' : '' ?>>Ditolak</option>
                    </select>
                </div>
                <div class="col-md-5">
                    <label class="form-label">Pencarian</label>
                    <input type="text" name="search" class="form-control"
                        placeholder="Cari nomor pendaftaran, nama, atau HP..."
                        value="<?= esc($search) ?>">
                </div>

                <div class="col-md-2">
                    <label class="form-label">&nbsp;</label>
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-search me-1"></i> Cari
                    </button>
                </div>
                <div class="col-md-2">
                    <label class="form-label">&nbsp;</label>
                    <a href="<?= base_url('pendaftaran/export-bulk-pdf?' . http_build_query(['status' => $status_filter, 'search' => $search])) ?>"
                        class="btn btn-danger w-100" target="_blank">
                        <i class="bi bi-file-pdf me-1"></i> Export PDF
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Data Table -->
    <div class="card mt-4">
        <div class="card-header">
            <h5 class="mb-0">Daftar Pendaftaran</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No. Pendaftaran</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>No. HP</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($pendaftaran)): ?>
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">
                                    <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                    Tidak ada data pendaftaran
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($pendaftaran as $row): ?>
                                <tr>
                                    <td><strong><?= esc($row->no_pendaftaran) ?></strong></td>
                                    <td><?= esc($row->nama_lengkap) ?></td>
                                    <td><?= esc(substr($row->alamat_pemasangan, 0, 50)) ?>...</td>
                                    <td><?= esc($row->no_hp) ?></td>
                                    <td><?= date('d/m/Y', strtotime($row->created_at)) ?></td>
                                    <td>
                                        <?php
                                        $badges = [
                                            'pending' => 'warning',
                                            'verifikasi' => 'info',
                                            'approved' => 'success',
                                            'rejected' => 'danger'
                                        ];
                                        $labels = [
                                            'pending' => 'Pending',
                                            'verifikasi' => 'Verifikasi',
                                            'approved' => 'Disetujui',
                                            'rejected' => 'Ditolak'
                                        ];
                                        ?>
                                        <span class="badge bg-<?= $badges[$row->status] ?> badge-status">
                                            <?= $labels[$row->status] ?>
                                        </span>
                                    </td>
                                    <td>
                                        <a href="<?= base_url('pendaftaran/detail/' . $row->id) ?>"
                                            class="btn btn-sm btn-primary">
                                            <i class="bi bi-eye"></i> Detail
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <?php if (!empty($pendaftaran)): ?>
                <div class="mt-3">
                    <?= $pager->links('default', 'bootstrap_pagination') ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    function filterStatus(status) {
        window.location.href = '<?= base_url('pendaftaran') ?>?status=' + status;
    }
</script>
<?= $this->endSection() ?>