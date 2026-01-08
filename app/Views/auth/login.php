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
    <h1 class="auth-title">Selamat Datang</h1>
    <p class="auth-subtitle">Silakan login untuk melanjutkan</p>

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

    <!-- Login Form -->
    <!-- Login Form -->
    <form action="<?= url_to('login.attempt') ?>" method="POST">
        <?= csrf_field() ?>

        <!-- Username/Email Input -->
        <div class="form-group">
            <i class="bi bi-person form-control-icon"></i>
            <input type="text" 
                   class="form-control" 
                   name="login" 
                   placeholder="Username atau Email"
                   value="<?= old('login') ?>"
                   required
                   autofocus>
        </div>

        <!-- Password Input -->
        <div class="form-group">
            <i class="bi bi-lock form-control-icon"></i>
            <input type="password" 
                   class="form-control" 
                   name="password" 
                   id="password"
                   placeholder="Password"
                   required>
            <i class="bi bi-eye password-toggle" id="togglePassword" onclick="togglePassword()"></i>
        </div>

        <!-- Remember Me -->
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="rememberMe">
            <label class="form-check-label" for="rememberMe">
                Ingat Saya
            </label>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-box-arrow-in-right"></i>
            <span>Masuk</span>
        </button>
    </form>

    <!-- Forgot Password Link -->
    <div class="forgot-password">
        <a href="<?= url_to('forgot_password') ?>">Lupa Password?</a>
    </div>

    <!-- Footer -->
    <div class="auth-footer">
        <p>&copy; <?= date('Y') ?> PERUMDA AIR MINUM MUARA TIRTA. All Rights Reserved.</p>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const toggleIcon = document.getElementById('togglePassword');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.classList.remove('bi-eye');
        toggleIcon.classList.add('bi-eye-slash');
    } else {
        passwordInput.type = 'password';
        toggleIcon.classList.remove('bi-eye-slash');
        toggleIcon.classList.add('bi-eye');
    }
}

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
