<?= $this->extend('backend/layouts/guest-layout') ?>

<?= $this->section('content') ?>
<div class="auth-card">
    <!-- Logo & Header -->
    <div class="auth-logo">
        <img src="<?= base_url('backend/assets/images/logo/logo.png') ?>" alt="Logo">
        <h4>PERUMDA AIR MINUM</h4>
        <h5>MUARA TIRTA</h5>
        <p>Kota Gorontalo</p>
    </div>

    <!-- Title -->
    <h1 class="auth-title">Lupa Password?</h1>
    <p class="auth-subtitle">Masukkan email Anda untuk menerima kode OTP</p>

    <!-- Alerts -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle"></i>
            <span><?= session()->getFlashdata('success') ?></span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">×</button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-circle"></i>
            <span><?= session()->getFlashdata('error') ?></span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">×</button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-circle"></i>
            <div>
                <ul>
                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">×</button>
        </div>
    <?php endif; ?>

    <!-- Form -->
    <form action="<?= url_to('send_reset_otp') ?>" method="POST">
        <?= csrf_field() ?>

        <!-- Email Input -->
        <div class="form-group">
            <i class="bi bi-envelope form-control-icon"></i>
            <input type="email"
                class="form-control"
                name="email"
                placeholder="Email"
                value="<?= old('email') ?>"
                required
                autofocus>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-send"></i>
            <span>Kirim Kode OTP</span>
        </button>
    </form>

    <!-- Back to Login -->
    <div class="forgot-password">
        <a href="<?= url_to('login') ?>">
            <i class="bi bi-arrow-left"></i> Kembali ke Login
        </a>
    </div>

    <!-- Footer -->
    <div class="auth-footer">
        <p>&copy; <?= date('Y') ?> PERUMDA AIR MINUM MUARA TIRTA. All Rights Reserved.</p>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    // Auto dismiss alerts after 5 seconds
    setTimeout(function() {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(function(alert) {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        });
    }, 5000);
</script>
<?= $this->endSection() ?>