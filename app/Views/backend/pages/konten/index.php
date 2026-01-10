<?= $this->extend('backend/layouts/app-layout') ?>

<?= $this->section('content') ?>
<section class="row">
    <div class="col-12">
        <!-- Filter Section -->
        <div class="card mb-3">
            <div class="card-body">
                <form action="<?= route_to('artikel.index') ?>" method="GET" class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label">Kategori</label>
                        <select name="kategori" class="form-select">
                            <option value="">Semua Kategori</option>
                            <?php foreach ($kategoris as $kategori): ?>
                                <option value="<?= $kategori->id ?>" <?= $filters['kategori_id'] == $kategori->id ? 'selected' : '' ?>>
                                    <?= esc($kategori->nama_kategori) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="">Semua Status</option>
                            <option value="draft" <?= $filters['status'] == 'draft' ? 'selected' : '' ?>>Draft</option>
                            <option value="published" <?= $filters['status'] == 'published' ? 'selected' : '' ?>>Published</option>
                            <option value="archived" <?= $filters['status'] == 'archived' ? 'selected' : '' ?>>Archived</option>
                        </select>
                    </div>
                    <div class="col-md-5">
                        <label class="form-label">Pencarian</label>
                        <input type="text" name="search" class="form-control" placeholder="Cari judul, konten, atau tags..." value="<?= esc($filters['search']) ?>">
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary me-2">
                            <i class="bi bi-search"></i> Cari
                        </button>
                        <a href="<?= route_to('artikel.index') ?>" class="btn btn-secondary">
                            <i class="bi bi-arrow-clockwise"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Content List -->
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Daftar Konten Publikasi</h5>
                    <a href="<?= route_to('artikel.create') ?>" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-2"></i>Buat Konten Baru
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th width="10%">Thumbnail</th>
                                <th width="30%">Judul</th>
                                <th width="15%">Kategori</th>
                                <th width="10%">Author</th>
                                <th width="10%">Status</th>
                                <th width="5%" class="text-center">Views</th>
                                <th width="10%">Tanggal</th>
                                <th width="10%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($kontens)): ?>
                                <tr>
                                    <td colspan="9" class="text-center py-4">
                                        <p class="text-muted mb-0">Belum ada konten</p>
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php 
                                $no = 1 + (($pager->getCurrentPage() - 1) * 10);
                                foreach ($kontens as $konten): 
                                ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td>
                                        <?php if ($konten->thumbnail): ?>
                                            <img src="<?= base_url('uploads/publikasi/thumbnails/' . $konten->thumbnail) ?>" 
                                                 alt="Thumbnail" 
                                                 class="img-thumbnail" 
                                                 style="width: 80px; height: 60px; object-fit: cover;">
                                        <?php else: ?>
                                            <div class="bg-light d-flex align-items-center justify-content-center" 
                                                 style="width: 80px; height: 60px; border-radius: 4px;">
                                                <i class="bi bi-image text-muted fs-4"></i>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <strong><?= esc($konten->judul) ?></strong>
                                        <?php if ($konten->is_featured == '1'): ?>
                                            <span class="badge bg-warning text-dark ms-2">
                                                <i class="bi bi-star-fill"></i> Featured
                                            </span>
                                        <?php endif; ?>
                                        <br>
                                        <small class="text-muted"><?= esc(substr(strip_tags($konten->konten), 0, 100)) ?>...</small>
                                    </td>
                                    <td>
                                        <span class="badge bg-info"><?= esc($konten->nama_kategori) ?></span>
                                    </td>
                                    <td>
                                        <small><?= esc($konten->author_name) ?></small>
                                    </td>
                                    <td>
                                        <?php
                                        $statusClass = [
                                            'draft' => 'secondary',
                                            'published' => 'success',
                                            'archived' => 'warning'
                                        ];
                                        ?>
                                        <span class="badge bg-<?= $statusClass[$konten->status] ?>">
                                            <?= ucfirst($konten->status) ?>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-primary"><?= number_format($konten->view_count) ?></span>
                                    </td>
                                    <td>
                                        <small>
                                            <?php if ($konten->published_at): ?>
                                                <?= date('d M Y', strtotime($konten->published_at)) ?>
                                            <?php else: ?>
                                                <?= date('d M Y', strtotime($konten->created_at)) ?>
                                            <?php endif; ?>
                                        </small>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <a href="<?= route_to('artikel.edit', $konten->id) ?>" 
                                               class="btn btn-sm btn-warning" 
                                               title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <a href="<?= route_to('artikel.delete', $konten->id) ?>" 
                                               class="btn btn-sm btn-danger" 
                                               onclick="return confirm('Yakin ingin menghapus konten ini?')"
                                               title="Hapus">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <?php if ($pager): ?>
                    <div class="mt-3">
                        <?= $pager->links('default', 'bootstrap_pagination') ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>