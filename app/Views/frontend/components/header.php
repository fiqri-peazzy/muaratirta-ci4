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
                <img
                    src="<?= base_url('assets/image/logo.svg') ?>"
                    alt="Logo PDAM Muara Tirta"
                    class="h-12 w-auto transition-all duration-300"
                    :class="scrolled ? 'filter-none' : 'brightness-0 invert'">
                <div class="hidden lg:block">
                    <div
                        class="font-display font-bold text-sm leading-tight transition-colors duration-300"
                        :class="scrolled ? 'text-gray-900' : 'text-white'">
                        PERUMDA AIR MINUM<br>
                        <span class="text-primary-600">MUARA TIRTA</span>
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
                        <a href="<?= base_url('visi-misi') ?>" class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-600 transition-colors">
                            Visi Misi
                        </a>
                        <a href="<?= base_url('struktur-organisasi') ?>" class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-600 transition-colors">
                            Struktur Organisasi
                        </a>
                        <a href="<?= base_url('infrastruktur') ?>" class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-600 transition-colors">
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
                        <a href="<?= base_url('cek-tagihan') ?>" class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-600 transition-colors">
                            Cek Tagihan
                        </a>
                        <a href="<?= base_url('pasang-baru') ?>" class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-600 transition-colors">
                            Pasang Baru
                        </a>
                        <a href="<?= base_url('lapor-keluhan') ?>" class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-600 transition-colors">
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
                        <a href="<?= base_url('berita') ?>" class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-600 transition-colors">
                            Berita
                        </a>
                        <a href="<?= base_url('promo') ?>" class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-600 transition-colors">
                            Promo
                        </a>
                        <a href="<?= base_url('info-gangguan') ?>" class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-600 transition-colors">
                            Info Gangguan
                        </a>
                        <a href="<?= base_url('galeri') ?>" class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-600 transition-colors">
                            Galeri
                        </a>
                    </div>
                </div>

                <!-- Kontak -->
                <a
                    href="<?= base_url('kontak') ?>"
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
                        <a href="<?= base_url('visi-misi') ?>" class="block px-4 py-2 text-sm text-gray-600 hover:text-primary-600">Visi Misi</a>
                        <a href="<?= base_url('struktur-organisasi') ?>" class="block px-4 py-2 text-sm text-gray-600 hover:text-primary-600">Struktur Organisasi</a>
                        <a href="<?= base_url('infrastruktur') ?>" class="block px-4 py-2 text-sm text-gray-600 hover:text-primary-600">Infrastruktur</a>
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
                        <a href="<?= base_url('cek-tagihan') ?>" class="block px-4 py-2 text-sm text-gray-600 hover:text-primary-600">Cek Tagihan</a>
                        <a href="<?= base_url('pasang-baru') ?>" class="block px-4 py-2 text-sm text-gray-600 hover:text-primary-600">Pasang Baru</a>
                        <a href="<?= base_url('lapor-keluhan') ?>" class="block px-4 py-2 text-sm text-gray-600 hover:text-primary-600">Lapor Keluhan</a>
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
                        <a href="<?= base_url('berita') ?>" class="block px-4 py-2 text-sm text-gray-600 hover:text-primary-600">Berita</a>
                        <a href="<?= base_url('promo') ?>" class="block px-4 py-2 text-sm text-gray-600 hover:text-primary-600">Promo</a>
                        <a href="<?= base_url('info-gangguan') ?>" class="block px-4 py-2 text-sm text-gray-600 hover:text-primary-600">Info Gangguan</a>
                        <a href="<?= base_url('galeri') ?>" class="block px-4 py-2 text-sm text-gray-600 hover:text-primary-600">Galeri</a>
                    </div>
                </div>
            </div>

            <a href="<?= base_url('kontak') ?>" class="block px-4 py-3 text-gray-700 hover:bg-primary-50 hover:text-primary-600 rounded-lg transition-colors">
                Kontak
            </a>
        </div>
    </div>
</header>