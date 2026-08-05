@extends('layouts.admin')

@section('title', 'Kelola Galeri Video')

@section('content')
<div class="space-y-8">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h2 class="font-headline-md text-3xl font-bold text-primary">Kelola Galeri Video</h2>
            <p class="text-on-surface-variant mt-1">Daftarkan tautan video YouTube kegiatan sekolah.</p>
        </div>
        <a href="{{ route('admin.galeri-video.create') }}" class="bg-primary text-on-primary px-6 py-2.5 rounded-full font-label-md font-bold hover:bg-primary/95 transition-all shadow-md inline-flex items-center gap-2">
            <span class="material-symbols-outlined text-sm">add</span> Tambah Video
        </a>
    </div>

    <!-- Search -->
    <div class="bg-white p-6 rounded-[20px] shadow-sm border border-outline-variant/30">
        <form action="{{ route('admin.galeri-video.index') }}" method="GET" class="flex gap-4">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari video..." class="flex-grow px-4 py-2.5 rounded-xl border border-outline/30 outline-none text-sm"/>
            <button type="submit" class="bg-secondary text-white px-8 py-2.5 rounded-xl font-label-md hover:bg-secondary/95 transition-colors text-sm font-semibold">
                Cari
            </button>
            @if(request('search'))
                <a href="{{ route('admin.galeri-video.index') }}" class="bg-surface-variant text-on-surface-variant px-4 py-2.5 rounded-xl hover:bg-surface-dim transition-colors text-sm font-semibold flex items-center justify-center">
                    Reset
                </a>
            @endif
        </form>
    </div>

    <!-- Video Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        @forelse($videos as $video)
            <div class="bg-white rounded-[24px] shadow-sm border border-outline-variant/30 overflow-hidden flex flex-col justify-between hover:shadow-md transition-shadow">
                <div>
                    <!-- Video Embed Preview -->
                    <div class="aspect-video">
                        <iframe class="w-full h-full" src="{{ $video->url_video }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                    <div class="p-6">
                        <h3 class="font-headline-md text-xl font-bold text-primary">{{ $video->judul }}</h3>
                        <p class="text-xs text-on-surface-low mt-2">Daftar Link: <a href="{{ $video->url_video }}" target="_blank" class="text-secondary hover:underline truncate block max-w-sm">{{ $video->url_video }}</a></p>
                    </div>
                </div>

                <div class="p-4 border-t border-outline-variant/20 bg-surface-variant/20 flex justify-end gap-2">
                    <a href="{{ route('admin.galeri-video.edit', $video->id) }}" class="p-1.5 text-secondary hover:bg-white rounded" title="Edit Video">
                        <span class="material-symbols-outlined text-sm">edit</span>
                    </a>
                    <form action="{{ route('admin.galeri-video.destroy', $video->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus video ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="p-1.5 text-error hover:bg-white rounded" title="Hapus Video">
                            <span class="material-symbols-outlined text-sm">delete</span>
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="col-span-1 md:col-span-2 bg-white p-16 text-center text-on-surface-low rounded-[24px] border border-outline-variant/30 shadow-sm">
                <span class="material-symbols-outlined text-5xl block mb-2">video_library</span>
                Belum ada video kegiatan yang terdaftar.
            </div>
        @endforelse
    </div>

    @if($videos->hasPages())
        <div class="bg-white p-6 rounded-[24px] border border-outline-variant/30 shadow-sm">
            {{ $videos->links() }}
        </div>
    @endif
</div>
@endsection
