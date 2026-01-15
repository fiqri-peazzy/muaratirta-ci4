<?= $this->extend('backend/layouts/app-layout') ?>

<?= $this->section('title') ?><?= $title ?><?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="section">
    <div class="row">
        <div class="col-md-8 col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Informasi Bagian</h4>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('organisasi/bagian/update/' . $bagian->id) ?>" method="POST" class="form form-vertical">
                        <?= csrf_field() ?>
                        <div class="form-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group mb-3">
                                        <label for="kd_bagian" class="form-label">Kode Bagian</label>
                                        <input type="text" id="kd_bagian" class="form-control <?= session('errors.kd_bagian') ? 'is-invalid' : '' ?>"
                                            name="kd_bagian" value="<?= old('kd_bagian') ?: $bagian->kd_bagian ?>" required readonly>
                                        <div class="invalid-feedback"><?= session('errors.kd_bagian') ?></div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group mb-3">
                                        <label for="nama_bagian" class="form-label">Nama Bagian / Divisi</label>
                                        <input type="text" id="nama_bagian" class="form-control <?= session('errors.nama_bagian') ? 'is-invalid' : '' ?>"
                                            name="nama_bagian" value="<?= old('nama_bagian') ?: $bagian->nama_bagian ?>" placeholder="Contoh: Administrasi Umum" required>
                                        <div class="invalid-feedback"><?= session('errors.nama_bagian') ?></div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group mb-3">
                                        <label for="parent_id" class="form-label">Bagian Induk</label>
                                        <select id="parent_id" class="form-select <?= session('errors.parent_id') ? 'is-invalid' : '' ?>" name="parent_id">
                                            <option value="">-- Set Sebagai Root --</option>
                                            <?php foreach ($allBagian as $b): ?>
                                                <option value="<?= $b->id ?>" <?= (old('parent_id') ?: $bagian->parent_id) == $b->id ? 'selected' : '' ?>><?= esc($b->nama_bagian) ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="invalid-feedback"><?= session('errors.parent_id') ?></div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group mb-3">
                                        <label for="urutan" class="form-label">Urutan Tampil</label>
                                        <input type="number" id="urutan" class="form-control <?= session('errors.urutan') ? 'is-invalid' : '' ?>"
                                            name="urutan" value="<?= old('urutan') ?: $bagian->urutan ?>" required>
                                        <div class="invalid-feedback"><?= session('errors.urutan') ?></div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group mb-3">
                                        <label for="deskripsi" class="form-label">Deskripsi / Tugas Pokok</label>
                                        <textarea id="deskripsi" class="form-control <?= session('errors.deskripsi') ? 'is-invalid' : '' ?>"
                                            name="deskripsi" rows="4"><?= old('deskripsi') ?: $bagian->deskripsi ?></textarea>
                                        <div class="invalid-feedback"><?= session('errors.deskripsi') ?></div>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end mt-4">
                                    <a href="<?= route_to('organisasi.bagian') ?>" class="btn btn-light-secondary me-2">Kembali</a>
                                    <button type="submit" class="btn btn-warning">Update Bagian</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>