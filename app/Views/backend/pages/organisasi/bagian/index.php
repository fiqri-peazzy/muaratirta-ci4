<?= $this->extend('backend/layouts/app-layout') ?>

<?= $this->section('title') ?><?= $title ?><?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="section">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Daftar Bagian / Divisi</h4>
            <a href="<?= route_to('organisasi.bagian.create') ?>" class="btn btn-primary">
                <i class="bi bi-plus-circle me-2"></i> Tambah Bagian
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="table-bagian">
                    <thead>
                        <tr>
                            <th width="50">Urutan</th>
                            <th>Kode</th>
                            <th>Nama Bagian</th>
                            <th>Induk/Parent</th>
                            <th>Deskripsi</th>
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($bagian as $b): ?>
                            <tr>
                                <td><span class="badge bg-light-primary text-primary"><?= $b->urutan ?></span></td>
                                <td class="fw-bold text-primary"><?= $b->kd_bagian ?></td>
                                <td class="fw-bold"><?= esc($b->nama_bagian) ?></td>
                                <td>
                                    <?php if ($b->parent_nama): ?>
                                        <span class="badge bg-light-info text-info"><?= esc($b->parent_nama) ?></span>
                                    <?php else: ?>
                                        <span class="text-muted small">-</span>
                                    <?php endif; ?>
                                </td>
                                <td><small class="text-muted"><?= esc($b->deskripsi) ?: '-' ?></small></td>
                                <td>
                                    <a href="<?= base_url('organisasi/bagian/edit/' . $b->id) ?>" class="btn btn-sm btn-outline-warning me-1">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href="<?= base_url('organisasi/bagian/delete/' . $b->id) ?>" class="btn btn-sm btn-outline-danger btn-delete">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php if (empty($bagian)): ?>
                            <tr>
                                <td colspan="6" class="text-center py-4">Belum ada data bagian</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
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
        $('.btn-delete').on('click', function(e) {
            e.preventDefault();
            const href = $(this).attr('href');
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Menghapus bagian akan sangat berpengaruh pada struktur organisasi!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = href;
                }
            });
        });
    });
</script>
<?= $this->endSection() ?>