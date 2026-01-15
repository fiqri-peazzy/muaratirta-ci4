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
    <h1 class="auth-title">Verifikasi OTP</h1>
    <p class="auth-subtitle">Masukkan kode OTP yang telah dikirim ke<br><strong><?= esc($email) ?></strong></p>

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
    <form action="<?= url_to('process_verify_otp') ?>" method="POST">
        <?= csrf_field() ?>

        <!-- OTP Input -->
        <div class="form-group">
            <i class="bi bi-shield-lock form-control-icon"></i>
            <input type="text"
                class="form-control"
                name="otp"
                id="otp"
                placeholder="Masukkan 6 digit kode OTP"
                maxlength="6"
                pattern="[0-9]{6}"
                style="text-align: center; font-size: 24px; letter-spacing: 8px; font-weight: 700;"
                required
                autofocus>
        </div>

        <p style="text-align: center; color: #718096; font-size: 13px; margin-bottom: 20px;">
            <i class="bi bi-clock"></i> Kode OTP berlaku selama 15 menit
        </p>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-check-circle"></i>
            <span>Verifikasi OTP</span>
        </button>
    </form>

    <!-- Resend OTP -->
    <div class="forgot-password">
        <a href="<?= url_to('forgot_password') ?>">
            <i class="bi bi-arrow-clockwise"></i> Kirim Ulang Kode OTP
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
    // Auto dismiss alerts
    setTimeout(function() {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(function(alert) {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        });
    }, 5000);

    // Auto format OTP input (numbers only)
    document.getElementById('otp').addEventListener('input', function(e) {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
</script>
<?= $this->endSection() ?>