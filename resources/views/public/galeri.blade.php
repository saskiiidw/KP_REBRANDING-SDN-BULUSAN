@extends('layouts.public')

@section('title', 'Galeri Sekolah')

@section('content')
<!-- Header Banner -->
<section class="bg-primary text-white py-16 px-4">
    <div class="max-w-container-max mx-auto px-4 md:px-margin-desktop">
        <h1 class="font-headline-lg text-4xl font-bold">Galeri Dokumentasi</h1>
        <p class="text-on-primary/75 mt-2">Kumpulan foto dan video dokumentasi berbagai aktivitas di SDN Bulusan.</p>
    </div>
</section>

<!-- Main Area -->
<section class="py-20 px-4 max-w-container-max mx-auto space-y-12">
    <!-- Tabs Header -->
    <div class="bg-white rounded-[28px] shadow-sm border border-outline-variant/30 overflow-hidden">
        <div class="flex border-b border-outline-variant/10 bg-surface-variant/20 px-6 pt-4 gap-2 overflow-x-auto">
            <button onclick="switchGaleriTab('foto')" id="g-tab-btn-foto" class="g-tab-btn px-6 py-3.5 font-label-md text-primary border-b-4 border-primary bg-white rounded-t-xl font-bold whitespace-nowrap">Galeri Foto</button>
            <button onclick="switchGaleriTab('video')" id="g-tab-btn-video" class="g-tab-btn px-6 py-3.5 font-label-md text-on-surface-low hover:text-primary hover:bg-white/50 transition-colors rounded-t-xl font-semibold whitespace-nowrap">Dokumentasi Video</button>
        </div>

        <div class="p-8 md:p-12">
            <!-- Galeri Foto Tab -->
            <div id="g-tab-content-foto" class="g-tab-content grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($albums as $album)
                    <div class="bg-white rounded-[24px] overflow-hidden border border-outline-variant/30 shadow-[0_8px_30px_rgb(0,0,0,0.01)] hover:shadow-md transition-shadow group flex flex-col justify-between">
                        <div>
                            <!-- Album Cover Thumbnail -->
                            <div class="aspect-[4/3] relative overflow-hidden bg-surface-variant border-b flex items-center justify-center">
                                @if($album->foto->isNotEmpty())
                                    <img src="{{ asset('storage/' . $album->foto->first()->path_foto) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="{{ $album->nama_album }}" loading="lazy"/>
                                @else
                                    <div class="text-primary/10 select-none text-center">
                                        <span class="material-symbols-outlined text-6xl">photo_library</span>
                                    </div>
                                @endif
                                <span class="absolute bottom-4 right-4 bg-primary text-white text-xs font-bold px-3 py-1.5 rounded-full shadow">
                                    {{ $album->foto_count }} Foto
                                </span>
                            </div>
                            
                            <div class="p-6 space-y-2">
                                <h3 class="font-headline-md text-lg font-bold text-primary group-hover:text-secondary transition-colors">{{ $album->nama_album }}</h3>
                                <p class="text-xs text-on-surface-variant leading-relaxed line-clamp-3">{{ $album->deskripsi ?: 'Dokumentasi foto kegiatan sekolah.' }}</p>
                            </div>
                        </div>
                        
                        <div class="p-6 pt-0">
                            <a href="{{ route('galeri.album.show', $album->id) }}" class="text-primary font-label-md font-bold flex items-center gap-2 group-hover:text-secondary text-sm">
                                Lihat Album Foto <span class="material-symbols-outlined text-sm">arrow_forward</span>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 py-16 text-center text-on-surface-low flex flex-col items-center justify-center">
                        <span class="material-symbols-outlined text-6xl mb-4 text-on-surface-low/50">photo_library</span>
                        <p class="text-lg">Belum ada album foto yang dipublikasikan.</p>
                    </div>
                @endforelse
            </div>

            <!-- Galeri Video Tab -->
            <div id="g-tab-content-video" class="g-tab-content grid grid-cols-1 md:grid-cols-2 gap-8 hidden">
                @forelse($videos as $vid)
                    <div class="bg-white rounded-[24px] overflow-hidden border border-outline-variant/30 shadow-[0_8px_30px_rgb(0,0,0,0.01)] hover:shadow-md transition-shadow">
                        <div class="aspect-video bg-black">
                            <iframe class="w-full h-full" src="{{ $vid->url_video }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                        <div class="p-6">
                            <h3 class="font-headline-md text-lg font-bold text-primary">{{ $vid->judul }}</h3>
                        </div>
                    </div>
                @empty
                    <div class="col-span-2 py-16 text-center text-on-surface-low flex flex-col items-center justify-center">
                        <span class="material-symbols-outlined text-6xl mb-4 text-on-surface-low/50">video_library</span>
                        <p class="text-lg">Belum ada video dokumentasi yang dipublikasikan.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
    function switchGaleriTab(tabId) {
        document.querySelectorAll('.g-tab-btn').forEach(btn => {
            btn.classList.remove('text-primary', 'border-b-4', 'border-primary', 'bg-white', 'font-bold');
            btn.classList.add('text-on-surface-low', 'font-semibold');
        });

        const activeBtn = document.getElementById(`g-tab-btn-${tabId}`);
        if (activeBtn) {
            activeBtn.classList.add('text-primary', 'border-b-4', 'border-primary', 'bg-white', 'font-bold');
            activeBtn.classList.remove('text-on-surface-low', 'font-semibold');
        }

        document.querySelectorAll('.g-tab-content').forEach(content => {
            content.classList.add('hidden');
        });

        const activeContent = document.getElementById(`g-tab-content-${tabId}`);
        if (activeContent) {
            activeContent.classList.remove('hidden');
        }
    }
</script>
@endsection
