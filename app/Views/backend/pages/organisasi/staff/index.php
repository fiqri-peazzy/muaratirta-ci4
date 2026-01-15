<?= $this->extend('backend/layouts/app-layout') ?>

<?= $this->section('title') ?><?= $title ?><?= $this->endSection() ?>

<?= $this->section('styles') ?>
<style>
    .avatar-staff {
        width: 45px;
        height: 45px;
        object-fit: cover;
        border-radius: 12px;
        border: 2px solid #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .staff-name {
        font-weight: 700;
        color: #25396f;
        margin-bottom: 0;
    }

    .staff-jabatan {
        font-size: 0.75rem;
        color: #7c8db5;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="section">
    <!-- Stats Row -->
    <div class="row">
        <div class="col-6 col-md-3">
            <div class="card">
                <div class="card-body px-4 py-4-5">
                    <div class="row">
                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                            <div class="stats-icon purple mb-2">
                                <i class="iconly-boldProfile"></i>
                            </div>
                        </div>
                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                            <h6 class="text-muted font-semibold">Total Staff</h6>
                            <h6 class="font-extrabold mb-0"><?= $stats['total'] ?></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card">
                <div class="card-body px-4 py-4-5">
                    <div class="row">
                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                            <div class="stats-icon blue mb-2">
                                <i class="iconly-boldShield-Done"></i>
                            </div>
                        </div>
                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                            <h6 class="text-muted font-semibold">Staff Aktif</h6>
                            <h6 class="font-extrabold mb-0"><?= $stats['active'] ?></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter & Search Card -->
    <div class="card">
        <div class="card-body">
            <form action="" method="GET" class="row g-3">
                <div class="col-md-3">
                    <label class="form-label small fw-bold">Bagian</label>
                    <select name="bagian" class="form-select select2">
                        <option value="all">Semua Bagian</option>
                        <?php foreach ($allBagian as $b): ?>
                            <option value="<?= $b->id ?>" <?= $bagian_filter == $b->id ? 'selected' : '' ?>><?= esc($b->nama_bagian) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label small fw-bold">Tingkat Jabatan</label>
                    <select name="tingkat" class="form-select select2">
                        <option value="all">Semua Tingkat</option>
                        <?php foreach ($allTingkat as $t): ?>
                            <option value="<?= $t->id ?>" <?= $tingkat_filter == $t->id ? 'selected' : '' ?>>(Level <?= $t->level ?>) <?= esc($t->nama_tingkat) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold">Cari Staff</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-search"></i></span>
                        <input type="text" name="search" class="form-control" placeholder="Nama, NIP, atau Jabatan..." value="<?= esc($search) ?>">
                    </div>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">Filter</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Data Table Card -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Manajemen Staff</h4>
            <a href="<?= route_to('organisasi.staff.create') ?>" class="btn btn-primary">
                <i class="bi bi-person-plus-fill me-2"></i> Tambah Staff
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Profil Staff</th>
                            <th>NIP / Pegawai</th>
                            <th>Bagian / Divisi</th>
                            <th>Status Kepegawaian</th>
                            <th>Status Aktif</th>
                            <th width="150" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($staff as $s): ?>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="<?= $s->profile_pict ? base_url('uploads/organisasi/' . $s->profile_pict) : 'https://ui-avatars.com/api/?name=' . urlencode($s->nm_lengkap) . '&background=random&color=fff' ?>"
                                            class="avatar-staff me-3" alt="Avatar">
                                        <div>
                                            <p class="staff-name">
                                                <?= ($s->gelar_depan ? $s->gelar_depan . ' ' : '') . esc($s->nm_lengkap) . ($s->gelar_belakang ? ', ' . $s->gelar_belakang : '') ?>
                                            </p>
                                            <p class="staff-jabatan fw-bold text-primary mb-0"><?= esc($s->jabatan_spesifik) ?></p>
                                            <small class="text-muted d-block" style="font-size: 0.7rem;"><?= esc($s->nama_tingkat) ?> (Level <?= $s->level ?>)</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="fw-bold"><?= $s->nip ?: '-' ?></span>
                                    <div class="small text-muted"><?= $s->email ?: 'Email tidak ada' ?></div>
                                </td>
                                <td>
                                    <span class="badge bg-light-info text-info"><?= esc($s->nama_bagian) ?></span>
                                    <div class="small text-muted mt-1"><?= $s->kd_bagian ?></div>
                                </td>
                                <td>
                                    <?php
                                    $badgeClass = [
                                        'PNS' => 'bg-primary',
                                        'PPPK' => 'bg-info',
                                        'Kontrak' => 'bg-warning',
                                        'Honorer' => 'bg-secondary'
                                    ][$s->status_kepegawaian] ?? 'bg-light';
                                    ?>
                                    <span class="badge <?= $badgeClass ?>"><?= $s->status_kepegawaian ?></span>
                                </td>
                                <td>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input btn-toggle-status" type="checkbox"
                                            data-id="<?= $s->id ?>" <?= $s->is_active == '1' ? 'checked' : '' ?>>
                                        <label class="form-check-label small"><?= $s->is_active == '1' ? 'Aktif' : 'Nonaktif' ?></label>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <a href="<?= base_url('organisasi/staff/edit/' . $s->id) ?>" class="btn btn-sm btn-outline-warning me-1">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href="<?= base_url('organisasi/staff/delete/' . $s->id) ?>" class="btn btn-sm btn-outline-danger btn-delete">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php if (empty($staff)): ?>
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <img src="<?= base_url('backend/assets/static/images/samples/error-404.svg') ?>" alt="Empty" style="width: 150px;" class="mb-3 opacity-50">
                                    <p class="text-muted">Tidak ada staff yang ditemukan sesuai filter.</p>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-4">
                <div class="text-muted small">
                    Menampilkan <?= count($staff) ?> dari total <?= $stats['total'] ?> staff
                </div>
                <div class="staff-pager">
                    <?= $pager->links('default', 'bootstrap_pagination') ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url('backend/assets/extensions/jquery/jquery.min.js') ?>"></script>
<script src="<?= base_url('backend/assets/extensions/sweetalert2/sweetalert2.min.js') ?>"></script>
<script>
    $(document).ready(function() {
        // Toggle Status via AJAX
        $('.btn-toggle-status').on('change', function() {
            const id = $(this).data('id');
            const label = $(this).next('label');

            $.ajax({
                url: `<?= base_url('organisasi/staff/toggle-status') ?>/${id}`,
                type: 'POST',
                data: {
                    '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
                },
                dataType: 'json',
                success: function(res) {
                    if (res.success) {
                        label.text(res.new_status == '1' ? 'Aktif' : 'Nonaktif');
                        Toast.fire({
                            icon: 'success',
                            title: res.message
                        });
                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: res.message
                        });
                    }
                },
                error: function() {
                    Toast.fire({
                        icon: 'error',
                        title: 'Terjadi kesalahan sistem'
                    });
                }
            });
        });

        // Delete Confirmation
        $('.btn-delete').on('click', function(e) {
            e.preventDefault();
            const href = $(this).attr('href');
            Swal.fire({
                title: 'Hapus Staff?',
                text: "Seluruh data profil dan riwayat staff ini akan terhapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = href;
                }
            });
        });

        // Toast Helper
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true
        });
    });
</script>
<?= $this->endSection() ?>