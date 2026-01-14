<?= $this->extend('backend/layouts/app-layout') ?>

<?= $this->section('styles') ?>
<style>
    .stats-card {
        border-left: 4px solid;
        transition: all 0.3s;
    }

    .stats-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 1rem 2rem rgba(0, 0, 0, 0.1);
    }

    .user-avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        object-fit: cover;
    }

    .level-badge {
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
        <div class="col-md-2">
            <div class="card stats-card" style="border-left-color: #0d6efd;">
                <div class="card-body">
                    <h6 class="text-muted mb-1">Total Users</h6>
                    <h3 class="mb-0 text-primary"><?= $stats['total'] ?></h3>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card stats-card" style="border-left-color: #dc3545;">
                <div class="card-body">
                    <h6 class="text-muted mb-1">Admin</h6>
                    <h3 class="mb-0 text-danger"><?= $stats['admin'] ?></h3>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card stats-card" style="border-left-color: #0dcaf0;">
                <div class="card-body">
                    <h6 class="text-muted mb-1">CS</h6>
                    <h3 class="mb-0 text-info"><?= $stats['cs'] ?></h3>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card stats-card" style="border-left-color: #6f42c1;">
                <div class="card-body">
                    <h6 class="text-muted mb-1">Publikasi</h6>
                    <h3 class="mb-0" style="color: #6f42c1;"><?= $stats['publikasi'] ?></h3>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card stats-card" style="border-left-color: #198754;">
                <div class="card-body">
                    <h6 class="text-muted mb-1">Active</h6>
                    <h3 class="mb-0 text-success"><?= $stats['active'] ?></h3>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card stats-card" style="border-left-color: #6c757d;">
                <div class="card-body">
                    <h6 class="text-muted mb-1">Inactive</h6>
                    <h3 class="mb-0 text-secondary"><?= $stats['inactive'] ?></h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter & Actions -->
    <div class="card">
        <div class="card-body">
            <div class="row align-items-end">
                <div class="col-md-3">
                    <label class="form-label">Level</label>
                    <select class="form-select" onchange="filterData('level', this.value)">
                        <option value="all" <?= $level_filter == 'all' ? 'selected' : '' ?>>Semua Level</option>
                        <option value="1" <?= $level_filter == '1' ? 'selected' : '' ?>>Admin</option>
                        <option value="2" <?= $level_filter == '2' ? 'selected' : '' ?>>Customer Service</option>
                        <option value="3" <?= $level_filter == '3' ? 'selected' : '' ?>>Publikasi</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Status</label>
                    <select class="form-select" onchange="filterData('status', this.value)">
                        <option value="all" <?= $status_filter == 'all' ? 'selected' : '' ?>>Semua Status</option>
                        <option value="1" <?= $status_filter == '1' ? 'selected' : '' ?>>Active</option>
                        <option value="0" <?= $status_filter == '0' ? 'selected' : '' ?>>Inactive</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Pencarian</label>
                    <form method="GET" action="<?= base_url('users') ?>" class="d-flex gap-2">
                        <input type="hidden" name="level" value="<?= $level_filter ?>">
                        <input type="hidden" name="status" value="<?= $status_filter ?>">
                        <input type="text" name="search" class="form-control"
                            placeholder="Cari username, email, nama..."
                            value="<?= esc($search) ?>">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-search"></i>
                        </button>
                    </form>
                </div>
                <div class="col-md-2">
                    <a href="<?= base_url('users/create') ?>" class="btn btn-success w-100">
                        <i class="bi bi-plus-circle me-1"></i> Tambah User
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Table -->
    <div class="card mt-4">
        <div class="card-header">
            <h5 class="mb-0">Daftar User</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Email</th>
                            <th>No. HP</th>
                            <th>Level</th>
                            <th>Status</th>
                            <th>Terdaftar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($users)): ?>
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">
                                    <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                    Tidak ada data user
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($users as $user): ?>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <?php if ($user->profile_pict): ?>
                                                <img src="<?= base_url('uploads/profile/' . $user->profile_pict) ?>"
                                                    class="user-avatar me-2"
                                                    alt="<?= esc($user->nm_lengkap) ?>">
                                            <?php else: ?>
                                                <div class="user-avatar me-2 bg-primary text-white d-flex align-items-center justify-content-center">
                                                    <strong><?= strtoupper(substr($user->nm_lengkap, 0, 2)) ?></strong>
                                                </div>
                                            <?php endif; ?>
                                            <div>
                                                <strong><?= esc($user->nm_lengkap) ?></strong><br>
                                                <small class="text-muted">@<?= esc($user->username) ?></small>
                                            </div>
                                        </div>
                                    </td>
                                    <td><?= esc($user->email) ?></td>
                                    <td><?= esc($user->no_hp ?: '-') ?></td>
                                    <td>
                                        <?php
                                        $levelBadges = [
                                            '1' => ['color' => 'danger', 'label' => 'Admin'],
                                            '2' => ['color' => 'warning', 'label' => 'CS'],
                                            '3' => ['color' => 'success', 'label' => 'Publikasi']
                                        ];
                                        $level = $levelBadges[$user->level];
                                        ?>
                                        <span class="badge bg-<?= $level['color'] ?> level-badge">
                                            <?= $level['label'] ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input"
                                                type="checkbox"
                                                <?= $user->is_active == '1' ? 'checked' : '' ?>
                                                onchange="toggleStatus(<?= $user->id ?>)"
                                                <?= $user->id == user_id() ? 'disabled' : '' ?>>
                                        </div>
                                    </td>
                                    <td>
                                        <?= date('d/m/Y', strtotime($user->created_at)) ?><br>
                                        <small class="text-muted"><?= date('H:i', strtotime($user->created_at)) ?></small>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="<?= base_url('users/edit/' . $user->id) ?>"
                                                class="btn btn-sm btn-warning"
                                                title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <?php if ($user->id != user_id()): ?>
                                                <a href="<?= base_url('users/delete/' . $user->id) ?>"
                                                    class="btn btn-sm btn-danger"
                                                    title="Hapus"
                                                    onclick="return confirm('Yakin ingin menghapus user ini?')">
                                                    <i class="bi bi-trash"></i>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <?php if (!empty($users)): ?>
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
    function filterData(type, value) {
        const url = new URL(window.location.href);
        url.searchParams.set(type, value);
        window.location.href = url.toString();
    }

    function toggleStatus(userId) {
        if (!confirm('Yakin ingin mengubah status user ini?')) {
            event.target.checked = !event.target.checked;
            return;
        }

        fetch('<?= base_url('users/toggle-status/') ?>' + userId, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: new URLSearchParams({
                    '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                } else {
                    alert(data.message);
                    event.target.checked = !event.target.checked;
                }
            })
            .catch(error => {
                alert('Terjadi kesalahan');
                event.target.checked = !event.target.checked;
            });
    }
</script>
<?= $this->endSection() ?>