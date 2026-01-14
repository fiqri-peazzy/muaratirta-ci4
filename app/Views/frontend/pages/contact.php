<?= $this->extend('frontend/layouts/main') ?>

<?= $this->section('styles') ?>
<style>
    /* Contact Page Enhanced Styles - Prefix: ct- */
    .ct-enhanced-section {
        padding: 60px 0;
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    }

    /* Header Section */
    .ct-header {
        text-align: center;
        margin-bottom: 50px;
    }

    .ct-lottie-wrapper {
        display: flex;
        justify-content: center;
        margin-bottom: 30px;
    }

    .ct-title {
        font-size: 32px;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 12px;
    }

    .ct-subtitle {
        color: #666;
        font-size: 16px;
    }

    /* Contact Cards Grid */
    .ct-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 24px;
        margin-bottom: 40px;
    }

    .ct-card {
        background: #ffffff;
        border-radius: 20px;
        padding: 32px 24px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.06);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid rgba(0, 123, 255, 0.08);
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .ct-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 16px 40px rgba(0, 123, 255, 0.12);
        border-color: #007bff;
    }

    /* Icon Styles with Modern SVG */
    .ct-icon-wrapper {
        width: 80px;
        height: 80px;
        margin: 0 auto 24px;
        background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 8px 20px rgba(0, 123, 255, 0.25);
        transition: all 0.3s ease;
    }

    .ct-card:hover .ct-icon-wrapper {
        transform: scale(1.1) rotate(5deg);
        box-shadow: 0 12px 28px rgba(0, 123, 255, 0.35);
    }

    .ct-icon-wrapper svg {
        width: 40px;
        height: 40px;
        fill: #ffffff;
    }

    .ct-card-title {
        font-size: 20px;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 8px;
        text-align: center;
    }

    .ct-card-subtitle {
        font-size: 13px;
        color: #007bff;
        font-weight: 600;
        text-align: center;
        margin-bottom: 16px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .ct-contact-item {
        margin-bottom: 20px;
        padding-bottom: 20px;
        border-bottom: 1px solid #f0f0f0;
    }

    .ct-contact-item:last-child {
        margin-bottom: 0;
        padding-bottom: 0;
        border-bottom: none;
    }

    .ct-contact-label {
        font-size: 14px;
        font-weight: 600;
        color: #1a1a1a;
        margin-bottom: 8px;
        display: block;
    }

    .ct-contact-value {
        font-size: 14px;
        color: #666;
        margin: 4px 0;
        display: block;
    }

    .ct-contact-value a {
        color: #007bff;
        text-decoration: none;
        transition: color 0.2s ease;
    }

    .ct-contact-value a:hover {
        color: #0056b3;
    }

    /* WhatsApp Button */
    .ct-wa-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        background: linear-gradient(135deg, #25D366 0%, #128C7E 100%);
        color: #ffffff;
        padding: 10px 20px;
        border-radius: 25px;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(37, 211, 102, 0.3);
    }

    .ct-wa-btn:hover {
        background: linear-gradient(135deg, #128C7E 0%, #075E54 100%);
        color: #ffffff;
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(37, 211, 102, 0.4);
    }

    .ct-wa-btn svg {
        width: 18px;
        height: 18px;
        fill: currentColor;
    }

    /* Map Card */
    .ct-map-card {
        grid-column: 1 / -1;
        padding: 40px;
    }

    .ct-map-wrapper {
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
        margin-top: 24px;
    }

    .ct-map-wrapper iframe {
        width: 100%;
        height: 400px;
        border: none;
    }

    .ct-address-text {
        text-align: center;
        color: #4a4a4a;
        font-size: 15px;
        line-height: 1.7;
        margin-bottom: 24px;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }

    /* List Styles */
    .ct-list {
        list-style: none;
        padding: 0;
        margin: 12px 0;
    }

    .ct-list li {
        padding: 6px 0 6px 24px;
        position: relative;
        color: #666;
        font-size: 14px;
    }

    .ct-list li:before {
        content: "•";
        position: absolute;
        left: 8px;
        color: #007bff;
        font-weight: bold;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .ct-grid {
            grid-template-columns: 1fr;
        }

        .ct-map-card {
            padding: 24px;
        }

        .ct-map-wrapper iframe {
            height: 300px;
        }

        .ct-title {
            font-size: 26px;
        }
    }

    /* Animation */
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

    .ct-card {
        animation: fadeInUp 0.6s ease-out;
    }

    .ct-card:nth-child(1) {
        animation-delay: 0.1s;
    }

    .ct-card:nth-child(2) {
        animation-delay: 0.2s;
    }

    .ct-card:nth-child(3) {
        animation-delay: 0.3s;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('title') ?>
Kontak Kami
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
        <h1 class="text-3xl lg:text-4xl font-display font-bold text-white mb-3 text-center lg:text-left">Kontak Kami</h1>
        <nav class="flex items-center justify-center lg:justify-start space-x-2 text-sm">
            <a href="<?= base_url('/') ?>" class="text-white/80 hover:text-white transition-colors font-medium">Beranda</a>
            <svg class="w-4 h-4 text-white/60" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
            </svg>
            <span class="text-white font-semibold">Kontak Kami</span>
        </nav>
    </div>
</section>

<!-- Enhanced Contact Section -->
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4 max-w-6xl" data-aos="fade-up">

        <!-- Header with Lottie Animation -->
        <div class="bg-gradient-to-br from-primary-50 to-water-50 rounded-2xl p-8 mb-8 shadow-sm">
            <div class="flex flex-col lg:flex-row items-center gap-8">
                <!-- Lottie Animation -->
                <div class="flex-shrink-0 w-48 h-48">
                    <dotlottie-wc
                        src="https://lottie.host/cae803f1-93c6-4351-bbbe-529017f979be/71SatsY3K9.lottie"
                        style="width: 100%; height: 100%;"
                        autoplay
                        loop>
                    </dotlottie-wc>
                </div>

                <!-- Header Text -->
                <div class="flex-1 text-center lg:text-left">
                    <div class="inline-flex items-center space-x-2 bg-primary-100 px-4 py-2 rounded-full mb-4">
                        <svg class="w-5 h-5 text-primary-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zm-4 0H9v2h2V9z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-sm font-semibold text-primary-700 uppercase tracking-wider">Hubungi Kami</span>
                    </div>
                    <h1 class="text-3xl lg:text-4xl font-display font-bold text-gray-900 mb-3 leading-tight">
                        Kami Siap Melayani Anda
                    </h1>
                    <p class="text-gray-600 leading-relaxed max-w-2xl">
                        Punya pertanyaan tentang layanan kami? Tim kami siap memberikan solusi terbaik bagi setiap kebutuhan air bersih Anda. Silakan hubungi kami melalui saluran berikut.
                    </p>
                </div>
            </div>
        </div>

        <!-- Contact Cards Grid -->
        <div class="ct-grid">

            <!-- Email Card -->
            <div class="ct-card" data-aos="fade-up" data-aos-delay="100">
                <div class="ct-icon-wrapper">
                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z" />
                    </svg>
                </div>
                <h3 class="ct-card-title">Email Kami</h3>
                <p class="ct-card-subtitle">Kirim Email Kapan Saja</p>

                <div class="ct-contact-item">
                    <span class="ct-contact-label">Customer Service</span>
                    <a href="mailto:<?= esc($contact['email_cs']) ?>" class="ct-contact-value"><?= esc($contact['email_cs']) ?></a>
                </div>

                <div class="ct-contact-item">
                    <span class="ct-contact-label">Public Relation</span>
                    <a href="mailto:<?= esc($contact['email_pr']) ?>" class="ct-contact-value"><?= esc($contact['email_pr']) ?></a>
                    <a href="mailto:<?= esc($contact['email_perumda']) ?>"
                        class="ct-contact-value"><?= esc($contact['email_perumda']) ?></a>
                </div>

                <div class="ct-contact-item">
                    <span class="ct-contact-label">IT Support</span>
                    <a href="mailto:<?= esc($contact['email_it']) ?>" class="ct-contact-value"><?= esc($contact['email_it']) ?></a>
                </div>
            </div>

            <!-- Phone/WhatsApp Card -->
            <div class="ct-card" data-aos="fade-up" data-aos-delay="200">
                <div class="ct-icon-wrapper">
                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M20.01 15.38c-1.23 0-2.42-.2-3.53-.56-.35-.12-.74-.03-1.01.24l-1.57 1.97c-2.83-1.35-5.48-3.9-6.89-6.83l1.95-1.66c.27-.28.35-.67.24-1.02-.37-1.11-.56-2.3-.56-3.53 0-.54-.45-.99-.99-.99H4.19C3.65 3 3 3.24 3 3.99 3 13.28 10.73 21 20.01 21c.71 0 .99-.63.99-1.18v-3.45c0-.54-.45-.99-.99-.99z" />
                    </svg>
                </div>
                <h3 class="ct-card-title">Hubungi Kami</h3>
                <p class="ct-card-subtitle">Chat via WhatsApp</p>

                <div class="ct-contact-item">
                    <span class="ct-contact-label">Customer Service</span>
                    <span class="ct-contact-value">Layanan Pelanggan 24/7</span>
                    <a href="<?= esc($contact['wa_cs']) ?>" class="ct-wa-btn" target="_blank">
                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                        </svg>
                        Chat Sekarang
                    </a>
                </div>

                <div class="ct-contact-item">
                    <span class="ct-contact-label">Humas</span>
                    <span class="ct-contact-value"><?= esc($contact['name_humas']) ?></span>
                    <a href="<?= esc($contact['wa_humas']) ?>" class="ct-wa-btn" target="_blank">
                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                        </svg>
                        Chat Sekarang
                    </a>
                </div>

                <div class="ct-contact-item">
                    <span class="ct-contact-label">Penagihan</span>
                    <ul class="ct-list">
                        <li>Konfirmasi Bukti Transfer</li>
                    </ul>
                    <span class="ct-contact-value"><?= esc($contact['name_billing']) ?></span>
                    <a href="<?= esc($contact['wa_billing']) ?>" class="ct-wa-btn" target="_blank">
                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                        </svg>
                        Chat Sekarang
                    </a>
                </div>
            </div>

            <!-- Map Card - Full Width -->
            <div class="ct-card" data-aos="fade-up" data-aos-delay="300">
                <div class="ct-icon-wrapper">
                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" />
                    </svg>
                </div>
                <h3 class="ct-card-title">Lokasi Kantor</h3>
                <p class="ct-card-subtitle">Kunjungi Kami</p>
                <p class="ct-address-text">
                    <?= nl2br((string)esc($contact['address'])) ?>
                </p>
                <div class="ct-map-wrapper">
                    <iframe
                        src="<?= esc($contact['maps_url']) ?>"
                        allowfullscreen loading="lazy">
                    </iframe>
                </div>
            </div>

        </div>

    </div>
</section>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="https://unpkg.com/@lottiefiles/dotlottie-wc@0.8.5/dist/dotlottie-wc.js" type="module"></script>
<?= $this->endSection() ?>