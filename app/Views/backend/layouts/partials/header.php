<?php helper('auth'); ?>

<header>
    <nav class="navbar navbar-expand navbar-light navbar-top">
        <div class="container-fluid">
            <a href="#" class="burger-btn d-block">
                <i class="bi bi-justify fs-3"></i>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-lg-0">
                    <!-- Theme Toggle -->
                    <li class="nav-item dropdown me-1">
                        <a class="nav-link active dropdown-toggle text-gray-600" href="#" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class='bi bi-sun fs-4'></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                            <li>
                                <a class="dropdown-item" href="#" data-bs-theme-value="light">
                                    <i class="bi bi-sun me-2"></i> Light
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#" data-bs-theme-value="dark">
                                    <i class="bi bi-moon-stars me-2"></i> Dark
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#" data-bs-theme-value="auto">
                                    <i class="bi bi-circle-half me-2"></i> Auto
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Notifications -->
                    <li class="nav-item dropdown me-3">
                        <a class="nav-link active dropdown-toggle text-gray-600" href="#" data-bs-toggle="dropdown"
                            data-bs-display="static" aria-expanded="false">
                            <i class='bi bi-bell fs-4'></i>
                            <span class="badge badge-notification bg-danger">3</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end notification-dropdown" aria-labelledby="dropdownMenuButton">
                            <li class="dropdown-header">
                                <h6>Notifikasi</h6>
                            </li>
                            <li class="dropdown-item notification-item">
                                <a class="d-flex align-items-center" href="#">
                                    <div class="notification-icon bg-primary">
                                        <i class="bi bi-chat-dots"></i>
                                    </div>
                                    <div class="notification-text ms-3">
                                        <p class="notification-title font-bold">Pengaduan Baru</p>
                                        <p class="notification-subtitle font-thin text-sm">Ada pengaduan baru masuk</p>
                                    </div>
                                </a>
                            </li>
                            <li class="dropdown-item notification-item">
                                <a class="d-flex align-items-center" href="#">
                                    <div class="notification-icon bg-success">
                                        <i class="bi bi-check-circle"></i>
                                    </div>
                                    <div class="notification-text ms-3">
                                        <p class="notification-title font-bold">Laporan Selesai</p>
                                        <p class="notification-subtitle font-thin text-sm">Laporan bulanan telah selesai</p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <p class="text-center py-2 mb-0">
                                    <a href="#" class="text-primary">Lihat Semua Notifikasi</a>
                                </p>
                            </li>
                        </ul>
                    </li>

                    <!-- User Profile -->
                    <li class="nav-item dropdown me-1">
                        <a class="nav-link active dropdown-toggle text-gray-600" href="#" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <div class="user-dropdown d-flex align-items-center">
                                <div class="avatar avatar-md me-2">
                                    <?php if (get_user_data('profile_pict') && get_user_data('profile_pict') != 'default.png'): ?>
                                        <img src="<?= profile_picture() ?>" alt="Avatar">
                                    <?php else: ?>
                                        <div class="avatar-content" style="background-color: #435ebe; color: white;">
                                            <?= user_initials() ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="text">
                                    <h6 class="user-dropdown-name mb-0"><?= get_user_data('nm_lengkap') ?></h6>
                                    <p class="user-dropdown-status text-sm text-muted mb-0"><?= get_user_data('level_name') ?></p>
                                </div>
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton" style="min-width: 11rem;">
                            <li>
                                <h6 class="dropdown-header">Hello, <?= get_user_data('username') ?>!</h6>
                            </li>
                            <li>
                                <a class="dropdown-item" href="<?= url_to('profile') ?>">
                                    <i class="icon-mid bi bi-person me-2"></i> Profil Saya
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="<?= url_to('settings.index') ?>">
                                    <i class="icon-mid bi bi-gear me-2"></i> Pengaturan
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item" href="<?= url_to('logout') ?>" 
                                   onclick="return confirm('Apakah Anda yakin ingin logout?')">
                                    <i class="icon-mid bi bi-box-arrow-left me-2"></i> Logout
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>