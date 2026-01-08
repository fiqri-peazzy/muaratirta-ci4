<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $title ?? 'Dashboard' ?> - PERUMDA AIR MINUM MUARA TIRTA</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url('backend/assets/css/bootstrap.css') ?>">

    <!-- Icon Sets -->
    <link rel="stylesheet" href="<?= base_url('backend/assets/vendors/iconly/bold.css') ?>">
    <link rel="stylesheet" href="<?= base_url('backend/assets/vendors/bootstrap-icons/bootstrap-icons.css') ?>">

    <!-- Plugins CSS -->
    <link rel="stylesheet" href="<?= base_url('backend/assets/vendors/perfect-scrollbar/perfect-scrollbar.css') ?>">

    <!-- App CSS -->
    <link rel="stylesheet" href="<?= base_url('backend/assets/css/app.css') ?>">

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

        .sidebar-wrapper .menu .sidebar-link {
            transition: all 0.3s ease;
        }

        .sidebar-wrapper .menu .sidebar-link:hover {
            background-color: #f8f9fa;
        }

        .sidebar-wrapper .menu .sidebar-link.active {
            background-color: #435ebe;
            color: white;
        }
    </style>
</head>

<body>
    <div id="app">
        <!-- Sidebar -->
        <?= $this->include('backend/layouts/partials/sidebar') ?>

        <div id="main" class='layout-navbar navbar-fixed'>
            <!-- Header -->
            <?= $this->include('backend/layouts/partials/header') ?>

            <!-- Main Content -->
            <div id="main-content">
                <div class="page-heading">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-12 col-md-6 order-md-1 order-last">
                                <h3><?= $pageTitle ?? $title ?? 'Dashboard' ?></h3>
                                <?php if (isset($breadcrumbs)): ?>
                                    <p class="text-subtitle text-muted"><?= $breadcrumbs ?></p>
                                <?php endif; ?>
                            </div>
                            <div class="col-12 col-md-6 order-md-2 order-first">
                                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                    <?= $this->renderSection('breadcrumb') ?>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Alert Messages -->
                <div class="page-content">
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
            </div>

            <!-- Footer -->
            <?= $this->include('backend/layouts/partials/footer') ?>
        </div>
    </div>

    <!-- Core JS -->
    <script src="<?= base_url('backend/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') ?>"></script>
    <script src="<?= base_url('backend/assets/js/bootstrap.bundle.min.js') ?>"></script>

    <!-- App JS -->
    <script src="<?= base_url('backend/assets/js/main.js') ?>"></script>

    <!-- Additional JS -->
    <?= $this->renderSection('scripts') ?>

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