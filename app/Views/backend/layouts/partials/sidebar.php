<?php 
helper('auth');
$currentUri = service('uri');
$segment1 = $currentUri->getSegment(1);
?>

<div id="sidebar">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header position-relative">
            <div class="d-flex justify-content-between align-items-center">
                <div class="logo">
                    <a href="<?= base_url('/dashboard') ?>">
                        <img src="<?= base_url('backend/assets/compiled/svg/logo.svg') ?>" alt="Logo" style="height: 2rem;">
                        <span class="ms-2" style="font-weight: 700; color: #435ebe;">MUARA TIRTA</span>
                    </a>
                </div>
                <div class="sidebar-toggler x">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>

        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu Utama</li>

                <!-- Dashboard -->
                <li class="sidebar-item <?= $segment1 == 'dashboard' ? 'active' : '' ?>">
                    <a href="<?= base_url('/dashboard') ?>" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <?php if (is_admin()): ?>
                <!-- Admin Only Menus -->
                <li class="sidebar-title">Manajemen Sistem</li>

                <li class="sidebar-item <?= $segment1 == 'users' ? 'active' : '' ?>">
                    <a href="<?= base_url('/users') ?>" class='sidebar-link'>
                        <i class="bi bi-people-fill"></i>
                        <span>Manajemen User</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-gear-fill"></i>
                        <span>Pengaturan</span>
                    </a>
                </li>
                <?php endif; ?>

                <?php if (has_access(['1', '2'])): ?>
                <!-- CS & Admin Menus -->
                <li class="sidebar-title">Layanan</li>

                <li class="sidebar-item">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-chat-dots-fill"></i>
                        <span>Pengaduan</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-clipboard-check-fill"></i>
                        <span>Layanan Pelanggan</span>
                    </a>
                </li>
                <?php endif; ?>

                <?php if (has_access(['1', '3'])): ?>
                <!-- Publikasi & Admin Menus -->
                <li class="sidebar-title">Konten</li>

                <li class="sidebar-item <?= $segment1 == 'artikel' ? 'active' : '' ?>">
                    <a href="<?= base_url('/artikel') ?>" class='sidebar-link'>
                        <i class="bi bi-file-earmark-text"></i>
                        <span>Kelola Konten</span>
                    </a>
                </li>

                <?php if (is_admin()): ?>
                <li class="sidebar-item <?= $segment1 == 'publikasi' ? 'active' : '' ?>">
                    <a href="<?= base_url('/publikasi/kategori') ?>" class='sidebar-link'>
                        <i class="bi bi-folder"></i>
                        <span>Kategori</span>
                    </a>
                </li>
                <?php endif; ?>
                <?php endif; ?>

                <li class="sidebar-title">Akun</li>

                <li class="sidebar-item">
                    <a href="<?= base_url('/profile') ?>" class='sidebar-link'>
                        <i class="bi bi-person-circle"></i>
                        <span>Profil Saya</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a href="<?= base_url('/logout') ?>" class='sidebar-link' 
                       onclick="return confirm('Apakah Anda yakin ingin logout?')">
                        <i class="bi bi-box-arrow-left"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>