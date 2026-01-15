<?= $this->extend('frontend/layouts/main') ?>

<?= $this->section('title') ?><?= $title ?><?= $this->endSection() ?>

<?= $this->section('styles') ?>
<style>
    .vm-card {
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
    }

    .vm-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(59, 130, 246, 0.1);
    }

    .vm-icon-blob {
        position: relative;
    }

    .vm-icon-blob::before {
        content: '';
        position: absolute;
        inset: -10px;
        background: currentColor;
        opacity: 0.1;
        border-radius: 40% 60% 70% 30% / 40% 50% 60% 50%;
        animation: blob 8s linear infinite;
    }

    @keyframes blob {

        0%,
        100% {
            border-radius: 40% 60% 70% 30% / 40% 50% 60% 50%;
        }

        33% {
            border-radius: 70% 30% 50% 50% / 30% 60% 40% 70%;
        }

        66% {
            border-radius: 50% 60% 30% 70% / 60% 30% 70% 40%;
        }
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- Breadcrumb -->
<section class="relative pt-32 pb-12 bg-gradient-to-r from-blue-900 via-blue-800 to-cyan-900 overflow-hidden">
    <div class="absolute inset-0 opacity-20">
        <svg class="absolute bottom-0 w-full h-32" viewBox="0 0 1440 320" xmlns="http://www.w3.org/2000/svg">
            <path fill="#ffffff" fill-opacity="0.2" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,112C672,96,768,96,864,112C960,128,1056,160,1152,160C1248,160,1344,128,1392,112L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
        </svg>
    </div>
    <div class="container mx-auto px-4 lg:px-8 relative z-10">
        <h1 class="text-4xl lg:text-5xl font-display font-bold text-white mb-4 text-center lg:text-left">Visi & Misi</h1>
        <nav class="flex items-center justify-center lg:justify-start space-x-2 text-sm">
            <a href="<?= base_url('/') ?>" class="text-white/80 hover:text-white transition-colors">Beranda</a>
            <svg class="w-4 h-4 text-white/60" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
            </svg>
            <span class="text-white font-medium">Visi Misi</span>
        </nav>
    </div>
</section>

<!-- Animation Hub -->
<section class="py-12 bg-white">
    <div class="container mx-auto px-4 flex justify-center" data-aos="zoom-in">
        <script src="https://unpkg.com/@lottiefiles/dotlottie-wc@0.8.5/dist/dotlottie-wc.js" type="module"></script>
        <dotlottie-wc src="https://lottie.host/41bfb167-65aa-4606-88eb-4dd3263926c5/TlcYI4p7Qd.lottie"
            speed="1" background="transparent" style="width: 320px; height: 320px" autoplay loop>
        </dotlottie-wc>
    </div>
</section>

<!-- PERUMDA Vision & Mission -->
<section class="py-20 bg-gray-50 overflow-hidden">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="text-center mb-16" data-aos="fade-up">
            <span class="inline-block px-4 py-1.5 bg-primary-100 text-primary-700 rounded-full text-xs font-bold uppercase tracking-widest mb-4">Internal Corporate</span>
            <h2 class="text-3xl lg:text-4xl font-display font-bold text-gray-900 mb-4">Visi & Misi PERUMDA Muara Tirta</h2>
            <div class="w-20 h-1.5 bg-primary-600 mx-auto rounded-full"></div>
        </div>

        <div class="grid lg:grid-cols-2 gap-8 items-stretch">
            <!-- Visi Card -->
            <div class="vm-card bg-white rounded-[2.5rem] p-10 border border-gray-100 shadow-sm flex flex-col items-center text-center" data-aos="fade-right">
                <div class="w-20 h-20 text-primary-600 mb-8 vm-icon-blob flex items-center justify-center">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </div>
                <h3 class="text-2xl font-display font-bold text-gray-900 mb-6">VISI</h3>
                <p class="text-xl text-gray-600 leading-relaxed italic">
                    "Peningkatan Pelayanan Air Minum Dalam Memenuhi Standar K4"
                </p>
            </div>

            <!-- Misi Card -->
            <div class="vm-card bg-white rounded-[2.5rem] p-10 border border-gray-100 shadow-sm" data-aos="fade-left">
                <div class="flex items-center space-x-6 mb-8">
                    <div class="w-16 h-16 text-primary-600 vm-icon-blob flex items-center justify-center flex-shrink-0">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-display font-bold text-gray-900">MISI</h3>
                </div>
                <ul class="space-y-6">
                    <li class="flex items-start space-x-4">
                        <div class="w-8 h-8 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <span class="text-lg text-gray-700 font-medium">Peningkatan Pelayanan Air Bersih</span>
                    </li>
                    <li class="flex items-start space-x-4">
                        <div class="w-8 h-8 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <span class="text-lg text-gray-700 font-medium">Pemenuhan Pelayanan Standar K4</span>
                    </li>
                    <li class="flex items-start space-x-4">
                        <div class="w-8 h-8 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <span class="text-lg text-gray-700 font-medium">Peningkatan Kinerja PUPR</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Government Vision & Mission -->
<section class="py-24 bg-white relative">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="text-center mb-20" data-aos="fade-up">
            <span class="inline-block px-4 py-1.5 bg-cyan-100 text-cyan-700 rounded-full text-xs font-bold uppercase tracking-widest mb-4">Gorontalo City Government</span>
            <h2 class="text-3xl lg:text-4xl font-display font-bold text-gray-900 mb-4">Selaras Dengan Visi Kota Gorontalo</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">Mendukung terwujudnya masyarakat yang sejahtera dan modern di bawah kepemimpinan Pemerintah Kota Gorontalo.</p>
        </div>

        <div class="max-w-4xl mx-auto space-y-12">
            <!-- City Vision -->
            <div class="relative bg-gradient-to-br from-cyan-600 to-blue-700 rounded-[3rem] p-12 overflow-hidden shadow-2xl" data-aos="fade-up">
                <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -mr-20 -mt-20 blur-3xl"></div>
                <div class="relative flex flex-col md:flex-row items-center gap-12">
                    <div class="flex-shrink-0 text-white opacity-20 hidden md:block">
                        <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M15 11V5l-3-3-3 3v2H3v14h18V11h-6zm-2 8h-2v-2h2v2zm0-4h-2v-2h2v2zm0-4h-2V9h2v2zm4 8h-2v-2h2v2zm0-4h-2v-2h2v2zm-8 4H5v-2h2v2zm0-4H5v-2h2v2zm0-4H5V9h2v2z" />
                        </svg>
                    </div>
                    <div class="text-center md:text-left">
                        <h4 class="text-cyan-100 font-bold uppercase tracking-tighter mb-4">Visi Kota</h4>
                        <p class="text-2xl lg:text-3xl text-white font-display font-extrabold leading-tight">
                            Kota Gorontalo Sejahtera, Maju, Aktif, Religius dan Terdidik (Kota SMART)
                        </p>
                    </div>
                </div>
            </div>

            <!-- City Mission List -->
            <div class="grid md:grid-cols-2 gap-6" data-aos="fade-up">
                <?php
                $misiKota = [
                    "Mewujudkan Kesetaraan bagi Masyarakat untuk Memperoleh Akses Layanan Pendidikan, Kesehatan dan Layanan Publik Lainnya Yang Terjangkau dan Berkualitas",
                    "Meningkatkan Ketersediaan Infrastruktur yang handal di semua sektor public",
                    "Penguatan Kapasitas UMKM, Koperasi dan pengembangan Sektor Perekonomian Primer lainnya",
                    "Reformasi Birokrasi yang berorientasi pada peningkatan tata kelola, kapasitas organisasi pemerintah, dan kualitas sumber daya aparatur",
                    "Mengembangkan Kualitas Hidup masyarakat yang religius dan berbudaya",
                    "Penguatan Daya Saing Kota Sebagai Pusat Perdagangan dan Jasa di Kawasan Teluk Tomini"
                ];
                ?>
                <?php foreach ($misiKota as $index => $misi): ?>
                    <div class="p-6 bg-white border border-gray-100 rounded-3xl shadow-sm hover:border-cyan-200 transition-colors duration-300 flex space-x-4">
                        <div class="w-8 h-8 bg-cyan-50 text-cyan-600 rounded-xl flex items-center justify-center font-bold text-sm flex-shrink-0">
                            <?= $index + 1 ?>
                        </div>
                        <p class="text-sm text-gray-600 leading-relaxed font-medium">
                            <?= $misi ?>
                        </p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
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