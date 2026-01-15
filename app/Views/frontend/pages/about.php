<?= $this->extend('frontend/layouts/main') ?>

<?= $this->section('title') ?><?= $title ?><?= $this->endSection() ?>

<?= $this->section('styles') ?>
<style>
    /* Custom Timeline Styles */
    .timeline-container {
        position: relative;
        padding-left: 2rem;
    }

    .timeline-container::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 2px;
        background: linear-gradient(to bottom, #3b82f6 0%, #06b6d4 100%);
        border-radius: 1px;
    }

    .timeline-item {
        position: relative;
        padding-bottom: 3rem;
    }

    .timeline-dot {
        position: absolute;
        left: -2.4rem;
        top: 0.25rem;
        width: 1rem;
        height: 1rem;
        background-color: #3b82f6;
        border: 3px solid #fff;
        border-radius: 50%;
        box-shadow: 0 0 10px rgba(59, 130, 246, 0.5);
        z-index: 10;
    }

    .timeline-year {
        display: inline-block;
        padding: 0.25rem 1rem;
        background-color: #eff6ff;
        color: #1d4ed8;
        border-radius: 9999px;
        font-weight: 700;
        font-size: 0.875rem;
        margin-bottom: 0.75rem;
    }

    /* Card Glow Effect */
    .glow-card {
        transition: all 0.3s ease;
    }

    .glow-card:hover {
        box-shadow: 0 20px 40px rgba(59, 130, 246, 0.1);
        transform: translateY(-5px);
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- Breadcrumb Section -->
<section class="relative pt-32 pb-12 bg-gradient-to-r from-blue-900 via-blue-800 to-cyan-900 overflow-hidden">
    <div class="absolute inset-0 opacity-20">
        <svg class="absolute bottom-0 w-full h-32" viewBox="0 0 1440 320" xmlns="http://www.w3.org/2000/svg">
            <path fill="#ffffff" fill-opacity="0.2" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,112C672,96,768,96,864,112C960,128,1056,160,1152,160C1248,160,1344,128,1392,112L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
        </svg>
    </div>
    <div class="container mx-auto px-4 lg:px-8 relative z-10">
        <h1 class="text-4xl lg:text-5xl font-display font-bold text-white mb-4 text-center lg:text-left"><?= $title ?></h1>
        <nav class="flex items-center justify-center lg:justify-start space-x-2 text-sm">
            <a href="<?= base_url('/') ?>" class="text-white/80 hover:text-white transition-colors">Beranda</a>
            <svg class="w-4 h-4 text-white/60" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
            </svg>
            <span class="text-white font-medium"><?= $title ?></span>
        </nav>
    </div>
</section>

<!-- Main Intro Section -->
<section class="py-20 bg-white overflow-hidden">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <!-- Left Side -->
            <div data-aos="fade-right">
                <div class="inline-flex items-center space-x-2 px-4 py-2 bg-blue-50 text-blue-600 rounded-full text-sm font-semibold mb-6">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <span>Siap Melayani</span>
                </div>

                <h2 class="text-4xl lg:text-5xl font-display font-bold text-gray-900 mb-6 leading-tight">
                    Menyediakan Air Bersih Untuk <span class="bg-gradient-to-r from-blue-600 to-cyan-500 bg-clip-text text-transparent">Masyarakat Gorontalo</span>
                </h2>

                <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                    PERUMDA Air Minum Muara Tirta Kota Gorontalo adalah pilar utama penyedia air bersih di Kota Gorontalo.
                    Kami berkomitmen penuh untuk meningkatkan taraf hidup masyarakat melalui ketersediaan air minum yang memenuhi standar K4.
                </p>

                <div class="grid sm:grid-cols-2 gap-6 mb-8">
                    <div class="flex items-center space-x-4 p-4 rounded-2xl bg-gray-50 border border-gray-100 transition-hover duration-300 hover:bg-blue-50 hover:border-blue-100">
                        <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h5 class="font-bold text-gray-900">Kualitas Terjamin</h5>
                    </div>

                    <div class="flex items-center space-x-4 p-4 rounded-2xl bg-gray-50 border border-gray-100 transition-hover duration-300 hover:bg-cyan-50 hover:border-cyan-100">
                        <div class="w-12 h-12 bg-cyan-500 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <h5 class="font-bold text-gray-900">Distribusi Kontinu</h5>
                    </div>
                </div>
            </div>

            <!-- Right Side (Lottie Illustration) -->
            <div class="relative" data-aos="fade-left">
                <div class="relative bg-gradient-to-br from-blue-50 to-cyan-50 rounded-[3rem] p-8 lg:p-12">
                    <script src="https://unpkg.com/@lottiefiles/dotlottie-wc@0.8.5/dist/dotlottie-wc.js" type="module"></script>
                    <dotlottie-wc
                        src="https://lottie.host/37db8280-9322-46aa-bc59-35ea54e21ca0/OyrSOjvXRC.lottie"
                        background="transparent" speed="1" style="width: 100%; height: 100%;" autoplay loop>
                    </dotlottie-wc>
                </div>
                <!-- Decoration -->
                <div class="absolute -top-6 -right-6 w-24 h-24 bg-blue-600/10 rounded-full blur-2xl"></div>
                <div class="absolute -bottom-6 -left-6 w-32 h-32 bg-cyan-600/10 rounded-full blur-2xl"></div>
            </div>
        </div>
    </div>
</section>

<!-- Transformation Section -->
<section class="py-12 bg-white">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="relative overflow-hidden bg-gradient-to-br from-blue-600 to-indigo-700 rounded-[2.5rem] p-8 lg:p-16 shadow-2xl shadow-blue-900/20" data-aos="fade-up">
            <!-- Background Shape -->
            <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 bg-white/10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 bg-cyan-400/20 rounded-full blur-3xl"></div>

            <div class="relative grid lg:grid-cols-12 gap-12 items-center">
                <div class="lg:col-span-8">
                    <div class="inline-block px-4 py-2 bg-white/20 backdrop-blur-md rounded-lg text-white text-sm font-semibold mb-6">
                        Era Baru Pelayanan
                    </div>
                    <h3 class="text-3xl lg:text-4xl font-display font-bold text-white mb-6">Transformasi Menjadi PERUMDA</h3>
                    <p class="text-lg text-blue-50 leading-relaxed opacity-90">
                        Dalam upaya meningkatkan profesionalitas dan kualitas pelayanan, institusi kami telah bertransformasi dari
                        <strong class="text-white">PDAM (Perusahaan Daerah Air Minum)</strong> menjadi <strong class="text-white">PERUMDA (Perusahaan Umum Daerah) Air Minum Muara Tirta</strong>.
                        Transformasi ini bukan sekadar pergantian nama, melainkan komitmen manajemen baru untuk tata kelola yang lebih modern, transparan, dan berorientasi pada kepuasan pelanggan.
                    </p>
                </div>
                <div class="lg:col-span-4 hidden lg:flex justify-center">
                    <div class="relative flex items-center justify-center">
                        <div class="absolute inset-0 bg-white/20 rounded-full animate-ping scale-150 opacity-20"></div>
                        <div class="w-48 h-48 bg-white/10 backdrop-blur-md rounded-full flex items-center justify-center border border-white/30">
                            <svg class="w-24 h-24 text-white opacity-40" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm0 10.99h7c-.53 4.12-3.28 7.79-7 8.94V12H5V6.3l7-3.11v8.8z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- History Timeline Section -->
<section class="py-24 bg-gray-50 overflow-hidden">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="max-w-4xl mx-auto text-center mb-16" data-aos="fade-up">
            <h2 class="text-3xl lg:text-4xl font-display font-bold text-gray-900 mb-4">Rekam Jejak & Sejarah</h2>
            <p class="text-lg text-gray-600">Perjalanan kami dalam melayani Kota Gorontalo dari masa ke masa</p>
        </div>

        <div class="max-w-3xl mx-auto">
            <div class="timeline-container">
                <!-- Item 1 -->
                <div class="timeline-item" data-aos="fade-up">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300">
                        <span class="timeline-year">1981</span>
                        <h4 class="text-xl font-bold text-gray-900 mb-3">Berdirinya BPAM Kotamadya Gorontalo</h4>
                        <p class="text-gray-600 leading-relaxed">Pembentukan Badan Pengelola Air Minum (BPAM) Kotamadya Dati II Gorontalo berdasarkan Surat Keputusan Dirjen Cipta Karya Departemen PU Nomor 125/KPTS/CK/1981. Ditandai dengan berfungsinya sistem penyediaan air bersih oleh PPSAB Sulawesi Utara.</p>
                    </div>
                </div>

                <!-- Item 2 -->
                <div class="timeline-item" data-aos="fade-up">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300">
                        <span class="timeline-year">1986</span>
                        <h4 class="text-xl font-bold text-gray-900 mb-3">Pembangunan IPA Tanggilingo</h4>
                        <p class="text-gray-600 leading-relaxed">Pembangunan Instalasi Pengolahan Air (IPA) dengan kapasitas besar 218 L/dt. Langkah awal dalam modernisasi infrastruktur pengolahan air untuk memenuhi kebutuhan yang terus meningkat di wilayah Gorontalo.</p>
                    </div>
                </div>

                <!-- Item 3 -->
                <div class="timeline-item" data-aos="fade-up">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300">
                        <span class="timeline-year">1991</span>
                        <h4 class="text-xl font-bold text-gray-900 mb-3">Alih Status Menjadi PDAM</h4>
                        <p class="text-gray-600 leading-relaxed">Secara resmi beralih status melalui SK Menteri PU Nomor 705/KPTS/1991. Penyerahan Prasarana dan Sarana Air Bersih kepada Gubernur Kepada Daerah Tk I Sulawesi Utara diperkuat dengan BAST No. 01/BA/CK/1991.</p>
                    </div>
                </div>

                <!-- Item 4 -->
                <div class="timeline-item" data-aos="fade-up">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300">
                        <span class="timeline-year">1997 - 2018</span>
                        <h4 class="text-xl font-bold text-gray-900 mb-3">Ekspansi Kapasitas & Jangkauan</h4>
                        <p class="text-gray-600 leading-relaxed mb-4">Masa pertumbuhan signifikan dengan pembangunan dan peningkatan kapasitas berbagai IPA:</p>
                        <ul class="space-y-3">
                            <li class="flex items-start space-x-3 text-sm text-gray-600">
                                <svg class="w-5 h-5 text-blue-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <span><strong>IPA Bulotadaa:</strong> Berkembang dari 20 L/dt (1997) menjadi 50 L/dt (2017).</span>
                            </li>
                            <li class="flex items-start space-x-3 text-sm text-gray-600">
                                <svg class="w-5 h-5 text-blue-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <span><strong>IPA Pilolodaa:</strong> Mulai beroperasi tahun 2009 dengan 10 L/dt.</span>
                            </li>
                            <li class="flex items-start space-x-3 text-sm text-gray-600">
                                <svg class="w-5 h-5 text-blue-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <span><strong>IPA Dungingi:</strong> Beroperasi tahun 2016 dengan 20 L/dt.</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Service Standards (K4) -->
<section class="py-24 bg-white">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-3xl lg:text-4xl font-display font-bold text-gray-900 mb-4">Standar Pelayanan K4</h2>
            <p class="text-lg text-gray-600">Empat pilar utama yang mendasari setiap tetes air yang kami alirkan</p>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Card 1 -->
            <div class="glow-card group p-8 rounded-3xl bg-white border border-gray-100 shadow-sm" data-aos="zoom-in" data-aos-delay="100">
                <div class="w-16 h-16 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600 mb-6 transition-colors duration-300 group-hover:bg-blue-600 group-hover:text-white">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <h4 class="text-xl font-bold text-gray-900 mb-2">Kualitas</h4>
                <p class="text-gray-500 leading-relaxed">Air bersih yang aman dan memenuhi standar kesehatan nasional.</p>
            </div>

            <!-- Card 2 -->
            <div class="glow-card group p-8 rounded-3xl bg-white border border-gray-100 shadow-sm" data-aos="zoom-in" data-aos-delay="200">
                <div class="w-16 h-16 bg-cyan-50 rounded-2xl flex items-center justify-center text-cyan-600 mb-6 transition-colors duration-300 group-hover:bg-cyan-500 group-hover:text-white">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                </div>
                <h4 class="text-xl font-bold text-gray-900 mb-2">Kuantitas</h4>
                <p class="text-gray-500 leading-relaxed">Ketersediaan volume air yang cukup untuk kebutuhan sehari-hari.</p>
            </div>

            <!-- Card 3 -->
            <div class="glow-card group p-8 rounded-3xl bg-white border border-gray-100 shadow-sm" data-aos="zoom-in" data-aos-delay="300">
                <div class="w-16 h-16 bg-indigo-50 rounded-2xl flex items-center justify-center text-indigo-600 mb-6 transition-colors duration-300 group-hover:bg-indigo-600 group-hover:text-white">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h4 class="text-xl font-bold text-gray-900 mb-2">Kontinuitas</h4>
                <p class="text-gray-500 leading-relaxed">Aliran air yang terus menerus selama 24 jam setiap harinya.</p>
            </div>

            <!-- Card 4 -->
            <div class="glow-card group p-8 rounded-3xl bg-white border border-gray-100 shadow-sm" data-aos="zoom-in" data-aos-delay="400">
                <div class="w-16 h-16 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-600 mb-6 transition-colors duration-300 group-hover:bg-emerald-500 group-hover:text-white">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                    </svg>
                </div>
                <h4 class="text-xl font-bold text-gray-900 mb-2">Keterjangkauan</h4>
                <p class="text-gray-500 leading-relaxed">Tarif yang adil dan dapat dijangkau oleh seluruh lapisan masyarakat.</p>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<!-- AOS Animation -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 1000,
        once: true,
        offset: 100
    });
</script>
<?= $this->endSection() ?>