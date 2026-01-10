<?= $this->extend('backend/layouts/app-layout') ?>

<?= $this->section('content') ?>
<section class="row">
    <div class="col-12 col-lg-8 offset-lg-2">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><?= isset($kategori) ? 'Edit' : 'Tambah' ?> Kategori</h5>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('errors')): ?>
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                <li><?= esc($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form action="<?= isset($kategori) ? route_to('publikasi.kategori.update', $kategori->id) : route_to('publikasi.kategori.store') ?>" 
                      method="POST">
                    <?= csrf_field() ?>

                    <!-- Nama Kategori -->
                    <div class="mb-3">
                        <label for="nama_kategori" class="form-label">Nama Kategori <span class="text-danger">*</span></label>
                        <input type="text" 
                               class="form-control" 
                               id="nama_kategori" 
                               name="nama_kategori" 
                               value="<?= old('nama_kategori', $kategori->nama_kategori ?? '') ?>"
                               placeholder="Contoh: Artikel & Berita"
                               required>
                        <small class="text-muted">Nama kategori akan otomatis di-generate menjadi slug</small>
                    </div>

                    <!-- Icon -->
                    <div class="mb-3">
                        <label for="icon" class="form-label">Icon (Bootstrap Icons)</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi <?= old('icon', $kategori->icon ?? 'bi-folder') ?>" id="icon-preview"></i>
                            </span>
                            <input type="text" 
                                   class="form-control" 
                                   id="icon" 
                                   name="icon" 
                                   value="<?= old('icon', $kategori->icon ?? 'bi-folder') ?>"
                                   placeholder="bi-folder"
                                   onkeyup="updateIconPreview()">
                        </div>
                        <small class="text-muted">
                            Lihat icon di: 
                            <a href="https://icons.getbootstrap.com/" target="_blank">Bootstrap Icons</a>
                        </small>
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" 
                                  id="deskripsi" 
                                  name="deskripsi" 
                                  rows="3"
                                  placeholder="Deskripsi singkat kategori (opsional)"><?= old('deskripsi', $kategori->deskripsi ?? '') ?></textarea>
                    </div>

                    <!-- Urutan -->
                    <div class="mb-3">
                        <label for="urutan" class="form-label">Urutan</label>
                        <input type="number" 
                               class="form-control" 
                               id="urutan" 
                               name="urutan" 
                               value="<?= old('urutan', $kategori->urutan ?? 0) ?>"
                               min="0">
                        <small class="text-muted">Urutan untuk sorting (angka kecil akan muncul lebih dulu)</small>
                    </div>

                    <!-- Status -->
                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" 
                                   type="checkbox" 
                                   id="is_active" 
                                   name="is_active" 
                                   value="1"
                                   <?= old('is_active', $kategori->is_active ?? '1') == '1' ? 'checked' : '' ?>>
                            <label class="form-check-label" for="is_active">
                                Aktif
                            </label>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="<?= route_to('publikasi.kategori') ?>" class="btn btn-secondary">
                            <i class="bi bi-x-circle me-2"></i>Batal
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-2"></i>Simpan Kategori
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
function updateIconPreview() {
    const iconInput = document.getElementById('icon');
    const iconPreview = document.getElementById('icon-preview');
    iconPreview.className = 'bi ' + iconInput.value;
}
</script>
<?= $this->endSection() ?>