@extends('layouts.public')

@section('title', $album->nama_album)

@section('content')
<!-- Header Banner -->
<section class="bg-primary text-white py-16 px-4">
    <div class="max-w-container-max mx-auto px-4 md:px-margin-desktop flex items-center gap-4">
        <a href="{{ route('galeri') }}" class="p-2 hover:bg-white/10 rounded-full transition-colors shrink-0">
            <span class="material-symbols-outlined text-white">arrow_back</span>
        </a>
        <div>
            <h1 class="font-headline-lg text-3xl font-bold">{{ $album->nama_album }}</h1>
            <p class="text-on-primary/75 mt-1">{{ $album->deskripsi ?: 'Dokumentasi foto kegiatan sekolah.' }}</p>
        </div>
    </div>
</section>

<!-- Photo Album Grid -->
<section class="py-24 px-4 max-w-container-max mx-auto">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse($album->foto as $foto)
            <div class="bg-white rounded-[24px] overflow-hidden border border-outline-variant/30 shadow-[0_8px_30px_rgb(0,0,0,0.01)] hover:shadow-md transition-shadow relative group">
                <div class="aspect-square overflow-hidden bg-surface-variant">
                    <img src="{{ asset('storage/' . $foto->path_foto) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" alt="{{ $foto->caption ?: $album->nama_album }}" loading="lazy"/>
                </div>
                @if($foto->caption)
                    <div class="p-4 bg-white border-t">
                        <p class="text-xs text-on-surface-variant font-medium line-clamp-2">{{ $foto->caption }}</p>
                    </div>
                @endif
            </div>
        @empty
            <div class="col-span-1 sm:col-span-4 bg-white p-16 text-center text-on-surface-low rounded-[24px] border border-outline-variant/30 shadow-sm">
                <span class="material-symbols-outlined text-5xl block mb-2">image</span>
                Tidak ada foto di album ini.
            </div>
        @endforelse
    </div>
</section>
@endsection
