<?= $this->extend('backend/layouts/app-layout') ?>

<?= $this->section('styles') ?>
<style>
    .preview-avatar {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #dee2e6;
    }

    .avatar-placeholder {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 3rem;
        font-weight: bold;
        border: 3px solid #dee2e6;
    }

    .form-label.required::after {
        content: " *";
        color: #dc3545;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="section">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-warning text-dark">
                    <h4 class="mb-0">
                        <i class="bi bi-pencil-square me-2"></i>
                        Edit User
                    </h4>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('users/update/' . $user->id) ?>" method="POST" enctype="multipart/form-data" id="formUser">
                        <?= csrf_field() ?>

                        <div class="row">
                            <!-- Profile Picture -->
                            <div class="col-md-12 mb-4 text-center">
                                <label class="form-label d-block">Foto Profil</label>
                                <div id="avatarPreview" class="mb-3 d-inline-block">
                                    <?php if ($user->profile_pict): ?>
                                        <img src="<?= base_url('uploads/profile/' . $user->profile_pict) ?>"
                                            class="preview-avatar"
                                            alt="<?= esc($user->nm_lengkap) ?>">
                                    <?php else: ?>
                                        <div class="avatar-placeholder">
                                            <?= strtoupper(substr($user->nm_lengkap, 0, 2)) ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div>
                                    <input type="file"
                                        class="form-control w-50 mx-auto"
                                        name="profile_pict"
                                        id="profile_pict"
                                        accept="image/*"
                                        onchange="previewImage(this)">
                                    <small class="text-muted">Kosongkan jika tidak ingin mengubah foto. Max 2MB (JPG, PNG, GIF)</small>
                                    <?php if (isset($errors['profile_pict'])): ?>
                                        <div class="text-danger small mt-1"><?= $errors['profile_pict'] ?></div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- Username -->
                            <div class="col-md-6 mb-3">
                                <label for="username" class="form-label required">Username</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                                    <input type="text"
                                        class="form-control <?= isset($errors['username']) ? 'is-invalid' : '' ?>"
                                        id="username"
                                        name="username"
                                        value="<?= old('username', $user->username) ?>"
                                        placeholder="Masukkan username"
                                        required>
                                </div>
                                <?php if (isset($errors['username'])): ?>
                                    <div class="text-danger small mt-1"><?= $errors['username'] ?></div>
                                <?php endif; ?>
                            </div>

                            <!-- Email -->
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label required">Email</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                    <input type="email"
                                        class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>"
                                        id="email"
                                        name="email"
                                        value="<?= old('email', $user->email) ?>"
                                        placeholder="contoh@email.com"
                                        required>
                                </div>
                                <?php if (isset($errors['email'])): ?>
                                    <div class="text-danger small mt-1"><?= $errors['email'] ?></div>
                                <?php endif; ?>
                            </div>

                            <!-- Nama Lengkap -->
                            <div class="col-md-6 mb-3">
                                <label for="nm_lengkap" class="form-label required">Nama Lengkap</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-person-badge"></i></span>
                                    <input type="text"
                                        class="form-control <?= isset($errors['nm_lengkap']) ? 'is-invalid' : '' ?>"
                                        id="nm_lengkap"
                                        name="nm_lengkap"
                                        value="<?= old('nm_lengkap', $user->nm_lengkap) ?>"
                                        placeholder="Masukkan nama lengkap"
                                        required>
                                </div>
                                <?php if (isset($errors['nm_lengkap'])): ?>
                                    <div class="text-danger small mt-1"><?= $errors['nm_lengkap'] ?></div>
                                <?php endif; ?>
                            </div>

                            <!-- No HP -->
                            <div class="col-md-6 mb-3">
                                <label for="no_hp" class="form-label">No. HP</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-phone"></i></span>
                                    <input type="text"
                                        class="form-control <?= isset($errors['no_hp']) ? 'is-invalid' : '' ?>"
                                        id="no_hp"
                                        name="no_hp"
                                        value="<?= old('no_hp', $user->no_hp) ?>"
                                        placeholder="08xxxxxxxxxx">
                                </div>
                                <?php if (isset($errors['no_hp'])): ?>
                                    <div class="text-danger small mt-1"><?= $errors['no_hp'] ?></div>
                                <?php endif; ?>
                            </div>

                            <!-- Level -->
                            <div class="col-md-12 mb-3">
                                <label for="level" class="form-label required">Level / Role</label>
                                <select class="form-select <?= isset($errors['level']) ? 'is-invalid' : '' ?>"
                                    id="level"
                                    name="level"
                                    required>
                                    <option value="">-- Pilih Level --</option>
                                    <option value="1" <?= old('level', $user->level) == '1' ? 'selected' : '' ?>>Admin</option>
                                    <option value="2" <?= old('level', $user->level) == '2' ? 'selected' : '' ?>>Customer Service</option>
                                    <option value="3" <?= old('level', $user->level) == '3' ? 'selected' : '' ?>>Publikasi</option>
                                </select>
                                <?php if (isset($errors['level'])): ?>
                                    <div class="text-danger small mt-1"><?= $errors['level'] ?></div>
                                <?php endif; ?>
                                <small class="text-muted">
                                    <i class="bi bi-info-circle"></i>
                                    Admin: Full akses | CS: Pengaduan & Pendaftaran | Publikasi: Konten
                                </small>
                            </div>

                            <div class="col-12">
                                <hr>
                                <h6 class="text-muted mb-3">
                                    <i class="bi bi-key-fill me-2"></i>
                                    Ubah Password (Opsional)
                                </h6>
                                <p class="text-muted small">Kosongkan jika tidak ingin mengubah password</p>
                            </div>

                            <!-- Password -->
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label">Password Baru</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                    <input type="password"
                                        class="form-control <?= isset($errors['password']) ? 'is-invalid' : '' ?>"
                                        id="password"
                                        name="password"
                                        placeholder="Minimal 6 karakter">
                                    <button class="btn btn-outline-secondary"
                                        type="button"
                                        onclick="togglePassword('password')">
                                        <i class="bi bi-eye" id="password-icon"></i>
                                    </button>
                                </div>
                                <?php if (isset($errors['password'])): ?>
                                    <div class="text-danger small mt-1"><?= $errors['password'] ?></div>
                                <?php endif; ?>
                            </div>

                            <!-- Confirm Password -->
                            <div class="col-md-6 mb-3">
                                <label for="password_confirm" class="form-label">Konfirmasi Password</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                                    <input type="password"
                                        class="form-control <?= isset($errors['password_confirm']) ? 'is-invalid' : '' ?>"
                                        id="password_confirm"
                                        name="password_confirm"
                                        placeholder="Ulangi password baru">
                                    <button class="btn btn-outline-secondary"
                                        type="button"
                                        onclick="togglePassword('password_confirm')">
                                        <i class="bi bi-eye" id="password_confirm-icon"></i>
                                    </button>
                                </div>
                                <?php if (isset($errors['password_confirm'])): ?>
                                    <div class="text-danger small mt-1"><?= $errors['password_confirm'] ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between">
                            <a href="<?= base_url('users') ?>" class="btn btn-secondary">
                                <i class="bi bi-arrow-left me-1"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-warning">
                                <i class="bi bi-save me-1"></i> Update User
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    // Preview image
    function previewImage(input) {
        const preview = document.getElementById('avatarPreview');

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.innerHTML = '<img src="' + e.target.result + '" class="preview-avatar" alt="Preview">';
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    // Toggle password visibility
    function togglePassword(fieldId) {
        const field = document.getElementById(fieldId);
        const icon = document.getElementById(fieldId + '-icon');

        if (field.type === 'password') {
            field.type = 'text';
            icon.classList.remove('bi-eye');
            icon.classList.add('bi-eye-slash');
        } else {
            field.type = 'password';
            icon.classList.remove('bi-eye-slash');
            icon.classList.add('bi-eye');
        }
    }

    // Form validation
    document.getElementById('formUser').addEventListener('submit', function(e) {
        const password = document.getElementById('password').value;
        const passwordConfirm = document.getElementById('password_confirm').value;

        // Only validate if password is filled
        if (password) {
            if (password !== passwordConfirm) {
                e.preventDefault();
                alert('Password dan konfirmasi password tidak cocok!');
                return false;
            }

            if (password.length < 6) {
                e.preventDefault();
                alert('Password minimal 6 karakter!');
                return false;
            }
        }
    });
</script>
<?= $this->endSection() ?>