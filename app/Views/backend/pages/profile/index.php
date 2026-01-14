<?= $this->extend('backend/layouts/app-layout') ?>

<?= $this->section('content') ?>
<section class="section">
    <div class="row">
        <div class="col-12 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-center align-items-center flex-column">
                        <div class="avatar avatar-2xl">
                            <?php if (!empty($user->profile_pict) && $user->profile_pict != 'default.png'): ?>
                                <img src="<?= base_url('uploads/profile/' . $user->profile_pict) ?>" alt="Avatar" style="width: 150px; height: 150px; object-fit: cover; border-radius: 50%;">
                            <?php else: ?>
                                <img src="<?= base_url('backend/assets/compiled/jpg/1.jpg') ?>" alt="Avatar" style="width: 150px; height: 150px; object-fit: cover; border-radius: 50%;">
                            <?php endif; ?>
                        </div>

                        <h3 class="mt-3"><?= esc($user->nm_lengkap) ?></h3>
                        <p class="text-small"><?= session()->get('level_name') ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Edit Profil</h5>
                </div>
                <div class="card-body">
                    <form action="<?= route_to('profile.update') ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>

                        <div class="form-group mb-3">
                            <label for="nm_lengkap" class="form-label">Nama Lengkap</label>
                            <input type="text" name="nm_lengkap" id="nm_lengkap" class="form-control <?= session('errors.nm_lengkap') ? 'is-invalid' : '' ?>" value="<?= old('nm_lengkap', $user->nm_lengkap) ?>">
                            <div class="invalid-feedback"><?= session('errors.nm_lengkap') ?></div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" name="username" id="username" class="form-control <?= session('errors.username') ? 'is-invalid' : '' ?>" value="<?= old('username', $user->username) ?>">
                            <div class="invalid-feedback"><?= session('errors.username') ?></div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control <?= session('errors.email') ? 'is-invalid' : '' ?>" value="<?= old('email', $user->email) ?>">
                            <div class="invalid-feedback"><?= session('errors.email') ?></div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="no_hp" class="form-label">No. Handphone</label>
                            <input type="text" name="no_hp" id="no_hp" class="form-control <?= session('errors.no_hp') ? 'is-invalid' : '' ?>" value="<?= old('no_hp', $user->no_hp) ?>">
                            <div class="invalid-feedback"><?= session('errors.no_hp') ?></div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="profile_image" class="form-label">Foto Profil (Optional)</label>
                            <input type="file" name="profile_image" id="profile_image" class="form-control <?= session('errors.profile_image') ? 'is-invalid' : '' ?>">
                            <div class="invalid-feedback"><?= session('errors.profile_image') ?></div>
                            <small class="text-muted">Format: jpg, jpeg, png. Max: 2MB</small>
                        </div>

                        <div class="form-group text-end">
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Ganti Password</h5>
                </div>
                <div class="card-body">
                    <form action="<?= route_to('profile.change_password') ?>" method="post">
                        <?= csrf_field() ?>

                        <div class="form-group mb-3">
                            <label for="current_password" class="form-label">Password Saat Ini</label>
                            <input type="password" name="current_password" id="current_password" class="form-control <?= session('errors.current_password') ? 'is-invalid' : '' ?>">
                            <div class="invalid-feedback"><?= session('errors.current_password') ?></div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="new_password" class="form-label">Password Baru</label>
                            <input type="password" name="new_password" id="new_password" class="form-control <?= session('errors.new_password') ? 'is-invalid' : '' ?>">
                            <div class="invalid-feedback"><?= session('errors.new_password') ?></div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="confirm_password" class="form-label">Konfirmasi Password Baru</label>
                            <input type="password" name="confirm_password" id="confirm_password" class="form-control <?= session('errors.confirm_password') ? 'is-invalid' : '' ?>">
                            <div class="invalid-feedback"><?= session('errors.confirm_password') ?></div>
                        </div>

                        <div class="form-group text-end">
                            <button type="submit" class="btn btn-danger">Ganti Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>