<?= $this->extend('frontend/layouts/main') ?>

<?= $this->section('styles') ?>
<style>
    /* Organization Page Styles - Prefix: org- */
    .org-section {
        padding: 40px 0;
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    }

    .org-header {
        text-align: center;
        margin-bottom: 30px;
    }

    /* Hierarchy Connectors */
    .org-top-level-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 20px;
        position: relative;
        margin-bottom: 40px;
    }

    .org-level-wrapper {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 15px;
        width: 100%;
        position: relative;
    }

    /* Staff Card */
    .org-card {
        background: #ffffff;
        border-radius: 16px;
        padding: 16px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        border: 1px solid rgba(0, 123, 255, 0.08);
        width: 240px;
        text-align: center;
        position: relative;
        z-index: 2;
    }

    .org-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 28px rgba(0, 123, 255, 0.1);
        border-color: #007bff;
    }

    .org-avatar-wrapper {
        width: 90px;
        height: 90px;
        margin: 0 auto 12px;
        position: relative;
    }

    .org-avatar {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
        border: 3px solid #fff;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .org-name {
        font-size: 14px;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 3px;
        line-height: 1.2;
    }

    .org-jabatan {
        font-size: 11px;
        color: #007bff;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    .org-nip {
        font-size: 10px;
        color: #888;
        margin-top: 3px;
    }

    /* Department Section */
    .org-dept-container {
        margin-top: 20px;
    }

    /* Desktop View Title */
    .org-dept-title {
        font-size: 20px;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 20px;
        padding-bottom: 8px;
        border-bottom: 2px solid #007bff;
        display: inline-block;
    }

    .org-dept-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: 15px;
        margin-bottom: 40px;
    }

    /* Vertical Connectors */
    .org-line-v {
        width: 2px;
        background: #dee2e6;
        height: 20px;
    }

    /* Accordion Styles (Mobile) */
    .org-accordion-header {
        display: none;
        width: 100%;
        padding: 15px 20px;
        background: #fff;
        border-radius: 12px;
        margin-bottom: 10px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        cursor: pointer;
        justify-content: connect;
        align-items: center;
        border: 1px solid #edf2f7;
        transition: all 0.3s;
    }

    .org-accordion-header:hover {
        border-color: #007bff;
        background: #f8fbff;
    }

    .org-accordion-header.active {
        background: #007bff;
        color: #fff;
    }

    .org-accordion-header.active svg {
        transform: rotate(180deg);
        color: #fff;
    }

    .org-accordion-icon {
        transition: transform 0.3s;
        margin-left: auto;
    }

    /* Responsive Logic */
    @media (max-width: 768px) {
        .org-card {
            width: 100%;
            max-width: none;
        }

        .org-dept-title {
            display: none;
            /* Use accordion header instead */
        }

        .org-accordion-header {
            display: flex;
            justify-content: space-between;
        }

        .org-dept-grid {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.5s ease-out, margin-bottom 0.5s;
            margin-bottom: 0;
            grid-template-columns: 1fr;
            /* Single column on mobile */
        }

        .org-dept-grid.open {
            max-height: 2000px;
            /* Large enough to fit content */
            margin-bottom: 20px;
            padding-top: 10px;
        }

        .org-top-level-container {
            gap: 15px;
        }
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('title') ?><?= $title ?><?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Breadcrumb -->
<section class="relative pt-24 pb-8 bg-gradient-to-r from-primary-600 to-water-500 overflow-hidden">
    <div class="absolute inset-0 opacity-20">
        <svg class="absolute bottom-0 w-full h-32" viewBox="0 0 1440 320" xmlns="http://www.w3.org/2000/svg">
            <path fill="#ffffff" fill-opacity="0.3" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,112C672,96,768,96,864,112C960,128,1056,160,1152,160C1248,160,1344,128,1392,112L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
        </svg>
    </div>
    <div class="container mx-auto px-4 relative z-10">
        <h1 class="text-3xl lg:text-4xl font-display font-bold text-white mb-2 text-center lg:text-left"><?= $title ?></h1>
        <nav class="flex items-center justify-center lg:justify-start space-x-2 text-sm">
            <a href="<?= base_url('/') ?>" class="text-white/80 hover:text-white transition-colors font-medium">Beranda</a>
            <svg class="w-4 h-4 text-white/60" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
            </svg>
            <span class="text-white font-semibold"><?= $title ?></span>
        </nav>
    </div>
</section>

<section class="org-section">
    <div class="container mx-auto px-4 max-w-6xl">

        <!-- Header Section -->
        <div class="org-header" data-aos="fade-up">
            <h2 class="text-3xl font-display font-bold text-gray-900 mb-2">Struktur Organisasi</h2>
            <p class="text-sm text-gray-600 max-w-2xl mx-auto">Jajaran manajemen dan tim profesional PERUMDA Air Minum Muara Tirta Kota Gorontalo.</p>
        </div>

        <!-- Top Level Hierarchy (1, 2, 3) -->
        <div class="org-top-level-container">
            <?php for ($lvl = 1; $lvl <= 3; $lvl++): ?>
                <?php if (isset($topLevelStaff[$lvl])): ?>
                    <div class="org-level-wrapper" data-aos="fade-up">
                        <?php foreach ($topLevelStaff[$lvl] as $s): ?>
                            <div class="org-card">
                                <div class="org-avatar-wrapper">
                                    <img src="<?= $s->profile_pict ? base_url('uploads/organisasi/' . $s->profile_pict) : 'https://ui-avatars.com/api/?name=' . urlencode($s->nm_lengkap) . '&background=007bff&color=fff' ?>"
                                        alt="<?= esc($s->nm_lengkap) ?>" class="org-avatar">
                                </div>
                                <h3 class="org-name">
                                    <?= ($s->gelar_depan ? $s->gelar_depan . ' ' : '') . esc($s->nm_lengkap) . ($s->gelar_belakang ? ', ' . $s->gelar_belakang : '') ?>
                                </h3>
                                <p class="org-jabatan"><?= esc($s->jabatan_spesifik) ?></p>
                                <?php if ($s->nip): ?>
                                    <p class="org-nip text-gray-400">NIP. <?= esc($s->nip) ?></p>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <?php if ($lvl < 3 && (isset($topLevelStaff[$lvl + 1]) || !empty($departmentalStaff))): ?>
                        <div class="org-line-v"></div>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endfor; ?>
        </div>

        <!-- Separator -->
        <div class="text-center mb-10" data-aos="fade-up">
            <div class="org-line-v mx-auto mb-2"></div>
            <h3 class="text-lg font-bold text-gray-400 uppercase tracking-widest">Divisi & Bagian</h3>
        </div>

        <!-- Departmental Section -->
        <div class="org-dept-container">
            <?php foreach ($allBagian as $b): ?>
                <?php if (isset($departmentalStaff[$b->id])): ?>
                    <div class="mb-4 lg:mb-10" data-aos="fade-up">
                        <!-- Desktop Static Title -->
                        <h4 class="org-dept-title"><?= esc($b->nama_bagian) ?></h4>

                        <!-- Mobile Accordion Header -->
                        <div class="org-accordion-header" onclick="toggleAccordion(this)">
                            <span class="font-bold text-sm"><?= esc($b->nama_bagian) ?></span>
                            <span class="text-xs bg-primary-100 text-primary-600 px-2 py-1 rounded-full mr-2"><?= count($departmentalStaff[$b->id], COUNT_RECURSIVE) - count($departmentalStaff[$b->id]) ?> Personel</span>
                            <svg class="w-4 h-4 org-accordion-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>

                        <div class="org-dept-grid">
                            <?php
                            $staffs = [];
                            // The departmentalStaff is [level => [staff]]
                            ksort($departmentalStaff[$b->id]);
                            foreach ($departmentalStaff[$b->id] as $lvl => $list) {
                                foreach ($list as $s) $staffs[] = $s;
                            }
                            ?>
                            <?php foreach ($staffs as $s): ?>
                                <div class="org-card flex flex-row items-center gap-4 lg:flex-col lg:justify-center p-3 lg:p-4">
                                    <div class="org-avatar-wrapper !w-16 !h-16 lg:!w-20 lg:!h-20 !m-0 lg:!mx-auto lg:!mb-3 lg:flex-shrink-0">
                                        <img src="<?= $s->profile_pict ? base_url('uploads/organisasi/' . $s->profile_pict) : 'https://ui-avatars.com/api/?name=' . urlencode($s->nm_lengkap) . '&background=random&color=fff' ?>"
                                            alt="<?= esc($s->nm_lengkap) ?>" class="org-avatar">
                                    </div>
                                    <div class="text-left lg:text-center">
                                        <h3 class="org-name !text-xs lg:!text-sm">
                                            <?= ($s->gelar_depan ? $s->gelar_depan . ' ' : '') . esc($s->nm_lengkap) . ($s->gelar_belakang ? ', ' . $s->gelar_belakang : '') ?>
                                        </h3>
                                        <p class="org-jabatan !text-[10px] lg:!text-[11px]"><?= esc($s->jabatan_spesifik) ?></p>
                                        <?php if ($s->nip): ?>
                                            <p class="org-nip !mt-1">NIP. <?= esc($s->nip) ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>

    </div>
</section>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script>
    AOS.init({
        duration: 800,
        once: true,
        offset: 50
    });

    function toggleAccordion(header) {
        // Toggle the grid display
        const grid = header.nextElementSibling;
        const isActive = header.classList.contains('active');

        // Close all other accordions first (optional, but requested for 'save space')
        document.querySelectorAll('.org-accordion-header').forEach(h => {
            if (h !== header) {
                h.classList.remove('active');
                h.nextElementSibling.classList.remove('open');
            }
        });

        // Toggle current
        header.classList.toggle('active');
        grid.classList.toggle('open');
    }
</script>
<?= $this->endSection() ?>