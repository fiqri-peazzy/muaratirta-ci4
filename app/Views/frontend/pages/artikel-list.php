<?= $this->extend('frontend/layouts/main') ?>

<?= $this->section('title') ?><?= esc($title) ?><?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Header -->
<div class="relative bg-gradient-to-br from-primary-900 to-primary-700 py-24 overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <svg class="w-full h-full" fill="none" viewBox="0 0 100 100" preserveAspectRatio="none">
            <path d="M0 100 L 100 0 L 100 100 Z" fill="currentColor"></path>
        </svg>
    </div>

    <div class="container mx-auto px-4 lg:px-8 relative z-10">
        <nav class="flex items-center space-x-2 text-primary-100/60 text-xs font-bold uppercase tracking-widest mb-6">
            <a href="<?= base_url() ?>" class="hover:text-white transition-colors">Beranda</a>
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
            <span class="text-white"><?= esc($title) ?></span>
        </nav>

        <h1 class="text-4xl md:text-6xl font-display font-black text-white leading-tight mb-4" data-aos="fade-up">
            <?= esc($title) ?>
        </h1>
        <p class="text-primary-100/70 max-w-2xl text-lg" data-aos="fade-up" data-aos-delay="100">
            Dapatkan informasi terbaru mengenai warta kegiatan, artikel edukasi, dan pemberitahuan penting dari PERUMDA Muara Tirta.
        </p>
    </div>
</div>

<div class="py-20 bg-gray-50">
    <div class="container mx-auto px-4 lg:px-8">
        <!-- Search & Filter Bar -->
        <div class="mb-16 bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex flex-col md:flex-row justify-between items-center gap-6" data-aos="fade-up">
            <form action="" method="GET" class="w-full md:w-96 relative">
                <input type="text" name="search" value="<?= esc($search ?? '') ?>" placeholder="Cari berita..." class="w-full pl-12 pr-4 py-3 bg-gray-50 rounded-2xl border-none focus:ring-2 focus:ring-primary-500 transition-all">
                <svg class="w-5 h-5 absolute left-4 top-1/2 -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </form>

            <div class="flex items-center space-x-2">
                <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Tampilkan:</span>
                <select class="bg-gray-50 border-none rounded-xl text-sm font-bold text-gray-700 py-2.5 px-4 focus:ring-2 focus:ring-primary-500">
                    <option>Terbaru</option>
                    <option>Terpopuler</option>
                    <option>Terlama</option>
                </select>
            </div>
        </div>

        <!-- Grid -->
        <?php if (!empty($kontens)): ?>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach ($kontens as $item): ?>
                    <article class="group bg-white rounded-[2rem] overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500" data-aos="fade-up">
                        <!-- Image Section -->
                        <div class="relative h-64 overflow-hidden">
                            <?php if ($item->thumbnail): ?>
                                <img src="<?= base_url('uploads/publikasi/thumbnails/' . $item->thumbnail) ?>" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                            <?php else: ?>
                                <div class="w-full h-full bg-primary-50 flex items-center justify-center text-primary-200">
                                    <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            <?php endif; ?>

                            <div class="absolute top-6 left-6">
                                <span class="bg-white/90 backdrop-blur-sm text-primary-600 text-[10px] font-black px-4 py-2 rounded-xl shadow-lg uppercase tracking-widest">
                                    <?= esc($item->nama_kategori) ?>
                                </span>
                            </div>
                        </div>

                        <!-- Content Section -->
                        <div class="p-8">
                            <div class="flex items-center space-x-3 mb-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest">
                                <span><?= date('d M Y', strtotime($item->published_at ?? $item->created_at)) ?></span>
                                <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                                <span><?= number_format($item->view_count) ?> Views</span>
                            </div>

                            <h3 class="text-xl font-display font-bold text-gray-900 mb-4 group-hover:text-primary-600 transition-colors line-clamp-2 min-h-[3.5rem] leading-tight text-balance">
                                <?= esc($item->judul) ?>
                            </h3>
                            <p class="text-gray-500 text-sm mb-8 line-clamp-2">
                                <?= $item->excerpt ?: strip_tags(substr($item->konten, 0, 150)) . '...' ?>
                            </p>

                            <a href="<?= base_url('berita/' . $item->slug) ?>" class="inline-flex items-center space-x-2 text-primary-600 font-black text-xs uppercase tracking-widest group/link">
                                <span>Baca Selengkapnya</span>
                                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>

            <!-- Pagination -->
            <div class="mt-20">
                <?= $pager->links('berita', 'frontend_pager') ?>
            </div>
        <?php else: ?>
            <div class="bg-white p-20 rounded-[3rem] text-center shadow-sm" data-aos="fade-up">
                <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-8">
                    <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l4 4v10a2 2 0 01-2 2zM14 4v4h4" />
                    </svg>
                </div>
                <h3 class="text-2xl font-display font-bold text-gray-900 mb-2">Belum Ada Konten</h3>
                <p class="text-gray-500">Maaf, saat ini belum ada konten yang dipublikasikan untuk kategori ini.</p>
            </div>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 800,
        once: true
    });
</script>
<?= $this->endSection() ?>