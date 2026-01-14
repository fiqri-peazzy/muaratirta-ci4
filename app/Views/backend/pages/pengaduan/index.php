<?= $this->extend('backend/layouts/app-layout') ?>

<?= $this->section('styles') ?>
<style>
    .stats-card {
        border-left: 4px solid;
        cursor: pointer;
        transition: all 0.3s;
    }

    .stats-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 1rem 2rem rgba(0, 0, 0, 0.1);
    }

    .badge-prioritas {
        padding: 0.5rem 1rem;
        border-radius: 0.5rem;
        font-weight: 600;
        font-size: 0.75rem;
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
            <div class="card stats-card" style="border-left-color: #0dcaf0;" onclick="filterStatus('proses')">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-1">Proses</h6>
                            <h3 class="mb-0 text-info"><?= $stats['proses'] ?></h3>
                        </div>
                        <i class="bi bi-arrow-repeat fs-1 text-info"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stats-card" style="border-left-color: #198754;" onclick="filterStatus('selesai')">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-1">Selesai</h6>
                            <h3 class="mb-0 text-success"><?= $stats['selesai'] ?></h3>
                        </div>
                        <i class="bi bi-check-circle fs-1 text-success"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stats-card" style="border-left-color: #dc3545;" onclick="filterStatus('ditolak')">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-1">Ditolak</h6>
                            <h3 class="mb-0 text-danger"><?= $stats['ditolak'] ?></h3>
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
            <form method="GET" action="<?= base_url('pengaduan') ?>" class="row g-3">
                <div class="col-md-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select" onchange="this.form.submit()">
                        <option value="all" <?= $status_filter == 'all' ? 'selected' : '' ?>>Semua Status</option>
                        <option value="pending" <?= $status_filter == 'pending' ? 'selected' : '' ?>>Pending</option>
                        <option value="proses" <?= $status_filter == 'proses' ? 'selected' : '' ?>>Proses</option>
                        <option value="selesai" <?= $status_filter == 'selesai' ? 'selected' : '' ?>>Selesai</option>
                        <option value="ditolak" <?= $status_filter == 'ditolak' ? 'selected' : '' ?>>Ditolak</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Prioritas</label>
                    <select name="prioritas" class="form-select" onchange="this.form.submit()">
                        <option value="all" <?= $prioritas_filter == 'all' ? 'selected' : '' ?>>Semua</option>
                        <option value="rendah" <?= $prioritas_filter == 'rendah' ? 'selected' : '' ?>>Rendah</option>
                        <option value="sedang" <?= $prioritas_filter == 'sedang' ? 'selected' : '' ?>>Sedang</option>
                        <option value="tinggi" <?= $prioritas_filter == 'tinggi' ? 'selected' : '' ?>>Tinggi</option>
                        <option value="urgent" <?= $prioritas_filter == 'urgent' ? 'selected' : '' ?>>Urgent</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Kategori</label>
                    <select name="kategori" class="form-select" onchange="this.form.submit()">
                        <option value="all" <?= $kategori_filter == 'all' ? 'selected' : '' ?>>Semua</option>
                        <?php foreach ($categories as $key => $label): ?>
                            <option value="<?= $key ?>" <?= $kategori_filter == $key ? 'selected' : '' ?>><?= $label ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Pencarian</label>
                    <input type="text" name="search" class="form-control"
                        placeholder="Cari nomor, nama, HP, ID pelanggan..."
                        value="<?= esc($search) ?>">
                </div>
                <div class="col-md-1">
                    <label class="form-label">&nbsp;</label>
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Data Table -->
    <div class="card mt-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar Pengaduan</h5>
            <span class="badge bg-secondary">Total: <?= $stats['total'] ?></span>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No. Pengaduan</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Isi Pengaduan</th>
                            <th>Tanggal</th>
                            <th>Prioritas</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($pengaduan)): ?>
                            <tr>
                                <td colspan="8" class="text-center py-4 text-muted">
                                    <i class="text-center bi bi-inbox fs-1 d-block mb-2"></i>
                                    Tidak ada data pengaduan
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($pengaduan as $row): ?>
                                <tr>
                                    <td>
                                        <strong><?= esc($row->no_pengaduan) ?></strong>
                                        <?php if ($row->id_pel): ?>
                                            <br><small class="text-muted">ID: <?= esc($row->id_pel) ?></small>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?= esc($row->nm_lengkap) ?><br>
                                        <small class="text-muted"><?= esc($row->no_hp) ?></small>
                                    </td>
                                    <td><span class="badge bg-secondary"><?= esc($categories[$row->kategori] ?? $row->kategori) ?></span></td>
                                    <td><?= esc(substr($row->isi_pengaduan, 0, 60)) ?>...</td>
                                    <td>
                                        <?= date('d/m/Y', strtotime($row->created_at)) ?><br>
                                        <small class="text-muted"><?= date('H:i', strtotime($row->created_at)) ?></small>
                                    </td>
                                    <td>
                                        <?php
                                        $prioritasBadge = [
                                            'rendah' => 'secondary',
                                            'sedang' => 'info',
                                            'tinggi' => 'warning',
                                            'urgent' => 'danger'
                                        ];
                                        ?>
                                        <span class="badge bg-<?= $prioritasBadge[$row->prioritas] ?? 'secondary' ?> badge-prioritas">
                                            <?= ucfirst($row->prioritas ?: 'Normal') ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?php
                                        $statusBadge = [
                                            'pending' => 'warning',
                                            'proses' => 'info',
                                            'selesai' => 'success',
                                            'ditolak' => 'danger'
                                        ];
                                        ?>
                                        <span class="badge bg-<?= $statusBadge[$row->status] ?? 'secondary' ?>">
                                            <?= ucfirst($row->status) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <a href="<?= base_url('pengaduan/detail/' . $row->id) ?>"
                                            class="btn btn-sm btn-primary">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <?php if (!empty($pengaduan)): ?>
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
        window.location.href = '<?= base_url('pengaduan') ?>?status=' + status;
    }
</script>
<?= $this->endSection() ?>