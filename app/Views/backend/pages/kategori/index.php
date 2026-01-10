<?= $this->extend('backend/layouts/app-layout') ?>

<?= $this->section('content') ?>
<section class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Daftar Kategori Publikasi</h5>
                    <a href="<?= route_to('publikasi.kategori.create') ?>" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-2"></i>Tambah Kategori
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped" id="table-kategori">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th width="10%">Icon</th>
                                <th width="20%">Nama Kategori</th>
                                <th width="20%">Slug</th>
                                <th width="25%">Deskripsi</th>
                                <th width="10%" class="text-center">Total Konten</th>
                                <th width="10%" class="text-center">Status</th>
                                <th width="15%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($kategoris)): ?>
                                <tr>
                                    <td colspan="8" class="text-center py-4">
                                        <p class="text-muted mb-0">Belum ada kategori</p>
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php $no = 1; foreach ($kategoris as $kategori): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td>
                                        <i class="bi <?= esc($kategori->icon) ?> fs-4"></i>
                                    </td>
                                    <td>
                                        <strong><?= esc($kategori->nama_kategori) ?></strong>
                                    </td>
                                    <td>
                                        <code><?= esc($kategori->slug) ?></code>
                                    </td>
                                    <td>
                                        <small class="text-muted"><?= esc($kategori->deskripsi) ?></small>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-info"><?= $kategori->total_konten ?></span>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-check form-switch d-flex justify-content-center">
                                            <input class="form-check-input status-toggle" 
                                                   type="checkbox" 
                                                   data-id="<?= $kategori->id ?>"
                                                   <?= $kategori->is_active == '1' ? 'checked' : '' ?>>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <a href="<?= route_to('publikasi.kategori.edit', $kategori->id) ?>" 
                                               class="btn btn-sm btn-warning" 
                                               title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <a href="<?= route_to('publikasi.kategori.delete', $kategori->id) ?>" 
                                               class="btn btn-sm btn-danger" 
                                               onclick="return confirm('Yakin ingin menghapus kategori ini?')"
                                               title="Hapus">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
$(document).ready(function() {
    // Status toggle
    $('.status-toggle').on('change', function() {
        const id = $(this).data('id');
        const checkbox = $(this);
        
        $.ajax({
            url: '<?= base_url('publikasi/kategori/toggle') ?>/' + id,
            type: 'POST',
            data: {
                <?= csrf_token() ?>: '<?= csrf_hash() ?>'
            },
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: response.message,
                        timer: 1500,
                        showConfirmButton: false
                    });
                } else {
                    checkbox.prop('checked', !checkbox.prop('checked'));
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: response.message
                    });
                }
            },
            error: function() {
                checkbox.prop('checked', !checkbox.prop('checked'));
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Terjadi kesalahan sistem'
                });
            }
        });
    });
});
</script>
<?= $this->endSection() ?>