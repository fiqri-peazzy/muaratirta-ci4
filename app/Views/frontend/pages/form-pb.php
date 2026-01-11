<?= $this->extend('frontend/layouts/main') ?>

<?= $this->section('title') ?>
<?= $title ?? 'Pendaftaran Pasang Baru' ?>
<?= $this->endSection() ?>

<?= $this->section('description') ?>
<?= $description ?? 'Daftar pemasangan sambungan air bersih PDAM Muara Tirta secara online' ?>
<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<style>
    /* Custom animations */
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

    @keyframes scaleIn {
        from {
            opacity: 0;
            transform: scale(0.95);
        }

        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(-20px);
        }

        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .animate-fadeInUp {
        animation: fadeInUp 0.6s ease-out forwards;
    }

    .animate-scaleIn {
        animation: scaleIn 0.5s ease-out forwards;
    }

    .animate-slideInRight {
        animation: slideInRight 0.5s ease-out forwards;
    }

    /* Progress bar animation */
    .progress-bar {
        transition: width 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* File upload styles */
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

    /* Checkbox custom */
    input[type="checkbox"]:checked {
        background-color: #3b82f6;
        border-color: #3b82f6;
    }

    /* Smooth scroll */
    html {
        scroll-behavior: smooth;
    }

    /* Loading spinner */
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
<section class="relative pt-24 pb-8 pl-40 bg-gradient-to-r from-primary-600 to-water-500 overflow-hidden">
    <!-- Wave Pattern Background -->
    <div class="absolute inset-0 opacity-20">
        <svg class="absolute bottom-0 w-full h-32" viewBox="0 0 1440 320" xmlns="http://www.w3.org/2000/svg">
            <path fill="#ffffff" fill-opacity="0.3" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,112C672,96,768,96,864,112C960,128,1056,160,1152,160C1248,160,1344,128,1392,112L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
        </svg>
        <svg class="absolute bottom-0 w-full h-24 animate-pulse" viewBox="0 0 1440 320" xmlns="http://www.w3.org/2000/svg">
            <path fill="#ffffff" fill-opacity="0.2" d="M0,192L48,176C96,160,192,128,288,133.3C384,139,480,181,576,186.7C672,192,768,160,864,138.7C960,117,1056,107,1152,122.7C1248,139,1344,181,1392,202.7L1440,224L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
        </svg>
    </div>

    <!-- Water Drops Pattern -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-4 left-1/4 w-2 h-2 bg-white rounded-full animate-bounce" style="animation-delay: 0.1s;"></div>
        <div class="absolute top-8 right-1/3 w-3 h-3 bg-white rounded-full animate-bounce" style="animation-delay: 0.3s;"></div>
        <div class="absolute top-12 left-1/2 w-2 h-2 bg-white rounded-full animate-bounce" style="animation-delay: 0.5s;"></div>
        <div class="absolute top-6 right-1/4 w-2 h-2 bg-white rounded-full animate-bounce" style="animation-delay: 0.7s;"></div>
    </div>

    <div class="container mx-auto px-4 relative z-10">
        <!-- Title -->
        <h1 class="text-3xl lg:text-4xl font-display font-bold text-white mb-3 text-center lg:text-left">
            Pasang Baru
        </h1>

        <!-- Breadcrumb Navigation -->
        <nav class="flex items-center justify-center lg:justify-start space-x-2 text-sm">
            <a href="<?= base_url('/') ?>" class="text-white/80 hover:text-white transition-colors font-medium">
                Beranda
            </a>
            <svg class="w-4 h-4 text-white/60" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
            </svg>
            <span class="text-white font-semibold">Pasang Baru</span>
        </nav>
    </div>
</section>

<!-- Main Form Section -->
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4 max-w-6xl">

        <!-- Header with Lottie Animation -->
        <div class="bg-gradient-to-br from-primary-50 to-water-50 rounded-2xl p-8 mb-8 shadow-sm">
            <div class="flex flex-col lg:flex-row items-center gap-8">
                <!-- Lottie Animation -->
                <div class="flex-shrink-0 w-48 h-48">
                    <script src="https://unpkg.com/@lottiefiles/dotlottie-wc@0.8.5/dist/dotlottie-wc.js" type="module"></script>
                    <dotlottie-wc
                        src="https://lottie.host/188d39df-296b-4795-b2b7-8a10f7ef4145/eNuxuAbH6X.lottie"
                        style="width: 100%; height: 100%;"
                        autoplay
                        loop>
                    </dotlottie-wc>
                </div>

                <!-- Header Text -->
                <div class="flex-1 text-center lg:text-left">
                    <div class="inline-flex items-center space-x-2 bg-primary-100 px-4 py-2 rounded-full mb-4">
                        <svg class="w-5 h-5 text-primary-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-sm font-semibold text-primary-700 uppercase tracking-wider">Registrasi Online</span>
                    </div>
                    <h1 class="text-3xl lg:text-4xl font-display font-bold text-gray-900 mb-3 leading-tight">
                        Pendaftaran Pemasangan Sambungan Baru
                    </h1>
                    <p class="text-gray-600 leading-relaxed">
                        Proses pendaftaran mudah dan cepat. Lengkapi formulir di bawah ini untuk mendapatkan sambungan air bersih PDAM Muara Tirta.
                    </p>
                </div>
            </div>
        </div>

        <!-- Step Progress -->
        <div class="bg-white rounded-2xl shadow-sm p-8 mb-8" x-data="formStepper()">

            <!-- Progress Bar -->
            <div class="mb-12">
                <div class="flex justify-between mb-4">
                    <template x-for="(step, index) in steps" :key="index">
                        <div class="flex flex-col items-center flex-1">
                            <!-- Step Circle -->
                            <div
                                class="relative flex items-center justify-center w-12 h-12 rounded-full border-2 transition-all duration-300 mb-3"
                                :class="currentStep > index + 1 ? 'bg-primary-600 border-primary-600' : 
                                        currentStep === index + 1 ? 'bg-primary-600 border-primary-600 ring-4 ring-primary-100' : 
                                        'bg-white border-gray-300'">
                                <!-- Checkmark for completed -->
                                <svg
                                    x-show="currentStep > index + 1"
                                    class="w-6 h-6 text-white"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                </svg>
                                <!-- Number for current/upcoming -->
                                <span
                                    x-show="currentStep <= index + 1"
                                    class="text-sm font-bold"
                                    :class="currentStep === index + 1 ? 'text-white' : 'text-gray-400'"
                                    x-text="index + 1">
                                </span>

                                <!-- Connector Line -->
                                <div
                                    x-show="index < steps.length - 1"
                                    class="absolute left-full top-1/2 -translate-y-1/2 h-0.5 bg-gray-300 transition-all duration-300"
                                    :class="currentStep > index + 1 ? 'bg-primary-600' : ''"
                                    :style="`width: calc(100vw / ${steps.length} - 3rem)`">
                                </div>
                            </div>

                            <!-- Step Label -->
                            <div class="text-center">
                                <div
                                    class="text-xs font-semibold transition-colors duration-300"
                                    :class="currentStep === index + 1 ? 'text-primary-600' : 
                                            currentStep > index + 1 ? 'text-gray-900' : 
                                            'text-gray-400'"
                                    x-text="step.title">
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>

            <!-- Form -->
            <form @submit.prevent="submitForm" id="pasangBaruForm" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <!-- Step 1: Persyaratan -->
                <div x-show="currentStep === 1" x-transition class="animate-fadeInUp">
                    <h2 class="text-2xl font-display font-bold text-gray-900 mb-6 flex items-center">
                        <svg class="w-7 h-7 text-primary-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Persyaratan Pendaftaran
                    </h2>

                    <div class="space-y-4 mb-8">
                        <!-- Requirement Item 1 -->
                        <div class="flex items-start space-x-4 p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors">
                            <div class="flex-shrink-0 w-10 h-10 bg-gradient-to-br from-primary-500 to-primary-600 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h3 class="font-semibold text-gray-900 mb-1">Foto KTP Asli</h3>
                                <p class="text-sm text-gray-600">Scan atau foto KTP yang masih berlaku dengan jelas dan tidak blur</p>
                            </div>
                        </div>

                        <!-- Requirement Item 2 -->
                        <div class="flex items-start space-x-4 p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors">
                            <div class="flex-shrink-0 w-10 h-10 bg-gradient-to-br from-water-500 to-water-600 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h3 class="font-semibold text-gray-900 mb-1">Foto Rumah Tampak Depan</h3>
                                <p class="text-sm text-gray-600">Foto bagian depan rumah yang akan dipasang sambungan air</p>
                            </div>
                        </div>

                        <!-- Requirement Item 3 -->
                        <div class="flex items-start space-x-4 p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors">
                            <div class="flex-shrink-0 w-10 h-10 bg-gradient-to-br from-green-500 to-green-600 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h3 class="font-semibold text-gray-900 mb-1">Alamat Lengkap dengan GPS</h3>
                                <p class="text-sm text-gray-600">Alamat lengkap beserta koordinat lokasi pemasangan</p>
                            </div>
                        </div>

                        <!-- Requirement Item 4 -->
                        <div class="flex items-start space-x-4 p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors">
                            <div class="flex-shrink-0 w-10 h-10 bg-gradient-to-br from-purple-500 to-purple-600 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h3 class="font-semibold text-gray-900 mb-1">Nomor Telepon/WhatsApp Aktif</h3>
                                <p class="text-sm text-gray-600">Nomor yang dapat dihubungi untuk konfirmasi dan informasi lebih lanjut</p>
                            </div>
                        </div>
                    </div>

                    <!-- Info Box -->
                    <div class="bg-amber-50 border border-amber-200 rounded-xl p-6">
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0">
                                <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-semibold text-amber-900 mb-2">Biaya Administrasi</h4>
                                <p class="text-sm text-amber-800 leading-relaxed">
                                    Calon pelanggan dikenakan biaya administrasi pendaftaran sebesar <strong>Rp 20.000</strong>.
                                    Biaya ini sudah termasuk proses verifikasi dan survei lokasi.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 2: Data Pribadi -->
                <div x-show="currentStep === 2" x-transition class="animate-fadeInUp">
                    <h2 class="text-2xl font-display font-bold text-gray-900 mb-6 flex items-center">
                        <svg class="w-7 h-7 text-primary-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Data Pribadi
                    </h2>

                    <div class="space-y-6">
                        <!-- Nama Lengkap -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Nama Lengkap <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="text"
                                name="nama_lengkap"
                                id="nama_lengkap"
                                required
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-primary-500 focus:ring-4 focus:ring-primary-100 transition-all"
                                placeholder="Masukkan nama lengkap sesuai KTP">
                        </div>

                        <!-- NIK -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                NIK (Nomor Induk Kependudukan)
                            </label>
                            <input
                                type="text"
                                name="nik"
                                id="nik"
                                maxlength="16"
                                pattern="[0-9]{16}"
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-primary-500 focus:ring-4 focus:ring-primary-100 transition-all"
                                placeholder="16 digit NIK">
                            <p class="mt-1 text-xs text-gray-500">Opsional - 16 digit angka</p>
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Email
                            </label>
                            <input
                                type="email"
                                name="email"
                                id="email"
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-primary-500 focus:ring-4 focus:ring-primary-100 transition-all"
                                placeholder="nama@email.com">
                            <p class="mt-1 text-xs text-gray-500">Opsional - untuk notifikasi via email</p>
                        </div>

                        <!-- No HP -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Nomor Telepon/HP <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="tel"
                                name="no_hp"
                                id="no_hp"
                                required
                                pattern="[0-9]{10,15}"
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-primary-500 focus:ring-4 focus:ring-primary-100 transition-all"
                                placeholder="08123456789">
                        </div>

                        <!-- No WA -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Nomor WhatsApp
                            </label>
                            <input
                                type="tel"
                                name="no_wa"
                                id="no_wa"
                                pattern="[0-9]{10,15}"
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-primary-500 focus:ring-4 focus:ring-primary-100 transition-all"
                                placeholder="Kosongkan jika sama dengan No. HP">
                            <p class="mt-1 text-xs text-gray-500">Opsional - Kosongkan jika sama dengan nomor HP</p>
                        </div>
                    </div>
                </div>

                <!-- Step 3: Upload & Lokasi -->
                <div x-show="currentStep === 3" x-transition class="animate-fadeInUp">
                    <h2 class="text-2xl font-display font-bold text-gray-900 mb-6 flex items-center">
                        <svg class="w-7 h-7 text-primary-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                        </svg>
                        Upload Dokumen & Lokasi
                    </h2>

                    <div class="space-y-6">
                        <!-- Upload KTP -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Upload Foto KTP <span class="text-red-500">*</span>
                            </label>
                            <div class="file-upload-area border-2 border-dashed border-gray-300 rounded-xl p-8 text-center cursor-pointer"
                                @click="$refs.fotoKTP.click()">
                                <input
                                    type="file"
                                    name="foto_ktp"
                                    id="foto_ktp"
                                    x-ref="fotoKTP"
                                    accept="image/*"
                                    required
                                    class="hidden"
                                    @change="handleFileUpload($event, 'ktp')">
                                <div x-show="!uploadedFiles.ktp">
                                    <svg class="w-12 h-12 mx-auto text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                    </svg>
                                    <p class="font-medium text-gray-700">Klik atau seret file KTP</p>
                                    <p class="text-sm text-gray-500 mt-1">Format: JPG, PNG (Max: 2MB)</p>
                                </div>
                                <div x-show="uploadedFiles.ktp" class="flex items-center justify-center space-x-2">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span class="font-medium text-green-600" x-text="uploadedFiles.ktp"></span>
                                </div>
                            </div>
                        </div>

                        <!-- Upload Rumah -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Upload Foto Rumah <span class="text-red-500">*</span>
                            </label>
                            <div class="file-upload-area border-2 border-dashed border-gray-300 rounded-xl p-8 text-center cursor-pointer"
                                @click="$refs.fotoRumah.click()">
                                <input
                                    type="file"
                                    name="foto_rumah"
                                    id="foto_rumah"
                                    x-ref="fotoRumah"
                                    accept="image/*"
                                    required
                                    class="hidden"
                                    @change="handleFileUpload($event, 'rumah')">
                                <div x-show="!uploadedFiles.rumah">
                                    <svg class="w-12 h-12 mx-auto text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                    <p class="font-medium text-gray-700">Klik atau seret foto rumah</p>
                                    <p class="text-sm text-gray-500 mt-1">Format: JPG, PNG (Max: 2MB)</p>
                                </div>
                                <div x-show="uploadedFiles.rumah" class="flex items-center justify-center space-x-2">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span class="font-medium text-green-600" x-text="uploadedFiles.rumah"></span>
                                </div>
                            </div>
                        </div>

                        <!-- Alamat -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Alamat Pemasangan Lengkap <span class="text-red-500">*</span>
                            </label>
                            <textarea
                                name="alamat_pemasangan"
                                id="alamat_pemasangan"
                                rows="4"
                                required
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-primary-500 focus:ring-4 focus:ring-primary-100 transition-all resize-none"
                                placeholder="Masukkan alamat lengkap lokasi pemasangan..."></textarea>

                            <input type="hidden" name="latitude" id="latitude">
                            <input type="hidden" name="longitude" id="longitude">

                            <button
                                type="button"
                                @click="getLocation()"
                                class="mt-3 inline-flex items-center space-x-2 px-4 py-2 bg-white border-2 border-primary-600 text-primary-600 rounded-lg hover:bg-primary-50 transition-all font-medium">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span>Dapatkan Lokasi Saya</span>
                            </button>

                            <div x-show="loadingLocation" class="inline-flex items-center space-x-2 ml-3 text-primary-600">
                                <svg class="animate-spin w-5 h-5" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                <span class="text-sm">Mendapatkan lokasi...</span>
                            </div>
                        </div>

                        <!-- RT/RW Row -->
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">RT</label>
                                <input
                                    type="text"
                                    name="rt"
                                    id="rt"
                                    maxlength="5"
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-primary-500 focus:ring-4 focus:ring-primary-100 transition-all"
                                    placeholder="001">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">RW</label>
                                <input
                                    type="text"
                                    name="rw"
                                    id="rw"
                                    maxlength="5"
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-primary-500 focus:ring-4 focus:ring-primary-100 transition-all"
                                    placeholder="001">
                            </div>
                        </div>

                        <!-- Kelurahan/Kecamatan Row -->
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Kelurahan</label>
                                <input
                                    type="text"
                                    name="kelurahan"
                                    id="kelurahan"
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-primary-500 focus:ring-4 focus:ring-primary-100 transition-all"
                                    placeholder="Nama Kelurahan">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Kecamatan</label>
                                <input
                                    type="text"
                                    name="kecamatan"
                                    id="kecamatan"
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-primary-500 focus:ring-4 focus:ring-primary-100 transition-all"
                                    placeholder="Nama Kecamatan">
                            </div>
                        </div>

                        <!-- Info Box -->
                        <div class="bg-blue-50 border border-blue-200 rounded-xl p-6">
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-semibold text-blue-900 mb-2">Tips Upload Dokumen</h4>
                                    <ul class="text-sm text-blue-800 space-y-1">
                                        <li>• Pastikan foto terlihat jelas dan tidak blur</li>
                                        <li>• Hindari pantulan cahaya yang berlebihan</li>
                                        <li>• Gunakan pencahayaan yang cukup</li>
                                        <li>• Pastikan seluruh area dokumen/rumah terlihat</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 4: Konfirmasi -->
                <div x-show="currentStep === 4" x-transition class="animate-fadeInUp">
                    <h2 class="text-2xl font-display font-bold text-gray-900 mb-6 flex items-center">
                        <svg class="w-7 h-7 text-primary-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Konfirmasi & Persetujuan
                    </h2>

                    <!-- Syarat & Ketentuan -->
                    <div class="bg-amber-50 border-2 border-amber-200 rounded-xl p-6 mb-6">
                        <div class="flex items-center space-x-3 mb-4">
                            <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            <h3 class="text-lg font-bold text-amber-900">Syarat & Ketentuan</h3>
                        </div>

                        <div class="bg-white rounded-lg p-5 max-h-64 overflow-y-auto mb-4 space-y-4 text-sm text-gray-700">
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-1">1. Biaya Administrasi</h4>
                                <p>Saya menyetujui untuk membayar biaya administrasi pendaftaran sebesar Rp 20.000 (Dua Puluh Ribu Rupiah).</p>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-1">2. Verifikasi Data</h4>
                                <p>Saya menjamin bahwa seluruh data dan dokumen yang saya berikan adalah benar dan sah. Jika ditemukan pemalsuan data, PERUMDA Muara Tirta berhak membatalkan permohonan tanpa pengembalian biaya.</p>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-1">3. Survei Lokasi</h4>
                                <p>Saya menyetujui untuk dilakukan survei lokasi oleh petugas PERUMDA untuk memastikan kelayakan pemasangan sambungan air.</p>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-1">4. Waktu Proses</h4>
                                <p>Proses verifikasi dan survei akan dilakukan maksimal 7 hari kerja setelah pendaftaran. Pemasangan akan dijadwalkan setelah survei selesai dan disetujui.</p>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-1">5. Pembayaran</h4>
                                <p>Biaya pemasangan dan deposit akan diinformasikan setelah survei selesai dan harus dibayarkan sebelum proses pemasangan dimulai.</p>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-1">6. Kontak</h4>
                                <p>Saya bersedia dihubungi melalui nomor telepon/WhatsApp yang telah saya berikan untuk keperluan konfirmasi dan penjadwalan.</p>
                            </div>
                        </div>

                        <label class="flex items-start space-x-3 cursor-pointer group">
                            <input
                                type="checkbox"
                                name="setuju_biaya"
                                id="setuju_biaya"
                                value="1"
                                required
                                class="mt-1 w-5 h-5 text-primary-600 border-2 border-gray-300 rounded focus:ring-4 focus:ring-primary-100 transition-all">
                            <span class="text-sm font-medium text-gray-900 group-hover:text-primary-600 transition-colors">
                                Saya telah membaca dan menyetujui semua syarat & ketentuan di atas
                            </span>
                        </label>
                    </div>

                    <!-- Info Bantuan -->
                    <div class="bg-green-50 border border-green-200 rounded-xl p-6">
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-semibold text-green-900 mb-2">Butuh Bantuan?</h4>
                                <p class="text-sm text-green-800 leading-relaxed">
                                    Jika ada pertanyaan atau memerlukan bantuan, silakan hubungi Customer Service kami di:<br>
                                    <strong>WhatsApp: 0812-4469-7154</strong> atau <strong>Telepon: (0435) 821234</strong>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <div class="flex items-center justify-between mt-8 pt-8 border-t-2 border-gray-100">
                    <button
                        type="button"
                        x-show="currentStep > 1"
                        @click="prevStep()"
                        class="inline-flex items-center space-x-2 px-6 py-3 bg-white border-2 border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition-all font-medium">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                        <span>Sebelumnya</span>
                    </button>

                    <div x-show="currentStep < 4">
                        <button
                            type="button"
                            @click="nextStep()"
                            class="inline-flex items-center space-x-2 px-6 py-3 bg-gradient-to-r from-primary-600 to-primary-700 text-white rounded-xl hover:from-primary-700 hover:to-primary-800 transition-all font-medium shadow-lg shadow-primary-500/30 ml-auto">
                            <span>Selanjutnya</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    </div>

                    <div x-show="currentStep === 4">
                        <button
                            type="submit"
                            :disabled="isSubmitting"
                            class="inline-flex items-center space-x-2 px-8 py-3 bg-gradient-to-r from-green-600 to-green-700 text-white rounded-xl hover:from-green-700 hover:to-green-800 transition-all font-medium shadow-lg shadow-green-500/30 disabled:opacity-50 disabled:cursor-not-allowed ml-auto">
                            <svg x-show="!isSubmitting" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                            </svg>
                            <svg x-show="isSubmitting" class="animate-spin w-5 h-5" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <span x-text="isSubmitting ? 'Mengirim...' : 'Kirim Pendaftaran'"></span>
                        </button>
                    </div>
                </div>

            </form>
        </div>

    </div>
</section>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function formStepper() {
        return {
            currentStep: 1,
            isSubmitting: false,
            loadingLocation: false,
            uploadedFiles: {
                ktp: null,
                rumah: null
            },
            steps: [{
                    title: 'Persyaratan'
                },
                {
                    title: 'Data Pribadi'
                },
                {
                    title: 'Upload & Lokasi'
                },
                {
                    title: 'Konfirmasi'
                }
            ],

            nextStep() {
                if (this.validateCurrentStep()) {
                    if (this.currentStep < 4) {
                        this.currentStep++;
                        window.scrollTo({
                            top: 0,
                            behavior: 'smooth'
                        });
                    }
                }
            },

            prevStep() {
                if (this.currentStep > 1) {
                    this.currentStep--;
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                }
            },

            validateCurrentStep() {
                if (this.currentStep === 2) {
                    const namaLengkap = document.getElementById('nama_lengkap').value.trim();
                    const noHp = document.getElementById('no_hp').value.trim();

                    if (!namaLengkap) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Data Belum Lengkap',
                            text: 'Nama lengkap wajib diisi',
                            confirmButtonColor: '#3b82f6'
                        });
                        return false;
                    }

                    if (!noHp) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Data Belum Lengkap',
                            text: 'Nomor telepon/HP wajib diisi',
                            confirmButtonColor: '#3b82f6'
                        });
                        return false;
                    }

                    if (noHp.length < 10) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Nomor Tidak Valid',
                            text: 'Nomor telepon minimal 10 digit',
                            confirmButtonColor: '#3b82f6'
                        });
                        return false;
                    }
                }

                if (this.currentStep === 3) {
                    if (!this.uploadedFiles.ktp || !this.uploadedFiles.rumah) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Dokumen Belum Lengkap',
                            text: 'Mohon upload foto KTP dan foto rumah terlebih dahulu',
                            confirmButtonColor: '#3b82f6'
                        });
                        return false;
                    }

                    const alamat = document.getElementById('alamat_pemasangan').value.trim();
                    if (!alamat) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Alamat Belum Diisi',
                            text: 'Alamat pemasangan wajib diisi',
                            confirmButtonColor: '#3b82f6'
                        });
                        return false;
                    }
                }

                return true;
            },

            handleFileUpload(event, type) {
                const file = event.target.files[0];
                if (!file) return;

                // Validate file size (2MB)
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

                // Validate file type
                if (!file.type.startsWith('image/')) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Format File Salah',
                        text: 'File harus berupa gambar (JPG, PNG, dll)',
                        confirmButtonColor: '#3b82f6'
                    });
                    event.target.value = '';
                    return;
                }

                this.uploadedFiles[type] = file.name;

                // Add visual feedback
                const uploadArea = event.target.closest('.file-upload-area');
                uploadArea.classList.add('has-file');
            },

            getLocation() {
                if (!navigator.geolocation) {
                    Swal.fire({
                        icon: 'error',
                        title: 'GPS Tidak Didukung',
                        text: 'Browser Anda tidak mendukung geolocation',
                        confirmButtonColor: '#3b82f6'
                    });
                    return;
                }

                this.loadingLocation = true;

                navigator.geolocation.getCurrentPosition(
                    (position) => {
                        const lat = position.coords.latitude;
                        const lng = position.coords.longitude;

                        document.getElementById('latitude').value = lat;
                        document.getElementById('longitude').value = lng;

                        // Try to get address from coordinates
                        this.reverseGeocode(lat, lng);
                    },
                    (error) => {
                        this.loadingLocation = false;
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal Mendapatkan Lokasi',
                            text: 'Mohon aktifkan GPS atau masukkan alamat secara manual',
                            confirmButtonColor: '#3b82f6'
                        });
                    }, {
                        enableHighAccuracy: true,
                        timeout: 20000,
                        maximumAge: 0
                    }
                );
            },

            reverseGeocode(lat, lng) {
                // Use Nominatim reverse geocoding (free alternative to Google)
                fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`)
                    .then(response => response.json())
                    .then(data => {
                        this.loadingLocation = false;
                        if (data.display_name) {
                            document.getElementById('alamat_pemasangan').value = data.display_name;
                            Swal.fire({
                                icon: 'success',
                                title: 'Lokasi Ditemukan',
                                text: 'Alamat berhasil diisi otomatis',
                                timer: 2000,
                                showConfirmButton: false
                            });
                        }
                    })
                    .catch(() => {
                        this.loadingLocation = false;
                        Swal.fire({
                            icon: 'info',
                            title: 'Koordinat Tersimpan',
                            text: 'Koordinat berhasil didapat, mohon lengkapi alamat secara manual',
                            confirmButtonColor: '#3b82f6'
                        });
                    });
            },

            submitForm() {
                if (!document.getElementById('setuju_biaya').checked) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Persetujuan Diperlukan',
                        text: 'Anda harus menyetujui syarat dan ketentuan',
                        confirmButtonColor: '#3b82f6'
                    });
                    return;
                }

                this.isSubmitting = true;

                const formData = new FormData(document.getElementById('pasangBaruForm'));

                fetch('<?= base_url('pasang-baru/submit') ?>', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        this.isSubmitting = false;

                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Pendaftaran Berhasil!',
                                html: `
                            <p class="mb-2">Nomor Pendaftaran Anda:</p>
                            <p class="text-2xl font-bold text-primary-600">${data.no_pendaftaran}</p>
                            <p class="mt-3 text-sm text-gray-600">Simpan nomor ini untuk melacak status pendaftaran Anda</p>
                        `,
                                confirmButtonColor: '#3b82f6',
                                confirmButtonText: 'Lihat Detail'
                            }).then(() => {
                                window.location.href = data.redirect;
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Pendaftaran Gagal',
                                text: data.message || 'Terjadi kesalahan, silakan coba lagi',
                                confirmButtonColor: '#3b82f6'
                            });
                        }
                    })
                    .catch(error => {
                        this.isSubmitting = false;
                        Swal.fire({
                            icon: 'error',
                            title: 'Terjadi Kesalahan',
                            text: 'Gagal mengirim data, periksa koneksi internet Anda',
                            confirmButtonColor: '#3b82f6'
                        });
                    });
            }
        }
    }
</script>
<?= $this->endSection() ?>