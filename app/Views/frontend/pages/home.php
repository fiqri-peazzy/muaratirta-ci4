<?= $this->extend('frontend/layouts/main') ?>

<?= $this->section('title') ?>Beranda<?= $this->endSection() ?>

<?= $this->section('description') ?>
PERUMDA Air Minum Muara Tirta Kota Gorontalo - Menyediakan Air Bersih Berkualitas Untuk Kehidupan yang Lebih Baik
<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<style>
    /* Hero Animation */
    @keyframes float {

        0%,
        100% {
            transform: translateY(0px);
        }

        50% {
            transform: translateY(-20px);
        }
    }

    @keyframes pulse-ring {
        0% {
            transform: scale(0.95);
            opacity: 1;
        }

        50% {
            transform: scale(1);
            opacity: 0.7;
        }

        100% {
            transform: scale(0.95);
            opacity: 1;
        }
    }

    .animate-float {
        animation: float 3s ease-in-out infinite;
    }

    .animate-pulse-ring {
        animation: pulse-ring 2s ease-in-out infinite;
    }

    /* Gradient Text */
    .gradient-text {
        background: linear-gradient(135deg, #3b82f6 0%, #06b6d4 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    /* Glass Effect */
    .glass-effect {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- Hero Section - UNIQUE DESIGN -->
<section class="relative min-h-screen flex items-center overflow-hidden bg-gradient-to-br from-blue-900 via-blue-800 to-cyan-900">
    <!-- Animated Background Elements -->
    <div class="absolute inset-0 overflow-hidden">
        <!-- Water Droplets Animation -->
        <div class="absolute top-20 left-10 w-64 h-64 bg-blue-400/20 rounded-full blur-3xl animate-pulse-ring"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-cyan-400/20 rounded-full blur-3xl animate-pulse-ring" style="animation-delay: 1s;"></div>
        <div class="absolute top-1/2 left-1/3 w-72 h-72 bg-blue-300/10 rounded-full blur-3xl animate-pulse-ring" style="animation-delay: 2s;"></div>

        <!-- Wave Pattern Overlay -->
        <!-- <svg class="absolute bottom-0 w-full h-64 opacity-20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#ffffff" fill-opacity="1" d="M0,96L48,112C96,128,192,160,288,186.7C384,213,480,235,576,213.3C672,192,768,128,864,128C960,128,1056,192,1152,197.3C1248,203,1344,149,1392,122.7L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
        </svg> -->
        <!-- add some  -->
        <svg class="absolute bottom-0 opacity-20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#0099ff" fill-opacity="1" d="M0,64L48,69.3C96,75,192,85,288,74.7C384,64,480,32,576,58.7C672,85,768,171,864,186.7C960,203,1056,149,1152,128C1248,107,1344,117,1392,122.7L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
        </svg>
    </div>

    <div class="container mx-auto px-4 lg:px-8 relative z-10 pt-32 pb-20">
        <div class="grid lg:grid-cols-2 gap-12 items-center">

            <!-- Left Content -->
            <div class="text-white space-y-8" data-aos="fade-right">
                <!-- Badge -->
                <div class="inline-flex items-center space-x-2 px-4 py-2 rounded-full glass-effect">
                    <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                    <span class="text-sm font-medium">Melayani dengan Standar K4</span>
                </div>

                <!-- Main Heading -->
                <div>
                    <h1 class="text-5xl lg:text-6xl font-display font-bold leading-tight mb-4">
                        PERUMDA AIR MINUM
                        <span class="block gradient-text">MUARA TIRTA</span>
                        <span class="block text-3xl lg:text-4xl mt-2">KOTA GORONTALO</span>
                    </h1>
                    <p class="text-lg lg:text-xl text-blue-100 font-light max-w-2xl">
                        Menyediakan Air Bersih Berkualitas Untuk Kehidupan yang Lebih Baik, Meningkatkan Pelayanan Air Minum Dalam Memenuhi Standar K4
                    </p>
                </div>

                <!-- Feature Pills -->
                <div class="flex flex-wrap gap-3">
                    <div class="flex items-center space-x-2 px-4 py-2.5 bg-white/10 backdrop-blur rounded-full border border-white/20 hover:bg-white/20 transition-all duration-300">
                        <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="text-sm font-medium">Pelayanan Air Bersih</span>
                    </div>
                    <div class="flex items-center space-x-2 px-4 py-2.5 bg-white/10 backdrop-blur rounded-full border border-white/20 hover:bg-white/20 transition-all duration-300">
                        <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="text-sm font-medium">Kinerja PERUMDA</span>
                    </div>
                    <div class="flex items-center space-x-2 px-4 py-2.5 bg-white/10 backdrop-blur rounded-full border border-white/20 hover:bg-white/20 transition-all duration-300">
                        <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="text-sm font-medium">Standar K4</span>
                    </div>
                </div>

                <!-- CTA Button -->
                <div class="flex flex-wrap gap-4">
                    <a
                        href="<?= base_url('about') ?>"
                        class="inline-flex items-center px-8 py-4 bg-white text-blue-900 rounded-full font-semibold hover:bg-blue-50 transition-all duration-300 shadow-lg hover:shadow-xl hover:scale-105">
                        <span>Tentang Perusahaan</span>
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </a>
                    <a
                        href="<?= base_url('kontak') ?>"
                        class="inline-flex items-center px-8 py-4 border-2 border-white text-white rounded-full font-semibold hover:bg-white hover:text-blue-900 transition-all duration-300">
                        Hubungi Kami
                    </a>
                </div>
            </div>

            <!-- Right Visual -->
            <div class="relative" data-aos="fade-left">
                <div class="relative max-w-lg ml-auto">
                    <!-- Main Image Container with 3D Effect -->
                    <div class="relative z-10 rounded-3xl overflow-hidden transform hover:scale-105 transition-transform duration-500 shadow-[0_20px_50px_rgba(8,_112,_184,_0.7)]">
                        <img
                            src="<?= base_url('backend/assets/images/water_3d.png') ?>"
                            alt="PDAM Infrastructure"
                            class="w-full h-auto animate-float"
                            style="animation-duration: 4s;">
                        <div class="absolute inset-0 bg-gradient-to-t from-blue-900/40 via-transparent to-transparent"></div>
                    </div>

                    <!-- Floating Stats Card -->
                    <div class="absolute -bottom-10 -left-10 z-20 bg-white rounded-2xl shadow-2xl p-6 animate-float">
                        <div class="flex items-center space-x-4">
                            <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-xl flex items-center justify-center">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-2xl font-bold text-gray-900">24/7</p>
                                <p class="text-sm text-gray-600">Layanan</p>
                            </div>
                        </div>
                    </div>

                    <!-- Floating Quality Badge -->
                    <div class="absolute -top-10 -right-10 z-20 bg-gradient-to-br from-green-400 to-emerald-500 rounded-2xl shadow-2xl p-6 animate-float" style="animation-delay: 0.5s;">
                        <div class="text-center text-white">
                            <p class="text-3xl font-bold">K4</p>
                            <p class="text-xs font-medium">Standard</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Web Ticker -->
<div class="bg-gradient-to-r from-blue-600 to-cyan-600 text-white py-4 shadow-lg">
    <div class="container mx-auto px-4">
        <div class="flex items-center space-x-4 overflow-hidden">
            <div class="flex-shrink-0 flex items-center space-x-2">
                <img src="<?= base_url('backend/assets/images/logo/logo.png') ?>" alt="Logo" class="h-8 w-auto">
                <svg class="w-5 h-5 text-yellow-300 animate-pulse" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z" />
                </svg>
            </div>
            <div class="flex-1 overflow-hidden">
                <div class="animate-marquee whitespace-nowrap">
                    <span class="text-sm font-medium">
                        📞 UNTUK INFORMASI TAGIHAN, PENGADUAN GANGGUAN DAN LAPOR ANGKA METER HUBUNGI CALL CENTER KAMI KE NOMOR (TELP./WA) +62 822-9275-4405
                    </span>
                </div>
            </div>
            <div class="flex-shrink-0 flex items-center space-x-2">
                <a href="https://web.facebook.com/pdam.n.tirta/" target="_blank" class="w-8 h-8 bg-white/20 hover:bg-white/30 rounded-full flex items-center justify-center transition-all">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                    </svg>
                </a>
                <a href="https://www.instagram.com/perumdam_muaratirta/" target="_blank" class="w-8 h-8 bg-white/20 hover:bg-white/30 rounded-full flex items-center justify-center transition-all">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z" />
                    </svg>
                </a>
                <a href="https://wa.me/6282292754405/" target="_blank" class="w-8 h-8 bg-white/20 hover:bg-white/30 rounded-full flex items-center justify-center transition-all">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.890-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Service Section -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4 lg:px-8">
        <!-- Section Header -->
        <div class="text-center mb-16" data-aos="fade-up">
            <span class="inline-block px-4 py-2 bg-blue-100 text-blue-600 rounded-full text-sm font-semibold mb-4">
                Layanan Kami
            </span>
            <h2 class="text-4xl lg:text-5xl font-display font-bold text-gray-900 mb-4">
                Layanan Kami
            </h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Akses cepat dan mudah untuk kebutuhan air bersih Anda
            </p>
        </div>

        <!-- Service Cards -->
        <div class="grid md:grid-cols-3 gap-8">
            <!-- Pemasangan Baru -->
            <div
                data-aos="fade-up"
                data-aos-delay="100"
                class="group bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 hover:border-blue-200 cursor-pointer"
                onclick="window.location.href='<?= base_url('pasang-baru') ?>'">
                <div class="mb-6">
                    <div class="w-20 h-20 bg-gradient-to-br from-blue-100 to-cyan-100 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <img src="<?= base_url('backend/assets/images/plumbing-plumber-svgrepo-com.svg') ?>" alt="Pemasangan Baru" class="w-12 h-12">
                    </div>
                </div>
                <h3 class="text-xl font-display font-bold text-gray-900 mb-3 group-hover:text-blue-600 transition-colors">
                    Pemasangan Baru
                </h3>
                <p class="text-gray-600 mb-6 leading-relaxed">
                    Daftar pemasangan sambungan air bersih baru untuk rumah atau usaha Anda dengan proses cepat dan mudah
                </p>
                <div class="flex items-center text-blue-600 font-semibold group-hover:translate-x-2 transition-transform">
                    <span>Daftar Sekarang</span>
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </div>
            </div>

            <!-- Lapor Keluhan -->
            <div
                data-aos="fade-up"
                data-aos-delay="200"
                class="group bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 hover:border-blue-200 cursor-pointer"
                onclick="window.location.href='<?= base_url('lapor-keluhan') ?>'">
                <div class="mb-6">
                    <div class="w-20 h-20 bg-gradient-to-br from-blue-100 to-cyan-100 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <img src="<?= base_url('assets/image/icons8-complaint-100.png') ?>" alt="Lapor Keluhan" class="w-12 h-12">
                    </div>
                </div>
                <h3 class="text-xl font-display font-bold text-gray-900 mb-3 group-hover:text-blue-600 transition-colors">
                    Lapor Keluhan
                </h3>
                <p class="text-gray-600 mb-6 leading-relaxed">
                    Laporkan kendala atau keluhan terkait layanan air bersih. Tim kami siap membantu Anda 24/7
                </p>
                <div class="flex items-center text-blue-600 font-semibold group-hover:translate-x-2 transition-transform">
                    <span>Laporkan Keluhan</span>
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </div>
            </div>

            <!-- Cek Tagihan -->
            <div
                data-aos="fade-up"
                data-aos-delay="300"
                class="group bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 hover:border-blue-200 cursor-pointer"
                onclick="window.location.href='<?= base_url('cek-tagihan') ?>'">
                <div class="mb-6">
                    <div class="w-20 h-20 bg-gradient-to-br from-blue-100 to-cyan-100 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <img src="<?= base_url('assets/image/billing.png') ?>" alt="Cek Tagihan" class="w-12 h-12">
                    </div>
                </div>
                <h3 class="text-xl font-display font-bold text-gray-900 mb-3 group-hover:text-blue-600 transition-colors">
                    Cek Tagihan
                </h3>
                <p class="text-gray-600 mb-6 leading-relaxed">
                    Cek tagihan air bulanan Anda secara online. Bayar dengan mudah melalui berbagai metode pembayaran
                </p>
                <div class="flex items-center text-blue-600 font-semibold group-hover:translate-x-2 transition-transform">
                    <span>Cek Tagihan</span>
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section class="py-20 bg-gradient-to-br from-blue-50 to-cyan-50">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-12 items-center">

            <!-- Left Content -->
            <div data-aos="fade-right">
                <span class="inline-flex items-center space-x-2 px-4 py-2 bg-blue-600 text-white rounded-full text-sm font-semibold mb-6">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <span>TENTANG KAMI</span>
                </span>

                <h2 class="text-4xl lg:text-5xl font-display font-bold text-gray-900 mb-6">
                    Komitmen Kami Untuk <span class="gradient-text">Air Bersih Berkualitas</span>
                </h2>

                <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                    PERUMDA Air Minum Muara Tirta Kota Gorontalo adalah perusahaan daerah yang berdedikasi untuk menyediakan air bersih berkualitas tinggi kepada masyarakat Gorontalo. Dengan standar pelayanan K4 (Kualitas, Kuantitas, Kontinuitas, dan Keterjangkauan), kami terus berinovasi untuk meningkatkan kualitas hidup masyarakat.
                </p>

                <!-- Features -->
                <div class="space-y-4 mb-8">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 mb-1">Kualitas Terjamin</h4>
                            <p class="text-gray-600">Air yang kami distribusikan telah melalui proses pengolahan dan pengujian ketat sesuai standar kesehatan nasional</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 mb-1">Layanan 24/7</h4>
                            <p class="text-gray-600">Sistem distribusi air yang kontinyu dan tim customer service yang siap membantu Anda kapan saja</p>
                        </div>
                    </div>
                </div>

                <a
                    href="<?= base_url('about') ?>"
                    class="inline-flex items-center px-8 py-4 bg-blue-600 text-white rounded-full font-semibold hover:bg-blue-700 transition-all duration-300 shadow-lg hover:shadow-xl">
                    <span>Selengkapnya</span>
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </a>
            </div>

            <!-- Right Visual -->
            <div data-aos="fade-left" class="relative">
                <img
                    src="<?= base_url('assets/image/customer-service-illustration.png') ?>"
                    alt="Customer Service"
                    class="w-full h-auto rounded-3xl shadow-2xl">
            </div>
        </div>
    </div>
</section>

<!-- Info Gangguan Section -->
<?php if (!empty($info_gangguan)): ?>
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4 lg:px-8">
            <!-- Section Header -->
            <div class="flex justify-between items-end mb-12" data-aos="fade-up">
                <div>
                    <span class="inline-block px-4 py-2 bg-red-100 text-red-600 rounded-full text-sm font-semibold mb-4">
                        Info Gangguan
                    </span>
                    <h2 class="text-4xl font-display font-bold text-gray-900">
                        Informasi Gangguan Terkini
                    </h2>
                    <p class="text-gray-600 mt-2">Informasi terkini mengenai gangguan pelayanan di wilayah Anda</p>
                </div>
                <a
                    href="<?= base_url('info-gangguan') ?>"
                    class="hidden md:inline-flex items-center text-blue-600 font-semibold hover:text-blue-700">
                    Lihat Semua
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </a>
            </div>

            <!-- Slider Container -->
            <div class="relative" data-aos="fade-up" data-aos-delay="100">
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php foreach (array_slice($info_gangguan, 0, 3) as $gangguan): ?>
                        <div class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100">
                            <!-- Badge Gangguan -->
                            <div class="absolute top-4 left-4 z-10">
                                <span class="px-3 py-1 bg-red-600 text-white text-xs font-bold rounded-full">
                                    GANGGUAN
                                </span>
                            </div>

                            <!-- Image -->
                            <div class="relative h-48 overflow-hidden">
                                <img
                                    src="<?= base_url('assets/info/' . ($gangguan['image'] ?? 'info-gangguan.jpg')) ?>"
                                    alt="<?= esc($gangguan['judul']) ?>"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                            </div>

                            <!-- Content -->
                            <div class="p-6">
                                <h3 class="text-lg font-bold text-gray-900 mb-3 line-clamp-2 group-hover:text-blue-600 transition-colors">
                                    <?= esc($gangguan['judul']) ?>
                                </h3>

                                <div class="flex items-center text-sm text-gray-500 mb-4 space-x-4">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        <?= esc($gangguan['author']) ?>
                                    </div>
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <?= date('d M Y', strtotime($gangguan['tanggal_buat'])) ?>
                                    </div>
                                </div>

                                <a
                                    href="<?= base_url('info-gangguan-detail?id-ig=' . $gangguan['id']) ?>"
                                    class="inline-flex items-center text-blue-600 font-semibold group-hover:translate-x-2 transition-transform">
                                    Lihat Selengkapnya
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<!-- Berita Section -->
<?php if (!empty($berita)): ?>
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4 lg:px-8">
            <!-- Section Header -->
            <div class="flex justify-between items-end mb-12" data-aos="fade-up">
                <div>
                    <span class="inline-block px-4 py-2 bg-blue-100 text-blue-600 rounded-full text-sm font-semibold mb-4">
                        Berita Terkini
                    </span>
                    <h2 class="text-4xl font-display font-bold text-gray-900">
                        Update Berita dan Kegiatan
                    </h2>
                    <p class="text-gray-600 mt-2">Update berita dan kegiatan PERUMDA Muara Tirta</p>
                </div>
                <a
                    href="<?= base_url('berita') ?>"
                    class="hidden md:inline-flex items-center text-blue-600 font-semibold hover:text-blue-700">
                    Lihat Semua
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </a>
            </div>

            <!-- Berita Grid -->
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach (array_slice($berita, 0, 3) as $item): ?>
                    <div class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300" data-aos="fade-up" data-aos-delay="<?= 100 * array_search($item, $berita) ?>">
                        <!-- Image with Date Badge -->
                        <div class="relative h-56 overflow-hidden">
                            <img
                                src="<?= base_url('assets/info/' . $item['image']) ?>"
                                alt="<?= esc($item['judul']) ?>"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            <div class="absolute top-4 right-4 bg-white rounded-lg px-3 py-2 text-center shadow-lg">
                                <div class="text-2xl font-bold text-blue-600"><?= date('d', strtotime($item['tanggal_buat'])) ?></div>
                                <div class="text-xs text-gray-600"><?= date('M Y', strtotime($item['tanggal_buat'])) ?></div>
                            </div>
                            <div class="absolute top-4 left-4">
                                <span class="px-3 py-1 bg-blue-600 text-white text-xs font-bold rounded-full">
                                    BERITA
                                </span>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="p-6">
                            <div class="flex items-center text-sm text-gray-500 mb-3">
                                <div class="flex items-center mr-4">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    <?= esc($item['author']) ?>
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                    </svg>
                                    <?= esc($item['tag']) ?>
                                </div>
                            </div>

                            <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 group-hover:text-blue-600 transition-colors">
                                <?= esc($item['judul']) ?>
                            </h3>

                            <div class="border-t border-gray-100 pt-4">
                                <a
                                    href="<?= base_url('detail-berita?id-berita=' . $item['id']) ?>"
                                    class="inline-flex items-center text-blue-600 font-semibold group-hover:translate-x-2 transition-transform">
                                    Lihat Selengkapnya
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<!-- Mitra Pembayaran Section -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4 lg:px-8">
        <!-- Section Header -->
        <div class="text-center mb-16" data-aos="fade-up">
            <span class="inline-block px-4 py-2 bg-blue-100 text-blue-600 rounded-full text-sm font-semibold mb-4">
                Mitra Pembayaran
            </span>
            <h2 class="text-4xl font-display font-bold text-gray-900 mb-4">
                Mitra Pembayaran
            </h2>
            <p class="text-gray-600">
                Bayar tagihan air dengan mudah melalui berbagai kanal
            </p>
        </div>

        <!-- Logo Grid -->
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-8 items-center" data-aos="fade-up" data-aos-delay="100">
            <div class="flex items-center justify-center p-6 bg-white rounded-xl border border-gray-100 hover:border-blue-200 hover:shadow-lg transition-all duration-300">
                <img src="<?= base_url('assets/image/Group-17.png') ?>" alt="GriyaBayar" class="h-12 w-auto grayscale hover:grayscale-0 transition-all">
            </div>
            <div class="flex items-center justify-center p-6 bg-white rounded-xl border border-gray-100 hover:border-blue-200 hover:shadow-lg transition-all duration-300">
                <img src="<?= base_url('assets/image/Logo_Bank_BSG.png') ?>" alt="Bank BSG" class="h-12 w-auto grayscale hover:grayscale-0 transition-all">
            </div>
            <div class="flex items-center justify-center p-6 bg-white rounded-xl border border-gray-100 hover:border-blue-200 hover:shadow-lg transition-all duration-300">
                <img src="<?= base_url('assets/image/Group-20.png') ?>" alt="POS Indonesia" class="h-12 w-auto grayscale hover:grayscale-0 transition-all">
            </div>
            <div class="flex items-center justify-center p-6 bg-white rounded-xl border border-gray-100 hover:border-blue-200 hover:shadow-lg transition-all duration-300">
                <img src="<?= base_url('assets/image/6d348add535c3c623309ebf5c1ee0c88_brand-architecture-bukalapak-primary@2x-1.png') ?>" alt="Tokopedia" class="h-12 w-auto grayscale hover:grayscale-0 transition-all">
            </div>
            <div class="flex items-center justify-center p-6 bg-white rounded-xl border border-gray-100 hover:border-blue-200 hover:shadow-lg transition-all duration-300">
                <img src="<?= base_url('assets/image/2560px-Bank_BTN_logo.svg.png') ?>" alt="Bank BTN" class="h-12 w-auto grayscale hover:grayscale-0 transition-all">
            </div>
            <div class="flex items-center justify-center p-6 bg-white rounded-xl border border-gray-100 hover:border-blue-200 hover:shadow-lg transition-all duration-300">
                <img src="<?= base_url('assets/image/Logo-myBCA-720x405.jpg') ?>" alt="myBCA" class="h-12 w-auto grayscale hover:grayscale-0 transition-all">
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<!-- AOS Animation Library -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 800,
        once: true,
        offset: 100
    });
</script>

<!-- Custom Animations -->
<style>
    @keyframes marquee {
        0% {
            transform: translateX(0);
        }

        100% {
            transform: translateX(-50%);
        }
    }

    .animate-marquee {
        display: inline-block;
        animation: marquee 20s linear infinite;
    }
</style>
<?= $this->endSection() ?>