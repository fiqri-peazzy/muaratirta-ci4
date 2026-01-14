<?= $this->extend('frontend/layouts/main') ?>

<?= $this->section('title') ?><?= $title ?? 'Lapor Keluhan' ?><?= $this->endSection() ?>

<?= $this->section('description') ?><?= $description ?? 'Laporkan keluhan atau gangguan layanan air PDAM Muara Tirta secara online' ?><?= $this->endSection() ?>

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

    .animate-fadeInUp {
        animation: fadeInUp 0.6s ease-out forwards;
    }

    .file-upload-area {
        transition: all 0.3s ease;
    }

    .file-upload-area:hover {
        border-color: #3b82f6;
        background-color: #eff6ff;
    }

    .file-upload-area.has-file {
        border-color: #10b981;
        background-color: #f0fdf4;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }

    .animate-spin {
        animation: spin 1s linear infinite;
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
        <h1 class="text-3xl lg:text-4xl font-display font-bold text-white mb-3 text-center lg:text-left">Lapor Keluhan</h1>
        <nav class="flex items-center justify-center lg:justify-start space-x-2 text-sm">
            <a href="<?= base_url('/') ?>" class="text-white/80 hover:text-white transition-colors font-medium">Beranda</a>
            <svg class="w-4 h-4 text-white/60" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
            </svg>
            <span class="text-white font-semibold">Lapor Keluhan</span>
        </nav>
    </div>
</section>

<!-- Main Form Section -->
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4 max-w-5xl">

        <!-- Header Banner -->
        <div class="bg-gradient-to-br from-primary-50 to-water-50 rounded-2xl p-8 mb-8 shadow-sm">
            <div class="flex flex-col lg:flex-row items-center gap-8">
                <div class="flex-shrink-0 w-48 h-48">
                    <script src="https://unpkg.com/@lottiefiles/dotlottie-wc@0.8.5/dist/dotlottie-wc.js" type="module"></script>
                    <dotlottie-wc src="https://lottie.host/e20386d5-f932-4265-91b0-001770e7b3d0/aKBuPw0vYQ.lottie" style="width: 100%; height: 100%" autoplay loop></dotlottie-wc>
                </div>
                <div class="flex-1 text-center lg:text-left">
                    <div class="inline-flex items-center space-x-2 bg-red-100 px-4 py-2 rounded-full mb-4">
                        <svg class="w-5 h-5 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z" />
                        </svg>
                        <span class="text-sm font-semibold text-red-700 uppercase tracking-wider">Pengaduan Online</span>
                    </div>
                    <h1 class="text-3xl lg:text-4xl font-display font-bold text-gray-900 mb-3 leading-tight">Laporkan Keluhan Anda</h1>
                    <p class="text-gray-600 leading-relaxed">Kami siap membantu menyelesaikan setiap keluhan dan gangguan pelayanan air Anda. Laporkan masalah secara online untuk respons yang lebih cepat.</p>
                </div>
            </div>
        </div>

        <!-- Form Container -->
        <div class="bg-white rounded-2xl shadow-sm p-8" x-data="pengaduanForm()">
            <form @submit.prevent="submitForm" id="pengaduanForm" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <div class="space-y-6">
                    <!-- Info Pelanggan (Optional) -->
                    <div class="bg-blue-50 border border-blue-200 rounded-xl p-6">
                        <div class="flex items-start space-x-3 mb-4">
                            <svg class="w-6 h-6 text-blue-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div class="flex-1">
                                <h3 class="font-semibold text-blue-900 mb-1">Informasi</h3>
                                <p class="text-sm text-blue-800">Jika Anda sudah terdaftar sebagai pelanggan, masukkan Nomor Pelanggan untuk mempercepat proses verifikasi.</p>
                            </div>
                        </div>
                        <input type="text" name="id_pel" id="id_pel" placeholder="Nomor Pelanggan (Opsional)" class="w-full px-4 py-3 border-2 border-blue-200 bg-white rounded-xl focus:border-primary-500 focus:ring-4 focus:ring-primary-100 transition-all">
                    </div>

                    <!-- Nama Lengkap -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_lengkap" id="nama_lengkap" required class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-primary-500 focus:ring-4 focus:ring-primary-100 transition-all" placeholder="Masukkan nama lengkap Anda">
                    </div>

                    <!-- No HP & Email Row -->
                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Nomor Telepon/HP <span class="text-red-500">*</span></label>
                            <input type="tel" name="no_hp" id="no_hp" required pattern="[0-9]{10,15}" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-primary-500 focus:ring-4 focus:ring-primary-100 transition-all" placeholder="08123456789">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                            <input type="email" name="email" id="email" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-primary-500 focus:ring-4 focus:ring-primary-100 transition-all" placeholder="nama@email.com">
                            <p class="mt-1 text-xs text-gray-500">Opsional</p>
                        </div>
                    </div>

                    <!-- Alamat -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Alamat Lengkap <span class="text-red-500">*</span></label>
                        <textarea name="alamat" id="alamat" rows="3" required class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-primary-500 focus:ring-4 focus:ring-primary-100 transition-all resize-none" placeholder="Masukkan alamat lengkap Anda..."></textarea>
                    </div>

                    <!-- Kategori Keluhan -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Kategori Keluhan <span class="text-red-500">*</span></label>
                        <select name="kategori" id="kategori" required class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-primary-500 focus:ring-4 focus:ring-primary-100 transition-all">
                            <option value="">Pilih kategori keluhan...</option>
                            <?php foreach ($categories as $key => $label): ?>
                                <option value="<?= esc($key) ?>"><?= esc($label) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Isi Pengaduan -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Isi Pengaduan/Keluhan <span class="text-red-500">*</span></label>
                        <textarea name="isi_pengaduan" id="isi_pengaduan" rows="6" required class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-primary-500 focus:ring-4 focus:ring-primary-100 transition-all resize-none" placeholder="Jelaskan keluhan Anda secara detail (minimal 20 karakter)..."></textarea>
                        <p class="mt-1 text-xs text-gray-500">Minimal 20 karakter</p>
                    </div>

                    <!-- Upload Foto -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Upload Foto Bukti <span class="text-red-500">*</span></label>
                        <div class="file-upload-area border-2 border-dashed border-gray-300 rounded-xl p-8 text-center cursor-pointer" @click="$refs.fotoBukti.click()">
                            <input type="file" name="foto" id="foto" x-ref="fotoBukti" accept="image/*" required class="hidden" @change="handleFileUpload($event)">
                            <div x-show="!uploadedFile">
                                <svg class="w-12 h-12 mx-auto text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <p class="font-medium text-gray-700">Klik atau seret foto bukti keluhan</p>
                                <p class="text-sm text-gray-500 mt-1">Format: JPG, PNG (Max: 2MB)</p>
                            </div>
                            <div x-show="uploadedFile" class="flex items-center justify-center space-x-2">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="font-medium text-green-600" x-text="uploadedFile"></span>
                            </div>
                        </div>
                    </div>

                    <!-- Info Contact -->
                    <div class="bg-green-50 border border-green-200 rounded-xl p-6">
                        <div class="flex items-start space-x-4">
                            <svg class="w-6 h-6 text-green-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <div class="flex-1">
                                <h4 class="font-semibold text-green-900 mb-2">Perlu Bantuan Segera?</h4>
                                <p class="text-sm text-green-800">Hubungi Call Center: <strong class="font-bold">+62 822-9275-4405</strong> (Telp/WA) untuk penanganan darurat</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="mt-8 pt-6 border-t-2 border-gray-100">
                    <button type="submit" :disabled="isSubmitting" class="w-full inline-flex items-center justify-center space-x-2 px-8 py-4 bg-gradient-to-r from-red-600 to-red-700 text-white rounded-xl hover:from-red-700 hover:to-red-800 transition-all font-semibold shadow-lg shadow-red-500/30 disabled:opacity-50 disabled:cursor-not-allowed">
                        <svg x-show="!isSubmitting" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                        </svg>
                        <svg x-show="isSubmitting" class="animate-spin w-5 h-5" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span x-text="isSubmitting ? 'Mengirim Pengaduan...' : 'Kirim Pengaduan'"></span>
                    </button>
                    <p class="text-center text-sm text-gray-500 mt-4">Dengan mengirim, Anda menyetujui pengaduan ini akan diproses oleh tim kami</p>
                </div>
            </form>
        </div>

        <!-- Tracking Link -->
        <div class="mt-6 text-center">
            <a href="<?= base_url('lapor-keluhan/tracking') ?>" class="inline-flex items-center space-x-2 text-primary-600 hover:text-primary-700 font-medium">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <span>Lacak Status Pengaduan Anda</span>
            </a>
        </div>
    </div>
</section>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function pengaduanForm() {
        return {
            isSubmitting: false,
            uploadedFile: null,

            handleFileUpload(event) {
                const file = event.target.files[0];
                if (!file) return;

                if (file.size > 2 * 1024 * 1024) {
                    Swal.fire({
                        icon: 'error',
                        title: 'File Terlalu Besar',
                        text: 'Ukuran file maksimal 2MB',
                        confirmButtonColor: '#3b82f6'
                    });
                    event.target.value = '';
                    return;
                }

                if (!file.type.startsWith('image/')) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Format File Salah',
                        text: 'File harus berupa gambar',
                        confirmButtonColor: '#3b82f6'
                    });
                    event.target.value = '';
                    return;
                }

                this.uploadedFile = file.name;
                event.target.closest('.file-upload-area').classList.add('has-file');
            },

            submitForm() {
                if (!this.validateForm()) return;

                this.isSubmitting = true;
                const formData = new FormData(document.getElementById('pengaduanForm'));

                fetch('<?= base_url('lapor-keluhan/submit') ?>', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        this.isSubmitting = false;
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Pengaduan Berhasil Dikirim!',
                                html: `<p class="mb-2">Nomor Pengaduan Anda:</p><p class="text-2xl font-bold text-red-600">${data.no_pengaduan}</p><p class="mt-3 text-sm text-gray-600">Simpan nomor ini untuk melacak status pengaduan</p>`,
                                confirmButtonColor: '#3b82f6',
                                confirmButtonText: 'Lihat Detail'
                            }).then(() => window.location.href = data.redirect);
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Pengaduan Gagal',
                                text: data.message || 'Terjadi kesalahan',
                                confirmButtonColor: '#3b82f6'
                            });
                        }
                    })
                    .catch(() => {
                        this.isSubmitting = false;
                        Swal.fire({
                            icon: 'error',
                            title: 'Terjadi Kesalahan',
                            text: 'Periksa koneksi internet Anda',
                            confirmButtonColor: '#3b82f6'
                        });
                    });
            },

            validateForm() {
                const fields = ['nama_lengkap', 'no_hp', 'alamat', 'kategori', 'isi_pengaduan'];
                for (let field of fields) {
                    const el = document.getElementById(field);
                    if (!el.value.trim()) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Data Belum Lengkap',
                            text: `${el.previousElementSibling.textContent} wajib diisi`,
                            confirmButtonColor: '#3b82f6'
                        });
                        return false;
                    }
                }

                const isiPengaduan = document.getElementById('isi_pengaduan').value.trim();
                if (isiPengaduan.length < 20) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Isi Pengaduan Terlalu Singkat',
                        text: 'Isi pengaduan minimal 20 karakter',
                        confirmButtonColor: '#3b82f6'
                    });
                    return false;
                }

                if (!this.uploadedFile) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Foto Belum Diupload',
                        text: 'Mohon upload foto bukti keluhan',
                        confirmButtonColor: '#3b82f6'
                    });
                    return false;
                }

                return true;
            }
        }
    }
</script>
<?= $this->endSection() ?>