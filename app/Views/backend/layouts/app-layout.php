<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $title ?? 'Dashboard' ?> - PERUMDA AIR MINUM MUARA TIRTA</title>

    <link rel="shortcut icon" href="<?= base_url('backend/assets/compiled/svg/favicon.svg') ?>" type="image/x-icon">

    <!-- PWA Meta Tags -->
    <meta name="theme-color" content="#667eea">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="PDAM MT Admin">
    <link rel="apple-touch-icon" href="<?= base_url('backend/assets/images/logo/logo.png') ?>">
    <link rel="manifest" href="<?= base_url('manifest.json') ?>">

    <!-- Mazer CSS -->
    <link rel="stylesheet" href="<?= base_url('backend/assets/compiled/css/app.css') ?>">
    <link rel="stylesheet" href="<?= base_url('backend/assets/compiled/css/app-dark.css') ?>">
    <link rel="stylesheet" href="<?= base_url('backend/assets/compiled/css/iconly.css') ?>">

    <!-- Additional CSS -->
    <?= $this->renderSection('styles') ?>

    <style>
        .page-heading h3 {
            color: #25396f;
            font-weight: 700;
        }

        .card {
            border-radius: 1rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.05);
            border: none;
        }

        .alert {
            border-radius: 0.5rem;
        }
    </style>
</head>

<body>
    <script src="<?= base_url('backend/assets/static/js/initTheme.js') ?>"></script>

    <div id="app">
        <!-- Sidebar -->
        <?= $this->include('backend/layouts/partials/sidebar') ?>

        <div id="main">
            <!-- Header -->
            <?= $this->include('backend/layouts/partials/header') ?>

            <!-- Page Heading -->
            <div class="page-heading">
                <h3><?= $pageTitle ?? $title ?? 'Dashboard' ?></h3>
            </div>

            <!-- Main Content -->
            <div class="page-content">
                <!-- Alert Messages -->
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle me-2"></i>
                        <?= session()->getFlashdata('success') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-circle me-2"></i>
                        <?= session()->getFlashdata('error') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('warning')): ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        <?= session()->getFlashdata('warning') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('info')): ?>
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <i class="bi bi-info-circle me-2"></i>
                        <?= session()->getFlashdata('info') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <!-- Page Content -->
                <?= $this->renderSection('content') ?>
            </div>

            <!-- Footer -->
            <?= $this->include('backend/layouts/partials/footer') ?>
        </div>
    </div>

    <!-- Mazer JS -->
    <script src="<?= base_url('backend/assets/static/js/components/dark.js') ?>"></script>
    <script src="<?= base_url('backend/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js') ?>"></script>
    <script src="<?= base_url('backend/assets/compiled/js/app.js') ?>"></script>

    <!-- Additional JS -->
    <?= $this->renderSection('scripts') ?>

    <!-- PWA Manager -->
    <script src="<?= base_url('pwa-manager.js') ?>"></script>

    <script>
        // Auto dismiss alerts after 5 seconds
        setTimeout(function() {
            let alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                let bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
    </script>
</body>

</html>