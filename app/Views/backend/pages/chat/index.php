<?= $this->extend('backend/layouts/app-layout') ?>

<?= $this->section('content') ?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Manajemen Asisten AI</h3>
                <p class="text-subtitle text-muted">Kelola FAQ dan Referensi Informasi untuk Asisten Virtual Tirta.</p>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="row">
            <!-- FAQ Section -->
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Daftar FAQ (Frequently Asked Questions)</h4>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAddFaq">
                            <i class="bi bi-plus-circle me-2"></i>Tambah FAQ
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="25%">Pertanyaan</th>
                                        <th width="40%">Jawaban</th>
                                        <th width="10%">Kategori</th>
                                        <th width="10%" class="text-center">Status</th>
                                        <th width="10%" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($faqs as $faq): ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><strong><?= esc($faq->pertanyaan) ?></strong></td>
                                            <td><small><?= esc($faq->jawaban) ?></small></td>
                                            <td><span class="badge bg-light-primary text-primary"><?= esc($faq->kategori) ?></span></td>
                                            <td class="text-center">
                                                <a href="<?= route_to('admin.chat.faq.toggle', $faq->id) ?>" class="badge <?= $faq->is_active == '1' ? 'bg-success' : 'bg-danger' ?>">
                                                    <?= $faq->is_active == '1' ? 'Aktif' : 'Non-aktif' ?>
                                                </a>
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <button class="btn btn-sm btn-warning btn-edit-faq"
                                                        data-id="<?= $faq->id ?>"
                                                        data-pertanyaan="<?= esc($faq->pertanyaan) ?>"
                                                        data-jawaban="<?= esc($faq->jawaban) ?>"
                                                        data-kategori="<?= esc($faq->kategori) ?>">
                                                        <i class="bi bi-pencil"></i>
                                                    </button>
                                                    <a href="<?= route_to('admin.chat.faq.delete', $faq->id) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">
                                                        <i class="bi bi-trash"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Info Section -->
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Referensi Informasi (Tarif & Layanan)</h4>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAddInfo">
                            <i class="bi bi-plus-circle me-2"></i>Tambah Info
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="20%">Judul</th>
                                        <th width="10%">Kategori</th>
                                        <th width="45%">Konten</th>
                                        <th width="10%" class="text-center">Status</th>
                                        <th width="10%" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($infos as $info): ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><strong><?= esc($info->judul) ?></strong></td>
                                            <td><span class="badge bg-light-info text-info"><?= esc($info->kategori) ?></span></td>
                                            <td><small><?= esc($info->konten) ?></small></td>
                                            <td class="text-center">
                                                <a href="<?= route_to('admin.chat.info.toggle', $info->id) ?>" class="badge <?= $info->is_active == '1' ? 'bg-success' : 'bg-danger' ?>">
                                                    <?= $info->is_active == '1' ? 'Aktif' : 'Non-aktif' ?>
                                                </a>
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <button class="btn btn-sm btn-warning btn-edit-info"
                                                        data-id="<?= $info->id ?>"
                                                        data-judul="<?= esc($info->judul) ?>"
                                                        data-konten="<?= esc($info->konten) ?>"
                                                        data-kategori="<?= esc($info->kategori) ?>">
                                                        <i class="bi bi-pencil"></i>
                                                    </button>
                                                    <a href="<?= route_to('admin.chat.info.delete', $info->id) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">
                                                        <i class="bi bi-trash"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modals -->
<!-- Add FAQ Modal -->
<div class="modal fade" id="modalAddFaq" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="<?= route_to('admin.chat.faq.store') ?>" method="POST" class="modal-content">
            <?= csrf_field() ?>
            <div class="modal-header">
                <h5 class="modal-title">Tambah FAQ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Pertanyaan</label>
                    <input type="text" name="pertanyaan" class="form-control" required placeholder="Contoh: Bagaimana cara daftar?">
                </div>
                <div class="mb-3">
                    <label class="form-label">Jawaban</label>
                    <textarea name="jawaban" class="form-control" rows="4" required placeholder="Jawaban lengkap untuk AI..."></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <input type="text" name="kategori" class="form-control" placeholder="Contoh: Pendaftaran">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit FAQ Modal -->
<div class="modal fade" id="modalEditFaq" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form id="formEditFaq" method="POST" class="modal-content">
            <?= csrf_field() ?>
            <div class="modal-header">
                <h5 class="modal-title">Edit FAQ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Pertanyaan</label>
                    <input type="text" name="pertanyaan" id="edit-faq-pertanyaan" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Jawaban</label>
                    <textarea name="jawaban" id="edit-faq-jawaban" class="form-control" rows="4" required></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <input type="text" name="kategori" id="edit-faq-kategori" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Perbarui</button>
            </div>
        </form>
    </div>
</div>

<!-- Add Info Modal -->
<div class="modal fade" id="modalAddInfo" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="<?= route_to('admin.chat.info.store') ?>" method="POST" class="modal-content">
            <?= csrf_field() ?>
            <div class="modal-header">
                <h5 class="modal-title">Tambah Info Referensi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Judul</label>
                    <input type="text" name="judul" class="form-control" required placeholder="Contoh: Jam Operasional">
                </div>
                <div class="mb-3">
                    <label class="form-label">Konten</label>
                    <textarea name="konten" class="form-control" rows="4" required placeholder="Detail informasi untuk referensi AI..."></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <input type="text" name="kategori" class="form-control" placeholder="Contoh: Layanan">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Info Modal -->
<div class="modal fade" id="modalEditInfo" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form id="formEditInfo" method="POST" class="modal-content">
            <?= csrf_field() ?>
            <div class="modal-header">
                <h5 class="modal-title">Edit Info Referensi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Judul</label>
                    <input type="text" name="judul" id="edit-info-judul" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Konten</label>
                    <textarea name="konten" id="edit-info-konten" class="form-control" rows="4" required></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <input type="text" name="kategori" id="edit-info-kategori" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Perbarui</button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    $(document).ready(function() {
        // Edit FAQ
        $('.btn-edit-faq').on('click', function() {
            const id = $(this).data('id');
            const pertanyaan = $(this).data('pertanyaan');
            const jawaban = $(this).data('jawaban');
            const kategori = $(this).data('kategori');

            $('#formEditFaq').attr('action', '<?= base_url('chat-assistant/faq/update') ?>/' + id);
            $('#edit-faq-pertanyaan').val(pertanyaan);
            $('#edit-faq-jawaban').val(jawaban);
            $('#edit-faq-kategori').val(kategori);

            $('#modalEditFaq').modal('show');
        });

        // Edit Info
        $('.btn-edit-info').on('click', function() {
            const id = $(this).data('id');
            const judul = $(this).data('judul');
            const konten = $(this).data('konten');
            const kategori = $(this).data('kategori');

            $('#formEditInfo').attr('action', '<?= base_url('chat-assistant/info/update') ?>/' + id);
            $('#edit-info-judul').val(judul);
            $('#edit-info-konten').val(konten);
            $('#edit-info-kategori').val(kategori);

            $('#modalEditInfo').modal('show');
        });
    });
</script>
<?= $this->endSection() ?>