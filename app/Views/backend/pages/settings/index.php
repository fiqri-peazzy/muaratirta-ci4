<?= $this->extend('backend/layouts/app-layout') ?>

<?= $this->section('styles') ?>
<style>
    .settings-card {
        border-left: 4px solid #0d6efd;
    }

    .form-label {
        font-weight: 600;
        color: #495057;
    }

    .form-text {
        font-size: 0.875rem;
    }

    .preview-logo {
        max-width: 200px;
        max-height: 100px;
        border: 2px solid #dee2e6;
        border-radius: 0.5rem;
        padding: 0.5rem;
        background: white;
    }

    .group-header {
        background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
        color: white;
        padding: 1rem;
        border-radius: 0.5rem;
        margin-bottom: 1.5rem;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="section">
    <div class="row">
        <div class="col-12">
            <form id="formSettings" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <?php foreach ($groups as $groupKey => $groupLabel): ?>
                    <?php if (isset($settings[$groupKey])): ?>
                        <div class="group-header">
                            <h4 class="mb-0 text-white">
                                <i class="bi bi-gear-fill me-2"></i>
                                <?= $groupLabel ?>
                            </h4>
                        </div>

                        <div class="card settings-card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <?php foreach ($settings[$groupKey] as $setting): ?>
                                        <div class="col-md-6 mb-3">
                                            <label for="<?= $setting->key ?>" class="form-label">
                                                <?= esc($setting->label) ?>
                                                <?php if ($setting->description): ?>
                                                    <i class="bi bi-info-circle text-muted"
                                                        data-bs-toggle="tooltip"
                                                        title="<?= esc($setting->description) ?>"></i>
                                                <?php endif; ?>
                                            </label>

                                            <?php if ($setting->type === 'textarea'): ?>
                                                <textarea
                                                    name="<?= $setting->key ?>"
                                                    id="<?= $setting->key ?>"
                                                    class="form-control"
                                                    rows="4"><?= esc($setting->value) ?></textarea>

                                            <?php elseif ($setting->type === 'select'): ?>
                                                <?php $options = json_decode($setting->options, true); ?>
                                                <select name="<?= $setting->key ?>"
                                                    id="<?= $setting->key ?>"
                                                    class="form-select">
                                                    <?php foreach ($options as $optKey => $optLabel): ?>
                                                        <option value="<?= $optKey ?>"
                                                            <?= $setting->value == $optKey ? 'selected' : '' ?>>
                                                            <?= $optLabel ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>

                                            <?php elseif ($setting->type === 'image'): ?>
                                                <?php if ($setting->value): ?>
                                                    <div class="mb-2">
                                                        <img src="<?= base_url($setting->value) ?>"
                                                            class="preview-logo"
                                                            alt="<?= $setting->label ?>">
                                                    </div>
                                                <?php endif; ?>
                                                <input
                                                    type="file"
                                                    name="<?= $setting->key ?>"
                                                    id="<?= $setting->key ?>"
                                                    class="form-control"
                                                    accept="image/*">
                                                <input type="hidden" name="<?= $setting->key ?>_file" value="1">

                                            <?php else: ?>
                                                <input
                                                    type="<?= $setting->type ?>"
                                                    name="<?= $setting->key ?>"
                                                    id="<?= $setting->key ?>"
                                                    class="form-control"
                                                    value="<?= esc($setting->value) ?>">
                                            <?php endif; ?>

                                            <?php if ($setting->description): ?>
                                                <div class="form-text"><?= esc($setting->description) ?></div>
                                            <?php endif; ?>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>

                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-end gap-2">
                            <button type="reset" class="btn btn-secondary">
                                <i class="bi bi-x-circle me-1"></i> Reset
                            </button>
                            <button type="submit" class="btn btn-primary" id="btnSubmit">
                                <i class="bi bi-save me-1"></i> Simpan Pengaturan
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });

    // Submit form
    document.getElementById('formSettings').addEventListener('submit', function(e) {
        e.preventDefault();

        const btnSubmit = document.getElementById('btnSubmit');
        const formData = new FormData(this);

        btnSubmit.disabled = true;
        btnSubmit.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Menyimpan...';

        fetch('<?= base_url('settings/update') ?>', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    window.location.reload();
                } else {
                    alert(data.message);
                }
                btnSubmit.disabled = false;
                btnSubmit.innerHTML = '<i class="bi bi-save me-1"></i> Simpan Pengaturan';
            })
            .catch(error => {
                alert('Terjadi kesalahan: ' + error);
                btnSubmit.disabled = false;
                btnSubmit.innerHTML = '<i class="bi bi-save me-1"></i> Simpan Pengaturan';
            });
    });
</script>
<?= $this->endSection() ?>