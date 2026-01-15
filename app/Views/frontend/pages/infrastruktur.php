<?= $this->extend('frontend/layouts/main') ?>

<?= $this->section('title') ?><?= $title ?><?= $this->endSection() ?>

<?= $this->section('styles') ?>
<style>
    .infra-gradient-card {
        background: linear-gradient(135deg, #ffffff 0%, #f8faff 100%);
    }

    .infra-accordion-item {
        transition: all 0.3s ease;
    }

    .infra-accordion-content {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.5s cubic-bezier(0, 1, 0, 1);
    }

    .infra-accordion-content.open {
        max-height: 2000px;
        transition: max-height 1s ease-in-out;
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
        <h1 class="text-4xl lg:text-5xl font-display font-bold text-white mb-4 text-center lg:text-left">Infrastruktur</h1>
        <nav class="flex items-center justify-center lg:justify-start space-x-2 text-sm">
            <a href="<?= base_url('/') ?>" class="text-white/80 hover:text-white transition-colors">Beranda</a>
            <svg class="w-4 h-4 text-white/60" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
            </svg>
            <span class="text-white font-medium">Infrastruktur</span>
        </nav>
    </div>
</section>

<section class="py-20 bg-white">
    <div class="container mx-auto px-4 lg:px-8 max-w-5xl" x-data="{ active: 1 }">

        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-3xl lg:text-4xl font-display font-bold text-gray-900 mb-4">Data Teknis & Infrastruktur</h2>
            <p class="text-gray-600 max-w-3xl mx-auto italic leading-relaxed">Informasi komprehensif mengenai profil kependudukan, sumber daya air, hingga sistem penyediaan air minum yang dikelola oleh PERUMDA Muara Tirta.</p>
        </div>

        <div class="space-y-4">
            <!-- 1. Data Existing -->
            <div class="infra-accordion-item bg-white border border-gray-100 rounded-3xl shadow-sm overflow-hidden" data-aos="fade-up">
                <button @click="active = (active === 1 ? null : 1)"
                    class="w-full px-8 py-6 flex items-center justify-between text-left group transition-colors duration-300"
                    :class="active === 1 ? 'bg-primary-600 text-white' : 'hover:bg-primary-50'">
                    <span class="text-lg font-bold" :class="active === 1 ? 'text-white' : 'text-gray-900 group-hover:text-primary-600'">Data Existing Pelayanan</span>
                    <svg class="w-6 h-6 transition-transform duration-300" :class="active === 1 ? 'rotate-180 text-white' : 'text-primary-600'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="infra-accordion-content" :class="active === 1 ? 'open' : ''">
                    <div class="p-8 space-y-8">
                        <div>
                            <h4 class="text-primary-700 font-bold mb-4 flex items-center">
                                <span class="w-2 h-6 bg-primary-600 rounded-full mr-3"></span>
                                Profil Kota Gorontalo (2023)
                            </h4>
                            <div class="text-gray-600 leading-relaxed text-sm space-y-4">
                                <p>Kota Gorontalo merupakan ibu kota Provinsi Gorontalo sekaligus pusat ekonomi dan jasa di Kawasan Teluk Tomini. Memiliki luas wilayah 79,03 km² yang mencakup 9 kecamatan dan 50 kelurahan.</p>
                                <p>Berdasarkan data DKPS Kota Gorontalo Semester 1 Tahun 2023, jumlah penduduk tercatat sebanyak 219.399 jiwa.</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
                            <div class="p-4 rounded-2xl bg-blue-50 border border-blue-100">
                                <p class="text-xs text-blue-600 font-bold uppercase mb-1">Pria</p>
                                <p class="text-xl font-extrabold text-gray-900">49.85%</p>
                            </div>
                            <div class="p-4 rounded-2xl bg-cyan-50 border border-cyan-100">
                                <p class="text-xs text-cyan-600 font-bold uppercase mb-1">Wanita</p>
                                <p class="text-xl font-extrabold text-gray-900">50.22%</p>
                            </div>
                            <div class="p-4 rounded-2xl bg-indigo-50 border border-indigo-100">
                                <p class="text-xs text-indigo-600 font-bold uppercase mb-1">Pertumbuhan</p>
                                <p class="text-xl font-extrabold text-gray-900">1.16% <span class="text-xs font-normal">/ Thn</span></p>
                            </div>
                        </div>

                        <hr class="border-gray-100">

                        <div>
                            <h4 class="text-primary-700 font-bold mb-6 flex items-center">
                                <span class="w-2 h-6 bg-primary-600 rounded-full mr-3"></span>
                                Cakupan & Kinerja Layanan
                            </h4>
                            <div class="grid md:grid-cols-2 gap-8">
                                <div class="space-y-4">
                                    <p class="text-sm font-bold text-gray-900 uppercase tracking-wider">Cakupan Layanan</p>
                                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-2xl">
                                        <span class="text-sm text-gray-500">Tahun 2021</span>
                                        <div class="text-right">
                                            <span class="text-xl font-bold text-gray-900">74.83%</span>
                                            <span class="block text-[10px] text-emerald-600 font-bold">Naik 15.22%</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="space-y-4">
                                    <p class="text-sm font-bold text-gray-900 uppercase tracking-wider">Kapasitas SDM</p>
                                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-2xl">
                                        <span class="text-sm text-gray-500">Jumlah Pegawai</span>
                                        <span class="text-xl font-bold text-gray-900">179 <span class="text-xs font-normal">Orang</span></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 2. Sumber Air Baku -->
            <div class="infra-accordion-item bg-white border border-gray-100 rounded-3xl shadow-sm overflow-hidden" data-aos="fade-up">
                <button @click="active = (active === 2 ? null : 2)"
                    class="w-full px-8 py-6 flex items-center justify-between text-left group transition-colors duration-300"
                    :class="active === 2 ? 'bg-primary-600 text-white' : 'hover:bg-primary-50'">
                    <span class="text-lg font-bold" :class="active === 2 ? 'text-white' : 'text-gray-900 group-hover:text-primary-600'">Sumber Air Baku</span>
                    <svg class="w-6 h-6 transition-transform duration-300" :class="active === 2 ? 'rotate-180 text-white' : 'text-primary-600'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="infra-accordion-content" :class="active === 2 ? 'open' : ''">
                    <div class="p-8">
                        <div class="grid sm:grid-cols-2 gap-4">
                            <div class="flex items-center space-x-4 p-5 bg-blue-50 rounded-2xl text-blue-700">
                                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="font-bold text-lg">Aliran Sungai Bone</span>
                            </div>
                            <div class="flex items-center space-x-4 p-5 bg-cyan-50 rounded-2xl text-cyan-700">
                                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="font-bold text-lg">Aliran Sungai Bolango</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 3. Sistem Penyediaan Air Minum (SPAM) -->
            <div class="infra-accordion-item bg-white border border-gray-100 rounded-3xl shadow-sm overflow-hidden" data-aos="fade-up">
                <button @click="active = (active === 3 ? null : 3)"
                    class="w-full px-8 py-6 flex items-center justify-between text-left group transition-colors duration-300"
                    :class="active === 3 ? 'bg-primary-600 text-white' : 'hover:bg-primary-50'">
                    <span class="text-lg font-bold" :class="active === 3 ? 'text-white' : 'text-gray-900 group-hover:text-primary-600'">Sistem Penyediaan Air Minum</span>
                    <svg class="w-6 h-6 transition-transform duration-300" :class="active === 3 ? 'rotate-180 text-white' : 'text-primary-600'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="infra-accordion-content" :class="active === 3 ? 'open' : ''">
                    <div class="p-10 text-gray-600 leading-relaxed text-sm space-y-6">
                        <p>Sistem penyediaan air minum yang dikelola oleh PERUMDA Kota Gorontalo dibangun berdasarkan master plan tahun 1975 oleh PT. Encona Engineering Inc.</p>
                        <p>Infrastruktur utama seperti gedung dan perpipaan dibangun pada 1979-1980 dan mulai beroperasi secara komersial sejak 1982. Sistem ini melayani 9 kecamatan di Kota Gorontalo dan 2 kecamatan di Kabupaten Bone Bolango.</p>
                        <div class="p-6 bg-yellow-50 border-l-4 border-yellow-400 rounded-r-2xl">
                            <p class="font-bold text-yellow-800 mb-2">Kapasitas Terpasang</p>
                            <p class="text-yellow-700">IPA Kabila (The Gremount) memiliki kapasitas terpasang sebesar <span class="font-bold">218 Liter/detik</span>.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 4. Water Treatment Plant (WTP) -->
            <div class="infra-accordion-item bg-white border border-gray-100 rounded-3xl shadow-sm overflow-hidden" data-aos="fade-up">
                <button @click="active = (active === 4 ? null : 4)"
                    class="w-full px-8 py-6 flex items-center justify-between text-left group transition-colors duration-300"
                    :class="active === 4 ? 'bg-primary-600 text-white' : 'hover:bg-primary-50'">
                    <span class="text-lg font-bold" :class="active === 4 ? 'text-white' : 'text-gray-900 group-hover:text-primary-600'">Water Treatment Plant (WTP)</span>
                    <svg class="w-6 h-6 transition-transform duration-300" :class="active === 4 ? 'rotate-180 text-white' : 'text-primary-600'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="infra-accordion-content" :class="active === 4 ? 'open' : ''">
                    <div class="p-8">
                        <div class="grid sm:grid-cols-2 gap-6">
                            <div class="p-6 bg-white border border-gray-100 rounded-2xl shadow-sm">
                                <h5 class="font-bold text-gray-900 mb-3">IPA Bulotadaa</h5>
                                <p class="text-sm text-gray-600 mb-4">Beroperasi sejak 2007 (20 l/s) dan ditingkatkan pada 2016 menjadi 50 l/s. Melayani area Kota Utara.</p>
                                <div class="inline-block px-3 py-1 bg-primary-100 text-primary-700 rounded-full text-xs font-bold">Kapasitas 70 l/dt</div>
                            </div>
                            <div class="p-6 bg-white border border-gray-100 rounded-2xl shadow-sm">
                                <h5 class="font-bold text-gray-900 mb-3">IPA Pilolodaa</h5>
                                <p class="text-sm text-gray-600 mb-4">Mulai beroperasi tahun 2009 untuk memperkuat distribusi di wilayah Kecamatan Kota Barat.</p>
                                <div class="inline-block px-3 py-1 bg-cyan-100 text-cyan-700 rounded-full text-xs font-bold">Kapasitas 10 l/dt</div>
                            </div>
                            <div class="p-6 bg-white border border-gray-100 rounded-2xl shadow-sm">
                                <h5 class="font-bold text-gray-900 mb-3">IPA Dungingi & Botu</h5>
                                <p class="text-sm text-gray-600 mb-4">Hibah kementerian PU yang masing-masing memiliki kapasitas stabil untuk menunjang distribusi kota.</p>
                                <div class="inline-block px-3 py-1 bg-indigo-100 text-indigo-700 rounded-full text-xs font-bold">Kapasitas @20 l/dt</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 5. Sistem Pengaliran -->
            <div class="infra-accordion-item bg-white border border-gray-100 rounded-3xl shadow-sm overflow-hidden" data-aos="fade-up">
                <button @click="active = (active === 5 ? null : 5)"
                    class="w-full px-8 py-6 flex items-center justify-between text-left group transition-colors duration-300"
                    :class="active === 5 ? 'bg-primary-600 text-white' : 'hover:bg-primary-50'">
                    <span class="text-lg font-bold" :class="active === 5 ? 'text-white' : 'text-gray-900 group-hover:text-primary-600'">Sistem Pengaliran (Pompanisasi)</span>
                    <svg class="w-6 h-6 transition-transform duration-300" :class="active === 5 ? 'rotate-180 text-white' : 'text-primary-600'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="infra-accordion-content" :class="active === 5 ? 'open' : ''">
                    <div class="p-8">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-sm">
                                <thead>
                                    <tr class="text-gray-400 font-bold uppercase tracking-wider border-b border-gray-100">
                                        <th class="pb-4">Instalasi / Boster</th>
                                        <th class="pb-4 text-right">Kapasitas</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 divide-y divide-gray-50">
                                    <tr>
                                        <td class="py-4">IPA Kabila</td>
                                        <td class="py-4 text-right font-bold text-primary-600">218 l/s</td>
                                    </tr>
                                    <tr>
                                        <td class="py-4">IPA Bulotadaa</td>
                                        <td class="py-4 text-right font-bold text-primary-600">70 l/s</td>
                                    </tr>
                                    <tr>
                                        <td class="py-4">IPA Dungingi</td>
                                        <td class="py-4 text-right font-bold text-primary-600">20 l/s</td>
                                    </tr>
                                    <tr>
                                        <td class="py-4">Boster Pohe</td>
                                        <td class="py-4 text-right font-bold text-primary-600">8 l/s</td>
                                    </tr>
                                    <tr>
                                        <td class="py-4">Boster Palma & Siendeng</td>
                                        <td class="py-4 text-right font-bold text-primary-600">@ 5 l/s</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 6. Intake & Jaringan -->
            <div class="infra-accordion-item bg-white border border-gray-100 rounded-3xl shadow-sm overflow-hidden" data-aos="fade-up">
                <button @click="active = (active === 6 ? null : 6)"
                    class="w-full px-8 py-6 flex items-center justify-between text-left group transition-colors duration-300"
                    :class="active === 6 ? 'bg-primary-600 text-white' : 'hover:bg-primary-50'">
                    <span class="text-lg font-bold" :class="active === 6 ? 'text-white' : 'text-gray-900 group-hover:text-primary-600'">Instalasi Intake & Area Pelayanan</span>
                    <svg class="w-6 h-6 transition-transform duration-300" :class="active === 6 ? 'rotate-180 text-white' : 'text-primary-600'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="infra-accordion-content" :class="active === 6 ? 'open' : ''">
                    <div class="p-8 space-y-6">
                        <div class="grid md:grid-cols-2 gap-8 items-center text-sm text-gray-600 leading-relaxed">
                            <div class="space-y-4">
                                <h5 class="font-bold text-gray-900">Spesifikasi Intake</h5>
                                <p>Konstruksi beton ± 20 meter dengan 2 mulut intake. Dilengkapi 4 unit pompa air baku berkapasitas 120 l/s setiap unit dengan head 15 meter.</p>
                                <p>Operasional dilakukan 24 jam dengan sistem rotasi unit pompa untuk menjamin stabilitas pasokan air baku ke IPA.</p>
                            </div>
                            <div class="p-6 bg-gray-50 rounded-3xl">
                                <h5 class="font-bold text-gray-900 mb-3">Wilayah Layanan</h5>
                                <p>Mencakup seluruh administrasi Kota Gorontalo dan sebagian Bone Bolango (Kabila & Suwawa). Jangkauan perpipaan di wilayah pemukiman saat ini mencapai ± 80%.</p>
                            </div>
                        </div>
                    </div>
                </div>
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
        duration: 800,
        once: true,
        offset: 50
    });
</script>
<?= $this->endSection() ?>