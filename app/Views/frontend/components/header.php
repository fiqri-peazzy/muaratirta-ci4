<header
    x-data="{ 
    scrolled: false,
    mobileMenuOpen: false 
}"
    @scroll.window="scrolled = window.pageYOffset > 50"
    :class="scrolled ? 'bg-white/95 backdrop-blur-md shadow-lg' : 'bg-transparent'"
    class="fixed w-full top-0 z-50 transition-all duration-300">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="flex items-center justify-between h-20">

            <!-- Logo -->
            <a href="<?= base_url('/') ?>" class="flex items-center space-x-3 group">
                <svg width="45" height="45" viewBox="0 0 45 45" fill="none" xmlns="http://www.w3.org/2000/svg"
                    class="h-12 w-auto transition-all duration-300"
                    :class="scrolled ? 'text-primary-600' : 'text-white'">
                    <g>
                        <path d="M20.9414 36.0695C15.7911 36.0695 11.5395 31.0672 11.7914 24.86C11.7914 24.86 14.8838 24.1542 18.4209 25.1761C21.8794 26.1753 23.2995 27.5324 26.4765 27.9748C28.6236 28.2739 29.7896 28.0925 29.7896 28.0925C29.7896 28.0925 29.8371 29.4745 28.1003 29.7905C26.3636 30.1066 24.2031 30.4648 20.4542 29.9169C16.7053 29.3691 14.3754 27.7677 13.6765 27.3885C12.9775 27.0092 12.5115 26.5878 12.5115 26.5878C12.5115 26.5878 13.6341 29.4534 18.315 31.3497C22.9959 33.2461 28.4816 31.7079 28.4816 31.7079C28.4816 31.7079 26.3424 36.0695 20.9414 36.0695Z" fill="currentColor" />
                        <path d="M4.80188 27.5781C4.80188 27.5781 8.68551 23.7445 14.7661 24.1318C20.8467 24.5192 23.6923 27.797 28.6047 27.7076C33.5171 27.6182 37.3212 25.4132 37.3212 25.4132C37.3212 25.4132 29.9826 27.8268 25.6393 25.145C21.296 22.4631 16.6232 22.195 12.8491 22.9399C9.07491 23.6849 5.50116 25.9885 4.80188 27.5781Z" fill="currentColor" />
                        <path d="M36.3627 27.6778C36.3627 27.6778 31.0909 31.2834 25.1001 31.7899C19.7901 32.2389 15.5449 29.421 15.0357 29.0634C14.5265 28.7058 14.0732 28.1637 14.0732 28.1637C14.0732 28.1637 17.9688 30.6278 23.3329 30.6278C27.8728 30.6278 31.1957 29.4955 33.0229 28.7654C34.85 28.0354 36.2955 27.3979 36.4076 27.3649C36.5513 27.3226 36.6023 27.4841 36.3627 27.6778Z" fill="currentColor" />
                        <path d="M12.4596 22.5525C12.4596 22.5525 15.6347 21.8075 19.5886 22.3439C25.7499 23.289 26.4701 25.9793 30.2521 25.9793C30.2521 25.9793 30.5816 22.4631 28.0055 18.1424C25.4295 13.8216 24.5908 13.0469 23.153 10.1565C21.7153 7.26604 21.3259 6.46149 21.3259 6.46149C21.3259 6.46149 18.5102 11.8848 16.5632 14.805C14.6163 17.7252 12.5794 21.45 12.4596 22.5525Z" fill="currentColor" />
                        <path d="M21.51 2.32311C21.4837 2.32348 21.4576 2.32843 21.4331 2.33776L8.34366 7.31051C8.29479 7.32906 8.25396 7.36402 8.22824 7.40933L1.36578 19.5037C1.3403 19.5486 1.33123 19.6009 1.34011 19.6517L3.75465 33.4739C3.76364 33.5253 3.79048 33.572 3.83049 33.6058L14.5053 42.624C14.5459 42.6583 14.5974 42.6771 14.6506 42.6771H21.5131H28.3756C28.4289 42.6771 28.4804 42.6583 28.5209 42.624L39.196 33.6058C39.236 33.572 39.2628 33.5253 39.2718 33.4739L41.6863 19.6517C41.6952 19.6009 41.6862 19.5486 41.6607 19.5037L34.7982 7.40933C34.7724 7.36403 34.7316 7.32907 34.6828 7.31051L21.5932 2.33776C21.5666 2.32767 21.5384 2.3227 21.51 2.32311ZM21.5132 2.78531L34.4471 7.69892L41.2304 19.6538L38.8434 33.3178L28.2932 42.2305H21.5131H14.7331L4.18301 33.3178L1.79606 19.6538L8.5794 7.69892L21.5132 2.78531Z" fill="currentColor" />
                        <path d="M21.5162 0.986831C21.4729 0.98644 21.43 0.994121 21.3895 1.00948L7.50316 6.28498C7.42774 6.31364 7.36475 6.36759 7.32507 6.43753L0.0447624 19.2683C0.00542999 19.3376 -0.00857965 19.4183 0.00511179 19.4967L2.56675 34.1604C2.58062 34.2398 2.62203 34.3119 2.68378 34.3641L14.0086 43.9313C14.0712 43.9842 14.1507 44.0133 14.2328 44.0132H21.5131H28.7935C28.8756 44.0133 28.9551 43.9842 29.0177 43.9313L40.3427 34.3641C40.4045 34.3119 40.4459 34.2398 40.4597 34.1604L43.0213 19.4967C43.035 19.4183 43.021 19.3376 42.9817 19.2683L35.7013 6.43753C35.6617 6.3676 35.5987 6.31365 35.5233 6.28498L21.6367 1.00948C21.5982 0.994859 21.5574 0.987191 21.5162 0.986831ZM21.5131 1.70028L35.1595 6.88453L42.3175 19.4999L39.7986 33.9195L28.6662 43.324H21.5131H14.3601L3.22782 33.9195L0.708863 19.4999L7.867 6.88453L21.5131 1.70028Z" fill="currentColor" />
                    </g>
                </svg>
                <div class="hidden lg:block">
                    <div
                        class="font-display font-bold text-sm leading-tight transition-colors duration-300"
                        :class="scrolled ? 'text-gray-900' : 'text-white'">
                        PERUMDA AIR MINUM<br>
                        <span :class="scrolled ? 'text-primary-600' : 'text-white'">MUARA TIRTA</span>
                    </div>
                    <div
                        class="text-xs mt-0.5 transition-colors duration-300"
                        :class="scrolled ? 'text-gray-600' : 'text-gray-100'">
                        Kota Gorontalo
                    </div>
                </div>
            </a>

            <!-- Desktop Navigation -->
            <nav class="hidden lg:flex items-center space-x-1">
                <!-- Beranda -->
                <a
                    href="<?= base_url('/') ?>"
                    class="px-4 py-2 rounded-lg font-medium text-sm transition-all duration-200"
                    :class="scrolled 
                    ? 'text-gray-700 hover:text-primary-600 hover:bg-primary-50' 
                    : 'text-white hover:bg-white/10'">
                    Beranda
                </a>

                <!-- Profil Dropdown -->
                <div x-data="{ open: false }" class="relative">
                    <button
                        @click="open = !open"
                        @click.away="open = false"
                        class="px-4 py-2 rounded-lg font-medium text-sm transition-all duration-200 flex items-center space-x-1"
                        :class="scrolled 
                        ? 'text-gray-700 hover:text-primary-600 hover:bg-primary-50' 
                        : 'text-white hover:bg-white/10'">
                        <span>Profil</span>
                        <svg
                            class="w-4 h-4 transition-transform duration-200"
                            :class="open ? 'rotate-180' : ''"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div
                        x-show="open"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 scale-95"
                        x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 scale-100"
                        x-transition:leave-end="opacity-0 scale-95"
                        class="absolute top-full left-0 mt-2 w-56 bg-white rounded-xl shadow-xl border border-gray-100 py-2"
                        style="display: none;">
                        <a href="<?= base_url('about') ?>" class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-600 transition-colors">
                            Tentang Perusahaan
                        </a>
                        <a href="<?= route_to('visi_misi') ?>" class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-600 transition-colors">
                            Visi Misi
                        </a>
                        <a href="<?= route_to('public.organisasi') ?>" class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-600 transition-colors">
                            Struktur Organisasi
                        </a>
                        <a href="<?= route_to('infrastruktur') ?>" class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-600 transition-colors">
                            Infrastruktur
                        </a>
                    </div>
                </div>

                <!-- Pelanggan Dropdown -->
                <div x-data="{ open: false }" class="relative">
                    <button
                        @click="open = !open"
                        @click.away="open = false"
                        class="px-4 py-2 rounded-lg font-medium text-sm transition-all duration-200 flex items-center space-x-1"
                        :class="scrolled 
                        ? 'text-gray-700 hover:text-primary-600 hover:bg-primary-50' 
                        : 'text-white hover:bg-white/10'">
                        <span>Pelanggan</span>
                        <svg
                            class="w-4 h-4 transition-transform duration-200"
                            :class="open ? 'rotate-180' : ''"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div
                        x-show="open"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 scale-95"
                        x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 scale-100"
                        x-transition:leave-end="opacity-0 scale-95"
                        class="absolute top-full left-0 mt-2 w-56 bg-white rounded-xl shadow-xl border border-gray-100 py-2"
                        style="display: none;">
                        <a href="<?= route_to('tagihan') ?>" class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-600 transition-colors">
                            Cek Tagihan
                        </a>
                        <a href="<?= route_to('pasang_baru') ?>" class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-600 transition-colors">
                            Pasang Baru
                        </a>
                        <a href="<?= route_to('lapor_keluhan') ?>" class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-600 transition-colors">
                            Lapor Keluhan
                        </a>
                    </div>
                </div>

                <!-- Informasi Dropdown -->
                <div x-data="{ open: false }" class="relative">
                    <button
                        @click="open = !open"
                        @click.away="open = false"
                        class="px-4 py-2 rounded-lg font-medium text-sm transition-all duration-200 flex items-center space-x-1"
                        :class="scrolled 
                        ? 'text-gray-700 hover:text-primary-600 hover:bg-primary-50' 
                        : 'text-white hover:bg-white/10'">
                        <span>Informasi</span>
                        <svg
                            class="w-4 h-4 transition-transform duration-200"
                            :class="open ? 'rotate-180' : ''"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div
                        x-show="open"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 scale-95"
                        x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 scale-100"
                        x-transition:leave-end="opacity-0 scale-95"
                        class="absolute top-full left-0 mt-2 w-56 bg-white rounded-xl shadow-xl border border-gray-100 py-2"
                        style="display: none;">
                        <a href="<?= route_to('news') ?>" class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-600 transition-colors">
                            Berita
                        </a>
                        <a href="<?= route_to('promo') ?>" class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-600 transition-colors">
                            Promo
                        </a>
                        <a href="<?= route_to('outage') ?>" class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-600 transition-colors">
                            Info Gangguan
                        </a>
                        <a href="<?= route_to('gallery') ?>" class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-600 transition-colors">
                            Galeri
                        </a>
                    </div>
                </div>

                <!-- Kontak -->
                <a
                    href="<?= route_to('contact') ?>"
                    class="px-4 py-2 rounded-lg font-medium text-sm transition-all duration-200"
                    :class="scrolled 
                    ? 'text-gray-700 hover:text-primary-600 hover:bg-primary-50' 
                    : 'text-white hover:bg-white/10'">
                    Kontak
                </a>
            </nav>

            <!-- Mobile Menu Button -->
            <button
                @click="mobileMenuOpen = !mobileMenuOpen"
                class="lg:hidden p-2 rounded-lg transition-colors"
                :class="scrolled ? 'text-gray-900' : 'text-white'">
                <svg
                    x-show="!mobileMenuOpen"
                    class="w-6 h-6"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg
                    x-show="mobileMenuOpen"
                    class="w-6 h-6"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                    style="display: none;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div
        x-show="mobileMenuOpen"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-4"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-4"
        class="lg:hidden bg-white border-t border-gray-100 shadow-xl"
        style="display: none;">
        <div class="container mx-auto px-4 py-4 space-y-2">
            <a href="<?= base_url('/') ?>" class="block px-4 py-3 text-gray-700 hover:bg-primary-50 hover:text-primary-600 rounded-lg transition-colors">
                Beranda
            </a>

            <!-- Mobile Profil Accordion -->
            <div x-data="{ open: false }">
                <button
                    @click="open = !open"
                    class="w-full flex items-center justify-between px-4 py-3 text-gray-700 hover:bg-primary-50 rounded-lg transition-colors">
                    <span>Profil</span>
                    <svg
                        class="w-5 h-5 transition-transform"
                        :class="open ? 'rotate-180' : ''"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="open" x-collapse style="display: none;">
                    <div class="pl-4 py-2 space-y-1">
                        <a href="<?= base_url('about') ?>" class="block px-4 py-2 text-sm text-gray-600 hover:text-primary-600">Tentang Perusahaan</a>
                        <a href="<?= route_to('visi_misi') ?>" class="block px-4 py-2 text-sm text-gray-600 hover:text-primary-600">Visi Misi</a>
                        <a href="<?= route_to('public.organisasi') ?>" class="block px-4 py-2 text-sm text-gray-600 hover:text-primary-600">Struktur Organisasi</a>
                        <a href="<?= route_to('infrastruktur') ?>" class="block px-4 py-2 text-sm text-gray-600 hover:text-primary-600">Infrastruktur</a>
                    </div>
                </div>
            </div>

            <!-- Mobile Pelanggan Accordion -->
            <div x-data="{ open: false }">
                <button
                    @click="open = !open"
                    class="w-full flex items-center justify-between px-4 py-3 text-gray-700 hover:bg-primary-50 rounded-lg transition-colors">
                    <span>Pelanggan</span>
                    <svg
                        class="w-5 h-5 transition-transform"
                        :class="open ? 'rotate-180' : ''"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="open" x-collapse style="display: none;">
                    <div class="pl-4 py-2 space-y-1">
                        <a href="<?= route_to('tagihan') ?>" class="block px-4 py-2 text-sm text-gray-600 hover:text-primary-600">Cek Tagihan</a>
                        <a href="<?= route_to('pasang-baru') ?>" class="block px-4 py-2 text-sm text-gray-600 hover:text-primary-600">Pasang Baru</a>
                        <a href="<?= route_to('keluhan') ?>" class="block px-4 py-2 text-sm text-gray-600 hover:text-primary-600">Lapor Keluhan</a>
                    </div>
                </div>
            </div>

            <!-- Mobile Informasi Accordion -->
            <div x-data="{ open: false }">
                <button
                    @click="open = !open"
                    class="w-full flex items-center justify-between px-4 py-3 text-gray-700 hover:bg-primary-50 rounded-lg transition-colors">
                    <span>Informasi</span>
                    <svg
                        class="w-5 h-5 transition-transform"
                        :class="open ? 'rotate-180' : ''"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="open" x-collapse style="display: none;">
                    <div class="pl-4 py-2 space-y-1">
                        <a href="<?= route_to('news') ?>" class="block px-4 py-2 text-sm text-gray-600 hover:text-primary-600">Berita</a>
                        <a href="<?= route_to('promo') ?>" class="block px-4 py-2 text-sm text-gray-600 hover:text-primary-600">Promo</a>
                        <a href="<?= route_to('outage') ?>" class="block px-4 py-2 text-sm text-gray-600 hover:text-primary-600">Info Gangguan</a>
                        <a href="<?= route_to('gallery') ?>" class="block px-4 py-2 text-sm text-gray-600 hover:text-primary-600">Galeri</a>
                    </div>
                </div>
            </div>

            <a href="<?= route_to('contact') ?>" class="block px-4 py-3 text-gray-700 hover:bg-primary-50 hover:text-primary-600 rounded-lg transition-colors">
                Kontak
            </a>
        </div>
    </div>
</header>