<!-- Top Navigation -->
<nav class="fixed top-0 w-full z-50 bg-surface/90 backdrop-blur-md border-b border-outline-variant/30 shadow-sm">
    <div class="max-w-container-max mx-auto px-4 md:px-margin-desktop py-4 flex justify-between items-center">
        <!-- Logo & Brand -->
        <a href="{{ route('home') }}" class="flex items-center gap-2 xl:gap-4 shrink-0">
            <img alt="School Logo" class="h-10 w-auto" src="{{ asset('images/logo.png') }}" loading="lazy"/>
            <span class="font-headline-md text-base lg:text-lg xl:text-headline-md font-bold text-primary whitespace-nowrap">SDN Bulusan</span>
        </a>
        
        <!-- Desktop Menu Items -->
        <div class="hidden lg:flex items-center gap-3 xl:gap-5 shrink-0">
            <!-- Beranda -->
            <a class="font-label-md lg:text-[13px] xl:text-label-md {{ Route::is('home') ? 'text-secondary font-bold border-b-2 border-secondary pb-1' : 'text-on-surface-variant hover:text-primary transition-colors pb-1' }}" href="{{ route('home') }}">
                Beranda
            </a>
            
            <!-- Profil Dropdown -->
            <div class="relative group">
                <button class="flex items-center gap-1 font-label-md lg:text-[13px] xl:text-label-md {{ Request::is('tentang*') ? 'text-secondary font-bold border-b-2 border-secondary pb-1' : 'text-on-surface-variant hover:text-primary transition-colors pb-1' }}">
                    <span>Profil</span>
                    <span class="material-symbols-outlined text-[16px] transition-transform duration-200 group-hover:rotate-180">arrow_drop_down</span>
                </button>
                <div class="absolute left-0 mt-2 w-56 rounded-2xl bg-white/95 backdrop-blur-md border border-outline-variant/30 shadow-[0_8px_30px_rgb(0,0,0,0.06)] py-2 opacity-0 invisible translate-y-2 group-hover:opacity-100 group-hover:visible group-hover:translate-y-0 transition-all duration-200 z-50">
                    <a href="{{ route('tentang') }}#tentang" class="block px-4 py-2 text-sm text-on-surface-variant hover:bg-surface-variant/50 hover:text-primary transition-colors font-medium">Tentang Sekolah</a>
                    <a href="{{ route('tentang') }}#visi-misi" class="block px-4 py-2 text-sm text-on-surface-variant hover:bg-surface-variant/50 hover:text-primary transition-colors font-medium">Visi & Misi</a>
                    <a href="{{ route('tentang') }}#sambutan" class="block px-4 py-2 text-sm text-on-surface-variant hover:bg-surface-variant/50 hover:text-primary transition-colors font-medium">Sambutan Kepala Sekolah</a>
                    <a href="{{ route('tentang') }}#guru-staf" class="block px-4 py-2 text-sm text-on-surface-variant hover:bg-surface-variant/50 hover:text-primary transition-colors font-medium">Guru & Staf</a>
                </div>
            </div>

            <!-- Akademik Dropdown -->
            <div class="relative group">
                <button class="flex items-center gap-1 font-label-md lg:text-[13px] xl:text-label-md {{ Request::is('ekstrakurikuler*') || Request::is('prestasi*') ? 'text-secondary font-bold border-b-2 border-secondary pb-1' : 'text-on-surface-variant hover:text-primary transition-colors pb-1' }}">
                    <span>Akademik</span>
                    <span class="material-symbols-outlined text-[16px] transition-transform duration-200 group-hover:rotate-180">arrow_drop_down</span>
                </button>
                <div class="absolute left-0 mt-2 w-56 rounded-2xl bg-white/95 backdrop-blur-md border border-outline-variant/30 shadow-[0_8px_30px_rgb(0,0,0,0.06)] py-2 opacity-0 invisible translate-y-2 group-hover:opacity-100 group-hover:visible group-hover:translate-y-0 transition-all duration-200 z-50">
                    <a href="{{ route('ekstrakurikuler') }}" class="block px-4 py-2 text-sm {{ Route::is('ekstrakurikuler') ? 'text-secondary font-bold' : 'text-on-surface-variant' }} hover:bg-surface-variant/50 hover:text-primary transition-colors font-medium">Ekstrakurikuler</a>
                    <a href="{{ route('prestasi') }}" class="block px-4 py-2 text-sm {{ Route::is('prestasi') ? 'text-secondary font-bold' : 'text-on-surface-variant' }} hover:bg-surface-variant/50 hover:text-primary transition-colors font-medium">Prestasi</a>
                </div>
            </div>

            <!-- Pusat Informasi Dropdown -->
            <div class="relative group">
                <button class="flex items-center gap-1 font-label-md lg:text-[13px] xl:text-label-md {{ Request::is('pusat-informasi*') || Request::is('berita*') ? 'text-secondary font-bold border-b-2 border-secondary pb-1' : 'text-on-surface-variant hover:text-primary transition-colors pb-1' }}">
                    <span>Pusat Informasi</span>
                    <span class="material-symbols-outlined text-[16px] transition-transform duration-200 group-hover:rotate-180">arrow_drop_down</span>
                </button>
                <div class="absolute left-0 mt-2 w-56 rounded-2xl bg-white/95 backdrop-blur-md border border-outline-variant/30 shadow-[0_8px_30px_rgb(0,0,0,0.06)] py-2 opacity-0 invisible translate-y-2 group-hover:opacity-100 group-hover:visible group-hover:translate-y-0 transition-all duration-200 z-50">
                    <a href="{{ route('pusat-informasi') }}?tab=berita" class="block px-4 py-2 text-sm {{ Request::is('pusat-informasi*') && request('tab') == 'berita' ? 'text-secondary font-bold' : 'text-on-surface-variant' }} hover:bg-surface-variant/50 hover:text-primary transition-colors font-medium">Berita</a>
                    <a href="{{ route('pusat-informasi') }}?tab=pengumuman" class="block px-4 py-2 text-sm {{ Request::is('pusat-informasi*') && request('tab') == 'pengumuman' ? 'text-secondary font-bold' : 'text-on-surface-variant' }} hover:bg-surface-variant/50 hover:text-primary transition-colors font-medium">Pengumuman</a>
                    <a href="{{ route('pusat-informasi') }}?tab=agenda" class="block px-4 py-2 text-sm {{ Request::is('pusat-informasi*') && request('tab') == 'agenda' ? 'text-secondary font-bold' : 'text-on-surface-variant' }} hover:bg-surface-variant/50 hover:text-primary transition-colors font-medium">Agenda</a>
                </div>
            </div>

            <!-- PPDB -->
            <a class="font-label-md lg:text-[13px] xl:text-label-md {{ Route::is('penerimaan') ? 'text-secondary font-bold border-b-2 border-secondary pb-1' : 'text-on-surface-variant hover:text-primary transition-colors pb-1' }}" href="{{ route('penerimaan') }}">
                PPDB
            </a>

            <!-- Galeri -->
            <a class="font-label-md lg:text-[13px] xl:text-label-md {{ Route::is('galeri') || Route::is('galeri.album.show') ? 'text-secondary font-bold border-b-2 border-secondary pb-1' : 'text-on-surface-variant hover:text-primary transition-colors pb-1' }}" href="{{ route('galeri') }}">
                Galeri
            </a>

            <!-- Kontak -->
            <a class="font-label-md lg:text-[13px] xl:text-label-md {{ Route::is('kontak') ? 'text-secondary font-bold border-b-2 border-secondary pb-1' : 'text-on-surface-variant hover:text-primary transition-colors pb-1' }}" href="{{ route('kontak') }}">
                Kontak
            </a>
        </div>
        
        <!-- Actions & Mobile Trigger -->
        <div class="flex items-center gap-2 xl:gap-4 shrink-0">
            <a href="https://spmb.semarangkota.go.id/" target="_blank" class="bg-primary text-on-primary px-4 py-1.5 xl:px-6 xl:py-2 rounded-full font-label-md lg:text-xs xl:text-label-md hover:bg-primary/90 transition-colors hidden sm:block whitespace-nowrap">
                Daftar SPMB
            </a>
            
            @auth
                <a href="{{ route('admin.dashboard') }}" class="text-on-surface-variant hover:bg-secondary-container/20 rounded-full transition-all p-2 duration-150 ease-in-out flex items-center justify-center shrink-0" title="CMS Panel">
                    <span class="material-symbols-outlined">account_circle</span>
                </a>
            @else
                <a href="{{ route('login') }}" class="text-on-surface-variant hover:bg-secondary-container/20 rounded-full transition-all p-2 duration-150 ease-in-out flex items-center justify-center shrink-0" title="Login Operator">
                    <span class="material-symbols-outlined">account_circle</span>
                </a>
            @endauth

            <!-- Mobile Menu Button -->
            <button id="mobile-menu-btn" class="lg:hidden text-on-surface-variant p-2 flex items-center justify-center shrink-0">
                <span class="material-symbols-outlined">menu</span>
            </button>
        </div>
    </div>
    
    <!-- Mobile Dropdown Menu -->
    <div id="mobile-menu" class="hidden lg:hidden bg-surface border-t border-outline-variant/30 py-4 px-4 flex flex-col gap-2 max-h-[80vh] overflow-y-auto">
        <!-- Beranda -->
        <a class="text-on-surface hover:text-secondary font-medium py-2 {{ Route::is('home') ? 'text-secondary font-bold' : '' }}" href="{{ route('home') }}">
            Beranda
        </a>
        
        <!-- Profil Accordion -->
        <div class="flex flex-col">
            <button onclick="toggleMobileSubmenu('mobile-submenu-profil')" class="flex justify-between items-center text-on-surface hover:text-secondary font-medium py-2 w-full text-left">
                <span>Profil</span>
                <span id="mobile-arrow-profil" class="material-symbols-outlined transition-transform duration-200">arrow_drop_down</span>
            </button>
            <div id="mobile-submenu-profil" class="hidden flex flex-col pl-4 gap-2 border-l border-outline-variant/30 mt-1">
                <a href="{{ route('tentang') }}#tentang" class="text-on-surface-variant hover:text-secondary py-1 text-sm">Tentang Sekolah</a>
                <a href="{{ route('tentang') }}#visi-misi" class="text-on-surface-variant hover:text-secondary py-1 text-sm">Visi & Misi</a>
                <a href="{{ route('tentang') }}#sambutan" class="text-on-surface-variant hover:text-secondary py-1 text-sm">Sambutan Kepala Sekolah</a>
                <a href="{{ route('tentang') }}#guru-staf" class="text-on-surface-variant hover:text-secondary py-1 text-sm">Guru & Staf</a>
            </div>
        </div>

        <!-- Akademik Accordion -->
        <div class="flex flex-col">
            <button onclick="toggleMobileSubmenu('mobile-submenu-akademik')" class="flex justify-between items-center text-on-surface hover:text-secondary font-medium py-2 w-full text-left">
                <span>Akademik</span>
                <span id="mobile-arrow-akademik" class="material-symbols-outlined transition-transform duration-200">arrow_drop_down</span>
            </button>
            <div id="mobile-submenu-akademik" class="hidden flex flex-col pl-4 gap-2 border-l border-outline-variant/30 mt-1">
                <a href="{{ route('ekstrakurikuler') }}" class="text-on-surface-variant hover:text-secondary py-1 text-sm {{ Route::is('ekstrakurikuler') ? 'text-secondary font-bold' : '' }}">Ekstrakurikuler</a>
                <a href="{{ route('prestasi') }}" class="text-on-surface-variant hover:text-secondary py-1 text-sm {{ Route::is('prestasi') ? 'text-secondary font-bold' : '' }}">Prestasi</a>
            </div>
        </div>

        <!-- Pusat Informasi Accordion -->
        <div class="flex flex-col">
            <button onclick="toggleMobileSubmenu('mobile-submenu-informasi')" class="flex justify-between items-center text-on-surface hover:text-secondary font-medium py-2 w-full text-left">
                <span>Pusat Informasi</span>
                <span id="mobile-arrow-informasi" class="material-symbols-outlined transition-transform duration-200">arrow_drop_down</span>
            </button>
            <div id="mobile-submenu-informasi" class="hidden flex flex-col pl-4 gap-2 border-l border-outline-variant/30 mt-1">
                <a href="{{ route('pusat-informasi') }}?tab=berita" class="text-on-surface-variant hover:text-secondary py-1 text-sm">Berita</a>
                <a href="{{ route('pusat-informasi') }}?tab=pengumuman" class="text-on-surface-variant hover:text-secondary py-1 text-sm">Pengumuman</a>
                <a href="{{ route('pusat-informasi') }}?tab=agenda" class="text-on-surface-variant hover:text-secondary py-1 text-sm">Agenda</a>
            </div>
        </div>

        <!-- PPDB -->
        <a class="text-on-surface hover:text-secondary font-medium py-2 {{ Route::is('penerimaan') ? 'text-secondary font-bold' : '' }}" href="{{ route('penerimaan') }}">
            PPDB
        </a>

        <!-- Galeri -->
        <a class="text-on-surface hover:text-secondary font-medium py-2 {{ Route::is('galeri') || Route::is('galeri.album.show') ? 'text-secondary font-bold' : '' }}" href="{{ route('galeri') }}">
            Galeri
        </a>

        <!-- Kontak -->
        <a class="text-on-surface hover:text-secondary font-medium py-2 {{ Route::is('kontak') ? 'text-secondary font-bold' : '' }}" href="{{ route('kontak') }}">
            Kontak
        </a>
        
        <!-- Mobile Actions -->
        <a href="https://spmb.semarangkota.go.id/" target="_blank" class="bg-primary text-on-primary text-center py-2.5 rounded-full font-label-md font-bold mt-4">
            Daftar SPMB
        </a>
        @auth
            <a href="{{ route('admin.dashboard') }}" class="bg-secondary text-on-secondary text-center py-2.5 rounded-full font-label-md font-bold mt-2">
                CMS Panel
            </a>
        @else
            <a href="{{ route('login') }}" class="border border-outline text-center py-2.5 rounded-full font-label-md font-bold text-on-surface mt-2">
                Login Operator
            </a>
        @endauth
    </div>
</nav>

<script>
    function toggleMobileSubmenu(id) {
        const submenu = document.getElementById(id);
        const arrow = document.getElementById('mobile-arrow-' + id.split('-')[2]);
        if (submenu) {
            submenu.classList.toggle('hidden');
        }
        if (arrow) {
            arrow.classList.toggle('rotate-180');
        }
    }
</script>
