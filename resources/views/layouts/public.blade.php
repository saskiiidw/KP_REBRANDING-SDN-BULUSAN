<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>@yield('title', 'SDN Bulusan') - SDN Bulusan</title>
    
    <!-- Meta SEO -->
    <meta name="description" content="@yield('meta_description', 'Official website of SDN Bulusan Semarang. Membentuk peserta didik yang beriman, bertakwa, berakhlak mulia, berprestasi, berkarakter, dan berbudaya lingkungan.')"/>
    <meta name="keywords" content="SDN Bulusan, SD Negeri Bulusan, Sekolah Semarang, Tembalang, Pendidikan Dasar, Sekolah Dasar"/>
    <meta name="author" content="SDN Bulusan"/>
    
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
<body class="bg-surface text-on-surface font-body-md antialiased overflow-x-hidden min-h-screen flex flex-col">
    @include('layouts.partials.navigation')

    <!-- Main Content Area -->
    <main class="pt-[72px] flex-grow">
        @yield('content')
    </main>

    <!-- Rich Footer -->
    <footer class="bg-primary text-on-primary w-full mt-auto">
        <div class="max-w-container-max mx-auto px-4 md:px-margin-desktop py-20">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 lg:gap-8 font-body-md">
                <!-- Brand/Identity -->
                <div class="col-span-1 lg:col-span-1">
                    <h2 class="font-headline-md text-2xl text-on-primary mb-6 flex items-center gap-3">
                        <img alt="School Logo" class="h-10 w-auto brightness-0 invert" src="{{ asset('images/logo.png') }}" loading="lazy"/>
                        SDN Bulusan
                    </h2>
                    <p class="text-on-primary/80 mb-8 leading-relaxed">
                        Menyediakan pendidikan dasar yang berkualitas, membentuk karakter siswa yang berbudi pekerti luhur, cerdas, dan terampil.
                    </p>
                    <div class="flex gap-4">
                        <a class="w-12 h-12 rounded-full bg-white/10 flex items-center justify-center hover:bg-white/20 transition-colors" href="#">
                            <span class="material-symbols-outlined">qr_code_2</span>
                        </a>
                        <a class="w-12 h-12 rounded-full bg-white/10 flex items-center justify-center hover:bg-white/20 transition-colors" href="https://www.youtube.com">
                            <span class="material-symbols-outlined">smart_display</span>
                        </a>
                        <a class="w-12 h-12 rounded-full bg-white/10 flex items-center justify-center hover:bg-white/20 transition-colors" href="#">
                            <span class="material-symbols-outlined">photo_camera</span>
                        </a>
                    </div>
                </div>
                
                <!-- Quick Links -->
                <div>
                    <h3 class="font-headline-sm text-lg font-bold mb-6 text-secondary-fixed">Tautan Cepat</h3>
                    <ul class="space-y-4">
                        <li><a class="text-on-primary/80 hover:text-white transition-colors flex items-center gap-2" href="{{ route('tentang') }}"><span class="material-symbols-outlined text-sm">chevron_right</span> Profil</a></li>
                        <li><a class="text-on-primary/80 hover:text-white transition-colors flex items-center gap-2" href="{{ route('ekstrakurikuler') }}"><span class="material-symbols-outlined text-sm">chevron_right</span> Ekstrakurikuler</a></li>
                        <li><a class="text-on-primary/80 hover:text-white transition-colors flex items-center gap-2" href="{{ route('galeri') }}"><span class="material-symbols-outlined text-sm">chevron_right</span> Galeri</a></li>
                        <li><a class="text-on-primary/80 hover:text-white transition-colors flex items-center gap-2" href="{{ route('penerimaan') }}"><span class="material-symbols-outlined text-sm">chevron_right</span> PPDB</a></li>
                        <li><a class="text-on-primary/80 hover:text-white transition-colors flex items-center gap-2" href="{{ route('kontak') }}"><span class="material-symbols-outlined text-sm">chevron_right</span> Kontak</a></li>
                    </ul>
                </div>
                
                <!-- Contact Details -->
                <div class="lg:col-span-2">
                    <h3 class="font-headline-sm text-lg font-bold mb-6 text-secondary-fixed">Hubungi Kami</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                        <ul class="space-y-4 text-sm">
                            <li class="flex items-start gap-3 text-on-primary/80">
                                <span class="material-symbols-outlined mt-1 text-secondary-fixed shrink-0">location_on</span>
                                <span>Jl. Bulusan Selatan Raya, Kec. Tembalang, Semarang</span>
                            </li>
                            <li class="flex items-center gap-3 text-on-primary/80">
                                <span class="material-symbols-outlined text-secondary-fixed shrink-0">call</span>
                                <span>(024) 76482524</span>
                            </li>
                            <li class="flex items-center gap-3 text-on-primary/80">
                                <span class="material-symbols-outlined text-secondary-fixed shrink-0">mail</span>
                                <span>sdnegeribulusan@gmail.com</span>
                            </li>
                        </ul>
                        <div>
                            <h4 class="font-label-md font-bold text-white mb-3">Jam Kerja</h4>
                            <ul class="space-y-2 text-on-primary/80 text-sm">
                                <li class="flex justify-between border-b border-white/10 pb-2"><span>Senin - Kamis:</span> <span>07:00 - 14:00</span></li>
                                <li class="flex justify-between border-b border-white/10 pb-2"><span>Jumat:</span> <span>07:00 - 11:30</span></li>
                                <li class="flex justify-between pb-2"><span>Sabtu - Minggu:</span> <span>Tutup</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Copyright -->
            <div class="pt-8 mt-16 border-t border-white/10 flex flex-col md:flex-row justify-between items-center gap-4 text-on-primary/60 text-sm">
                <p>© {{ date('Y') }} SDN Bulusan. Hak Cipta Dilindungi.</p>
                <div class="flex gap-6">
                    <a class="hover:text-white transition-colors" href="#">Kebijakan Privasi</a>
                    <a class="hover:text-white transition-colors" href="#">Syarat dan Ketentuan</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Mobile Menu Script -->
    <script>
        const btn = document.getElementById('mobile-menu-btn');
        const menu = document.getElementById('mobile-menu');
        if (btn && menu) {
            btn.addEventListener('click', () => {
                menu.classList.toggle('hidden');
            });
        }
    </script>
    @yield('scripts')
</body>
</html>
