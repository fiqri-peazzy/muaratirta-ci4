<?= $this->extend('backend/layouts/app-layout') ?>

<?= $this->section('content') ?>
<section class="row">
    <div class="col-12 col-lg-9">
        <div class="row">
            <!-- Statistics Cards -->
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                <div class="stats-icon purple mb-2">
                                    <i class="iconly-boldShow"></i>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <h6 class="text-muted font-semibold">Total Pelanggan</h6>
                                <h6 class="font-extrabold mb-0">12,543</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6 col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                <div class="stats-icon blue mb-2">
                                    <i class="iconly-boldProfile"></i>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <h6 class="text-muted font-semibold">Pengaduan Aktif</h6>
                                <h6 class="font-extrabold mb-0">34</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6 col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                <div class="stats-icon green mb-2">
                                    <i class="iconly-boldAdd-User"></i>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <h6 class="text-muted font-semibold">Artikel</h6>
                                <h6 class="font-extrabold mb-0">145</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6 col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                <div class="stats-icon red mb-2">
                                    <i class="iconly-boldBookmark"></i>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <h6 class="text-muted font-semibold">Pengumuman</h6>
                                <h6 class="font-extrabold mb-0">23</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activities -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Aktivitas Terbaru</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-lg">
                                <thead>
                                    <tr>
                                        <th>Waktu</th>
                                        <th>Aktivitas</th>
                                        <th>User</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="col-3">
                                            <div class="d-flex align-items-center">
                                                <p class="font-bold ms-3 mb-0">10:30</p>
                                            </div>
                                        </td>
                                        <td class="col-auto">
                                            <p class="mb-0">Pengaduan baru dari pelanggan</p>
                                        </td>
                                        <td class="col-auto">
                                            <p class="mb-0">Ahmad Yani</p>
                                        </td>
                                        <td class="col-auto">
                                            <span class="badge bg-warning">Pending</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="col-3">
                                            <div class="d-flex align-items-center">
                                                <p class="font-bold ms-3 mb-0">09:15</p>
                                            </div>
                                        </td>
                                        <td class="col-auto">
                                            <p class="mb-0">Artikel baru dipublikasikan</p>
                                        </td>
                                        <td class="col-auto">
                                            <p class="mb-0">Siti Rahma</p>
                                        </td>
                                        <td class="col-auto">
                                            <span class="badge bg-success">Published</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="col-3">
                                            <div class="d-flex align-items-center">
                                                <p class="font-bold ms-3 mb-0">08:45</p>
                                            </div>
                                        </td>
                                        <td class="col-auto">
                                            <p class="mb-0">Pengaduan diselesaikan</p>
                                        </td>
                                        <td class="col-auto">
                                            <p class="mb-0">Budi Santoso</p>
                                        </td>
                                        <td class="col-auto">
                                            <span class="badge bg-success">Resolved</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Profile & Info Sidebar -->
    <div class="col-12 col-lg-3">
        <div class="card">
            <div class="card-body py-4 px-4">
                <div class="d-flex align-items-center">
                    <div class="avatar avatar-xl me-3">
                        <?php if (get_user_data('profile_pict') && get_user_data('profile_pict') != 'default.png'): ?>
                            <img src="<?= profile_picture() ?>" alt="Avatar">
                        <?php else: ?>
                            <div class="avatar-content" style="background-color: #435ebe; color: white; font-size: 1.5rem;">
                                <?= user_initials() ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="ms-3 name">
                        <h5 class="font-bold"><?= get_user_data('nm_lengkap') ?></h5>
                        <h6 class="text-muted mb-0"><?= get_user_data('level_name') ?></h6>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4>Quick Access</h4>
            </div>
            <div class="card-content pb-4">
                <?php if (is_admin()): ?>
                <div class="px-4 py-2">
                    <a href="<?= url_to('users.index') ?>" class="btn btn-block btn-xl btn-outline-primary font-bold mt-3">
                        <i class="bi bi-people me-2"></i> Kelola User
                    </a>
                </div>
                <?php endif; ?>

                <?php if (has_access(['1', '2'])): ?>
                <div class="px-4 py-2">
                    <a href="<?= url_to('pengaduan.index') ?>" class="btn btn-block btn-xl btn-outline-success font-bold mt-3">
                        <i class="bi bi-chat-dots me-2"></i> Pengaduan
                    </a>
                </div>
                <?php endif; ?>

                <?php if (has_access(['1', '3'])): ?>
                <div class="px-4 py-2">
                    <a href="<?= url_to('artikel.index') ?>" class="btn btn-block btn-xl btn-outline-info font-bold mt-3">
                        <i class="bi bi-newspaper me-2"></i> Artikel
                    </a>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4>Statistik Hari Ini</h4>
            </div>
            <div class="card-body">
                <div id="chart-visitors-profile"></div>
                <div class="mt-4">
                    <div class="d-flex justify-content-between mb-2">
                        <span>Pengaduan Masuk</span>
                        <span class="text-primary fw-bold">12</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Pengaduan Selesai</span>
                        <span class="text-success fw-bold">8</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Artikel Dibuat</span>
                        <span class="text-info fw-bold">3</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>