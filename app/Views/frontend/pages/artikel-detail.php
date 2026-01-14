<?= $this->extend('frontend/layouts/main') ?>

<?= $this->section('title') ?><?= esc($konten->judul) ?><?= $this->endSection() ?>

<?= $this->section('styles') ?>
<style>
    .prose img {
        border-radius: 1rem;
        margin: 2rem 0;
    }

    .prose p {
        margin-bottom: 1.5rem;
        line-height: 1.8;
        color: #4b5563;
    }

    .prose h2,
    .prose h3 {
        margin-top: 2.5rem;
        margin-bottom: 1.25rem;
        font-weight: 700;
        color: #111827;
    }

    .galeri-grid img {
        transition: all 0.5s ease;
    }

    .galeri-grid img:hover {
        transform: scale(1.05);
    }
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Breadcrumb & Header -->
<div class="relative bg-gradient-to-br from-primary-900 to-primary-700 py-24 overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <svg class="w-full h-full" fill="none" viewBox="0 0 100 100" preserveAspectRatio="none">
            <path d="M0 100 C 20 0 50 0 100 100 Z" fill="currentColor"></path>
        </svg>
    </div>

    <div class="container mx-auto px-4 lg:px-8 relative z-10">
        <nav class="flex items-center space-x-2 text-primary-100/60 text-xs font-bold uppercase tracking-widest mb-6">
            <a href="<?= base_url() ?>" class="hover:text-white transition-colors">Beranda</a>
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
            <a href="<?= base_url('berita') ?>" class="hover:text-white transition-colors">Berita</a>
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
            <span class="text-white truncate max-w-[200px]"><?= esc($konten->nama_kategori) ?></span>
        </nav>

        <h1 class="text-2xl md:text-3xl lg:text-4xl font-display font-black text-white leading-tight mb-8 max-w-4xl" data-aos="fade-up">
            <?= esc($konten->judul) ?>
        </h1>

        <div class="flex flex-wrap items-center gap-6" data-aos="fade-up" data-aos-delay="100">
            <div class="flex items-center space-x-3">
                <div class="w-12 h-12 rounded-full border-2 border-white/20 p-0.5">
                    <?php if ($konten->profile_pict): ?>
                        <img src="<?= base_url('uploads/profile/' . $konten->profile_pict) ?>" class="w-full h-full rounded-full object-cover">
                    <?php else: ?>
                        <div class="w-full h-full rounded-full bg-primary-500 flex items-center justify-center text-white font-bold">
                            <?= substr($konten->author_name, 0, 1) ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div>
                    <p class="text-[10px] text-white/50 uppercase font-black tracking-widest">Penulis</p>
                    <p class="text-sm font-bold text-white"><?= esc($konten->author_name) ?></p>
                </div>
            </div>

            <div class="h-8 w-px bg-white/10 hidden md:block"></div>

            <div>
                <p class="text-[10px] text-white/50 uppercase font-black tracking-widest">Diterbitkan</p>
                <p class="text-sm font-bold text-white"><?= date('d F Y', strtotime($konten->published_at ?? $konten->created_at)) ?></p>
            </div>

            <div class="h-8 w-px bg-white/10 hidden md:block"></div>

            <div>
                <p class="text-[10px] text-white/50 uppercase font-black tracking-widest">Dilihat</p>
                <p class="text-sm font-bold text-white"><?= number_format($konten->view_count) ?> Kali</p>
            </div>
        </div>
    </div>
</div>

<div class="py-16 md:py-24 bg-white">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="grid lg:grid-cols-12 gap-16">
            <!-- Main Content -->
            <div class="lg:col-span-8">
                <!-- Main image -->
                <?php if ($konten->thumbnail): ?>
                    <div class="relative rounded-[2rem] overflow-hidden shadow-2xl mb-12" data-aos="zoom-in">
                        <img src="<?= base_url('uploads/publikasi/thumbnails/' . $konten->thumbnail) ?>" alt="<?= esc($konten->judul) ?>" class="w-full h-auto">
                    </div>
                <?php endif; ?>

                <!-- Article body -->
                <div class="prose max-w-none text-gray-700" data-aos="fade-up">
                    <?= $konten->konten ?>
                </div>

                <!-- Gallery Section if exists -->
                <?php if (!empty($galeri)): ?>
                    <div class="mt-20 border-t border-gray-100 pt-16">
                        <h2 class="text-2xl font-display font-bold text-gray-900 mb-8 flex items-center">
                            <span class="w-8 h-8 rounded-lg bg-primary-100 text-primary-600 flex items-center justify-center mr-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </span>
                            Galeri Foto
                        </h2>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4 galeri-grid">
                            <?php foreach ($galeri as $img): ?>
                                <div class="relative aspect-square rounded-2xl overflow-hidden group cursor-pointer shadow-sm hover:shadow-xl transition-all">
                                    <img src="<?= base_url('uploads/publikasi/galeri/' . $img->image_path) ?>" class="w-full h-full object-cover">
                                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                        </svg>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Tags and Share -->
                <div class="mt-16 pt-8 border-t border-gray-100 flex flex-col md:flex-row justify-between items-center gap-6">
                    <div class="flex flex-wrap gap-2">
                        <?php
                        $tags = array_filter(explode(',', $konten->tags ?? ''));
                        foreach ($tags as $tag):
                        ?>
                            <span class="px-3 py-1 bg-gray-50 text-gray-600 text-[10px] font-bold uppercase tracking-wider rounded-lg border border-gray-100">
                                #<?= trim($tag) ?>
                            </span>
                        <?php endforeach; ?>
                    </div>

                    <div class="flex items-center space-x-4">
                        <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Bagikan:</span>
                        <div class="flex space-x-2">
                            <a href="#" class="w-9 h-9 rounded-full bg-blue-600 text-white flex items-center justify-center hover:scale-110 transition-transform">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                                </svg>
                            </a>
                            <a href="#" class="w-9 h-9 rounded-full bg-green-500 text-white flex items-center justify-center hover:scale-110 transition-transform">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.414 0 .004 5.412.001 12.049a11.823 11.823 0 001.574 5.939L0 24l6.105-1.595a11.81 11.81 0 005.936 1.579h.005c6.637 0 12.05-5.414 12.052-12.052a11.829 11.829 0 00-3.41-8.528z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-4">
                <div class="sticky top-24 space-y-12">
                    <!-- Search Widget -->
                    <div class="bg-gray-50 p-8 rounded-[2rem] border border-gray-100">
                        <h3 class="text-lg font-display font-bold text-gray-900 mb-6">Cari Sesuatu?</h3>
                        <form action="<?= base_url('berita') ?>" method="GET" class="relative">
                            <input type="text" name="search" placeholder="Masukkan kata kunci..." class="w-full pl-12 pr-4 py-4 bg-white rounded-2xl border-none focus:ring-2 focus:ring-primary-500 shadow-sm transition-all text-sm">
                            <svg class="w-5 h-5 absolute left-4 top-1/2 -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </form>
                    </div>

                    <!-- Latest News Widget -->
                    <div>
                        <h3 class="text-xl font-display font-bold text-gray-900 mb-8 flex items-center">
                            <span class="w-2 h-8 bg-primary-600 rounded-full mr-4"></span>
                            Warna Terbaru
                        </h3>
                        <div class="space-y-8">
                            <?php foreach ($latest as $item): ?>
                                <a href="<?= base_url('berita/' . $item->slug) ?>" class="group flex gap-4">
                                    <div class="flex-shrink-0 w-24 h-24 rounded-2xl overflow-hidden shadow-sm">
                                        <?php if ($item->thumbnail): ?>
                                            <img src="<?= base_url('uploads/publikasi/thumbnails/' . $item->thumbnail) ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                        <?php else: ?>
                                            <div class="w-full h-full bg-primary-50 flex items-center justify-center text-primary-200">
                                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="flex flex-col justify-center">
                                        <p class="text-[9px] text-primary-600 font-black uppercase tracking-widest mb-1"><?= esc($item->nama_kategori) ?></p>
                                        <h4 class="text-sm font-bold text-gray-900 group-hover:text-primary-600 transition-colors line-clamp-2 leading-snug">
                                            <?= esc($item->judul) ?>
                                        </h4>
                                        <p class="text-[10px] text-gray-400 font-medium mt-1 uppercase"><?= date('d M Y', strtotime($item->published_at ?? $item->created_at)) ?></p>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- CTA Widget -->
                    <div class="bg-gradient-to-br from-gray-900 to-gray-800 p-8 rounded-[2rem] text-white overflow-hidden relative group">
                        <div class="absolute top-0 right-0 -translate-y-1/2 translate-x-1/2 w-48 h-48 bg-white/5 rounded-full blur-3xl group-hover:bg-white/10 transition-colors"></div>
                        <h3 class="text-xl font-display font-bold mb-4 relative z-10">Lapor Gangguan?</h3>
                        <p class="text-gray-400 text-sm mb-8 relative z-10">Punya kendala dengan distribusi air? Hubungi kami segera melalu form aduan online.</p>
                        <a href="<?= base_url('lapor-keluhan') ?>" class="inline-flex items-center space-x-2 px-6 py-3 bg-white text-gray-900 rounded-xl font-bold text-xs hover:bg-primary-50 transition-colors relative z-10">
                            <span>Buat Laporan</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
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