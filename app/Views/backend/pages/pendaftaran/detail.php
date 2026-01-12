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

    .status-timeline {
        position: relative;
        padding-left: 2rem;
    }

    .status-timeline::before {
        content: '';
        position: absolute;
        left: 0.5rem;
        top: 0;
        bottom: 0;
        width: 2px;
        background: #e9ecef;
    }

    .timeline-item {
        position: relative;
        margin-bottom: 1.5rem;
    }

    .timeline-dot {
        position: absolute;
        left: -1.5rem;
        width: 1rem;
        height: 1rem;
        border-radius: 50%;
        border: 2px solid #fff;
        box-shadow: 0 0 0 3px;
    }

    .map-container {
        height: 300px;
        border-radius: 0.5rem;
        overflow: hidden;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="section">
    <div class="row">
        <!-- Back Button -->
        <div class="col-12 mb-3">
            <div class="d-flex justify-content-between">
                <a href="<?= base_url('pendaftaran') ?>" class="btn btn-secondary">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
                <a href="<?= base_url('pendaftaran/export-pdf/' . $pendaftaran->id) ?>"
                    class="btn btn-danger" target="_blank">
                    <i class="bi bi-file-pdf me-1"></i> Cetak PDF
                </a>
            </div>
        </div>

        <!-- Main Info -->
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Informasi Pendaftaran</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-label">Nomor Pendaftaran</div>
                            <div class="info-value">
                                <strong><?= esc($pendaftaran->no_pendaftaran) ?></strong>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-label">Tanggal Pendaftaran</div>
                            <div class="info-value">
                                <?= date('d F Y, H:i', strtotime($pendaftaran->created_at)) ?> WIB
                            </div>
                        </div>
                    </div>

                    <hr>

                    <h6 class="mb-3">Data Pemohon</h6>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-label">Nama Lengkap</div>
                            <div class="info-value"><?= esc($pendaftaran->nama_lengkap) ?></div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-label">NIK</div>
                            <div class="info-value"><?= esc($pendaftaran->nik ?: '-') ?></div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-label">No. HP</div>
                            <div class="info-value">
                                <a href="tel:<?= esc($pendaftaran->no_hp) ?>"><?= esc($pendaftaran->no_hp) ?></a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-label">No. WhatsApp</div>
                            <div class="info-value">
                                <a href="https://wa.me/62<?= ltrim(esc((string) $pendaftaran->no_wa), '0') ?>" target="_blank">
                                    <?= esc($pendaftaran->no_wa ?: '-') ?>
                                    <?php if ($pendaftaran->no_wa): ?>
                                        <i class="bi bi-whatsapp text-success"></i>
                                    <?php endif; ?>
                                </a>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="info-label">Email</div>
                            <div class="info-value">
                                <?= esc($pendaftaran->email ?: '-') ?>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <h6 class="mb-3">Alamat Pemasangan</h6>
                    <div class="row">
                        <div class="col-12">
                            <div class="info-label">Alamat Lengkap</div>
                            <div class="info-value"><?= esc($pendaftaran->alamat_pemasangan) ?></div>
                        </div>
                        <div class="col-md-3">
                            <div class="info-label">RT</div>
                            <div class="info-value"><?= esc($pendaftaran->rt ?: '-') ?></div>
                        </div>
                        <div class="col-md-3">
                            <div class="info-label">RW</div>
                            <div class="info-value"><?= esc($pendaftaran->rw ?: '-') ?></div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-label">Kelurahan</div>
                            <div class="info-value"><?= esc($pendaftaran->kelurahan ?: '-') ?></div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-label">Kecamatan</div>
                            <div class="info-value"><?= esc($pendaftaran->kecamatan ?: '-') ?></div>
                        </div>
                    </div>

                    <!-- Map Location -->
                    <?php if ($pendaftaran->latitude && $pendaftaran->longitude): ?>
                        <hr>
                        <h6 class="mb-3">Lokasi Pemasangan</h6>
                        <div class="map-container">
                            <iframe
                                width="100%"
                                height="300"
                                frameborder="0"
                                scrolling="no"
                                marginheight="0"
                                marginwidth="0"
                                src="https://maps.google.com/maps?q=<?= esc($pendaftaran->latitude) ?>,<?= esc($pendaftaran->longitude) ?>&hl=id&z=16&output=embed">
                            </iframe>
                        </div>
                        <p class="text-muted small mt-2">
                            <i class="bi bi-geo-alt"></i>
                            Koordinat: <?= esc($pendaftaran->latitude) ?>, <?= esc($pendaftaran->longitude) ?>
                        </p>
                    <?php endif; ?>

                    <!-- Dokumen -->
                    <hr>
                    <h6 class="mb-3">Dokumen Pendukung</h6>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="info-label">Foto KTP</div>
                            <?php if ($pendaftaran->foto_ktp): ?>
                                <img src="<?= base_url('uploads/pendaftaran/ktp/' . $pendaftaran->foto_ktp) ?>"
                                    alt="Foto KTP"
                                    class="image-preview"
                                    onclick="showImageModal(this.src, 'Foto KTP')">
                            <?php else: ?>
                                <p class="text-muted">Tidak ada file</p>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="info-label">Foto Rumah/Lokasi</div>
                            <?php if ($pendaftaran->foto_rumah): ?>
                                <img src="<?= base_url('uploads/pendaftaran/rumah/' . $pendaftaran->foto_rumah) ?>"
                                    alt="Foto Rumah"
                                    class="image-preview"
                                    onclick="showImageModal(this.src, 'Foto Rumah')">
                            <?php else: ?>
                                <p class="text-muted">Tidak ada file</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Status & Action -->
        <div class="col-lg-4">
            <!-- Current Status -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Status Pendaftaran</h5>
                </div>
                <div class="card-body">
                    <?php
                    $statusConfig = [
                        'pending' => ['color' => 'warning', 'icon' => 'hourglass-split', 'label' => 'Menunggu Verifikasi'],
                        'verifikasi' => ['color' => 'info', 'icon' => 'clock-history', 'label' => 'Sedang Diverifikasi'],
                        'approved' => ['color' => 'success', 'icon' => 'check-circle', 'label' => 'Disetujui'],
                        'rejected' => ['color' => 'danger', 'icon' => 'x-circle', 'label' => 'Ditolak'],
                        'survey' => ['color' => 'primary', 'icon' => 'geo-alt', 'label' => 'Proses Survey'],
                    ];
                    $current = $statusConfig[$pendaftaran->status];
                    ?>
                    <div class="text-center mb-4">
                        <i class="bi bi-<?= $current['icon'] ?> text-<?= $current['color'] ?>" style="font-size: 4rem;"></i>
                        <h5 class="text-<?= $current['color'] ?> mt-3"><?= $current['label'] ?></h5>
                    </div>

                    <?php if ($pendaftaran->catatan_admin): ?>
                        <div class="alert alert-info">
                            <strong>Catatan Admin:</strong><br>
                            <?= nl2br(esc((string) $pendaftaran->catatan_admin)) ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($pendaftaran->catatan_penolakan): ?>
                        <div class="alert alert-danger">
                            <strong>Alasan Penolakan:</strong><br>
                            <?= nl2br(esc((string) $pendaftaran->catatan_penolakan)) ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($pendaftaran->verified_by): ?>
                        <div class="text-muted small">
                            <i class="bi bi-person"></i> Diverifikasi oleh: User #<?= $pendaftaran->verified_by ?><br>
                            <i class="bi bi-clock"></i> <?= date('d F Y, H:i', strtotime($pendaftaran->verified_at)) ?> WIB
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Update Status Form -->
            <div class="card mt-3">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0 text-white">Update Status</h5>
                </div>
                <div class="card-body">
                    <form id="formUpdateStatus">
                        <div class="mb-3">
                            <label class="form-label">Status Baru</label>
                            <select name="status" id="status" class="form-select" required>
                                <option value="">-- Pilih Status --</option>
                                <option value="pending" <?= $pendaftaran->status == 'pending' ? 'selected' : '' ?>>Pending</option>
                                <option value="verifikasi" <?= $pendaftaran->status == 'verifikasi' ? 'selected' : '' ?>>Verifikasi</option>
                                <option value="approved" <?= $pendaftaran->status == 'approved' ? 'selected' : '' ?>>Disetujui</option>
                                <option value="survey" <?= $pendaftaran->status == 'survey' ? 'selected' : '' ?>>Survey Lokasi</option>
                                <option value="rejected" <?= $pendaftaran->status == 'rejected' ? 'selected' : '' ?>>Ditolak</option>
                            </select>
                        </div>

                        <div class="mb-3" id="catatanWrapper">
                            <label class="form-label" id="catatanLabel">Catatan</label>
                            <textarea name="catatan" id="catatan" class="form-control" rows="4"
                                placeholder="Tambahkan catatan (opsional)"></textarea>
                            <small class="text-muted" id="catatanHelper">Catatan akan dikirim ke pemohon</small>
                        </div>

                        <button type="submit" class="btn btn-primary w-100" id="btnSubmit">
                            <i class="bi bi-check-circle me-1"></i> Update Status
                        </button>
                    </form>
                </div>
            </div>

            <!-- User Info -->
            <?php if ($pendaftaran->ip_address || $pendaftaran->user_agent): ?>
                <div class="card mt-3">
                    <div class="card-header">
                        <h5 class="mb-0">Info Sistem</h5>
                    </div>
                    <div class="card-body">
                        <?php if ($pendaftaran->ip_address): ?>
                            <div class="mb-2">
                                <small class="text-muted">IP Address:</small><br>
                                <code><?= esc($pendaftaran->ip_address) ?></code>
                            </div>
                        <?php endif; ?>
                        <?php if ($pendaftaran->user_agent): ?>
                            <div>
                                <small class="text-muted">User Agent:</small><br>
                                <small><?= esc(substr($pendaftaran->user_agent, 0, 100)) ?>...</small>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Image Modal -->
<div class="modal fade" id="imageModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Preview</h5>
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
    function showImageModal(src, title) {
        document.getElementById('modalImage').src = src;
        document.getElementById('imageModalLabel').textContent = title;
        new bootstrap.Modal(document.getElementById('imageModal')).show();
    }

    // Change catatan label based on status
    document.getElementById('status').addEventListener('change', function() {
        const status = this.value;
        const catatanLabel = document.getElementById('catatanLabel');
        const catatanHelper = document.getElementById('catatanHelper');
        const catatan = document.getElementById('catatan');

        if (status === 'rejected') {
            catatanLabel.textContent = 'Alasan Penolakan *';
            catatanHelper.textContent = 'Wajib diisi untuk status ditolak';
            catatan.required = true;
            catatan.placeholder = 'Jelaskan alasan penolakan...';
        } else {
            catatanLabel.textContent = 'Catatan';
            catatanHelper.textContent = 'Catatan akan dikirim ke pemohon (opsional)';
            catatan.required = false;
            catatan.placeholder = 'Tambahkan catatan (opsional)';
        }
    });

    // Submit form
    document.getElementById('formUpdateStatus').addEventListener('submit', function(e) {
        e.preventDefault();

        const status = document.getElementById('status').value;
        const catatan = document.getElementById('catatan').value;
        const btnSubmit = document.getElementById('btnSubmit');

        if (!status) {
            alert('Pilih status terlebih dahulu');
            return;
        }

        if (status === 'rejected' && !catatan.trim()) {
            alert('Alasan penolakan wajib diisi');
            return;
        }

        if (!confirm('Yakin ingin mengupdate status pendaftaran ini?')) {
            return;
        }

        btnSubmit.disabled = true;
        btnSubmit.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Memproses...';

        fetch('<?= base_url('pendaftaran/update-status/' . $pendaftaran->id) ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: new URLSearchParams({
                    status: status,
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