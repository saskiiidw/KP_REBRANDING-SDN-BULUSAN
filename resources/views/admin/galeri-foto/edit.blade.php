@extends('layouts.admin')

@section('title', 'Sunting Album Galeri')

@section('content')
<div class="space-y-8">
    <!-- Header -->
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.galeri-foto.index') }}" class="p-2 hover:bg-surface-variant rounded-full transition-colors">
            <span class="material-symbols-outlined">arrow_back</span>
        </a>
        <div>
            <h2 class="font-headline-md text-3xl font-bold text-primary">Sunting Album Galeri</h2>
            <p class="text-on-surface-variant mt-1">Perbarui nama atau keterangan deskripsi album galeri.</p>
        </div>
    </div>

    <!-- Form -->
    <form action="{{ route('admin.galeri-foto.update', $album->id) }}" method="POST" class="space-y-8">
        @csrf
        @method('PUT')

        <div class="max-w-2xl space-y-6 bg-white p-6 md:p-8 rounded-[24px] shadow-sm border border-outline-variant/30">
            <div>
                <label class="block text-sm font-semibold text-primary mb-2">Nama Album</label>
                <input type="text" name="nama_album" value="{{ old('nama_album', $album->nama_album) }}" class="w-full px-4 py-2.5 rounded-xl border border-outline/30 outline-none text-sm" required/>
            </div>

            <div>
                <label class="block text-sm font-semibold text-primary mb-2">Deskripsi Album</label>
                <textarea name="deskripsi" rows="5" class="w-full px-4 py-2.5 rounded-xl border border-outline/30 outline-none text-sm">{{ old('deskripsi', $album->deskripsi) }}</textarea>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-start gap-4">
            <a href="{{ route('admin.galeri-foto.index') }}" class="bg-surface-variant text-on-surface-variant px-8 py-3 rounded-full font-label-md font-bold hover:bg-surface-dim transition-all">
                Batal
            </a>
            <button type="submit" class="bg-primary text-on-primary px-8 py-3 rounded-full font-label-md font-bold hover:bg-primary/95 transition-all shadow-md">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
