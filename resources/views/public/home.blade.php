@extends('layouts.public')

@section('title', 'Beranda')

@section('content')
<!-- Hero Section -->
<section class="relative min-h-[640px] flex items-start pt-16 md:pt-20 pb-32 justify-center overflow-hidden">
    <div class="absolute inset-0 z-0">
        <img class="w-full h-full object-cover opacity-90" src="{{ asset('images/hero_school_new.png') }}" alt="SDN Bulusan Facade" loading="eager"/>
        <div class="absolute inset-0 bg-gradient-to-r from-primary/95 via-primary/70 to-transparent"></div>
    </div>
    <div class="relative z-10 w-full max-w-container-max mx-auto px-4 md:px-margin-desktop grid grid-cols-1 md:grid-cols-12 gap-gutter">
        <div class="md:col-span-9 lg:col-span-7 flex flex-col justify-start text-white">
            <span class="font-label-md text-secondary-fixed mb-4 uppercase tracking-[0.2em] font-bold">Selamat Datang di</span>
            <h1 class="font-headline-lg-mobile md:font-headline-lg text-5xl md:text-6xl text-white mb-6 leading-tight uppercase">SD Negeri Bulusan</h1>
            <p class="font-body-lg text-lg md:text-xl text-white/90 mb-10 max-w-xl leading-relaxed">
                Menyelenggarakan pendidikan dasar berkualitas di Kota Semarang. Membentuk generasi pembelajar yang cerdas, bertakwa, berakhlak mulia, dan peduli lingkungan.
            </p>
            <div class="flex flex-wrap gap-4">
                <a href="{{ route('penerimaan') }}" class="bg-secondary text-on-secondary px-8 py-4 rounded-full font-label-md font-bold hover:bg-secondary/90 transition-all shadow-lg hover:-translate-y-0.5 text-center">
                    Informasi Pendaftaran
                </a>
                <a href="{{ route('tentang') }}" class="bg-white/10 backdrop-blur-md border border-white/30 text-white px-8 py-4 rounded-full font-label-md font-bold hover:bg-white/20 transition-all hover:-translate-y-0.5 text-center">
                    Profil Sekolah
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Principal's Welcome -->
<section class="py-12 px-4 md:px-margin-desktop max-w-container-max mx-auto">
    <div class="bg-white rounded-[32px] shadow-[0_8px_30px_rgb(0,0,0,0.02)] border border-outline-variant/30 p-8 md:p-16">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-12 lg:gap-16 items-center">
            <div class="md:col-span-5 relative">
                <div class="aspect-[4/5] rounded-[24px] overflow-hidden shadow-xl border-8 border-surface-variant">
                    @if($profil->foto_kepsek)
                        <img class="w-full h-full object-cover" src="{{ asset('storage/' . $profil->foto_kepsek) }}" alt="{{ $profil->nama_kepsek }}" loading="lazy"/>
                    @else
                        <img class="w-full h-full object-cover" src="{{ asset('images/default_kepsek.jpg') }}" alt="Harmana, S.Pd.SD" loading="lazy"/>
                    @endif
                </div>

            </div>
            <div class="md:col-span-7">
                <span class="font-label-md text-secondary uppercase font-bold tracking-wider mb-2 block">Sambutan Hangat</span>
                <h2 class="font-headline-lg text-3xl md:text-4xl text-primary mb-2">SAMBUTAN KEPALA SEKOLAH</h2>
                <h3 class="font-headline-md text-xl md:text-2xl text-secondary mb-8 font-semibold">{{ $profil->nama_kepsek }}</h3>
                <div class="font-body-lg text-on-surface-variant space-y-6 leading-relaxed">
                    <p class="font-bold">Asalamualaikum warohmatullahi wabarokatuh.</p>
                    <p class="line-clamp-6 whitespace-pre-line">{{ $profil->sambutan_kepsek }}</p>
                </div>
                <a href="{{ route('tentang') }}" class="mt-8 text-secondary font-label-md font-bold flex items-center gap-2 hover:text-secondary-fixed transition-colors text-lg group">
                    Baca Selengkapnya <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">arrow_forward</span>
                </a>
            </div>
        </div>
    </div>
</section>


<!-- About & Visi Misi -->
<section class="py-12 max-w-container-max mx-auto px-4 md:px-margin-desktop">
    <div class="text-center mb-16">
        <h2 class="font-headline-lg text-3xl md:text-4xl text-primary mb-4">Visi, Misi & Karakter</h2>
        <p class="font-body-lg text-on-surface-variant max-w-2xl mx-auto">Menjadi lembaga pendidikan unggul berkarakter lingkungan.</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="bg-white p-8 md:p-10 rounded-[24px] shadow-[0_8px_30px_rgb(0,0,0,0.02)] border border-outline-variant/30 text-center hover:-translate-y-1.5 transition-transform duration-300">
            <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-6 text-primary">
                <span class="material-symbols-outlined text-3xl">visibility</span>
            </div>
            <h3 class="font-headline-md text-xl font-bold text-primary mb-4">Visi</h3>
            <p class="font-body-md text-on-surface-variant leading-relaxed">{{ $profil->visi }}</p>
        </div>
        <div class="bg-white p-8 md:p-10 rounded-[24px] shadow-[0_8px_30px_rgb(0,0,0,0.02)] border border-outline-variant/30 text-center hover:-translate-y-1.5 transition-transform duration-300">
            <div class="w-16 h-16 bg-secondary/10 rounded-full flex items-center justify-center mx-auto mb-6 text-secondary">
                <span class="material-symbols-outlined text-3xl">rocket_launch</span>
            </div>
            <h3 class="font-headline-md text-xl font-bold text-primary mb-4">Misi</h3>
            <p class="font-body-md text-on-surface-variant leading-relaxed line-clamp-6 whitespace-pre-line">{{ $profil->misi }}</p>
        </div>
        <div class="bg-white p-8 md:p-10 rounded-[24px] shadow-[0_8px_30px_rgb(0,0,0,0.02)] border border-outline-variant/30 text-center hover:-translate-y-1.5 transition-transform duration-300">
            <div class="w-16 h-16 bg-tertiary-container/10 rounded-full flex items-center justify-center mx-auto mb-6 text-tertiary">
                <span class="material-symbols-outlined text-3xl">menu_book</span>
            </div>
            <h3 class="font-headline-md text-xl font-bold text-primary mb-4">Fasilitas</h3>
            <p class="font-body-md text-on-surface-variant leading-relaxed">Ruang kelas dengan smart projector, perpustakaan baca, laboratorium TIK, sarana olahraga terpadu, dan lingkungan asri hijau.</p>
        </div>
    </div>
</section>


<!-- Service Buttons / Tautan Layanan -->
@if($tautan->isNotEmpty())
    <section class="py-12 px-4 md:px-margin-desktop max-w-container-max mx-auto">
        <div class="text-center mb-16">
            <h2 class="font-headline-lg text-3xl md:text-4xl text-primary mb-4">Layanan Digital Terintegrasi</h2>
            <p class="font-body-lg text-on-surface-variant max-w-xl mx-auto">Akses layanan publik resmi Kota Semarang dan Dapodik secara praktis.</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($tautan as $t)
                <a href="{{ $t->url }}" target="{{ $t->is_eksternal ? '_blank' : '_self' }}"
                   class="bg-white p-6 rounded-[24px] border border-outline-variant/30 shadow-sm flex items-center gap-4 hover:shadow-md hover:-translate-y-0.5 transition-all group">
                    <div class="w-12 h-12 rounded-full bg-primary/10 text-primary flex items-center justify-center shrink-0 group-hover:bg-primary group-hover:text-white transition-all">
                        <span class="material-symbols-outlined text-2xl">{{ $t->ikon }}</span>
                    </div>
                    <div>
                        <h4 class="font-headline-sm font-semibold text-primary group-hover:text-secondary transition-colors">{{ $t->nama_layanan }}</h4>
                        <span class="text-xs text-on-surface-low block mt-1">Buka Layanan <span class="material-symbols-outlined text-xs inline-block align-middle">open_in_new</span></span>
                    </div>
                </a>
            @endforeach
        </div>
    </section>
@endif

<!-- Info Center / Pusat Informasi Tabs -->
<section class="py-12 bg-surface-variant/30 border-y border-outline-variant/30">
    <div class="max-w-container-max mx-auto px-4 md:px-margin-desktop">
        <div class="text-center mb-16">
            <h2 class="font-headline-lg text-3xl md:text-4xl text-primary mb-4">Pusat Informasi Terkini</h2>
            <p class="font-body-lg text-on-surface-variant max-w-2xl mx-auto">Dapatkan pembaruan berita sekolah, edaran pengumuman, dan kalender agenda.</p>
        </div>

        <div class="bg-white rounded-[28px] shadow-sm border border-outline-variant/30 overflow-hidden">
            <!-- Tabs -->
            <div class="flex border-b border-outline-variant/10 bg-surface-variant/20 px-6 pt-4 gap-2 overflow-x-auto">
                <button onclick="switchHomeTab('berita')" id="tab-btn-berita" class="tab-btn px-6 py-3.5 font-label-md text-primary border-b-4 border-primary bg-white rounded-t-xl font-bold whitespace-nowrap">Berita</button>
                <button onclick="switchHomeTab('pengumuman')" id="tab-btn-pengumuman" class="tab-btn px-6 py-3.5 font-label-md text-on-surface-low hover:text-primary hover:bg-white/50 transition-colors rounded-t-xl font-semibold whitespace-nowrap">Pengumuman</button>
                <button onclick="switchHomeTab('agenda')" id="tab-btn-agenda" class="tab-btn px-6 py-3.5 font-label-md text-on-surface-low hover:text-primary hover:bg-white/50 transition-colors rounded-t-xl font-semibold whitespace-nowrap">Agenda</button>
            </div>

            <!-- Content Area -->
            <div class="p-8 md:p-12">
                <!-- Berita Tab -->
                <div id="tab-content-berita" class="tab-content grid grid-cols-1 md:grid-cols-3 gap-8">
                    @forelse($berita as $b)
                        <div class="bg-surface-variant/10 rounded-[20px] p-6 border border-outline-variant/20 hover:shadow-md transition-shadow group flex flex-col justify-between">
                            <div>
                                <span class="text-xs font-bold text-secondary mb-3 block">{{ $b->created_at->format('d M Y') }}</span>
                                <h3 class="font-headline-md text-lg font-bold text-primary group-hover:text-secondary transition-colors mb-3 line-clamp-2">{{ $b->judul }}</h3>
                                <p class="text-sm text-on-surface-variant line-clamp-3 mb-6 leading-relaxed">{{ $b->ringkasan }}</p>
                            </div>
                            <a href="{{ route('berita.detail', $b->slug) }}" class="text-primary font-label-md font-bold flex items-center gap-2 group-hover:text-secondary">
                                Baca Selengkapnya <span class="material-symbols-outlined text-sm">arrow_forward</span>
                            </a>
                        </div>
                    @empty
                        <div class="col-span-3 py-8 text-center text-on-surface-low text-sm">
                            Tidak ada berita terkini.
                        </div>
                    @endforelse
                </div>

                <!-- Pengumuman Tab -->
                <div id="tab-content-pengumuman" class="tab-content grid grid-cols-1 md:grid-cols-3 gap-8 hidden">
                    @forelse($pengumuman as $p)
                        <div class="bg-surface-variant/10 rounded-[20px] p-6 border border-outline-variant/20 hover:shadow-md transition-shadow group flex flex-col justify-between">
                            <div>
                                <span class="text-xs font-bold text-secondary mb-3 block">Terbit: {{ $p->tanggal_terbit->format('d M Y') }}</span>
                                <h3 class="font-headline-md text-lg font-bold text-primary mb-3 line-clamp-2">{{ $p->judul }}</h3>
                                <p class="text-sm text-on-surface-variant line-clamp-3 mb-6 leading-relaxed">{{ $p->konten }}</p>
                            </div>
                            <a href="{{ route('pusat-informasi') }}?tab=pengumuman" class="text-primary font-label-md font-bold flex items-center gap-2">
                                Lihat Selengkapnya <span class="material-symbols-outlined text-sm">arrow_forward</span>
                            </a>
                        </div>
                    @empty
                        <div class="col-span-3 py-8 text-center text-on-surface-low text-sm">
                            Tidak ada pengumuman terkini.
                        </div>
                    @endforelse
                </div>

                <!-- Agenda Tab -->
                <div id="tab-content-agenda" class="tab-content grid grid-cols-1 md:grid-cols-3 gap-8 hidden">
                    @forelse($agenda as $a)
                        <div class="bg-surface-variant/10 rounded-[20px] p-6 border border-outline-variant/20 hover:shadow-md transition-shadow group flex flex-col justify-between">
                            <div>
                                <span class="text-xs font-bold text-secondary mb-3 block">{{ $a->tanggal_mulai->format('d M Y') }}</span>
                                <h3 class="font-headline-md text-lg font-bold text-primary mb-3 line-clamp-2">{{ $a->nama_kegiatan }}</h3>
                                <p class="text-sm text-on-surface-variant line-clamp-3 mb-6 leading-relaxed">{{ $a->deskripsi }}</p>
                            </div>
                            <a href="{{ route('pusat-informasi') }}?tab=agenda" class="text-primary font-label-md font-bold flex items-center gap-2">
                                Lihat Agenda <span class="material-symbols-outlined text-sm">arrow_forward</span>
                            </a>
                        </div>
                    @empty
                        <div class="col-span-3 py-8 text-center text-on-surface-low text-sm">
                            Tidak ada agenda terdekat.
                        </div>
                    @endforelse
                </div>

                <div class="mt-12 text-center">
                    <a href="{{ route('pusat-informasi') }}" class="px-8 py-3 bg-primary text-white font-label-md font-bold rounded-full hover:bg-primary/95 transition-all shadow-md inline-block">
                        Lihat Seluruh Informasi
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Dedicated Admission Banner / PPDB -->
<section class="py-12 px-4 md:px-margin-desktop max-w-container-max mx-auto">
    <div class="bg-white rounded-[32px] shadow-xl overflow-hidden border border-outline-variant/30">
        <div class="grid grid-cols-1 lg:grid-cols-2">
            <div class="p-8 md:p-16 flex flex-col justify-center space-y-6">
                <h2 class="font-headline-lg text-3xl md:text-4xl text-primary leading-tight">Penerimaan Peserta Didik Baru (PPDB)</h2>
                <p class="font-body-lg text-on-surface-variant leading-relaxed">
                    Kami menantikan kehadiran putra-putri Anda untuk bertumbuh, belajar, dan mengukir prestasi bersama di SD Negeri Bulusan Kota Semarang.
                </p>
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-secondary font-bold text-sm bg-secondary/10 p-1.5 rounded-full">check</span>
                        <span class="text-sm font-semibold text-primary">Usia minimal 6 tahun pada bulan Juli</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-secondary font-bold text-sm bg-secondary/10 p-1.5 rounded-full">check</span>
                        <span class="text-sm font-semibold text-primary">Fotokopi Akta Kelahiran dan Kartu Keluarga (KK)</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-secondary font-bold text-sm bg-secondary/10 p-1.5 rounded-full">check</span>
                        <span class="text-sm font-semibold text-primary">Pendaftaran dilakukan online melalui portal terpadu</span>
                    </div>
                </div>
                <div class="pt-4">
                    <a href="{{ route('penerimaan') }}" class="bg-primary text-on-primary px-8 py-3.5 rounded-full font-label-md font-bold hover:bg-primary/95 transition-all shadow-md inline-block">
                        Prosedur & Alur Pendaftaran
                    </a>
                </div>
            </div>
            <div class="relative min-h-[360px] lg:min-h-full">
                <img class="absolute inset-0 w-full h-full object-cover" src="{{ asset('images/guru_ppdb.png') }}" alt="Guru SDN Bulusan" loading="lazy"/>
                <div class="absolute inset-0 flex items-center justify-center p-8 bg-black/10">
                    <div class="bg-white p-8 rounded-[32px] shadow-2xl max-w-sm text-left relative overflow-hidden group">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-secondary/10 rounded-bl-[100px] z-0 group-hover:scale-110 transition-transform duration-500"></div>
                        <div class="relative z-10">
                            <h4 class="font-headline-md text-2xl font-bold text-primary mb-3 flex items-center gap-2">
                                <span class="material-symbols-outlined text-secondary">verified</span>
                                Tahun Ajaran Baru
                            </h4>
                            <p class="font-body-md text-sm text-on-surface-variant leading-relaxed">
                                Siapkan berkas Anda dari sekarang. Pendaftaran sekolah dasar negeri terintegrasi melalui PPDB online terpadu Kota Semarang.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
    function switchHomeTab(tabId) {
        // Toggle tab button classes
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.classList.remove('text-primary', 'border-b-4', 'border-primary', 'bg-white', 'font-bold');
            btn.classList.add('text-on-surface-low', 'font-semibold');
        });

        const activeBtn = document.getElementById(`tab-btn-${tabId}`);
        if (activeBtn) {
            activeBtn.classList.add('text-primary', 'border-b-4', 'border-primary', 'bg-white', 'font-bold');
            activeBtn.classList.remove('text-on-surface-low', 'font-semibold');
        }

        // Toggle tab content classes
        document.querySelectorAll('.tab-content').forEach(content => {
            content.classList.add('hidden');
        });

        const activeContent = document.getElementById(`tab-content-${tabId}`);
        if (activeContent) {
            activeContent.classList.remove('hidden');
        }
    }
</script>
@endsection
