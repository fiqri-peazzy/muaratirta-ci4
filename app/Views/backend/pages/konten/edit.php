<?= $this->extend('backend/layouts/app-layout') ?>

<?= $this->section('styles') ?>
<!-- TinyMCE -->
<script src="https://cdn.tiny.cloud/1/q16pd3ynt0igfd0msxdvboh5eeo1m095rohn78l1kim3vdhp/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<style>
.image-preview {
    max-width: 300px;
    max-height: 200px;
    margin-top: 10px;
    border-radius: 8px;
}
.galeri-preview {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-top: 10px;
}
.galeri-item {
    position: relative;
    width: 150px;
}
.galeri-item img {
    width: 100%;
    height: 100px;
    object-fit: cover;
    border-radius: 8px;
}
.galeri-item .remove-image {
    position: absolute;
    top: 5px;
    right: 5px;
    background: #dc3545;
    color: white;
    border: none;
    border-radius: 50%;
    width: 25px;
    height: 25px;
    cursor: pointer;
}
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Edit Konten</h5>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('errors')): ?>
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                <li><?= esc($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form action="<?= route_to('artikel.update', $konten->id) ?>" method="POST" enctype="multipart/form-data" id="form-konten">
                    <?= csrf_field() ?>

                    <div class="row">
                        <!-- Left Column -->
                        <div class="col-md-8">
                            <!-- Judul -->
                            <div class="mb-3">
                                <label for="judul" class="form-label">Judul <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control form-control-lg" 
                                       id="judul" 
                                       name="judul" 
                                       value="<?= old('judul', $konten->judul) ?>"
                                       placeholder="Masukkan judul konten"
                                       required>
                            </div>

                            <!-- Konten -->
                            <div class="mb-3">
                                <label for="konten" class="form-label">Konten <span class="text-danger">*</span></label>
                                <textarea id="konten" name="konten" class="form-control"><?= old('konten', $konten->konten) ?></textarea>
                            </div>

                            <!-- Excerpt -->
                            <div class="mb-3">
                                <label for="excerpt" class="form-label">Ringkasan/Excerpt</label>
                                <textarea class="form-control" 
                                          id="excerpt" 
                                          name="excerpt" 
                                          rows="3"
                                          placeholder="Ringkasan singkat untuk preview (opsional)"><?= old('excerpt', $konten->excerpt) ?></textarea>
                                <small class="text-muted">Maksimal 200 karakter</small>
                            </div>

                            <!-- Tags -->
                            <div class="mb-3">
                                <label for="tags" class="form-label">Tags</label>
                                <input type="text" 
                                       class="form-control" 
                                       id="tags" 
                                       name="tags" 
                                       value="<?= old('tags', $konten->tags) ?>"
                                       placeholder="promo, gangguan, berita (pisahkan dengan koma)">
                                <small class="text-muted">Pisahkan dengan koma untuk multiple tags</small>
                            </div>

                            <!-- Galeri Images (Multiple) -->
                            <div class="mb-3">
                                <label for="galeri_images" class="form-label">Galeri Gambar (Multiple)</label>
                                <input type="file" 
                                       class="form-control" 
                                       id="galeri_images" 
                                       name="galeri_images[]" 
                                       accept="image/*"
                                       multiple
                                       onchange="previewMultipleImages(event)">
                                <small class="text-muted">Pilih beberapa gambar sekaligus (maks 2MB per file)</small>
                                
                                <div id="galeri-preview" class="galeri-preview mt-3">
                                    <?php if (!empty($galeriImages)): ?>
                                        <?php foreach ($galeriImages as $image): ?>
                                            <div class="galeri-item" id="galeri-item-<?= $image->id ?>">
                                                <img src="<?= base_url('uploads/publikasi/galeri/' . $image->image_path) ?>" alt="Galeri">
                                                <button type="button" class="remove-image" onclick="deleteGaleriImage(<?= $image->id ?>)">
                                                    <i class="bi bi-x"></i>
                                                </button>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="col-md-4">
                            <!-- Status -->
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h6 class="card-title">Publikasi</h6>
                                    <div class="mb-3">
                                        <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                        <select class="form-select" id="status" name="status" required>
                                            <option value="draft" <?= old('status', $konten->status) == 'draft' ? 'selected' : '' ?>>Draft</option>
                                            <option value="published" <?= old('status', $konten->status) == 'published' ? 'selected' : '' ?>>Published</option>
                                            <option value="archived" <?= old('status', $konten->status) == 'archived' ? 'selected' : '' ?>>Archived</option>
                                        </select>
                                    </div>

                                    <!-- Featured -->
                                    <div class="form-check form-switch mb-3">
                                        <input class="form-check-input" 
                                               type="checkbox" 
                                               id="is_featured" 
                                               name="is_featured" 
                                               value="1"
                                               <?= old('is_featured', $konten->is_featured) == '1' ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="is_featured">
                                            Konten Unggulan
                                        </label>
                                    </div>

                                    <div class="d-grid gap-2">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-save me-2"></i>Update Konten
                                        </button>
                                        <a href="<?= route_to('artikel.index') ?>" class="btn btn-secondary">
                                            <i class="bi bi-x-circle me-2"></i>Batal
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Kategori -->
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h6 class="card-title">Kategori</h6>
                                    <select class="form-select" id="kategori_id" name="kategori_id" required>
                                        <option value="">-- Pilih Kategori --</option>
                                        <?php foreach ($kategoris as $kategori): ?>
                                            <option value="<?= $kategori->id ?>" <?= old('kategori_id', $konten->kategori_id) == $kategori->id ? 'selected' : '' ?>>
                                                <?= esc($kategori->nama_kategori) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <!-- Thumbnail -->
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h6 class="card-title">Thumbnail</h6>
                                    <input type="file" 
                                           class="form-control" 
                                           id="thumbnail" 
                                           name="thumbnail" 
                                           accept="image/*"
                                           onchange="previewImage(event)">
                                    <small class="text-muted d-block mt-2">Ukuran ideal: 800x600px (maks 2MB)</small>
                                    
                                    <img id="thumbnail-preview" 
                                         class="image-preview" 
                                         src="<?= $konten->thumbnail ? base_url('uploads/publikasi/thumbnails/' . $konten->thumbnail) : '' ?>"
                                         style="<?= $konten->thumbnail ? 'display:block;' : 'display:none;' ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
// Initialize TinyMCE
tinymce.init({
    selector: '#konten',
    height: 500,
    menubar: true,
    plugins: [
        'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
        'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
        'insertdatetime', 'media', 'table', 'code', 'help', 'wordcount'
    ],
    toolbar: 'undo redo | blocks | bold italic forecolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | image link | code',
    content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',
    images_upload_url: '<?= route_to('artikel.upload_image') ?>',
    images_upload_handler: function (blobInfo, success, failure) {
        var xhr, formData;
        xhr = new XMLHttpRequest();
        xhr.withCredentials = false;
        xhr.open('POST', '<?= route_to('artikel.upload_image') ?>');
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        
        xhr.onload = function() {
            var json;
            if (xhr.status != 200) {
                failure('HTTP Error: ' + xhr.status);
                return;
            }
            json = JSON.parse(xhr.responseText);
            if (!json || typeof json.location != 'string') {
                failure('Invalid JSON: ' + xhr.responseText);
                return;
            }
            success(json.location);
        };
        
        formData = new FormData();
        formData.append('file', blobInfo.blob(), blobInfo.filename());
        formData.append('<?= csrf_token() ?>', '<?= csrf_hash() ?>');
        
        xhr.send(formData);
    },
    automatic_uploads: true,
});

// Preview single thumbnail
function previewImage(event) {
    const preview = document.getElementById('thumbnail-preview');
    const file = event.target.files[0];
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        }
        reader.readAsDataURL(file);
    }
}

// Preview multiple galeri images
function previewMultipleImages(event) {
    // Append to existing preview instead of clearing
    const preview = document.getElementById('galeri-preview');
    const files = event.target.files;
    
    for (let i = 0; i < files.length; i++) {
        const file = files[i];
        const reader = new FileReader();
        
        reader.onload = function(e) {
            const div = document.createElement('div');
            div.className = 'galeri-item new-image'; // Add class to distinguish new uploads
            div.innerHTML = `
                <img src="${e.target.result}" alt="Preview">
                <button type="button" class="remove-image" onclick="removePreviewImage(this)">
                    <i class="bi bi-x"></i>
                </button>
            `;
            preview.appendChild(div);
        }
        
        reader.readAsDataURL(file);
    }
}

function removePreviewImage(btn) {
    // Only removes the preview element, real file removal handling for uploaded files needs ajax
    btn.parentElement.remove();
}

function deleteGaleriImage(id) {
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Gambar akan dihapus permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, hapus!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '<?= base_url('artikel/delete-galeri') ?>/' + id,
                type: 'POST',
                data: {
                    <?= csrf_token() ?>: '<?= csrf_hash() ?>'
                },
                success: function(response) {
                    if (response.success) {
                        $('#galeri-item-' + id).remove();
                        Swal.fire('Terhapus!', response.message, 'success');
                    } else {
                        Swal.fire('Gagal!', response.message, 'error');
                    }
                },
                error: function() {
                    Swal.fire('Error!', 'Terjadi kesalahan sistem', 'error');
                }
            });
        }
    })
}

// Form validation
document.getElementById('form-konten').addEventListener('submit', function(e) {
    const judul = document.getElementById('judul').value;
    const konten = tinymce.get('konten').getContent();
    const kategori = document.getElementById('kategori_id').value;
    
    if (!judul || !konten || !kategori) {
        e.preventDefault();
        Swal.fire({
            icon: 'error',
            title: 'Validasi Gagal',
            text: 'Mohon lengkapi semua field yang wajib diisi'
        });
        return false;
    }
});
</script>
<?= $this->endSection() ?>
