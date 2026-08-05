@extends('layouts.admin')

@section('title', 'Tambah Tautan Layanan')

@section('content')
<div class="space-y-8">
    <!-- Header -->
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.tautan-layanan.index') }}" class="p-2 hover:bg-surface-variant rounded-full transition-colors">
            <span class="material-symbols-outlined">arrow_back</span>
        </a>
        <div>
            <h2 class="font-headline-md text-3xl font-bold text-primary">Tambah Tautan Layanan Baru</h2>
            <p class="text-on-surface-variant mt-1">Daftarkan layanan digital baru untuk aksi di tombol navigasi / halaman beranda.</p>
        </div>
    </div>

    <!-- Form -->
    <form action="{{ route('admin.tautan-layanan.store') }}" method="POST" class="space-y-8">
        @csrf

        <div class="max-w-2xl space-y-6 bg-white p-6 md:p-8 rounded-[24px] shadow-sm border border-outline-variant/30">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-primary mb-2">Nama Layanan</label>
                    <input type="text" name="nama_layanan" value="{{ old('nama_layanan') }}" placeholder="Misal: Portal Pendaftaran PPDB" class="w-full px-4 py-2.5 rounded-xl border border-outline/30 outline-none text-sm" required/>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-primary mb-2">Ikon (Material Symbol Name)</label>
                    <input type="text" name="ikon" value="{{ old('ikon', 'link') }}" placeholder="Misal: how_to_reg, emoji_events, school" class="w-full px-4 py-2.5 rounded-xl border border-outline/30 outline-none text-sm" required/>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-primary mb-2">URL Tujuan</label>
                    <input type="url" name="url" value="{{ old('url') }}" placeholder="Misal: https://ppd.semarangkota.go.id" class="w-full px-4 py-2.5 rounded-xl border border-outline/30 outline-none text-sm" required/>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-primary mb-2">Urutan Tampilan</label>
                    <input type="number" name="urutan" value="{{ old('urutan', 0) }}" class="w-full px-4 py-2.5 rounded-xl border border-outline/30 outline-none text-sm" required/>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-primary mb-2">Jenis Link</label>
                    <select name="is_eksternal" class="w-full px-4 py-2.5 rounded-xl border border-outline/30 outline-none text-sm bg-white" required>
                        <option value="1" {{ old('is_eksternal') == '1' ? 'selected' : '' }}>Eksternal (Membuka Tab Baru)</option>
                        <option value="0" {{ old('is_eksternal') == '0' ? 'selected' : '' }}>Internal (Halaman Website Sendiri)</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-start gap-4">
            <a href="{{ route('admin.tautan-layanan.index') }}" class="bg-surface-variant text-on-surface-variant px-8 py-3 rounded-full font-label-md font-bold hover:bg-surface-dim transition-all">
                Batal
            </a>
            <button type="submit" class="bg-primary text-on-primary px-8 py-3 rounded-full font-label-md font-bold hover:bg-primary/95 transition-all shadow-md">
                Simpan Tautan
            </button>
        </div>
    </form>
</div>
@endsection
