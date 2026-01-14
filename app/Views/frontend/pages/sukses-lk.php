<?= $this->extend('frontend/layouts/main') ?>

<?= $this->section('title') ?><?= $title ?? 'Pengaduan Berhasil' ?><?= $this->endSection() ?>

<?= $this->section('description') ?>Pengaduan Anda telah berhasil dikirim dan akan segera diproses oleh tim kami<?= $this->endSection() ?>

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
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .checkmark-circle {
        animation: scaleIn 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .checkmark-path {
        stroke-dasharray: 100;
        stroke-dashoffset: 100;
        animation: checkmark 0.8s ease-in-out 0.3s forwards;
    }

    .fade-in-up {
        animation: fadeInUp 0.6s ease-out forwards;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- Success Section -->
<section class="relative min-h-screen flex items-center justify-center bg-gradient-to-br from-green-50 via-emerald-50 to-teal-50 py-20">
    <!-- Decorative Elements -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-20 left-10 w-72 h-72 bg-green-200/30 rounded-full blur-3xl"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-emerald-200/30 rounded-full blur-3xl"></div>
    </div>

    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-3xl mx-auto">

            <!-- Success Card -->
            <div class="bg-white rounded-3xl shadow-2xl p-8 lg:p-12 text-center">

                <!-- Animated Checkmark -->
                <div class="flex justify-center mb-8">
                    <svg class="w-32 h-32 checkmark-circle" viewBox="0 0 100 100">
                        <circle cx="50" cy="50" r="45" fill="#10b981" opacity="0.1" />
                        <circle cx="50" cy="50" r="40" fill="none" stroke="#10b981" stroke-width="3" />
                        <path class="checkmark-path" fill="none" stroke="#10b981" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" d="M30 50 L45 65 L70 35" />
                    </svg>
                </div>

                <!-- Success Message -->
                <div class="fade-in-up" style="animation-delay: 0.5s;">
                    <h1 class="text-4xl lg:text-5xl font-display font-bold text-gray-900 mb-4">
                        Pengaduan Berhasil Dikirim! 🎉
                    </h1>
                    <p class="text-lg text-gray-600 mb-8">
                        Terima kasih telah melaporkan keluhan Anda. Tim kami akan segera menindaklanjuti pengaduan ini.
                    </p>
                </div>

                <!-- Pengaduan Info Card -->
                <?php if (isset($pengaduan)): ?>
                    <div class="fade-in-up bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl p-8 mb-8" style="animation-delay: 0.7s;">
                        <div class="flex items-center justify-center space-x-3 mb-6">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <h2 class="text-2xl font-bold text-gray-900">Nomor Pengaduan Anda</h2>
                        </div>

                        <div class="bg-white rounded-xl p-6 mb-6 border-2 border-green-200">
                            <p class="text-sm text-gray-600 mb-2 font-medium">Nomor Pengaduan</p>
                            <p class="text-4xl font-bold text-green-600 mb-4 font-mono tracking-wide"><?= esc($pengaduan->no_pengaduan) ?></p>
                            <button
                                onclick="copyToClipboard('<?= esc($pengaduan->no_pengaduan) ?>')"
                                class="inline-flex items-center space-x-2 px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition-all font-medium">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                </svg>
                                <span>Salin Nomor</span>
                            </button>
                        </div>

                        <!-- Detail Info Grid -->
                        <div class="grid md:grid-cols-2 gap-4 text-left">
                            <div class="bg-white rounded-lg p-4">
                                <p class="text-xs text-gray-500 mb-1 uppercase tracking-wider">Nama Pelapor</p>
                                <p class="font-semibold text-gray-900"><?= esc($pengaduan->nm_lengkap) ?></p>
                            </div>
                            <div class="bg-white rounded-lg p-4">
                                <p class="text-xs text-gray-500 mb-1 uppercase tracking-wider">Kategori</p>
                                <p class="font-semibold text-gray-900 capitalize"><?= esc(str_replace('_', ' ', $pengaduan->kategori)) ?></p>
                            </div>
                            <div class="bg-white rounded-lg p-4">
                                <p class="text-xs text-gray-500 mb-1 uppercase tracking-wider">Tanggal Laporan</p>
                                <p class="font-semibold text-gray-900"><?= date('d F Y, H:i', strtotime($pengaduan->created_at)) ?> WIB</p>
                            </div>
                            <div class="bg-white rounded-lg p-4">
                                <p class="text-xs text-gray-500 mb-1 uppercase tracking-wider">Status</p>
                                <span class="inline-flex items-center px-3 py-1 bg-amber-100 text-amber-700 rounded-full text-sm font-semibold">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                    </svg>
                                    Menunggu Proses
                                </span>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Next Steps -->
                <div class="fade-in-up bg-blue-50 border border-blue-200 rounded-2xl p-6 mb-8 text-left" style="animation-delay: 0.9s;">
                    <div class="flex items-center space-x-3 mb-4">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h3 class="text-lg font-bold text-blue-900">Langkah Selanjutnya</h3>
                    </div>
                    <ol class="space-y-3 text-sm text-blue-800">
                        <li class="flex items-start">
                            <span class="flex-shrink-0 w-6 h-6 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold text-xs mr-3">1</span>
                            <span>Tim kami akan <strong>memverifikasi</strong> pengaduan Anda dalam 1x24 jam</span>
                        </li>
                        <li class="flex items-start">
                            <span class="flex-shrink-0 w-6 h-6 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold text-xs mr-3">2</span>
                            <span>Anda akan dihubungi melalui <strong>nomor telepon/WhatsApp</strong> yang terdaftar untuk konfirmasi</span>
                        </li>
                        <li class="flex items-start">
                            <span class="flex-shrink-0 w-6 h-6 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold text-xs mr-3">3</span>
                            <span>Gunakan <strong>nomor pengaduan</strong> untuk melacak status penanganan</span>
                        </li>
                        <li class="flex items-start">
                            <span class="flex-shrink-0 w-6 h-6 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold text-xs mr-3">4</span>
                            <span>Tim teknis kami akan <strong>menindaklanjuti</strong> sesuai kategori keluhan</span>
                        </li>
                    </ol>
                </div>

                <!-- Action Buttons -->
                <div class="fade-in-up flex flex-col sm:flex-row gap-4 justify-center" style="animation-delay: 1.1s;">
                    <a href="<?= base_url('lapor-keluhan/tracking') ?>" class="inline-flex items-center justify-center space-x-2 px-8 py-4 bg-gradient-to-r from-primary-600 to-primary-700 text-white rounded-xl hover:from-primary-700 hover:to-primary-800 transition-all font-semibold shadow-lg shadow-primary-500/30">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <span>Lacak Status</span>
                    </a>
                    <a href="<?= base_url('/') ?>" class="inline-flex items-center justify-center space-x-2 px-8 py-4 bg-white border-2 border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition-all font-semibold">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        <span>Kembali ke Beranda</span>
                    </a>
                </div>

                <!-- Contact Info -->
                <div class="fade-in-up mt-8 pt-8 border-t-2 border-gray-100" style="animation-delay: 1.3s;">
                    <p class="text-sm text-gray-600 mb-2">Butuh bantuan segera?</p>
                    <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                        <a href="tel:+6282292754405" class="inline-flex items-center space-x-2 text-green-600 hover:text-green-700 font-semibold">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <span>+62 822-9275-4405</span>
                        </a>
                        <span class="text-gray-400 hidden sm:inline">|</span>
                        <a href="https://wa.me/6282292754405" target="_blank" class="inline-flex items-center space-x-2 text-green-600 hover:text-green-700 font-semibold">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.890-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
                            </svg>
                            <span>Chat WhatsApp</span>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(() => {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil Disalin!',
                text: 'Nomor pengaduan telah disalin ke clipboard',
                timer: 2000,
                showConfirmButton: false,
                toast: true,
                position: 'top-end'
            });
        }).catch(() => {
            Swal.fire({
                icon: 'error',
                title: 'Gagal Menyalin',
                text: 'Silakan salin nomor secara manual',
                confirmButtonColor: '#3b82f6'
            });
        });
    }
</script>
<?= $this->endSection() ?>