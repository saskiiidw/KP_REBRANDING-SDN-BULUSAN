@extends('layouts.public')

@section('title', 'Pusat Informasi')

@section('content')
<!-- Header Banner -->
<section class="bg-primary text-white py-16 px-4">
    <div class="max-w-container-max mx-auto px-4 md:px-margin-desktop">
        <h1 class="font-headline-lg text-4xl font-bold">Pusat Informasi</h1>
        <p class="text-on-primary/75 mt-2">Update berita kegiatan, pengumuman edaran, dan kalender kegiatan sekolah.</p>
    </div>
</section>

<!-- Content -->
<section class="py-20 px-4 max-w-container-max mx-auto space-y-12">
    <!-- Tabs Header -->
    <div class="bg-white rounded-[28px] shadow-sm border border-outline-variant/30 overflow-hidden">
        <div class="flex border-b border-outline-variant/10 bg-surface-variant/20 px-6 pt-4 gap-2 overflow-x-auto">
            <a href="{{ route('pusat-informasi') }}?tab=berita" class="px-6 py-4 font-label-md rounded-t-xl font-bold whitespace-nowrap {{ $tab === 'berita' ? 'text-primary border-b-4 border-primary bg-white' : 'text-on-surface-low hover:text-primary hover:bg-white/50 transition-colors' }}">
                Berita Terkini
            </a>
            <a href="{{ route('pusat-informasi') }}?tab=pengumuman" class="px-6 py-4 font-label-md rounded-t-xl font-bold whitespace-nowrap {{ $tab === 'pengumuman' ? 'text-primary border-b-4 border-primary bg-white' : 'text-on-surface-low hover:text-primary hover:bg-white/50 transition-colors' }}">
                Pengumuman Resmi
            </a>
            <a href="{{ route('pusat-informasi') }}?tab=agenda" class="px-6 py-4 font-label-md rounded-t-xl font-bold whitespace-nowrap {{ $tab === 'agenda' ? 'text-primary border-b-4 border-primary bg-white' : 'text-on-surface-low hover:text-primary hover:bg-white/50 transition-colors' }}">
                Agenda Kegiatan
            </a>
        </div>

        <div class="p-8 md:p-12">
            <!-- Search Inside Selected Tab -->
            <div class="mb-8">
                <form action="{{ route('pusat-informasi') }}" method="GET" class="flex gap-4">
                    <input type="hidden" name="tab" value="{{ $tab }}"/>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari {{ $tab }}..." class="flex-grow px-4 py-2.5 rounded-xl border border-outline/30 outline-none text-sm"/>
                    <button type="submit" class="bg-secondary text-white px-8 py-2.5 rounded-xl font-label-md hover:bg-secondary/95 transition-colors text-sm font-semibold">
                        Cari
                    </button>
                    @if(request('search'))
                        <a href="{{ route('pusat-informasi') }}?tab={{ $tab }}" class="bg-surface-variant text-on-surface-variant px-4 py-2.5 rounded-xl hover:bg-surface-dim transition-colors text-sm font-semibold flex items-center justify-center">
                            Reset
                        </a>
                    @endif
                </form>
            </div>

            <!-- Tab Contents -->
            @if($tab === 'berita')
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse($berita as $b)
                        <div class="bg-surface-variant/20 rounded-[24px] overflow-hidden border border-outline-variant/20 flex flex-col justify-between hover:shadow-md transition-shadow group">
                            <div>
                                @if($b->thumbnail)
                                    <div class="aspect-video relative overflow-hidden border-b">
                                        <img src="{{ asset('storage/' . $b->thumbnail) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="{{ $b->judul }}"/>
                                    </div>
                                @endif
                                <div class="p-6">
                                    <span class="text-xs font-bold text-secondary mb-2 block">{{ $b->created_at->format('d M Y') }}</span>
                                    <h3 class="font-headline-md text-lg font-bold text-primary group-hover:text-secondary transition-colors mb-3 line-clamp-2">{{ $b->judul }}</h3>
                                    <p class="text-xs text-on-surface-variant leading-relaxed line-clamp-3 mb-4">{{ $b->ringkasan }}</p>
                                </div>
                            </div>
                            <div class="p-6 pt-0">
                                <a href="{{ route('berita.detail', $b->slug) }}" class="text-primary font-label-md font-bold flex items-center gap-2 group-hover:text-secondary text-sm">
                                    Baca Selengkapnya <span class="material-symbols-outlined text-sm">arrow_forward</span>
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-3 py-16 text-center text-on-surface-low">
                            <span class="material-symbols-outlined text-5xl block mb-2">article</span>
                            Tidak ada berita terkini.
                        </div>
                    @endforelse
                </div>
                
                @if($berita->hasPages())
                    <div class="pt-12">
                        {{ $berita->links() }}
                    </div>
                @endif

            @elseif($tab === 'pengumuman')
                <div class="space-y-6">
                    @forelse($pengumuman as $p)
                        <div class="bg-white p-6 md:p-8 rounded-[24px] border border-outline-variant/30 shadow-sm flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                            <div class="space-y-3 flex-grow max-w-3xl">
                                <div class="flex items-center gap-2">
                                    <span class="text-xs font-bold text-secondary bg-secondary/10 px-2 py-0.5 rounded">
                                        Terbit: {{ $p->tanggal_terbit->format('d M Y') }}
                                    </span>
                                    @if($p->tanggal_berakhir)
                                        <span class="text-xs text-on-surface-low font-semibold">
                                            s/d {{ $p->tanggal_berakhir->format('d M Y') }}
                                        </span>
                                    @endif
                                </div>
                                <h3 class="font-headline-md text-xl font-bold text-primary leading-tight">{{ $p->judul }}</h3>
                                <p class="text-sm text-on-surface-variant leading-relaxed whitespace-pre-line">{{ $p->konten }}</p>
                                
                                @if($p->lampiran->isNotEmpty())
                                    <div class="pt-4 space-y-2">
                                        <h5 class="text-xs font-bold text-primary">Lampiran Tersedia:</h5>
                                        <div class="flex flex-wrap gap-2">
                                            @foreach($p->lampiran as $lamp)
                                                <a href="{{ asset('storage/' . $lamp->path_file) }}" target="_blank"
                                                   class="bg-surface-variant border border-outline-variant hover:bg-surface-dim px-3 py-1.5 rounded-full text-xs font-bold text-primary inline-flex items-center gap-1.5 transition-colors">
                                                    <span class="material-symbols-outlined text-xs">download</span>
                                                    {{ $lamp->nama_lampiran }}
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="py-16 text-center text-on-surface-low">
                            <span class="material-symbols-outlined text-5xl block mb-2">campaign</span>
                            Tidak ada pengumuman terdaftar saat ini.
                        </div>
                    @endforelse
                </div>

                @if($pengumuman->hasPages())
                    <div class="pt-12">
                        {{ $pengumuman->links() }}
                    </div>
                @endif

            @elseif($tab === 'agenda')
                <div class="space-y-6">
                    @forelse($agenda as $a)
                        <div class="bg-white p-6 md:p-8 rounded-[24px] border border-outline-variant/30 shadow-sm flex flex-col md:flex-row gap-6">
                            <!-- Date Badge -->
                            <div class="bg-primary text-white p-4 rounded-xl text-center shrink-0 w-24 flex flex-col justify-center select-none">
                                <span class="text-2xl font-bold block">{{ $a->tanggal_mulai->format('d') }}</span>
                                <span class="text-xs uppercase font-semibold text-on-primary/70">{{ $a->tanggal_mulai->format('M') }}</span>
                                <span class="text-[10px] font-medium opacity-50 block mt-1">{{ $a->tanggal_mulai->format('Y') }}</span>
                            </div>
                            
                            <div class="space-y-2">
                                <h3 class="font-headline-md text-lg font-bold text-primary">{{ $a->nama_kegiatan }}</h3>
                                <p class="text-sm text-on-surface-variant leading-relaxed">{{ $a->deskripsi }}</p>
                                <div class="flex items-center gap-1.5 text-xs text-on-surface-low font-bold pt-2">
                                    <span class="material-symbols-outlined text-sm">schedule</span>
                                    <span>Durasi: {{ $a->tanggal_mulai->format('d M Y') }} s/d {{ $a->tanggal_selesai->format('d M Y') }}</span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="py-16 text-center text-on-surface-low">
                            <span class="material-symbols-outlined text-5xl block mb-2">calendar_today</span>
                            Tidak ada agenda kegiatan terdekat.
                        </div>
                    @endforelse
                </div>

                @if($agenda->hasPages())
                    <div class="pt-12">
                        {{ $agenda->links() }}
                    </div>
                @endif
            @endif
        </div>
    </div>
</section>
@endsection
