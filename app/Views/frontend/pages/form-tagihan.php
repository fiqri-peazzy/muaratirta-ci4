<?= $this->extend('frontend/layouts/main') ?>

<?= $this->section('title') ?>Cek Tagihan<?= $this->endSection() ?>

<?= $this->section('description') ?>Cek tagihan air PDAM Muara Tirta secara online dengan mudah dan cepat melalui nomor sambungan Anda.<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<style>
    /* Billing Page Specific Styles - Consistency with Contact Page */
    .tg-header-gradient {
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
        padding: 60px 0;
    }

    .tg-search-card {
        background: #ffffff;
        border-radius: 24px;
        padding: 40px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        border: 1px solid rgba(0, 123, 255, 0.1);
        max-width: 800px;
        margin: 0 auto;
    }

    .tg-input-group {
        position: relative;
        margin-top: 30px;
    }

    .tg-input {
        width: 100%;
        padding: 16px 24px;
        padding-left: 56px;
        background: #f8fafc;
        border: 2px solid #e2e8f0;
        border-radius: 16px;
        font-size: 18px;
        font-weight: 600;
        transition: all 0.3s ease;
        font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
    }

    .tg-input:focus {
        border-color: #007bff;
        background: #ffffff;
        box-shadow: 0 0 0 4px rgba(0, 123, 255, 0.1);
        outline: none;
    }

    .tg-input-icon {
        position: absolute;
        left: 20px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
    }

    .tg-btn-submit {
        width: 100%;
        margin-top: 20px;
        background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
        color: #ffffff;
        padding: 16px;
        border-radius: 16px;
        font-weight: 700;
        font-size: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        box-shadow: 0 8px 20px rgba(0, 123, 255, 0.25);
        transition: all 0.3s ease;
    }

    .tg-btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 28px rgba(0, 123, 255, 0.35);
    }

    .tg-result-card {
        background: #ffffff;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.1);
        border: 1px solid #f1f5f9;
        margin-top: 40px;
    }

    .tg-result-header {
        background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
        color: white;
        padding: 40px;
    }

    .tg-info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 24px;
    }

    .tg-info-item {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .tg-info-label {
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 1px;
        opacity: 0.8;
        font-weight: 600;
    }

    .tg-info-value {
        font-size: 16px;
        font-weight: 700;
    }

    .tg-table-wrapper {
        padding: 40px;
    }

    .tg-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }

    .tg-table th {
        background: #f8fafc;
        padding: 16px;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        color: #64748b;
        text-align: left;
        border-bottom: 2px solid #e2e8f0;
    }

    .tg-table td {
        padding: 16px;
        border-bottom: 1px solid #f1f5f9;
        color: #1e293b;
        font-size: 14px;
    }

    .tg-total-row {
        background: #f1f5f9;
        font-weight: 800;
        font-size: 16px !important;
    }

    .tg-alert {
        margin: 40px;
        background: #fffbeb;
        border: 1px solid #fef3c7;
        border-radius: 16px;
        padding: 24px;
    }

    .tg-alert-title {
        color: #92400e;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 12px;
    }

    .tg-alert-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .tg-alert-item {
        padding-left: 24px;
        position: relative;
        font-size: 13px;
        color: #b45309;
        margin-bottom: 8px;
        line-height: 1.6;
    }

    .tg-alert-item:before {
        content: "✓";
        position: absolute;
        left: 0;
        color: #d97706;
        font-weight: bold;
    }

    .tg-btn-wa {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #25d366;
        color: white;
        padding: 12px 24px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 14px;
        margin-top: 16px;
        transition: all 0.3s ease;
    }

    .tg-btn-wa:hover {
        background: #128c7e;
        transform: translateY(-2px);
    }

    .tg-capture-footer {
        padding: 30px 40px;
        background: #f8fafc;
        border-top: 1px solid #e2e8f0;
        display: flex;
        justify-content: center;
        gap: 16px;
    }

    .tg-btn-download {
        background: #1e293b;
        color: white;
        padding: 12px 24px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
    }

    .tg-btn-download:hover {
        background: #0f172a;
        transform: translateY(-2px);
    }

    .capturing .hide-on-capture {
        display: none !important;
    }

    .tg-watermark {
        display: none;
    }

    .capturing .tg-watermark {
        display: block;
        padding: 20px 40px;
        background: #ffffff;
        border-top: 1px solid #f1f5f9;
        text-align: center;
        font-size: 11px;
        color: #94a3b8;
    }

    /* Modal Styles */
    .tg-modal {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.7);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        z-index: 9999;
        opacity: 0;
        pointer-events: none;
        transition: all 0.3s ease;
    }

    .tg-modal.active {
        opacity: 1;
        pointer-events: auto;
    }

    .tg-modal-content {
        background: white;
        border-radius: 24px;
        width: 100%;
        max-width: 600px;
        overflow: hidden;
        position: relative;
    }

    .tg-modal-header {
        padding: 20px 24px;
        border-bottom: 1px solid #f1f5f9;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .tg-modal-close {
        width: 32px;
        height: 32px;
        background: #f8fafc;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        border: none;
        cursor: pointer;
        color: #64748b;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- Header/Breadcrumb Section -->
<section class="relative pt-24 pb-16 bg-gradient-to-br from-primary-900 via-primary-800 to-water-600 overflow-hidden">
    <div class="absolute inset-0 opacity-20">
        <svg class="absolute bottom-0 w-full h-40" viewBox="0 0 1440 320" preserveAspectRatio="none">
            <path fill="#ffffff" d="M0,224L48,213.3C96,203,192,181,288,181.3C384,181,480,203,576,224C672,245,768,267,864,250.7C960,235,1056,181,1152,165.3C1248,149,1344,171,1392,181.3L1440,192L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
        </svg>
    </div>

    <div class="container mx-auto px-4 relative z-10 text-center">
        <div class="inline-flex items-center space-x-2 bg-white/10 px-4 py-2 rounded-full mb-6">
            <svg class="w-5 h-5 text-water-200" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM3.22 16.65a11.054 11.054 0 005.13 2.15 1 1 0 11-.4 1.96 13.055 13.055 0 01-6.04-2.531 1 1 0 111.31-1.579zM18.692 9.397a11.115 11.115 0 01.25 3.762 1 1 0 01-.89.89 8.951 8.951 0 00-1.051.174v-4.102l1.691-.724zM16.78 16.65a1 1 0 111.31 1.579 13.055 13.055 0 01-6.04 2.531 1 1 0 11-.4-1.96 11.054 11.054 0 005.13-2.15z" />
            </svg>
            <span class="text-xs font-bold text-water-100 uppercase tracking-widest">Informasi Tagihan</span>
        </div>
        <h1 class="text-2xl md:text-3xl lg:text-4xl font-display font-black text-white leading-tight mb-4">Cek Tagihan Air</h1>
        <p class="text-water-100/70 max-w-2xl mx-auto text-lg mb-8">Pantau tagihan pemakaian air bersih Anda secara online kapan saja dan di mana saja dengan aman dan transparan.</p>

        <nav class="flex items-center justify-center space-x-2 text-sm">
            <a href="<?= base_url('/') ?>" class="text-white/60 hover:text-white transition-colors">Beranda</a>
            <svg class="w-4 h-4 text-white/30" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
            </svg>
            <span class="text-white">Cek Tagihan</span>
        </nav>
    </div>
</section>

<!-- Main App Section -->
<section class="py-10 bg-gray-50 overflow-hidden" x-data="tagihanApp()">
    <div class="container mx-auto px-4 max-w-5xl">

        <!-- Search Card -->
        <div class="tg-search-card" data-aos="fade-up">
            <h2 class="text-2xl font-display font-bold text-gray-900 text-center">Masukkan No. Sambung</h2>
            <p class="text-gray-500 text-center mt-2 text-sm">Contoh: 0112233 (7 digit angka)</p>

            <form @submit.prevent="cekTagihan" class="max-w-md mx-auto">
                <div class="tg-input-group">
                    <div class="tg-input-icon">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input
                        type="text"
                        x-model="idPel"
                        placeholder="01XXXXX"
                        maxlength="7"
                        required
                        class="tg-input"
                        @input="idPel = idPel.replace(/[^0-9]/g, '').slice(0,7)">
                </div>

                <button type="submit" :disabled="loading" class="tg-btn-submit">
                    <template x-if="!loading">
                        <span class="flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                            Cek Sekarang
                        </span>
                    </template>
                    <template x-if="loading">
                        <span class="flex items-center gap-2">
                            <svg class="animate-spin h-5 w-5 text-white" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Sedang Mencari...
                        </span>
                    </template>
                </button>
            </form>
        </div>

        <!-- Result Card -->
        <div x-show="showResult && hasData" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 transform translate-y-10" x-transition:enter-end="opacity-100 transform translate-y-0">
            <div class="tg-result-card">
                <div id="capture-area" :class="isCapturing ? 'capturing' : ''">
                    <!-- Customer Header -->
                    <div class="tg-result-header">
                        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-8">
                            <div class="tg-info-grid flex-1">
                                <div class="tg-info-item">
                                    <span class="tg-info-label">No. Sambung</span>
                                    <span class="tg-info-value font-mono text-xl" x-text="customer.NOSAMW"></span>
                                </div>
                                <div class="tg-info-item">
                                    <span class="tg-info-label">Nama Pelanggan</span>
                                    <span class="tg-info-value" x-text="customer.NAMA"></span>
                                </div>
                                <div class="tg-info-item">
                                    <span class="tg-info-label">Klasifikasi</span>
                                    <span class="tg-info-value" x-text="getGolongan(customer.GOLONGAN)"></span>
                                </div>
                            </div>

                            <div class="hide-on-capture">
                                <button @click="openFoto" class="flex items-center gap-2 bg-white/20 hover:bg-white/30 px-4 py-2 rounded-xl transition-all font-bold text-sm">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    Cek Foto Rumah
                                </button>
                            </div>
                        </div>

                        <div class="mt-8 pt-8 border-t border-white/10">
                            <div class="tg-info-item">
                                <span class="tg-info-label">Alamat Lengkap</span>
                                <span class="tg-info-value opacity-90 font-medium" x-text="customer.ALAMAT"></span>
                            </div>
                        </div>
                    </div>

                    <!-- Bills Content -->
                    <div class="tg-table-wrapper">
                        <div class="flex items-center gap-3 mb-8">
                            <div class="w-10 h-10 bg-primary-100 rounded-xl flex items-center justify-center text-primary-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 font-display">Rincian Tagihan Air</h3>
                        </div>

                        <div class="overflow-x-auto rounded-2xl border border-gray-100">
                            <table class="tg-table">
                                <thead>
                                    <tr>
                                        <th width="80">No</th>
                                        <th>Periode</th>
                                        <th class="text-center">Kubik (m³)</th>
                                        <th class="text-right">Tagihan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template x-for="(bill, index) in bills" :key="index">
                                        <tr>
                                            <td x-text="index + 1"></td>
                                            <td x-text="formatPeriode(bill.PERIODE)" class="font-bold"></td>
                                            <td class="text-center font-mono font-medium" x-text="bill.PAKAI"></td>
                                            <td class="text-right font-mono font-bold text-gray-900" x-text="formatRupiah(bill.TAGIHAN)"></td>
                                        </tr>
                                    </template>
                                </tbody>
                                <tfoot>
                                    <tr class="tg-total-row">
                                        <td colspan="3" class="text-center py-4 text-xs font-black uppercase text-gray-500">Total Yang Harus Dibayar</td>
                                        <td class="text-right font-mono font-black text-primary-600" x-text="formatRupiah(totalTagihan)"></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <!-- Alert Info -->
                    <div class="tg-alert hide-on-capture">
                        <div class="tg-alert-title">
                            <svg class="w-5 h-5 text-amber-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                            INFORMASI PENTING
                        </div>
                        <ul class="tg-alert-list">
                            <li class="tg-alert-item">Bayarlah tagihan Anda sebelum tanggal <strong>20 setiap bulannya</strong> untuk menghindari denda keterlambatan dan sanksi penyegelan.</li>
                            <li class="tg-alert-item">Simpanlah bukti pembayaran Anda baik cetak maupun digital untuk keperluan administrasi di masa mendatang.</li>
                        </ul>

                        <a href="https://wa.me/6281244697154" target="_blank" class="tg-btn-wa">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
                            </svg>
                            Layanan Customer Service
                        </a>
                    </div>

                    <!-- Watermark on Capture -->
                    <div class="tg-watermark">
                        <strong>PERUMDA Muara Tirta Kota Gorontalo</strong><br>
                        Data resmi tagihan pelanggan. Dicetak pada: <span x-text="captureDate"></span>
                    </div>
                </div>

                <!-- Footer Actions -->
                <div class="tg-capture-footer hide-on-capture">
                    <button @click="download" :disabled="capturing" class="tg-btn-download">
                        <template x-if="!capturing">
                            <span class="flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                </svg>
                                Simpan Gambar Tagihan
                            </span>
                        </template>
                        <template x-if="capturing">
                            <span class="flex items-center gap-2">
                                <svg class="animate-spin h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Memproses...
                            </span>
                        </template>
                    </button>

                    <a :href="`https://wa.me/?text=Halo, berikut adalah tagihan air PERUMDA Muara Tirta. No Sambung: ${idPel}. Total: ${formatRupiah(totalTagihan)}. Cek lengkap di: ${window.location.href}`" target="_blank" class="flex items-center gap-2 bg-green-500 text-white px-6 py-3 rounded-xl font-bold text-sm hover:bg-green-600 transition-all">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                        </svg>
                        Bagikan Ke WA
                    </a>
                </div>
            </div>
        </div>

        <!-- Empty State (Lunas/Not Found) -->
        <div x-show="showResult && !hasData" x-transition class="bg-white rounded-[2rem] p-12 text-center shadow-lg border border-gray-100" data-aos="zoom-in">
            <div class="w-24 h-24 bg-green-50 rounded-full flex items-center justify-center mx-auto mb-8">
                <svg class="w-12 h-12 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <h3 class="text-3xl font-display font-bold text-gray-900 mb-4">Yeay! Tagihan Lunas</h3>
            <p class="text-gray-500 max-w-md mx-auto mb-8">Tidak ditemukan tagihan yang belum dibayar untuk nomor sambungan ini. Terima kasih telah membayar tepat waktu!</p>

            <div class="bg-gray-50 p-6 rounded-2xl inline-block">
                <p class="text-sm font-bold text-gray-400 uppercase tracking-widest mb-2">Butuh Bantuan Lain?</p>
                <div class="flex items-center gap-4">
                    <a href="<?= route_to('contact') ?>" class="text-primary-600 font-bold hover:underline">Kontak Kami</a>
                    <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                    <a href="https://wa.me/6281244697154" target="_blank" class="text-green-600 font-bold hover:underline">WhatsApp Humas</a>
                </div>
            </div>
        </div>

    </div>

    <!-- Modal Foto Rumah -->
    <div class="tg-modal" :class="showFotoModal ? 'active' : ''">
        <div class="tg-modal-content">
            <div class="tg-modal-header">
                <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                    <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Foto Rumah Pelanggan
                </h3>
                <button @click="showFotoModal = false" class="tg-modal-close">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l18 18" />
                    </svg>
                </button>
            </div>
            <div class="p-6">
                <div class="aspect-video rounded-xl bg-gray-100 overflow-hidden relative">
                    <img :src="`<?= base_url('tagihan/foto') ?>/${idPel}`" class="w-full h-full object-cover" @error="$event.target.src='https://placehold.co/600x400?text=Foto+Tidak+Tersedia'">
                </div>
                <div class="mt-4 p-4 bg-gray-50 rounded-xl border border-gray-100">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-[10px] text-gray-400 font-bold uppercase">Nama</p>
                            <p class="text-sm font-bold" x-text="customer.NAMA"></p>
                        </div>
                        <div>
                            <p class="text-[10px] text-gray-400 font-bold uppercase">ID Pelanggan</p>
                            <p class="text-sm font-bold" x-text="customer.NOSAMW"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script>
    function tagihanApp() {
        return {
            idPel: '',
            loading: false,
            showResult: false,
            hasData: false,
            customer: {},
            bills: [],
            totalTagihan: 0,
            capturing: false,
            isCapturing: false,
            captureDate: '',
            showFotoModal: false,

            cekTagihan() {
                if (this.idPel.length !== 7) {
                    toastr.warning('Masukkan 7 digit No. Sambung');
                    return;
                }

                this.loading = true;
                this.showResult = false;

                let formData = new FormData();
                formData.append('id_pel', this.idPel);
                formData.append('<?= csrf_token() ?>', '<?= csrf_hash() ?>');

                fetch('<?= route_to('tagihan.detail') ?>', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': '<?= csrf_hash() ?>'
                        }
                    })
                    .then(res => res.json())
                    .then(res => {
                        this.loading = false;
                        if (res.status === 'true' && res.pelanggan) {
                            this.hasData = true;
                            this.customer = res.pelanggan[0];
                            this.bills = res.pelanggan;
                            this.totalTagihan = this.bills.reduce((acc, current) => acc + parseInt(current.TAGIHAN), 0);
                            this.showResult = true;

                            // Scroll to result
                            setTimeout(() => {
                                window.scrollTo({
                                    top: document.querySelector('.tg-result-card')?.offsetTop - 100 || 0,
                                    behavior: 'smooth'
                                });
                            }, 100);
                        } else if (res.status === false && res.error) {
                            toastr.error(Object.values(res.error)[0]);
                        } else {
                            // Probably "Lunas" or not found
                            this.hasData = false;
                            this.showResult = true;
                        }
                    })
                    .catch(err => {
                        this.loading = false;
                        toastr.error('Gagal menghubungi server. Periksa koneksi Anda.');
                    });
            },

            getGolongan(gol) {
                const map = {
                    '01': 'Sosial Umum',
                    '02': 'Sosial Khusus',
                    '03': 'Rumah Tangga A',
                    '04': 'Rumah Tangga B',
                    '05': 'Instansi Pemerintah',
                    '06': 'Niaga Kecil',
                    '07': 'Niaga Besar',
                    '08': 'Rumah Tangga C',
                    '09': 'Khusus',
                    '10': 'Rumah Tangga D'
                };
                return map[gol] || 'Klasifikasi Tidak Dikenali';
            },

            formatRupiah(amount) {
                return new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0
                }).format(amount);
            },

            formatPeriode(periode) {
                if (!periode) return '';
                const thn = periode.substring(0, 4);
                const blnMap = {
                    '01': 'Januari',
                    '02': 'Februari',
                    '03': 'Maret',
                    '04': 'April',
                    '05': 'Mei',
                    '06': 'Juni',
                    '07': 'Juli',
                    '08': 'Agustus',
                    '09': 'September',
                    '10': 'Oktober',
                    '11': 'November',
                    '12': 'Desember'
                };
                const bln = blnMap[periode.substring(4, 6)] || '';
                return `${bln} ${thn}`;
            },

            openFoto() {
                this.showFotoModal = true;
            },

            download() {
                this.capturing = true;
                this.isCapturing = true;
                this.captureDate = new Date().toLocaleString('id-ID');

                const captureArea = document.getElementById('capture-area');

                setTimeout(() => {
                    html2canvas(captureArea, {
                        scale: 2,
                        backgroundColor: '#ffffff',
                        logging: false,
                        useCORS: true,
                        allowTaint: true
                    }).then(canvas => {
                        const link = document.createElement('a');
                        link.download = `Tagihan_PDAM_${this.idPel}_${Date.now()}.png`;
                        link.href = canvas.toDataURL('image/png');
                        link.click();

                        this.capturing = false;
                        this.isCapturing = false;
                        toastr.success('Gambar berhasil disimpan!');
                    }).catch(err => {
                        this.capturing = false;
                        this.isCapturing = false;
                        toastr.error('Gagal memproses gambar');
                    });
                }, 300);
            }
        }
    }
</script>
<?= $this->endSection() ?>