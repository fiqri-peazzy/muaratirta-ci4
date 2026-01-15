<?= $this->extend('backend/layouts/app-layout') ?>

<?= $this->section('title') ?><?= $title ?><?= $this->endSection() ?>

<?= $this->section('styles') ?>
<link rel="stylesheet" href="<?= base_url('backend/assets/extensions/sweetalert2/sweetalert2.min.css') ?>">
<style>
    .level-badge {
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background-color: #e3f2fd;
        color: #0d47a1;
        font-weight: bold;
        font-size: 0.8rem;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="section">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Daftar Tingkat Jabatan</h4>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTingkat" onclick="resetForm()">
                <i class="bi bi-plus-circle me-2"></i> Tambah Tingkat
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="table-tingkat">
                    <thead>
                        <tr>
                            <th width="50">Level</th>
                            <th>Nama Tingkat</th>
                            <th>Keterangan</th>
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tingkat as $t): ?>
                            <tr>
                                <td>
                                    <div class="level-badge"><?= $t->level ?></div>
                                </td>
                                <td class="fw-bold"><?= esc($t->nama_tingkat) ?></td>
                                <td><small class="text-muted"><?= esc($t->keterangan) ?: '-' ?></small></td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-outline-warning me-1"
                                        onclick="editData(<?= htmlspecialchars(json_encode($t)) ?>)"
                                        data-bs-toggle="modal" data-bs-target="#modalTingkat">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <a href="<?= base_url('organisasi/tingkat-jabatan/delete/' . $t->id) ?>"
                                        class="btn btn-sm btn-outline-danger btn-delete">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php if (empty($tingkat)): ?>
                            <tr>
                                <td colspan="4" class="text-center py-4">Belum ada data tingkat jabatan</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<!-- Modal Tingkat Jabatan -->
<div class="modal fade" id="modalTingkat" tabindex="-1" aria-labelledby="modalTingkatLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTingkatLabel">Tambah Tingkat Jabatan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formTingkat">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="level" class="form-label">Level Jabatan</label>
                        <input type="number" class="form-control" id="level" name="level" value="<?= $nextLevel ?>" required>
                        <small class="text-muted">1 = tertinggi, semakin besar semakin rendah</small>
                        <div class="invalid-feedback" id="error-level"></div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="nama_tingkat" class="form-label">Nama Tingkat</label>
                        <input type="text" class="form-control" id="nama_tingkat" name="nama_tingkat" placeholder="Contoh: Direktur, Manajer, dll" required>
                        <div class="invalid-feedback" id="error-nama_tingkat"></div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea class="form-control" id="keterangan" name="keterangan" rows="3" placeholder="Deskripsi singkat jabatan"></textarea>
                        <div class="invalid-feedback" id="error-keterangan"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" id="btn-submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url('backend/assets/extensions/jquery/jquery.min.js') ?>"></script>
<script src="<?= base_url('backend/assets/extensions/sweetalert2/sweetalert2.min.js') ?>"></script>
<script>
    let isEdit = false;
    let editId = null;

    function resetForm() {
        isEdit = false;
        editId = null;
        $('#formTingkat')[0].reset();
        $('#modalTingkatLabel').text('Tambah Tingkat Jabatan');
        $('#level').val('<?= $nextLevel ?>');
        $('.is-invalid').removeClass('is-invalid');
    }

    function editData(data) {
        isEdit = true;
        editId = data.id;
        $('#modalTingkatLabel').text('Edit Tingkat Jabatan');
        $('#level').val(data.level);
        $('#nama_tingkat').val(data.nama_tingkat);
        $('#keterangan').val(data.keterangan);
        $('.is-invalid').removeClass('is-invalid');
    }

    $(document).ready(function() {
        $('#formTingkat').on('submit', function(e) {
            e.preventDefault();
            const url = isEdit ? `<?= base_url('organisasi/tingkat-jabatan/update') ?>/${editId}` : `<?= base_url('organisasi/tingkat-jabatan/store') ?>`;
            const formData = $(this).serialize();

            $('#btn-submit').attr('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Menyimpan...');

            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.message,
                            timer: 1500,
                            showConfirmButton: false
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        $('#btn-submit').attr('disabled', false).text('Simpan');
                        if (response.errors) {
                            $('.is-invalid').removeClass('is-invalid');
                            $.each(response.errors, function(key, val) {
                                $(`#${key}`).addClass('is-invalid');
                                $(`#error-${key}`).text(val);
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: response.message
                            });
                        }
                    }
                },
                error: function() {
                    $('#btn-submit').attr('disabled', false).text('Simpan');
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Terjadi kesalahan sistem'
                    });
                }
            });
        });

        $('.btn-delete').on('click', function(e) {
            e.preventDefault();
            const href = $(this).attr('href');
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
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