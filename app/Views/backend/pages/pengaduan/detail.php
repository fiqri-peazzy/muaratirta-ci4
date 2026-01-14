<?= $this->extend('backend/layouts/app-layout') ?>

<?= $this->section('styles') ?>
<style>
    .info-label {
        font-weight: 600;
        color: #6c757d;
        margin-bottom: 0.25rem;
    }

    .info-value {
        font-size: 1.1rem;
        color: #25396f;
        margin-bottom: 1rem;
    }

    .image-preview {
        max-width: 100%;
        border-radius: 0.5rem;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        cursor: pointer;
        transition: transform 0.3s;
    }

    .image-preview:hover {
        transform: scale(1.05);
    }

    .pengaduan-content {
        background: #f8f9fa;
        padding: 1.5rem;
        border-radius: 0.5rem;
        border-left: 4px solid #0d6efd;
        white-space: pre-wrap;
        word-wrap: break-word;
    }

    .timeline-item {
        position: relative;
        padding-bottom: 1.5rem;
        border-left: 2px solid #e9ecef;
        padding-left: 2rem;
        margin-left: 0.5rem;
    }

    .timeline-item:last-child {
        border-left: none;
    }

    .timeline-dot {
        position: absolute;
        left: -0.6rem;
        width: 1rem;
        height: 1rem;
        border-radius: 50%;
        border: 3px solid #fff;
        box-shadow: 0 0 0 3px;
    }

    .status-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 1rem;
        padding: 1.5rem;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="section">
    <div class="row">
        <!-- Back Button -->
        <div class="col-12 mb-3">
            <div class="d-flex justify-content-between">
                <a href="<?= base_url('pengaduan') ?>" class="btn btn-secondary">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
                <a href="<?= base_url('pengaduan/export-pdf/' . $pengaduan->id) ?>"
                    class="btn btn-danger" target="_blank">
                    <i class="bi bi-file-pdf me-1"></i> Cetak PDF
                </a>
            </div>
        </div>

        <!-- Main Info -->
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="bi bi-chat-dots-fill me-2"></i>
                        Detail Pengaduan
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-label">Nomor Pengaduan</div>
                            <div class="info-value">
                                <strong><?= esc($pengaduan->no_pengaduan) ?></strong>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-label">Tanggal Pengaduan</div>
                            <div class="info-value">
                                <?= date('d F Y, H:i', strtotime($pengaduan->created_at)) ?> WIB
                            </div>
                        </div>
                    </div>

                    <hr>

                    <h6 class="mb-3">Data Pengadu</h6>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-label">Nama Lengkap</div>
                            <div class="info-value"><?= esc($pengaduan->nm_lengkap) ?></div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-label">ID Pelanggan</div>
                            <div class="info-value"><?= esc($pengaduan->id_pel ?: '-') ?></div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-label">No. HP / WhatsApp</div>
                            <div class="info-value">
                                <a href="https://wa.me/62<?= ltrim((string) esc($pengaduan->no_hp), '0') ?>" target="_blank">
                                    <?= esc($pengaduan->no_hp) ?>
                                    <i class="bi bi-whatsapp text-success"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-label">Email</div>
                            <div class="info-value">
                                <?php if ($pengaduan->email): ?>
                                    <a href="mailto:<?= esc($pengaduan->email) ?>"><?= esc($pengaduan->email) ?></a>
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="info-label">Alamat</div>
                            <div class="info-value"><?= esc($pengaduan->alamat) ?></div>
                        </div>
                    </div>

                    <hr>

                    <h6 class="mb-3">Kategori Pengaduan</h6>
                    <div class="mb-3">
                        <?php
                        $categories = [
                            'umum' => ['label' => 'Umum', 'icon' => 'chat-square-text'],
                            'teknis' => ['label' => 'Teknis', 'icon' => 'tools'],
                            'administrasi' => ['label' => 'Administrasi', 'icon' => 'file-text'],
                            'tagihan' => ['label' => 'Tagihan', 'icon' => 'receipt'],
                            'kualitas_air' => ['label' => 'Kualitas Air', 'icon' => 'droplet'],
                            'kebocoran' => ['label' => 'Kebocoran', 'icon' => 'exclamation-triangle'],
                            'sambungan_baru' => ['label' => 'Sambungan Baru', 'icon' => 'plug'],
                            'lainnya' => ['label' => 'Lainnya', 'icon' => 'three-dots']
                        ];
                        $kategori = $categories[$pengaduan->kategori] ?? ['label' => $pengaduan->kategori, 'icon' => 'chat'];
                        ?>
                        <span class="badge bg-secondary" style="font-size: 1rem; padding: 0.5rem 1rem;">
                            <i class="bi bi-<?= $kategori['icon'] ?> me-1"></i>
                            <?= $kategori['label'] ?>
                        </span>
                    </div>

                    <h6 class="mb-3">Isi Pengaduan</h6>
                    <div class="pengaduan-content">
                        <?= nl2br((string) esc($pengaduan->isi_pengaduan)) ?>
                    </div>

                    <!-- Foto Pendukung -->
                    <?php if ($pengaduan->foto): ?>
                        <hr>
                        <h6 class="mb-3">Foto Pendukung</h6>
                        <div class="text-center">
                            <img src="<?= base_url('uploads/pengaduan/' . $pengaduan->foto) ?>"
                                alt="Foto Pendukung"
                                class="image-preview"
                                onclick="showImageModal(this.src)">
                        </div>
                    <?php endif; ?>

                    <!-- Tanggapan Admin -->
                    <?php if ($pengaduan->tanggapan): ?>
                        <hr>
                        <h6 class="mb-3">Tanggapan</h6>
                        <div class="alert alert-success">
                            <strong><i class="bi bi-reply-fill me-2"></i>Tanggapan:</strong><br>
                            <?= nl2br((string) esc($pengaduan->tanggapan)) ?>
                        </div>
                    <?php endif; ?>

                    <!-- Catatan Admin -->
                    <?php if ($pengaduan->catatan_admin): ?>
                        <hr>
                        <h6 class="mb-3">Catatan Internal</h6>
                        <div class="alert alert-info">
                            <strong><i class="bi bi-sticky-fill me-2"></i>Catatan Admin:</strong><br>
                            <?= nl2br((string) esc($pengaduan->catatan_admin)) ?>
                        </div>
                    <?php endif; ?>

                    <!-- Timeline Handler -->
                    <?php if ($pengaduan->handled_by): ?>
                        <hr>
                        <h6 class="mb-3">Riwayat Penanganan</h6>
                        <div class="timeline-item">
                            <div class="timeline-dot bg-primary" style="box-shadow: 0 0 0 3px #0d6efd;"></div>
                            <div>
                                <strong>Ditangani oleh: <?= esc($pengaduan->handler_name ?? 'Admin') ?></strong>
                                <br>
                                <small class="text-muted">
                                    <i class="bi bi-clock"></i>
                                    <?= date('d F Y, H:i', strtotime($pengaduan->handled_at)) ?> WIB
                                </small>
                            </div>
                        </div>
                        <?php if ($pengaduan->resolved_at): ?>
                            <div class="timeline-item">
                                <div class="timeline-dot bg-success" style="box-shadow: 0 0 0 3px #198754;"></div>
                                <div>
                                    <strong>Diselesaikan</strong>
                                    <br>
                                    <small class="text-muted">
                                        <i class="bi bi-clock"></i>
                                        <?= date('d F Y, H:i', strtotime($pengaduan->resolved_at)) ?> WIB
                                    </small>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Info Sistem -->
            <?php if ($pengaduan->ip_address || $pengaduan->user_agent): ?>
                <div class="card mt-3">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="bi bi-info-circle me-2"></i>Info Sistem</h6>
                    </div>
                    <div class="card-body">
                        <?php if ($pengaduan->ip_address): ?>
                            <div class="mb-2">
                                <small class="text-muted">IP Address:</small><br>
                                <code><?= esc($pengaduan->ip_address) ?></code>
                            </div>
                        <?php endif; ?>
                        <?php if ($pengaduan->user_agent): ?>
                            <div>
                                <small class="text-muted">User Agent:</small><br>
                                <small><?= esc(substr($pengaduan->user_agent, 0, 100)) ?>...</small>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Status & Action -->
        <div class="col-lg-4">
            <!-- Current Status -->
            <div class="status-card mb-3">
                <div class="text-center">
                    <?php
                    $statusConfig = [
                        'pending' => ['icon' => 'hourglass-split', 'label' => 'Menunggu Ditangani'],
                        'proses' => ['icon' => 'arrow-repeat', 'label' => 'Sedang Diproses'],
                        'selesai' => ['icon' => 'check-circle', 'label' => 'Selesai'],
                        'ditolak' => ['icon' => 'x-circle', 'label' => 'Ditolak']
                    ];
                    $current = $statusConfig[$pengaduan->status] ?? $statusConfig['pending'];
                    ?>
                    <i class="bi bi-<?= $current['icon'] ?>" style="font-size: 4rem;"></i>
                    <h4 class="mt-3 mb-0"><?= $current['label'] ?></h4>
                </div>
            </div>

            <!-- Prioritas Badge -->
            <div class="card mb-3">
                <div class="card-body text-center">
                    <h6 class="text-muted mb-2">Tingkat Prioritas</h6>
                    <?php
                    $prioritasConfig = [
                        'rendah' => ['color' => 'secondary', 'icon' => 'arrow-down'],
                        'sedang' => ['color' => 'info', 'icon' => 'dash'],
                        'tinggi' => ['color' => 'warning', 'icon' => 'arrow-up'],
                        'urgent' => ['color' => 'danger', 'icon' => 'exclamation-triangle-fill']
                    ];
                    $prioritas = $prioritasConfig[$pengaduan->prioritas] ?? $prioritasConfig['sedang'];
                    ?>
                    <span class="badge bg-<?= $prioritas['color'] ?>" style="font-size: 1.2rem; padding: 0.75rem 1.5rem;">
                        <i class="bi bi-<?= $prioritas['icon'] ?> me-2"></i>
                        <?= strtoupper($pengaduan->prioritas) ?>
                    </span>
                </div>
            </div>

            <!-- Update Status Form -->
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Update Pengaduan</h5>
                </div>
                <div class="card-body">
                    <form id="formUpdateStatus">
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" id="status" class="form-select" required>
                                <option value="pending" <?= $pengaduan->status == 'pending' ? 'selected' : '' ?>>Pending</option>
                                <option value="proses" <?= $pengaduan->status == 'proses' ? 'selected' : '' ?>>Proses</option>
                                <option value="selesai" <?= $pengaduan->status == 'selesai' ? 'selected' : '' ?>>Selesai</option>
                                <option value="ditolak" <?= $pengaduan->status == 'ditolak' ? 'selected' : '' ?>>Ditolak</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Prioritas</label>
                            <select name="prioritas" id="prioritas" class="form-select" required>
                                <option value="rendah" <?= $pengaduan->prioritas == 'rendah' ? 'selected' : '' ?>>Rendah</option>
                                <option value="sedang" <?= $pengaduan->prioritas == 'sedang' ? 'selected' : '' ?>>Sedang</option>
                                <option value="tinggi" <?= $pengaduan->prioritas == 'tinggi' ? 'selected' : '' ?>>Tinggi</option>
                                <option value="urgent" <?= $pengaduan->prioritas == 'urgent' ? 'selected' : '' ?>>Urgent</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tanggapan untuk Pengadu</label>
                            <textarea name="tanggapan" id="tanggapan" class="form-control" rows="4"
                                placeholder="Berikan tanggapan yang akan diterima oleh pengadu..."><?= esc($pengaduan->tanggapan) ?></textarea>
                            <small class="text-muted">Tanggapan ini akan dilihat oleh pengadu</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Catatan Internal</label>
                            <textarea name="catatan" id="catatan" class="form-control" rows="3"
                                placeholder="Catatan internal (tidak dilihat pengadu)..."><?= esc($pengaduan->catatan_admin) ?></textarea>
                            <small class="text-muted">Hanya untuk keperluan internal admin</small>
                        </div>

                        <button type="submit" class="btn btn-primary w-100" id="btnSubmit">
                            <i class="bi bi-check-circle me-1"></i> Update Status
                        </button>
                    </form>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card mt-3">
                <div class="card-header">
                    <h6 class="mb-0"><i class="bi bi-lightning-fill me-2"></i>Quick Actions</h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="https://wa.me/62<?= ltrim((string) esc($pengaduan->no_hp), '0') ?>?text=Halo%20<?= urlencode($pengaduan->nm_lengkap) ?>,%20terkait%20pengaduan%20Anda%20dengan%20nomor%20<?= $pengaduan->no_pengaduan ?>"
                            class="btn btn-success btn-sm" target="_blank">
                            <i class="bi bi-whatsapp me-1"></i> Hubungi via WhatsApp
                        </a>
                        <?php if ($pengaduan->email): ?>
                            <a href="mailto:<?= esc($pengaduan->email) ?>?subject=Pengaduan%20<?= $pengaduan->no_pengaduan ?>"
                                class="btn btn-info btn-sm">
                                <i class="bi bi-envelope me-1"></i> Kirim Email
                            </a>
                        <?php endif; ?>
                        <a href="tel:<?= esc($pengaduan->no_hp) ?>" class="btn btn-secondary btn-sm">
                            <i class="bi bi-telephone me-1"></i> Telepon
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Image Modal -->
<div class="modal fade" id="imageModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Foto Pendukung</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <img id="modalImage" src="" alt="Preview" style="max-width: 100%; height: auto;">
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    // Show image in modal
    function showImageModal(src) {
        document.getElementById('modalImage').src = src;
        new bootstrap.Modal(document.getElementById('imageModal')).show();
    }

    // Submit form
    document.getElementById('formUpdateStatus').addEventListener('submit', function(e) {
        e.preventDefault();

        const status = document.getElementById('status').value;
        const prioritas = document.getElementById('prioritas').value;
        const tanggapan = document.getElementById('tanggapan').value;
        const catatan = document.getElementById('catatan').value;
        const btnSubmit = document.getElementById('btnSubmit');

        if (!confirm('Yakin ingin mengupdate pengaduan ini?')) {
            return;
        }

        btnSubmit.disabled = true;
        btnSubmit.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Memproses...';

        fetch('<?= base_url('pengaduan/update-status/' . $pengaduan->id) ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: new URLSearchParams({
                    status: status,
                    prioritas: prioritas,
                    tanggapan: tanggapan,
                    catatan: catatan,
                    '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    window.location.reload();
                } else {
                    alert(data.message);
                    btnSubmit.disabled = false;
                    btnSubmit.innerHTML = '<i class="bi bi-check-circle me-1"></i> Update Status';
                }
            })
            .catch(error => {
                alert('Terjadi kesalahan: ' + error);
                btnSubmit.disabled = false;
                btnSubmit.innerHTML = '<i class="bi bi-check-circle me-1"></i> Update Status';
            });
    });
</script>
<?= $this->endSection() ?>