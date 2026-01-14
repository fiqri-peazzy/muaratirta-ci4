<?= $this->extend('frontend/layouts/main') ?>

<?= $this->section('title') ?><?= $title ?? 'Lacak Status Pengaduan' ?><?= $this->endSection() ?>

<?= $this->section('description') ?>Lacak status pengaduan dan keluhan Anda secara real-time<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<style>
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

    .fade-in-up {
        animation: fadeInUp 0.6s ease-out forwards;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }

    .animate-spin {
        animation: spin 1s linear infinite;
    }

    @keyframes pulse {

        0%,
        100% {
            opacity: 1;
        }

        50% {
            opacity: 0.5;
        }
    }

    .animate-pulse {
        animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
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
        <h1 class="text-3xl lg:text-4xl font-display font-bold text-white mb-3 text-center lg:text-left">Lacak Status Pengaduan</h1>
        <nav class="flex items-center justify-center lg:justify-start space-x-2 text-sm">
            <a href="<?= base_url('/') ?>" class="text-white/80 hover:text-white transition-colors font-medium">Beranda</a>
            <svg class="w-4 h-4 text-white/60" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
            </svg>
            <a href="<?= base_url('lapor-keluhan') ?>" class="text-white/80 hover:text-white transition-colors font-medium">Lapor Keluhan</a>
            <svg class="w-4 h-4 text-white/60" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
            </svg>
            <span class="text-white font-semibold">Lacak Status</span>
        </nav>
    </div>
</section>

<!-- Main Tracking Section -->
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4 max-w-4xl">

        <!-- Header Banner -->
        <div class="bg-gradient-to-br from-primary-50 to-water-50 rounded-2xl p-8 mb-8 shadow-sm text-center">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-primary-100 rounded-full mb-4">
                <svg class="w-10 h-10 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            <h1 class="text-3xl lg:text-4xl font-display font-bold text-gray-900 mb-3">Lacak Status Pengaduan Anda</h1>
            <p class="text-gray-600">Masukkan nomor pengaduan untuk melihat status dan progress penanganan</p>
        </div>

        <!-- Search Form -->
        <div class="bg-white rounded-2xl shadow-lg p-8 mb-8" x-data="trackingForm()">
            <form @submit.prevent="searchPengaduan" class="space-y-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-3">Nomor Pengaduan</label>
                    <div class="relative">
                        <input
                            type="text"
                            x-model="noPengaduan"
                            placeholder="PGD/20260114/0001"
                            class="w-full px-5 py-4 pr-12 border-2 border-gray-200 rounded-xl focus:border-primary-500 focus:ring-4 focus:ring-primary-100 transition-all text-lg font-mono"
                            required>
                        <svg class="absolute right-4 top-1/2 -translate-y-1/2 w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14" />
                        </svg>
                    </div>
                    <p class="mt-2 text-sm text-gray-500">Format: PGD/YYYYMMDD/XXXX</p>
                </div>

                <button
                    type="submit"
                    :disabled="isSearching"
                    class="w-full inline-flex items-center justify-center space-x-2 px-8 py-4 bg-gradient-to-r from-primary-600 to-primary-700 text-white rounded-xl hover:from-primary-700 hover:to-primary-800 transition-all font-semibold shadow-lg shadow-primary-500/30 disabled:opacity-50 disabled:cursor-not-allowed">
                    <svg x-show="!isSearching" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <svg x-show="isSearching" class="animate-spin w-6 h-6" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span x-text="isSearching ? 'Mencari...' : 'Lacak Pengaduan'"></span>
                </button>
            </form>

            <!-- Result Section -->
            <div x-show="showResult" x-transition class="mt-8 pt-8 border-t-2 border-gray-100">

                <!-- Not Found -->
                <div x-show="!pengaduan" class="text-center py-8">
                    <svg class="w-20 h-20 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Pengaduan Tidak Ditemukan</h3>
                    <p class="text-gray-600 mb-6">Nomor pengaduan yang Anda masukkan tidak ditemukan dalam sistem</p>
                    <button @click="showResult = false; noPengaduan = ''" class="text-primary-600 hover:text-primary-700 font-semibold">Coba Lagi</button>
                </div>

                <!-- Found -->
                <template x-if="pengaduan">
                    <div class="space-y-6">
                        <!-- Status Badge -->
                        <div class="text-center">
                            <span
                                class="inline-flex items-center px-6 py-3 rounded-full text-lg font-bold"
                                :class="{
                                    'bg-amber-100 text-amber-700': pengaduan.status === 'pending',
                                    'bg-blue-100 text-blue-700': pengaduan.status === 'proses',
                                    'bg-green-100 text-green-700': pengaduan.status === 'selesai',
                                    'bg-red-100 text-red-700': pengaduan.status === 'ditolak'
                                }">
                                <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <circle cx="10" cy="10" r="8" />
                                </svg>
                                <span x-text="getStatusLabel(pengaduan.status)"></span>
                            </span>
                        </div>

                        <!-- Timeline -->
                        <div class="bg-gray-50 rounded-xl p-6">
                            <h3 class="font-bold text-gray-900 mb-6 text-lg">Timeline Pengaduan</h3>
                            <div class="relative">
                                <div class="absolute left-4 top-0 bottom-0 w-0.5 bg-gray-300"></div>
                                <div class="space-y-6">
                                    <!-- Submitted -->
                                    <div class="relative pl-12">
                                        <div class="absolute left-0 w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="font-semibold text-gray-900">Pengaduan Diterima</p>
                                            <p class="text-sm text-gray-600" x-text="formatDate(pengaduan.created_at)"></p>
                                        </div>
                                    </div>

                                    <!-- In Progress -->
                                    <div class="relative pl-12">
                                        <div
                                            class="absolute left-0 w-8 h-8 rounded-full flex items-center justify-center"
                                            :class="['proses', 'selesai'].includes(pengaduan.status) ? 'bg-blue-500' : 'bg-gray-300'">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p
                                                class="font-semibold"
                                                :class="['proses', 'selesai'].includes(pengaduan.status) ? 'text-gray-900' : 'text-gray-400'">
                                                Sedang Diproses
                                            </p>
                                            <p
                                                class="text-sm"
                                                :class="['proses', 'selesai'].includes(pengaduan.status) ? 'text-gray-600' : 'text-gray-400'"
                                                x-text="pengaduan.handled_at ? formatDate(pengaduan.handled_at) : 'Menunggu'">
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Resolved -->
                                    <div class="relative pl-12">
                                        <div
                                            class="absolute left-0 w-8 h-8 rounded-full flex items-center justify-center"
                                            :class="pengaduan.status === 'selesai' ? 'bg-green-500' : 'bg-gray-300'">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p
                                                class="font-semibold"
                                                :class="pengaduan.status === 'selesai' ? 'text-gray-900' : 'text-gray-400'">
                                                Selesai
                                            </p>
                                            <p
                                                class="text-sm"
                                                :class="pengaduan.status === 'selesai' ? 'text-gray-600' : 'text-gray-400'"
                                                x-text="pengaduan.resolved_at ? formatDate(pengaduan.resolved_at) : 'Belum selesai'">
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Detail Info -->
                        <div class="bg-white border-2 border-gray-200 rounded-xl p-6">
                            <h3 class="font-bold text-gray-900 mb-4 text-lg">Detail Pengaduan</h3>
                            <div class="space-y-4">
                                <div class="grid grid-cols-3 gap-2">
                                    <p class="text-sm text-gray-600">Nomor</p>
                                    <p class="col-span-2 font-semibold text-gray-900 font-mono" x-text="pengaduan.no_pengaduan"></p>
                                </div>
                                <div class="grid grid-cols-3 gap-2">
                                    <p class="text-sm text-gray-600">Nama</p>
                                    <p class="col-span-2 font-semibold text-gray-900" x-text="pengaduan.nm_lengkap"></p>
                                </div>
                                <div class="grid grid-cols-3 gap-2">
                                    <p class="text-sm text-gray-600">Kategori</p>
                                    <p class="col-span-2 font-semibold text-gray-900 capitalize" x-text="pengaduan.kategori.replace('_', ' ')"></p>
                                </div>
                                <div class="grid grid-cols-3 gap-2">
                                    <p class="text-sm text-gray-600">Prioritas</p>
                                    <span
                                        class="col-span-2 inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold w-fit"
                                        :class="{
                                            'bg-red-100 text-red-700': pengaduan.prioritas === 'tinggi',
                                            'bg-amber-100 text-amber-700': pengaduan.prioritas === 'normal',
                                            'bg-blue-100 text-blue-700': pengaduan.prioritas === 'rendah'
                                        }"
                                        x-text="pengaduan.prioritas.charAt(0).toUpperCase() + pengaduan.prioritas.slice(1)">
                                    </span>
                                </div>
                                <div class="pt-4 border-t border-gray-200">
                                    <p class="text-sm text-gray-600 mb-2">Isi Pengaduan</p>
                                    <p class="text-gray-900 leading-relaxed" x-text="pengaduan.isi_pengaduan"></p>
                                </div>
                                <template x-if="pengaduan.tanggapan">
                                    <div class="pt-4 border-t border-gray-200 bg-blue-50 -mx-6 -mb-6 px-6 py-4 rounded-b-xl">
                                        <div class="flex items-start space-x-3">
                                            <svg class="w-6 h-6 text-blue-600 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                            </svg>
                                            <div class="flex-1">
                                                <p class="text-sm font-semibold text-blue-900 mb-2">Tanggapan Petugas</p>
                                                <p class="text-sm text-blue-800 leading-relaxed" x-text="pengaduan.tanggapan"></p>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        <!-- Help Section -->
        <div class="bg-gradient-to-br from-green-50 to-emerald-50 border border-green-200 rounded-2xl p-8">
            <div class="flex flex-col md:flex-row items-center gap-6">
                <div class="flex-shrink-0">
                    <svg class="w-16 h-16 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
                <div class="flex-1 text-center md:text-left">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Butuh Bantuan?</h3>
                    <p class="text-gray-700 mb-4">Jika Anda kesulitan melacak pengaduan atau memerlukan bantuan lebih lanjut, hubungi kami:</p>
                    <div class="flex flex-col sm:flex-row gap-3 justify-center md:justify-start">
                        <a href="tel:+6282292754405" class="inline-flex items-center justify-center space-x-2 px-6 py-3 bg-green-600 hover:bg-green-700 text-white rounded-lg transition-all font-semibold">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <span>Telepon</span>
                        </a>
                        <a href="https://wa.me/6282292754405" target="_blank" class="inline-flex items-center justify-center space-x-2 px-6 py-3 bg-white border-2 border-green-600 text-green-600 hover:bg-green-50 rounded-lg transition-all font-semibold">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.890-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
                            </svg>
                            <span>WhatsApp</span>
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
    function trackingForm() {
        return {
            noPengaduan: '',
            isSearching: false,
            showResult: false,
            pengaduan: null,

            searchPengaduan() {
                if (!this.noPengaduan.trim()) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Nomor Pengaduan Kosong',
                        text: 'Masukkan nomor pengaduan',
                        confirmButtonColor: '#3b82f6'
                    });
                    return;
                }

                this.isSearching = true;
                this.showResult = false;

                fetch('<?= base_url('lapor-keluhan/check-status') ?>', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: new URLSearchParams({
                            no_pengaduan: this.noPengaduan
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        this.isSearching = false;
                        this.showResult = true;

                        if (data.success) {
                            this.pengaduan = data.data;
                        } else {
                            this.pengaduan = null;
                        }
                    })
                    .catch(() => {
                        this.isSearching = false;
                        Swal.fire({
                            icon: 'error',
                            title: 'Terjadi Kesalahan',
                            text: 'Periksa koneksi internet',
                            confirmButtonColor: '#3b82f6'
                        });
                    });
            },

            getStatusLabel(status) {
                const labels = {
                    'pending': 'Menunggu Verifikasi',
                    'proses': 'Sedang Diproses',
                    'selesai': 'Selesai',
                    'ditolak': 'Ditolak'
                };
                return labels[status] || status;
            },

            formatDate(dateString) {
                if (!dateString) return '-';
                const options = {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit'
                };
                return new Date(dateString).toLocaleDateString('id-ID', options) + ' WIB';
            }
        }
    }
</script>
<?= $this->endSection() ?>