@extends('layouts.admin')

@section('title', 'Tulis Berita Baru')

@section('content')
<div class="space-y-8">
    <!-- Header -->
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.berita.index') }}" class="p-2 hover:bg-surface-variant rounded-full transition-colors">
            <span class="material-symbols-outlined">arrow_back</span>
        </a>
        <div>
            <h2 class="font-headline-md text-3xl font-bold text-primary">Tulis Berita Baru</h2>
            <p class="text-on-surface-variant mt-1">Buat artikel berita atau kegiatan baru untuk dipublikasikan.</p>
        </div>
    </div>

    <!-- Form -->
    <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Side: Content Fields -->
            <div class="lg:col-span-2 space-y-6 bg-white p-6 md:p-8 rounded-[24px] shadow-sm border border-outline-variant/30">
                <div>
                    <label class="block text-sm font-semibold text-primary mb-2">Judul Berita</label>
                    <input type="text" name="judul" value="{{ old('judul') }}" placeholder="Ketikkan judul berita..." class="w-full px-4 py-2.5 rounded-xl border border-outline/30 outline-none text-sm" required/>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-primary mb-2">Kategori Berita</label>
                    <select name="kategori_berita_id" class="w-full px-4 py-2.5 rounded-xl border border-outline/30 outline-none text-sm bg-white" required>
                        <option value="">Pilih Kategori</option>
                        @foreach($kategori as $cat)
                            <option value="{{ $cat->id }}" {{ old('kategori_berita_id') == $cat->id ? 'selected' : '' }}>{{ $cat->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-primary mb-2">Ringkasan Berita</label>
                    <textarea name="ringkasan" rows="3" placeholder="Ketikkan ringkasan singkat untuk tampilan kartu berita..." class="w-full px-4 py-2.5 rounded-xl border border-outline/30 outline-none text-sm" required>{{ old('ringkasan') }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-primary mb-2">Konten Lengkap Berita</label>
                    <textarea name="konten" rows="12" placeholder="Ketikkan isi berita lengkap di sini..." class="w-full px-4 py-2.5 rounded-xl border border-outline/30 outline-none text-sm" required>{{ old('konten') }}</textarea>
                </div>
            </div>

            <!-- Right Side: Status, Images & SEO -->
            <div class="space-y-6">
                <!-- Status & Thumbnail -->
                <div class="bg-white p-6 rounded-[24px] shadow-sm border border-outline-variant/30 space-y-6">
                    <h3 class="font-headline-sm text-lg font-bold text-primary border-b border-outline-variant/20 pb-4">Pengaturan Publikasi</h3>

                    <div>
                        <label class="block text-sm font-semibold text-primary mb-2">Status Publikasi</label>
                        <select name="status" class="w-full px-4 py-2.5 rounded-xl border border-outline/30 outline-none text-sm bg-white" required>
                            <option value="published" {{ old('status', 'published') === 'published' ? 'selected' : '' }}>Published</option>
                            <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="archived" {{ old('status') === 'archived' ? 'selected' : '' }}>Archived</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-primary mb-2">Thumbnail Gambar</label>
                        <input type="file" name="thumbnail" class="w-full text-xs text-on-surface-variant"/>
                        <p class="text-xs text-on-surface-low mt-2">Format: JPG, JPEG, PNG, WEBP (Max 2MB)</p>
                    </div>
                </div>

                <!-- SEO Panel -->
                <div class="bg-white p-6 rounded-[24px] shadow-sm border border-outline-variant/30 space-y-6">
                    <h3 class="font-headline-sm text-lg font-bold text-primary border-b border-outline-variant/20 pb-4">Optimasi SEO (Opsional)</h3>

                    <div>
                        <label class="block text-sm font-semibold text-primary mb-2">Meta Title</label>
                        <input type="text" name="meta_title" value="{{ old('meta_title') }}" placeholder="Judul khusus untuk mesin pencari..." class="w-full px-4 py-2.5 rounded-xl border border-outline/30 outline-none text-sm"/>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-primary mb-2">Meta Description</label>
                        <textarea name="meta_description" rows="4" placeholder="Deskripsi ringkas pencarian..." class="w-full px-4 py-2.5 rounded-xl border border-outline/30 outline-none text-sm">{{ old('meta_description') }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end gap-4">
            <a href="{{ route('admin.berita.index') }}" class="bg-surface-variant text-on-surface-variant px-8 py-3 rounded-full font-label-md font-bold hover:bg-surface-dim transition-all">
                Batal
            </a>
            <button type="submit" class="bg-primary text-on-primary px-8 py-3 rounded-full font-label-md font-bold hover:bg-primary/95 transition-all shadow-md">
                Simpan & Terbitkan
            </button>
        </div>
    </form>
</div>
@endsection
