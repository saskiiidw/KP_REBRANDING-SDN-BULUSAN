@extends('layouts.admin')

@section('title', 'Kelola Album Galeri')

@section('content')
<div class="space-y-8">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h2 class="font-headline-md text-3xl font-bold text-primary">Kelola Galeri Foto</h2>
            <p class="text-on-surface-variant mt-1">Buat album dan unggah foto kegiatan sekolah.</p>
        </div>
        <a href="{{ route('admin.galeri-foto.create') }}" class="bg-primary text-on-primary px-6 py-2.5 rounded-full font-label-md font-bold hover:bg-primary/95 transition-all shadow-md inline-flex items-center gap-2">
            <span class="material-symbols-outlined text-sm">add</span> Buat Album
        </a>
    </div>

    <!-- Search -->
    <div class="bg-white p-6 rounded-[20px] shadow-sm border border-outline-variant/30">
        <form action="{{ route('admin.galeri-foto.index') }}" method="GET" class="flex gap-4">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari album..." class="flex-grow px-4 py-2.5 rounded-xl border border-outline/30 outline-none text-sm"/>
            <button type="submit" class="bg-secondary text-white px-8 py-2.5 rounded-xl font-label-md hover:bg-secondary/95 transition-colors text-sm font-semibold">
                Cari
            </button>
            @if(request('search'))
                <a href="{{ route('admin.galeri-foto.index') }}" class="bg-surface-variant text-on-surface-variant px-4 py-2.5 rounded-xl hover:bg-surface-dim transition-colors text-sm font-semibold flex items-center justify-center">
                    Reset
                </a>
            @endif
        </form>
    </div>

    <!-- Album Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($albums as $album)
            <div class="bg-white rounded-[24px] shadow-sm border border-outline-variant/30 overflow-hidden flex flex-col justify-between group hover:shadow-md transition-shadow">
                <div class="p-6 space-y-4">
                    <div class="flex justify-between items-start">
                        <span class="material-symbols-outlined text-primary bg-primary/10 w-10 h-10 rounded-full flex items-center justify-center">photo_library</span>
                        <span class="bg-secondary-container text-on-secondary-container px-3 py-1 rounded-full text-xs font-semibold">
                            {{ $album->foto_count }} Foto
                        </span>
                    </div>
                    <div>
                        <h3 class="font-headline-md text-xl font-bold text-primary">{{ $album->nama_album }}</h3>
                        <p class="text-sm text-on-surface-low mt-2 line-clamp-2">{{ $album->deskripsi ?: 'Tidak ada deskripsi.' }}</p>
                    </div>
                </div>

                <div class="p-4 border-t border-outline-variant/20 bg-surface-variant/20 flex justify-between items-center">
                    <a href="{{ route('admin.galeri-foto.show', $album->id) }}" class="text-xs font-bold text-secondary hover:underline flex items-center gap-1">
                        Kelola Foto <span class="material-symbols-outlined text-xs">arrow_forward</span>
                    </a>
                    <div class="flex gap-2">
                        <a href="{{ route('admin.galeri-foto.edit', $album->id) }}" class="p-1.5 text-secondary hover:bg-white rounded" title="Edit Album">
                            <span class="material-symbols-outlined text-sm">edit</span>
                        </a>
                        <form action="{{ route('admin.galeri-foto.destroy', $album->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus album ini beserta seluruh fotonya?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-1.5 text-error hover:bg-white rounded" title="Hapus Album">
                                <span class="material-symbols-outlined text-sm">delete</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-1 lg:col-span-3 bg-white p-16 text-center text-on-surface-low rounded-[24px] border border-outline-variant/30 shadow-sm">
                <span class="material-symbols-outlined text-5xl block mb-2">photo_library</span>
                Belum ada album galeri yang dibuat.
            </div>
        @endforelse
    </div>

    @if($albums->hasPages())
        <div class="bg-white p-6 rounded-[24px] border border-outline-variant/30 shadow-sm">
            {{ $albums->links() }}
        </div>
    @endif
</div>
@endsection
