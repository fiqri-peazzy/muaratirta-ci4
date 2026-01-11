<?= $this->extend('frontend/layouts/main') ?>

<?= $this->section('title') ?>
<?= $title ?? 'Pendaftaran Berhasil' ?>
<?= $this->endSection() ?>

<?= $this->section('description') ?>
<?= $description ?? 'Pendaftaran pasang baru Anda telah berhasil' ?>
<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<style>
    @keyframes checkmark {
        0% {
            stroke-dashoffset: 100;
        }

        100% {
            stroke-dashoffset: 0;
        }
    }

    @keyframes scaleIn {
        0% {
            transform: scale(0);
            opacity: 0;
        }

        50% {
            transform: scale(1.1);
        }

        100% {
            transform: scale(1);
            opacity: 1;
        }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .checkmark-circle {
        stroke-dasharray: 166;
        stroke-dashoffset: 166;
        animation: checkmark 0.6s ease-in-out 0.3s forwards;
    }

    .checkmark-check {
        stroke-dasharray: 48;
        stroke-dashoffset: 48;
        animation: checkmark 0.3s ease-in-out 0.9s forwards;
    }

    .animate-scaleIn {
        animation: scaleIn 0.6s ease-out forwards;
    }

    .animate-fadeInUp {
        animation: fadeInUp 0.6s ease-out forwards;
        opacity: 0;
    }

    .animate-delay-100 {
        animation-delay: 0.1s;
    }

    .animate-delay-200 {
        animation-delay: 0.2s;
    }

    .animate-delay-300 {
        animation-delay: 0.3s;
    }

    .animate-delay-400 {
        animation-delay: 0.4s;
    }

    .animate-delay-500 {
        animation-delay: 0.5s;
    }

    @keyframes float {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-10px);
        }
    }

    .animate-float {
        animation: float 3s ease-in-out infinite;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- Breadcrumb -->
<section class="relative pt-24 pb-8 bg-gradient-to-r from-primary-600 to-water-500 overflow-hidden">
    <div class="absolute inset-0 opacity-20">
        <svg class="absolute bottom-0 w-full h-32" viewBox="0 0 1440 320" xmlns="http://www.w3.org/2000/svg">
            <path fill="#ffffff" fill-opacity="0.3" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,112C672,96,768,96,864,112C960,128,1056,160,1152,160C1248,160,1344,128,1392,112L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
        </svg>
    </div>

    <div class="container mx-auto px-4 relative z-10">
        <h1 class="text-3xl lg:text-4xl font-display font-bold text-white mb-3 text-center lg:text-left">
            Pendaftaran Berhasil
        </h1>
        <nav class="flex items-center justify-center lg:justify-start space-x-2 text-sm">
            <a href="<?= base_url('/') ?>" class="text-white/80 hover:text-white transition-colors font-medium">
                Beranda
            </a>
            <svg class="w-4 h-4 text-white/60" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
            </svg>
            <a href="<?= base_url('pasang-baru') ?>" class="text-white/80 hover:text-white transition-colors font-medium">
                Pasang Baru
            </a>
            <svg class="w-4 h-4 text-white/60" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
            </svg>
            <span class="text-white font-semibold">Sukses</span>
        </nav>
    </div>
</section>

<!-- Main Content -->
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4 max-w-4xl">

        <!-- Success Card -->
        <div class="bg-white rounded-2xl shadow-lg p-8 lg:p-12 mb-8 animate-fadeInUp">

            <!-- Success Icon -->
            <div class="flex justify-center mb-8">
                <div class="relative animate-scaleIn">
                    <svg class="w-32 h-32" viewBox="0 0 100 100">
                        <circle class="checkmark-circle" cx="50" cy="50" r="45" fill="none" stroke="#10b981" stroke-width="4" />
                        <path class="checkmark-check" fill="none" stroke="#10b981" stroke-width="6" stroke-linecap="round" d="M30 50 L45 65 L70 35" />
                    </svg>
                    <div class="absolute inset-0 bg-green-50 rounded-full -z-10 animate-ping"></div>
                </div>
            </div>

            <!-- Success Message -->
            <div class="text-center mb-8 animate-fadeInUp animate-delay-300">
                <h2 class="text-3xl font-display font-bold text-gray-900 mb-3">
                    Pendaftaran Berhasil!
                </h2>
                <p class="text-gray-600 leading-relaxed">
                    Terima kasih telah mendaftar. Permohonan pemasangan sambungan baru Anda telah kami terima dan akan segera diproses.
                </p>
            </div>

            <!-- Registration Number -->
            <div class="bg-gradient-to-br from-primary-50 to-water-50 rounded-xl p-6 mb-8 animate-fadeInUp animate-delay-400">
                <div class="text-center">
                    <p class="text-sm font-semibold text-gray-600 uppercase tracking-wider mb-2">
                        Nomor Pendaftaran Anda
                    </p>
                    <div class="flex items-center justify-center space-x-3">
                        <p class="text-4xl font-display font-bold text-primary-600">
                            <?= $pendaftaran->no_pendaftaran ?? 'PB-2025-0001' ?>
                        </p>
                        <button
                            onclick="copyToClipboard('<?= $pendaftaran->no_pendaftaran ?? 'PB-2025-0001' ?>')"
                            class="p-2 hover:bg-white rounded-lg transition-colors group"
                            title="Salin nomor">
                            <svg class="w-6 h-6 text-primary-600 group-hover:text-primary-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                            </svg>
                        </button>
                    </div>
                    <p class="text-xs text-gray-500 mt-3">
                        Simpan nomor ini untuk melacak status pendaftaran Anda
                    </p>
                </div>
            </div>

            <!-- Registration Details -->
            <div class="space-y-4 mb-8 animate-fadeInUp animate-delay-500">
                <div class="flex items-start space-x-4 p-4 bg-gray-50 rounded-xl">
                    <div class="flex-shrink-0 w-10 h-10 bg-primary-100 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-semibold text-gray-600 mb-1">Nama Lengkap</p>
                        <p class="text-gray-900 font-medium"><?= $pendaftaran->nama_lengkap ?? '-' ?></p>
                    </div>
                </div>

                <div class="flex items-start space-x-4 p-4 bg-gray-50 rounded-xl">
                    <div class="flex-shrink-0 w-10 h-10 bg-water-100 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-water-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-semibold text-gray-600 mb-1">Alamat Pemasangan</p>
                        <p class="text-gray-900 font-medium"><?= $pendaftaran->alamat_pemasangan ?? '-' ?></p>
                    </div>
                </div>

                <div class="flex items-start space-x-4 p-4 bg-gray-50 rounded-xl">
                    <div class="flex-shrink-0 w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-semibold text-gray-600 mb-1">Nomor Telepon</p>
                        <p class="text-gray-900 font-medium"><?= $pendaftaran->no_hp ?? '-' ?></p>
                    </div>
                </div>
            </div>

        </div>

        <!-- Next Steps -->
        <div class="bg-white rounded-2xl shadow-lg p-8 mb-8 animate-fadeInUp animate-delay-500">
            <div class="flex items-center space-x-3 mb-6">
                <div class="w-10 h-10 bg-primary-100 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                    </svg>
                </div>
                <h3 class="text-xl font-display font-bold text-gray-900">Langkah Selanjutnya</h3>
            </div>

            <div class="space-y-4">
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0 w-8 h-8 bg-primary-600 text-white rounded-full flex items-center justify-center font-bold text-sm">
                        1
                    </div>
                    <div class="flex-1 pt-1">
                        <h4 class="font-semibold text-gray-900 mb-1">Verifikasi Data</h4>
                        <p class="text-sm text-gray-600">Tim kami akan memverifikasi data dan dokumen yang Anda kirimkan dalam waktu 1-2 hari kerja.</p>
                    </div>
                </div>

                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0 w-8 h-8 bg-primary-600 text-white rounded-full flex items-center justify-center font-bold text-sm">
                        2
                    </div>
                    <div class="flex-1 pt-1">
                        <h4 class="font-semibold text-gray-900 mb-1">Survei Lokasi</h4>
                        <p class="text-sm text-gray-600">Petugas kami akan menghubungi Anda untuk jadwal survei lokasi pemasangan.</p>
                    </div>
                </div>

                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0 w-8 h-8 bg-primary-600 text-white rounded-full flex items-center justify-center font-bold text-sm">
                        3
                    </div>
                    <div class="flex-1 pt-1">
                        <h4 class="font-semibold text-gray-900 mb-1">Informasi Biaya</h4>
                        <p class="text-sm text-gray-600">Setelah survei, Anda akan mendapat informasi detail biaya pemasangan dan cara pembayaran.</p>
                    </div>
                </div>

                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0 w-8 h-8 bg-primary-600 text-white rounded-full flex items-center justify-center font-bold text-sm">
                        4
                    </div>
                    <div class="flex-1 pt-1">
                        <h4 class="font-semibold text-gray-900 mb-1">Pemasangan</h4>
                        <p class="text-sm text-gray-600">Setelah pembayaran dikonfirmasi, kami akan menjadwalkan pemasangan sambungan air.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 animate-fadeInUp animate-delay-500">
            <a
                href="<?= base_url('pasang-baru/tracking') ?>"
                class="flex items-center justify-center space-x-2 px-6 py-4 bg-gradient-to-r from-primary-600 to-primary-700 text-white rounded-xl hover:from-primary-700 hover:to-primary-800 transition-all font-semibold shadow-lg shadow-primary-500/30">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <span>Lacak Status Pendaftaran</span>
            </a>

            <a
                href="<?= base_url('/') ?>"
                class="flex items-center justify-center space-x-2 px-6 py-4 bg-white border-2 border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition-all font-semibold">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                <span>Kembali ke Beranda</span>
            </a>
        </div>

        <!-- Contact Info -->
        <div class="mt-8 bg-gradient-to-br from-green-50 to-water-50 rounded-2xl p-6 border border-green-200 animate-fadeInUp animate-delay-500">
            <div class="flex items-start space-x-4">
                <div class="flex-shrink-0">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="flex-1">
                    <h4 class="font-semibold text-gray-900 mb-2">Butuh Bantuan?</h4>
                    <p class="text-sm text-gray-600 leading-relaxed mb-3">
                        Jika ada pertanyaan atau memerlukan bantuan, silakan hubungi Customer Service kami:
                    </p>
                    <div class="flex flex-wrap gap-3">
                        <a href="https://wa.me/6281244697154" target="_blank" class="inline-flex items-center space-x-2 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors text-sm font-medium">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                            </svg>
                            <span>WhatsApp</span>
                        </a>
                        <a href="tel:+6243582123" class="inline-flex items-center space-x-2 px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition-colors text-sm font-medium">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <span>(0435) 821234</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(() => {
            // Simple alert
            const alert = document.createElement('div');
            alert.className = 'fixed top-4 right-4 bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg z-50 animate-fadeInUp';
            alert.innerHTML = `
            <div class="flex items-center space-x-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                <span>Nomor berhasil disalin!</span>
            </div>
        `;
            document.body.appendChild(alert);
            setTimeout(() => {
                alert.remove();
            }, 3000);
        });
    }
</script>
<?= $this->endSection() ?>