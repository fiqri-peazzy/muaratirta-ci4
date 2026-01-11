<?= $this->extend('frontend/layouts/main') ?>

<?= $this->section('title') ?>
<?= $title ?? 'Lacak Status Pendaftaran' ?>
<?= $this->endSection() ?>

<?= $this->section('description') ?>
<?= $description ?? 'Cek status pendaftaran pasang baru Anda' ?>
<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<style>
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

    @keyframes pulse {

        0%,
        100% {
            opacity: 1;
        }

        50% {
            opacity: 0.5;
        }
    }

    .animate-fadeInUp {
        animation: fadeInUp 0.6s ease-out forwards;
    }

    .animate-pulse-slow {
        animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }

    /* Timeline Styles */
    .timeline-item {
        position: relative;
    }

    .timeline-item::before {
        content: '';
        position: absolute;
        left: 1.25rem;
        top: 3rem;
        bottom: -1rem;
        width: 2px;
        background: #e5e7eb;
    }

    .timeline-item:last-child::before {
        display: none;
    }

    .timeline-item.active::before {
        background: linear-gradient(to bottom, #3b82f6 0%, #e5e7eb 100%);
    }

    .timeline-item.completed::before {
        background: #10b981;
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
            Lacak Status Pendaftaran
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
            <span class="text-white font-semibold">Tracking</span>
        </nav>
    </div>
</section>

<!-- Main Content -->
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4 max-w-4xl">

        <!-- Search Form -->
        <div class="bg-white rounded-2xl shadow-lg p-8 mb-8 animate-fadeInUp" x-data="trackingForm()">
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-primary-100 rounded-full mb-4">
                    <svg class="w-10 h-10 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <h2 class="text-2xl font-display font-bold text-gray-900 mb-2">
                    Cek Status Pendaftaran
                </h2>
                <p class="text-gray-600">
                    Masukkan nomor pendaftaran Anda untuk melihat status terkini
                </p>
            </div>

            <form @submit.prevent="checkStatus()" class="max-w-xl mx-auto">
                <?= csrf_field() ?>
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Nomor Pendaftaran
                    </label>
                    <div class="relative">
                        <input
                            type="text"
                            x-model="noPendaftaran"
                            placeholder="Contoh: PB-2025-0001"
                            class="w-full px-4 py-3 pl-12 border-2 border-gray-200 rounded-xl focus:border-primary-500 focus:ring-4 focus:ring-primary-100 transition-all"
                            required>
                        <div class="absolute left-4 top-1/2 -translate-y-1/2">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14" />
                            </svg>
                        </div>
                    </div>
                    <p class="mt-2 text-xs text-gray-500">
                        Format: PB-TAHUN-NOMOR (contoh: PB-2025-0001)
                    </p>
                </div>

                <button
                    type="submit"
                    :disabled="isLoading"
                    class="w-full flex items-center justify-center space-x-2 px-6 py-4 bg-gradient-to-r from-primary-600 to-primary-700 text-white rounded-xl hover:from-primary-700 hover:to-primary-800 transition-all font-semibold shadow-lg shadow-primary-500/30 disabled:opacity-50 disabled:cursor-not-allowed">
                    <svg x-show="!isLoading" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <svg x-show="isLoading" class="animate-spin w-5 h-5" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span x-text="isLoading ? 'Mencari...' : 'Cek Status'"></span>
                </button>
            </form>
        </div>

        <!-- Result Section -->
        <div
            id="resultSection"
            class="hidden"
            x-data="trackingResult()">

            <!-- Status Card -->
            <div class="bg-white rounded-2xl shadow-lg p-8 mb-6 animate-fadeInUp">
                <div class="flex items-center justify-between mb-6 pb-6 border-b-2 border-gray-100">
                    <div>
                        <p class="text-sm font-semibold text-gray-600 uppercase tracking-wider mb-1">
                            Nomor Pendaftaran
                        </p>
                        <p class="text-2xl font-display font-bold text-primary-600" id="displayNoPendaftaran">
                            -
                        </p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-semibold text-gray-600 uppercase tracking-wider mb-1">
                            Tanggal Daftar
                        </p>
                        <p class="text-lg font-semibold text-gray-900" id="displayTanggal">
                            -
                        </p>
                    </div>
                </div>

                <!-- Current Status Badge -->
                <div class="mb-6">
                    <div class="inline-flex items-center space-x-2 px-4 py-2 rounded-full" id="statusBadge">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="font-semibold" id="statusLabel">-</span>
                    </div>
                </div>

                <!-- Personal Info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="p-4 bg-gray-50 rounded-xl">
                        <p class="text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1">Nama Lengkap</p>
                        <p class="font-semibold text-gray-900" id="displayNama">-</p>
                    </div>
                    <div class="p-4 bg-gray-50 rounded-xl">
                        <p class="text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1">Nomor Telepon</p>
                        <p class="font-semibold text-gray-900" id="displayNoHp">-</p>
                    </div>
                    <div class="md:col-span-2 p-4 bg-gray-50 rounded-xl">
                        <p class="text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1">Alamat Pemasangan</p>
                        <p class="font-medium text-gray-900" id="displayAlamat">-</p>
                    </div>
                </div>
            </div>

            <!-- Timeline -->
            <div class="bg-white rounded-2xl shadow-lg p-8 mb-6 animate-fadeInUp">
                <h3 class="text-xl font-display font-bold text-gray-900 mb-6 flex items-center">
                    <svg class="w-6 h-6 text-primary-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                    </svg>
                    Progress Pendaftaran
                </h3>

                <div class="space-y-6" id="timelineContainer">
                    <!-- Timeline items will be inserted here -->
                </div>
            </div>

            <!-- Notes Section -->
            <div id="notesSection" class="hidden bg-amber-50 border border-amber-200 rounded-2xl p-6 mb-6 animate-fadeInUp">
                <div class="flex items-start space-x-3">
                    <svg class="w-6 h-6 text-amber-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div class="flex-1">
                        <h4 class="font-semibold text-amber-900 mb-1">Catatan</h4>
                        <p class="text-sm text-amber-800" id="notesText">-</p>
                    </div>
                </div>
            </div>

            <!-- Rejection Section -->
            <div id="rejectionSection" class="hidden bg-red-50 border border-red-200 rounded-2xl p-6 mb-6 animate-fadeInUp">
                <div class="flex items-start space-x-3">
                    <svg class="w-6 h-6 text-red-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div class="flex-1">
                        <h4 class="font-semibold text-red-900 mb-1">Alasan Penolakan</h4>
                        <p class="text-sm text-red-800" id="rejectionText">-</p>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex flex-col sm:flex-row gap-4">
                <button
                    onclick="window.print()"
                    class="flex items-center justify-center space-x-2 px-6 py-3 bg-white border-2 border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition-all font-semibold">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                    </svg>
                    <span>Cetak Status</span>
                </button>
                <button
                    onclick="location.reload()"
                    class="flex items-center justify-center space-x-2 px-6 py-3 bg-primary-600 text-white rounded-xl hover:bg-primary-700 transition-all font-semibold">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <span>Cek Nomor Lain</span>
                </button>
            </div>
        </div>

        <!-- Info Help -->
        <div class="bg-gradient-to-br from-blue-50 to-water-50 rounded-2xl p-6 border border-blue-200 animate-fadeInUp">
            <div class="flex items-start space-x-4">
                <div class="flex-shrink-0">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="flex-1">
                    <h4 class="font-semibold text-gray-900 mb-2">Informasi</h4>
                    <ul class="text-sm text-gray-600 space-y-1">
                        <li>• Proses verifikasi membutuhkan waktu 1-2 hari kerja</li>
                        <li>• Anda akan dihubungi via telepon/WhatsApp untuk jadwal survei</li>
                        <li>• Status akan diperbarui secara berkala</li>
                        <li>• Simpan nomor pendaftaran Anda dengan baik</li>
                    </ul>
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
            noPendaftaran: '',
            isLoading: false,

            async checkStatus() {
                if (!this.noPendaftaran.trim()) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Nomor Pendaftaran Kosong',
                        text: 'Mohon masukkan nomor pendaftaran',
                        confirmButtonColor: '#3b82f6'
                    });
                    return;
                }

                this.isLoading = true;

                try {
                    const response = await fetch('<?= base_url('pasang-baru/check-status') ?>', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: 'no_pendaftaran=' + encodeURIComponent(this.noPendaftaran) + '&<?= csrf_token() ?>=' + '<?= csrf_hash() ?>'
                    });

                    const data = await response.json();

                    this.isLoading = false;

                    if (data.success) {
                        displayResult(data.data);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Data Tidak Ditemukan',
                            text: data.message || 'Nomor pendaftaran tidak ditemukan',
                            confirmButtonColor: '#3b82f6'
                        });
                    }
                } catch (error) {
                    this.isLoading = false;
                    Swal.fire({
                        icon: 'error',
                        title: 'Terjadi Kesalahan',
                        text: 'Gagal memeriksa status, silakan coba lagi',
                        confirmButtonColor: '#3b82f6'
                    });
                }
            }
        }
    }

    function trackingResult() {
        return {}
    }

    function displayResult(data) {
        // Show result section
        document.getElementById('resultSection').classList.remove('hidden');

        // Scroll to result
        document.getElementById('resultSection').scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        });

        // Fill data
        document.getElementById('displayNoPendaftaran').textContent = data.no_pendaftaran;
        document.getElementById('displayTanggal').textContent = data.tanggal_daftar;
        document.getElementById('displayNama').textContent = data.nama_lengkap;
        document.getElementById('displayNoHp').textContent = data.no_hp;
        document.getElementById('displayAlamat').textContent = data.alamat_pemasangan;

        // Status badge
        const statusBadge = document.getElementById('statusBadge');
        const statusLabel = document.getElementById('statusLabel');
        const statusColors = {
            'pending': 'bg-amber-100 text-amber-700',
            'verifikasi': 'bg-blue-100 text-blue-700',
            'approved': 'bg-green-100 text-green-700',
            'survey': 'bg-purple-100 text-purple-700',
            'rejected': 'bg-red-100 text-red-700'
        };

        statusBadge.className = 'inline-flex items-center space-x-2 px-4 py-2 rounded-full ' + (statusColors[data.status] || 'bg-gray-100 text-gray-700');
        statusLabel.textContent = data.status_label;

        // Timeline
        buildTimeline(data.status);

        // Notes
        if (data.catatan_admin) {
            document.getElementById('notesSection').classList.remove('hidden');
            document.getElementById('notesText').textContent = data.catatan_admin;
        }

        // Rejection
        if (data.status === 'rejected' && data.catatan_penolakan) {
            document.getElementById('rejectionSection').classList.remove('hidden');
            document.getElementById('rejectionText').textContent = data.catatan_penolakan;
        }
    }

    function buildTimeline(currentStatus) {
        const container = document.getElementById('timelineContainer');

        const statuses = [{
                key: 'pending',
                label: 'Menunggu Verifikasi',
                icon: 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'
            },
            {
                key: 'verifikasi',
                label: 'Sedang Diverifikasi',
                icon: 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'
            },
            {
                key: 'approved',
                label: 'Disetujui',
                icon: 'M5 13l4 4L19 7'
            },
            {
                key: 'survey',
                label: 'Proses Survey Lokasi',
                icon: 'M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z'
            }
        ];

        const statusIndex = statuses.findIndex(s => s.key === currentStatus);

        container.innerHTML = statuses.map((status, index) => {
            const isCompleted = index < statusIndex;
            const isActive = index === statusIndex;
            const isPending = index > statusIndex;

            let itemClass = 'timeline-item';
            if (isCompleted) itemClass += ' completed';
            if (isActive) itemClass += ' active';

            let circleClass = 'w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0';
            if (isCompleted) circleClass += ' bg-green-600';
            else if (isActive) circleClass += ' bg-primary-600 animate-pulse-slow';
            else circleClass += ' bg-gray-300';

            return `
            <div class="${itemClass}">
                <div class="flex items-start space-x-4">
                    <div class="${circleClass}">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="${status.icon}"/>
                        </svg>
                    </div>
                    <div class="flex-1 pt-1">
                        <p class="font-semibold text-gray-900">${status.label}</p>
                        <p class="text-sm text-gray-500 mt-1">
                            ${isCompleted ? 'Selesai' : isActive ? 'Sedang diproses' : 'Menunggu'}
                        </p>
                    </div>
                </div>
            </div>
        `;
        }).join('');
    }
</script>
<?= $this->endSection() ?>