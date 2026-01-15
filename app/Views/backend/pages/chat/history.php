<?= $this->extend('backend/layouts/app-layout') ?>

<?= $this->section('content') ?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Riwayat Chat AI</h3>
                <p class="text-subtitle text-muted">Monitoring interaksi pelanggan dengan Asisten Virtual Tirta.</p>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Log Percakapan Terakhir</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="table-history">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th width="15%">Waktu</th>
                                <th width="15%">Session ID</th>
                                <th width="20%">Pesan User</th>
                                <th width="35%">Bot Response</th>
                                <th width="10%">Intent</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($history as $row): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><small><?= date('d/m/Y H:i', strtotime($row->created_at)) ?></small></td>
                                    <td><code><?= esc(substr($row->session_id, 0, 8)) ?>...</code></td>
                                    <td><small><?= esc($row->user_message) ?></small></td>
                                    <td><small class="text-muted"><?= esc($row->bot_response) ?></small></td>
                                    <td><span class="badge bg-light-secondary"><?= esc($row->intent) ?></span></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    $(document).ready(function() {
        // Optional: Add simple filtering or datatables here
    });
</script>
<?= $this->endSection() ?>