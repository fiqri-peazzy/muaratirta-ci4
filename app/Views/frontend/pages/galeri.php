<?= $this->extend('frontend/layouts/main') ?>

<?= $this->section('title') ?><?= esc($title) ?><?= $this->endSection() ?>

<?= $this->section('styles') ?>
<style>
    .album-card {
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .album-card:hover {
        transform: translateY(-5px);
    }

    .img-stack {
        position: relative;
    }

    .img-stack::before,
    .img-stack::after {
        content: '';
        position: absolute;
        inset: 0;
        background: #f3f4f6;
        border: 1px solid #e5e7eb;
        border-radius: 1.5rem;
        z-index: -1;
        transition: transform 0.3s ease;
    }

    .img-stack::before {
        transform: translate(8px, 8px) rotate(2deg);
    }

    .img-stack::after {
        transform: translate(16px, 16px) rotate(4deg);
        z-index: -2;
    }

    .album-card:hover .img-stack::before {
        transform: translate(12px, 12px) rotate(3deg);
    }

    .album-card:hover .img-stack::after {
        transform: translate(24px, 24px) rotate(6deg);
    }

    .glightbox-desc {
        display: none;
    }
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Header -->
<div class="relative bg-gradient-to-br from-blue-900 via-blue-800 to-indigo-950 py-24 overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <svg class="w-full h-full" fill="none" viewBox="0 0 100 100" preserveAspectRatio="none">
            <path d="M0 100 L 100 0 L 100 100 Z" fill="currentColor"></path>
        </svg>
    </div>

    <div class="container mx-auto px-4 lg:px-8 relative z-10 text-center lg:text-left">
        <nav class="flex items-center justify-center lg:justify-start space-x-2 text-blue-100/60 text-xs font-bold uppercase tracking-widest mb-6">
            <a href="<?= base_url() ?>" class="hover:text-white transition-colors">Beranda</a>
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
            <span class="text-white">Galeri</span>
        </nav>

        <h1 class="text-4xl md:text-6xl font-display font-black text-white leading-tight mb-4" data-aos="fade-up">
            <?= esc($title) ?>
        </h1>
        <p class="text-blue-100/70 max-w-2xl text-lg mx-auto lg:mx-0" data-aos="fade-up" data-aos-delay="100">
            Jelajahi album dokumentasi kegiatan dan infrastruktur kami yang dikelompokkan berdasarkan momen spesial perusahaan.
        </p>
    </div>
</div>

<div class="py-24 bg-gray-50">
    <div class="container mx-auto px-4 lg:px-8">

        <?php if (!empty($kontens)): ?>
            <div class="grid lg:grid-cols-2 gap-12">
                <?php foreach ($kontens as $index => $item): ?>
                    <div class="album-card bg-white rounded-[3rem] p-8 shadow-sm border border-gray-100 flex flex-col md:flex-row gap-8" data-aos="fade-up" data-aos-delay="<?= $index * 50 ?>">
                        <!-- Left: Visual Stack -->
                        <div class="md:w-2/5">
                            <div class="img-stack aspect-square rounded-[2rem] overflow-hidden shadow-xl">
                                <?php if ($item->thumbnail): ?>
                                    <img src="<?= base_url('uploads/publikasi/thumbnails/' . $item->thumbnail) ?>" class="w-full h-full object-cover">
                                <?php elseif (!empty($item->images)): ?>
                                    <img src="<?= base_url('uploads/publikasi/galeri/' . $item->images[0]->image_path) ?>" class="w-full h-full object-cover">
                                <?php else: ?>
                                    <div class="w-full h-full bg-blue-50 flex items-center justify-center">
                                        <svg class="w-12 h-12 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Right: Info & Thumbs -->
                        <div class="md:w-3/5 flex flex-col justify-between py-2">
                            <div>
                                <div class="flex items-center space-x-3 mb-4">
                                    <span class="px-3 py-1 bg-primary-50 text-primary-600 text-[10px] font-black rounded-lg uppercase tracking-widest border border-primary-100">
                                        <?= esc($item->nama_kategori) ?>
                                    </span>
                                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">
                                        <?= date('d M Y', strtotime($item->published_at ?? $item->created_at)) ?>
                                    </span>
                                </div>
                                <h3 class="text-2xl font-display font-bold text-gray-900 mb-2 leading-tight">
                                    <?= esc($item->judul) ?>
                                </h3>
                                <p class="text-sm text-gray-500 line-clamp-2 mb-6">
                                    <?= $item->excerpt ?: strip_tags(substr($item->konten, 0, 100)) . '...' ?>
                                </p>

                                <!-- Photos Preview -->
                                <?php if (!empty($item->images)): ?>
                                    <div class="flex flex-wrap gap-2 mb-8">
                                        <?php foreach (array_slice($item->images, 0, 4) as $imgIdx => $img): ?>
                                            <a href="<?= base_url('uploads/publikasi/galeri/' . $img->image_path) ?>"
                                                class="glightbox_<?= $item->id ?> w-12 h-12 rounded-xl overflow-hidden border-2 border-white shadow-sm hover:scale-110 transition-transform"
                                                data-gallery="gallery_<?= $item->id ?>"
                                                data-glightbox="title: <?= esc($item->judul) ?>; description: <?= esc($img->caption ?: 'Dokumentasi ' . $item->judul) ?>">
                                                <img src="<?= base_url('uploads/publikasi/galeri/' . $img->image_path) ?>" class="w-full h-full object-cover">
                                            </a>
                                        <?php endforeach; ?>
                                        <?php if (count($item->images) > 4): ?>
                                            <div class="w-12 h-12 flex items-center justify-center bg-gray-100 text-gray-500 text-xs font-bold rounded-xl border-2 border-white shadow-sm">
                                                +<?= count($item->images) - 4 ?>
                                            </div>
                                        <?php endif; ?>

                                        <!-- Hidden remaining images for GLightbox -->
                                        <?php foreach (array_slice($item->images, 4) as $img): ?>
                                            <a href="<?= base_url('uploads/publikasi/galeri/' . $img->image_path) ?>"
                                                class="glightbox_<?= $item->id ?> hidden"
                                                data-gallery="gallery_<?= $item->id ?>"
                                                data-glightbox="title: <?= esc($item->judul) ?>; description: <?= esc($img->caption ?: 'Dokumentasi ' . $item->judul) ?>">
                                            </a>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="flex items-center justify-between mt-auto">
                                <button onclick="openGallery('<?= $item->id ?>')"
                                    class="inline-flex items-center space-x-2 bg-gray-900 text-white px-6 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-primary-600 transition-colors group">
                                    <span>Buka Album</span>
                                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                    </svg>
                                </button>
                                <a href="<?= route_to('news.detail', $item->slug) ?>" class="text-[10px] font-black text-gray-400 uppercase tracking-widest hover:text-primary-600 transition-colors">
                                    Baca Berita
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Pagination -->
            <div class="mt-20">
                <?= $pager->links('gallery', 'frontend_pager') ?>
            </div>

        <?php else: ?>
            <div class="bg-white p-20 rounded-[4rem] text-center shadow-sm border border-gray-100" data-aos="fade-up">
                <div class="w-24 h-24 bg-blue-50 rounded-full flex items-center justify-center mx-auto mb-8">
                    <svg class="w-12 h-12 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <h3 class="text-3xl font-display font-bold text-gray-900 mb-4">Galeri Dokumentasi Kosong</h3>
                <p class="text-gray-500 max-w-md mx-auto">Kami belum mempublikasikan album dokumentasi terbaru. Silakan kembali lagi nanti untuk melihat momen spesial kami.</p>
            </div>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://cdn.jsdelivr.net/gh/mcstudios/glightbox/dist/js/glightbox.min.js"></script>
<script>
    AOS.init({
        duration: 1000,
        once: true
    });

    // Initialize all galleries
    document.querySelectorAll('[class^="glightbox_"]').forEach(el => {
        const id = el.className.split(' ')[0];
        GLightbox({
            selector: '.' + id
        });
    });

    function openGallery(id) {
        const firstImg = document.querySelector('.glightbox_' + id);
        if (firstImg) firstImg.click();
    }
</script>
<?= $this->endSection() ?>