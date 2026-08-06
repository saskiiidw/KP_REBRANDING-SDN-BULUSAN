<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>@yield('title', 'Admin Panel') - CMS SDN Bulusan</title>
    
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@400;600;700&amp;family=Inter:wght@400;500;700&amp;display=swap" rel="stylesheet"/>
    
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .material-symbols-outlined.fill {
            font-variation-settings: 'FILL' 1;
        }
    </style>
    @yield('styles')
</head>
<body class="bg-surface text-on-surface font-body-md antialiased min-h-screen flex flex-col md:flex-row overflow-x-hidden">
    <!-- Mobile Header -->
    <header class="md:hidden w-full bg-primary text-white py-4 px-6 flex justify-between items-center z-50">
        <div class="flex items-center gap-3">
            <span class="font-headline-md text-xl font-bold">CMS SDN Bulusan</span>
        </div>
        <button id="mobile-sidebar-btn" class="p-2">
            <span class="material-symbols-outlined text-white text-3xl">menu</span>
        </button>
    </header>

    <!-- Sidebar Navigation -->
    <aside id="sidebar" class="hidden md:flex flex-col w-full md:w-72 bg-primary text-white shrink-0 shadow-lg min-h-screen transition-all">
        <div class="p-6 border-b border-white/10 hidden md:block">
            <h1 class="font-headline-md text-2xl font-bold tracking-wide">SD N Bulusan</h1>
            <p class="text-xs text-on-primary/60 mt-1">Sistem Manajemen Konten</p>
        </div>
        
        <!-- User Info -->
        <div class="px-6 py-4 border-b border-white/10 bg-white/5 flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-secondary-fixed text-primary flex items-center justify-center font-bold">
                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
            </div>
            <div>
                <h4 class="font-label-md text-white truncate max-w-[160px]">{{ Auth::user()->name }}</h4>
                <span class="text-xs text-secondary-fixed capitalize font-semibold bg-secondary/30 px-2 py-0.5 rounded">{{ Auth::user()->role }}</span>
            </div>
        </div>

        <!-- Navigation Links -->
        <nav class="flex-grow p-4 space-y-1 overflow-y-auto">
            <a class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/5 transition-all text-sm font-semibold {{ Route::is('admin.dashboard') ? 'bg-secondary text-white' : 'text-on-primary/80' }}" href="{{ route('admin.dashboard') }}">
                <span class="material-symbols-outlined">dashboard</span>
                Dashboard
            </a>
            
            <a class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/5 transition-all text-sm font-semibold {{ Route::is('admin.profil.*') ? 'bg-secondary text-white' : 'text-on-primary/80' }}" href="{{ route('admin.profil.edit') }}">
                <span class="material-symbols-outlined">settings</span>
                Profil Sekolah
            </a>

            <a class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/5 transition-all text-sm font-semibold {{ Route::is('admin.berita.*') ? 'bg-secondary text-white' : 'text-on-primary/80' }}" href="{{ route('admin.berita.index') }}">
                <span class="material-symbols-outlined">article</span>
                Berita
            </a>

            <a class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/5 transition-all text-sm font-semibold {{ Route::is('admin.pengumuman.*') ? 'bg-secondary text-white' : 'text-on-primary/80' }}" href="{{ route('admin.pengumuman.index') }}">
                <span class="material-symbols-outlined">campaign</span>
                Pengumuman
            </a>

            <a class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/5 transition-all text-sm font-semibold {{ Route::is('admin.agenda.*') ? 'bg-secondary text-white' : 'text-on-primary/80' }}" href="{{ route('admin.agenda.index') }}">
                <span class="material-symbols-outlined">calendar_today</span>
                Agenda
            </a>

            <a class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/5 transition-all text-sm font-semibold {{ Route::is('admin.guru.*') ? 'bg-secondary text-white' : 'text-on-primary/80' }}" href="{{ route('admin.guru.index') }}">
                <span class="material-symbols-outlined">badge</span>
                Guru & Staf
            </a>

            <a class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/5 transition-all text-sm font-semibold {{ Route::is('admin.prestasi.*') ? 'bg-secondary text-white' : 'text-on-primary/80' }}" href="{{ route('admin.prestasi.index') }}">
                <span class="material-symbols-outlined">emoji_events</span>
                Prestasi
            </a>

            <a class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/5 transition-all text-sm font-semibold {{ Route::is('admin.galeri-foto.*') ? 'bg-secondary text-white' : 'text-on-primary/80' }}" href="{{ route('admin.galeri-foto.index') }}">
                <span class="material-symbols-outlined">photo_library</span>
                Galeri Foto
            </a>

            <a class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/5 transition-all text-sm font-semibold {{ Route::is('admin.galeri-video.*') ? 'bg-secondary text-white' : 'text-on-primary/80' }}" href="{{ route('admin.galeri-video.index') }}">
                <span class="material-symbols-outlined">video_library</span>
                Galeri Video
            </a>

            <a class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/5 transition-all text-sm font-semibold {{ Route::is('admin.tautan-layanan.*') ? 'bg-secondary text-white' : 'text-on-primary/80' }}" href="{{ route('admin.tautan-layanan.index') }}">
                <span class="material-symbols-outlined">link</span>
                Tautan Layanan
            </a>

            <a class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/5 transition-all text-sm font-semibold {{ Route::is('admin.kontak-pengaduan.*') ? 'bg-secondary text-white' : 'text-on-primary/80' }}" href="{{ route('admin.kontak-pengaduan.index') }}">
                <span class="material-symbols-outlined">inbox</span>
                Kontak & Pengaduan
            </a>
        </nav>

        <!-- Footer / Logout -->
        <div class="p-4 border-t border-white/10">
            <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/5 transition-all text-sm font-semibold text-on-primary/80 mb-2">
                <span class="material-symbols-outlined">open_in_new</span>
                Lihat Website
            </a>
            
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-error/20 hover:text-error transition-all text-sm font-semibold text-error-container">
                    <span class="material-symbols-outlined">logout</span>
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content Area -->
    <div class="flex-grow flex flex-col min-h-screen">
        <!-- Top Bar -->
        <header class="hidden md:flex justify-end items-center bg-white border-b border-outline-variant/30 py-4 px-8 shadow-sm">
            <div class="flex items-center gap-4">
                
            </div>
        </header>

        <!-- Dynamic Content -->
        <main class="flex-grow p-6 md:p-8 overflow-y-auto">
            <!-- Flash Messages -->
            @if(session('success'))
                <div id="flash-success" class="mb-6 p-4 bg-green-50 text-green-800 border-l-4 border-green-500 rounded-lg shadow flex items-center gap-3 transition-opacity duration-500">
                    <span class="material-symbols-outlined">check_circle</span>
                    <span class="font-semibold text-sm">{{ session('success') }}</span>
                </div>
                <script>
                    setTimeout(() => {
                        const flash = document.getElementById('flash-success');
                        if (flash) {
                            flash.style.opacity = '0';
                            setTimeout(() => flash.remove(), 500);
                        }
                    }, 5000);
                </script>
            @endif

            @if(session('error'))
                <div class="mb-6 p-4 bg-error-container text-on-error-container border-l-4 border-error rounded-lg shadow flex items-center gap-3">
                    <span class="material-symbols-outlined">error</span>
                    <span class="font-semibold text-sm">{{ session('error') }}</span>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <!-- Mobile Navigation Toggle Script -->
    <script>
        const btn = document.getElementById('mobile-sidebar-btn');
        const sidebar = document.getElementById('sidebar');
        if (btn && sidebar) {
            btn.addEventListener('click', () => {
                sidebar.classList.toggle('hidden');
                sidebar.classList.toggle('flex');
            });
        }
    </script>
    @yield('scripts')
</body>
</html>
