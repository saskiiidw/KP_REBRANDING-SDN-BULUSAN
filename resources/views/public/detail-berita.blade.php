@extends('layouts.public')

@section('title', $berita->judul)
@section('meta_description', $berita->meta_description ?: $berita->ringkasan)

@section('content')
<section class="py-20 px-4 max-w-container-max mx-auto">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 lg:gap-16">
        <!-- Main Article Content -->
        <article class="lg:col-span-2 space-y-8 bg-white p-8 md:p-12 rounded-[32px] border border-outline-variant/30 shadow-[0_8px_30px_rgb(0,0,0,0.01)]">
            <!-- Article Header Info -->
            <div class="space-y-4">
                <div class="flex items-center gap-2">
                    <span class="bg-primary-fixed text-primary px-3 py-1 rounded-full text-xs font-bold uppercase">
                        {{ $berita->kategori->nama }}
                    </span>
                    <span class="text-xs text-on-surface-low font-bold">{{ $berita->created_at->format('d F Y') }}</span>
                </div>
                
                <h1 class="font-headline-lg text-3xl md:text-4xl text-primary leading-tight font-bold">
                    {{ $berita->judul }}
                </h1>
                
                <div class="flex items-center gap-2 pt-2 border-b border-outline-variant/20 pb-4 text-xs font-semibold text-on-surface-low">
                    <span class="material-symbols-outlined text-sm">person</span>
                    <span>Oleh: <strong class="text-primary">{{ $berita->penulis->name }}</strong></span>
                </div>
            </div>

            <!-- Article Thumbnail -->
            @if($berita->thumbnail)
                <div class="rounded-2xl overflow-hidden border shadow-sm aspect-video">
                    <img src="{{ asset('storage/' . $berita->thumbnail) }}" class="w-full h-full object-cover" alt="{{ $berita->judul }}" loading="lazy"/>
                </div>
            @endif

            <!-- Article Body -->
            <div class="text-base text-primary/95 leading-relaxed whitespace-pre-line space-y-6 font-medium">
                {{ $berita->konten }}
            </div>
        </article>

        <!-- Sidebar: Recent News -->
        <div class="space-y-8">
            <div class="bg-white p-6 rounded-[28px] border border-outline-variant/30 shadow-sm space-y-6">
                <h3 class="font-headline-sm text-lg font-bold text-primary border-b border-outline-variant/20 pb-4">Berita Terbaru Lainnya</h3>
                
                <div class="divide-y divide-outline-variant/20">
                    @forelse($recent_berita as $recent)
                        <div class="py-4 first:pt-0 last:pb-0 space-y-2">
                            <span class="text-[10px] font-bold text-secondary uppercase">{{ $recent->created_at->format('d M Y') }}</span>
                            <h4 class="font-semibold text-primary text-sm line-clamp-2 hover:text-secondary transition-colors">
                                <a href="{{ route('berita.detail', $recent->slug) }}">{{ $recent->judul }}</a>
                            </h4>
                        </div>
                    @empty
                        <p class="text-xs text-on-surface-low py-4">Tidak ada berita terbaru lainnya.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
