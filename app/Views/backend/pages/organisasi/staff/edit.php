<?= $this->extend('backend/layouts/app-layout') ?>

<?= $this->section('title') ?><?= $title ?><?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="section">
    <form action="<?= base_url('organisasi/staff/update/' . $staff->id) ?>" method="POST" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <div class="row">
            <!-- Left Side: Basic Info -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Informasi Pegawai</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label for="nm_lengkap" class="form-label">Nama Lengkap (Tanpa Gelar)</label>
                                    <input type="text" id="nm_lengkap" class="form-control <?= session('errors.nm_lengkap') ? 'is-invalid' : '' ?>"
                                        name="nm_lengkap" value="<?= old('nm_lengkap') ?: $staff->nm_lengkap ?>" placeholder="Nama lengkap sesuai KTP" required>
                                    <div class="invalid-feedback"><?= session('errors.nm_lengkap') ?></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="gelar_depan" class="form-label">Gelar Depan</label>
                                    <input type="text" id="gelar_depan" class="form-control <?= session('errors.gelar_depan') ? 'is-invalid' : '' ?>"
                                        name="gelar_depan" value="<?= old('gelar_depan') ?: $staff->gelar_depan ?>" placeholder="Contoh: Ir., Dr.">
                                    <div class="invalid-feedback"><?= session('errors.gelar_depan') ?></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="gelar_belakang" class="form-label">Gelar Belakang</label>
                                    <input type="text" id="gelar_belakang" class="form-control <?= session('errors.gelar_belakang') ? 'is-invalid' : '' ?>"
                                        name="gelar_belakang" value="<?= old('gelar_belakang') ?: $staff->gelar_belakang ?>" placeholder="Contoh: S.T., M.Kom.">
                                    <div class="invalid-feedback"><?= session('errors.gelar_belakang') ?></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="nip" class="form-label">NIP / Nomor Induk Pegawai</label>
                                    <input type="text" id="nip" class="form-control <?= session('errors.nip') ? 'is-invalid' : '' ?>"
                                        name="nip" value="<?= old('nip') ?: $staff->nip ?>" placeholder="Masukkan NIP jika ada">
                                    <div class="invalid-feedback"><?= session('errors.nip') ?></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="status_kepegawaian" class="form-label">Status Kepegawaian</label>
                                    <select id="status_kepegawaian" class="form-select <?= session('errors.status_kepegawaian') ? 'is-invalid' : '' ?>" name="status_kepegawaian" required>
                                        <?php
                                        $statuses = ['PNS', 'PPPK', 'Kontrak', 'Honorer'];
                                        foreach ($statuses as $st):
                                        ?>
                                            <option value="<?= $st ?>" <?= (old('status_kepegawaian') ?: $staff->status_kepegawaian) == $st ? 'selected' : '' ?>><?= $st ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback"><?= session('errors.status_kepegawaian') ?></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="email" class="form-label">Email Kerja</label>
                                    <input type="email" id="email" class="form-control <?= session('errors.email') ? 'is-invalid' : '' ?>"
                                        name="email" value="<?= old('email') ?: $staff->email ?>" placeholder="alamat@email.com">
                                    <div class="invalid-feedback"><?= session('errors.email') ?></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="no_hp" class="form-label">Nomor WhatsApp/HP</label>
                                    <input type="text" id="no_hp" class="form-control <?= session('errors.no_hp') ? 'is-invalid' : '' ?>"
                                        name="no_hp" value="<?= old('no_hp') ?: $staff->no_hp ?>" placeholder="08xxxxxxxxxx">
                                    <div class="invalid-feedback"><?= session('errors.no_hp') ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="card-header">
                        <h4 class="card-title">Informasi Jabatan & Struktur</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="bagian_id" class="form-label">Bagian / Divisi</label>
                                    <select id="bagian_id" class="form-select <?= session('errors.bagian_id') ? 'is-invalid' : '' ?>" name="bagian_id" required>
                                        <option value="">-- Pilih Bagian --</option>
                                        <?php foreach ($allBagian as $b): ?>
                                            <option value="<?= $b->id ?>" <?= (old('bagian_id') ?: $staff->bagian_id) == $b->id ? 'selected' : '' ?>><?= esc($b->nama_bagian) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback"><?= session('errors.bagian_id') ?></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="tingkat_jabatan_id" class="form-label">Tingkat Jabatan (Eselon/Level)</label>
                                    <select id="tingkat_jabatan_id" class="form-select <?= session('errors.tingkat_jabatan_id') ? 'is-invalid' : '' ?>" name="tingkat_jabatan_id" required>
                                        <option value="">-- Pilih Tingkat --</option>
                                        <?php foreach ($allTingkat as $t): ?>
                                            <option value="<?= $t->id ?>" <?= (old('tingkat_jabatan_id') ?: $staff->tingkat_jabatan_id) == $t->id ? 'selected' : '' ?>>(Level <?= $t->level ?>) <?= esc($t->nama_tingkat) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback"><?= session('errors.tingkat_jabatan_id') ?></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label for="jabatan_spesifik" class="form-label">Nama Jabatan Spesifik</label>
                                    <input type="text" id="jabatan_spesifik" class="form-control <?= session('errors.jabatan_spesifik') ? 'is-invalid' : '' ?>"
                                        name="jabatan_spesifik" value="<?= old('jabatan_spesifik') ?: $staff->jabatan_spesifik ?>" placeholder="Contoh: Manajer Teknik dan Perencanaan" required>
                                    <small class="text-muted">Gunakan nama jabatan lengkap yang akan tampil di website</small>
                                    <div class="invalid-feedback"><?= session('errors.jabatan_spesifik') ?></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="urutan_tampil" class="form-label">Urutan Dalam Level</label>
                                    <input type="number" id="urutan_tampil" class="form-control <?= session('errors.urutan_tampil') ? 'is-invalid' : '' ?>"
                                        name="urutan_tampil" value="<?= old('urutan_tampil') ?: $staff->urutan_tampil ?>" required>
                                    <div class="invalid-feedback"><?= session('errors.urutan_tampil') ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side: Profile Picture & Submission -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Foto Profil</h4>
                    </div>
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <?php
                            $avatarUrl = $staff->profile_pict ? base_url('uploads/organisasi/' . $staff->profile_pict) : 'https://ui-avatars.com/api/?name=' . urlencode($staff->nm_lengkap) . '&background=random&color=fff';
                            ?>
                            <img src="<?= $avatarUrl ?>" id="preview-img" class="img-fluid rounded-circle border p-1 mb-3" style="width: 200px; height: 200px; object-fit: cover;">
                        </div>
                        <div class="form-group mb-3">
                            <input type="file" class="form-control <?= session('errors.profile_pict') ? 'is-invalid' : '' ?>"
                                id="profile_pict" name="profile_pict" accept="image/*" onchange="previewImage(this)">
                            <div class="invalid-feedback"><?= session('errors.profile_pict') ?></div>
                            <small class="text-muted mt-2 d-block">Maksimal 2MB (Format: JPG, PNG, WEBP)</small>
                            <small class="text-muted d-block">Biarkan kosong jika tidak ingin mengubah foto</small>
                        </div>
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-warning lg">
                                <i class="bi bi-save me-2"></i> Update Data Staff
                            </button>
                            <a href="<?= route_to('organisasi.staff') ?>" class="btn btn-light-secondary">Batal</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview-img').src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<?= $this->endSection() ?>