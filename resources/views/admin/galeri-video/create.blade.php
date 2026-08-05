@extends('layouts.admin')

@section('title', 'Tambah Video Baru')

@section('content')
<div class="space-y-8">
    <!-- Header -->
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.galeri-video.index') }}" class="p-2 hover:bg-surface-variant rounded-full transition-colors">
            <span class="material-symbols-outlined">arrow_back</span>
        </a>
        <div>
            <h2 class="font-headline-md text-3xl font-bold text-primary">Tambah Video Baru</h2>
            <p class="text-on-surface-variant mt-1">Daftarkan link video YouTube untuk masuk ke galeri video.</p>
        </div>
    </div>

    <!-- Form -->
    <form action="{{ route('admin.galeri-video.store') }}" method="POST" class="space-y-8">
        @csrf

        <div class="max-w-2xl space-y-6 bg-white p-6 md:p-8 rounded-[24px] shadow-sm border border-outline-variant/30">
            <div>
                <label class="block text-sm font-semibold text-primary mb-2">Judul Video</label>
                <input type="text" name="judul" value="{{ old('judul') }}" placeholder="Misal: Profil SDN Bulusan atau Penampilan Pentas Seni" class="w-full px-4 py-2.5 rounded-xl border border-outline/30 outline-none text-sm" required/>
            </div>

            <div>
                <label class="block text-sm font-semibold text-primary mb-2">Link/URL Video YouTube</label>
                <input type="url" name="url_video" value="{{ old('url_video') }}" placeholder="Misal: https://www.youtube.com/watch?v=xxxxxx" class="w-full px-4 py-2.5 rounded-xl border border-outline/30 outline-none text-sm" required/>
                <p class="text-xs text-on-surface-low mt-2">Dukung format link share (youtu.be) atau watch link. URL otomatis dikonversi ke embed format.</p>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-start gap-4">
            <a href="{{ route('admin.galeri-video.index') }}" class="bg-surface-variant text-on-surface-variant px-8 py-3 rounded-full font-label-md font-bold hover:bg-surface-dim transition-all">
                Batal
            </a>
            <button type="submit" class="bg-primary text-on-primary px-8 py-3 rounded-full font-label-md font-bold hover:bg-primary/95 transition-all shadow-md">
                Simpan Video
            </button>
        </div>
    </form>
</div>
@endsection
