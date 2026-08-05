@extends('layouts.admin')

@section('title', 'Buat Pengumuman Baru')

@section('content')
<div class="space-y-8">
    <!-- Header -->
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.pengumuman.index') }}" class="p-2 hover:bg-surface-variant rounded-full transition-colors">
            <span class="material-symbols-outlined">arrow_back</span>
        </a>
        <div>
            <h2 class="font-headline-md text-3xl font-bold text-primary">Buat Pengumuman Baru</h2>
            <p class="text-on-surface-variant mt-1">Publikasikan informasi penting atau edaran resmi untuk siswa/orang tua.</p>
        </div>
    </div>

    <!-- Form -->
    <form action="{{ route('admin.pengumuman.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Side: Content -->
            <div class="lg:col-span-2 space-y-6 bg-white p-6 md:p-8 rounded-[24px] shadow-sm border border-outline-variant/30">
                <div>
                    <label class="block text-sm font-semibold text-primary mb-2">Judul Pengumuman</label>
                    <input type="text" name="judul" value="{{ old('judul') }}" placeholder="Ketikkan judul pengumuman..." class="w-full px-4 py-2.5 rounded-xl border border-outline/30 outline-none text-sm" required/>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-primary mb-2">Isi Pengumuman</label>
                    <textarea name="konten" rows="12" placeholder="Tuliskan detail informasi pengumuman..." class="w-full px-4 py-2.5 rounded-xl border border-outline/30 outline-none text-sm" required>{{ old('konten') }}</textarea>
                </div>

                <!-- Attachments Section -->
                <div>
                    <div class="flex justify-between items-center border-b border-outline-variant/20 pb-2 mb-4">
                        <label class="text-sm font-semibold text-primary">File Lampiran (PDF, PNG, JPG)</label>
                        <button type="button" id="add-attachment-btn" class="text-xs text-secondary font-bold hover:underline flex items-center gap-1">
                            <span class="material-symbols-outlined text-xs">add</span> Tambah Lampiran
                        </button>
                    </div>

                    <div id="attachments-container" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-center bg-surface-variant/30 p-4 rounded-xl border border-outline-variant/30 relative">
                            <div>
                                <label class="block text-xs font-bold text-primary mb-1">Nama Lampiran (Misal: Surat Edaran PPDB)</label>
                                <input type="text" name="nama_lampiran[]" placeholder="Nama file..." class="w-full px-3 py-2 rounded-lg border border-outline/20 outline-none text-xs bg-white"/>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-primary mb-1">Pilih File</label>
                                <input type="file" name="lampiran[]" class="w-full text-xs text-on-surface-variant"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side: Config -->
            <div class="space-y-6">
                <div class="bg-white p-6 rounded-[24px] shadow-sm border border-outline-variant/30 space-y-6">
                    <h3 class="font-headline-sm text-lg font-bold text-primary border-b border-outline-variant/20 pb-4">Pengaturan</h3>

                    <div>
                        <label class="block text-sm font-semibold text-primary mb-2">Status Publikasi</label>
                        <select name="status" class="w-full px-4 py-2.5 rounded-xl border border-outline/30 outline-none text-sm bg-white" required>
                            <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Published</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-primary mb-2">Tanggal Terbit</label>
                        <input type="date" name="tanggal_terbit" value="{{ old('tanggal_terbit', date('Y-m-d')) }}" class="w-full px-4 py-2.5 rounded-xl border border-outline/30 outline-none text-sm bg-white" required/>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-primary mb-2">Tanggal Berakhir (Opsional)</label>
                        <input type="date" name="tanggal_berakhir" value="{{ old('tanggal_berakhir') }}" class="w-full px-4 py-2.5 rounded-xl border border-outline/30 outline-none text-sm bg-white"/>
                        <p class="text-xs text-on-surface-low mt-2">Pengumuman otomatis disembunyikan setelah melewati tanggal ini.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-end gap-4">
            <a href="{{ route('admin.pengumuman.index') }}" class="bg-surface-variant text-on-surface-variant px-8 py-3 rounded-full font-label-md font-bold hover:bg-surface-dim transition-all">
                Batal
            </a>
            <button type="submit" class="bg-primary text-on-primary px-8 py-3 rounded-full font-label-md font-bold hover:bg-primary/95 transition-all shadow-md">
                Simpan & Terbitkan
            </button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    document.getElementById('add-attachment-btn').addEventListener('click', () => {
        const container = document.getElementById('attachments-container');
        
        const card = document.createElement('div');
        card.className = 'grid grid-cols-1 md:grid-cols-2 gap-4 items-center bg-surface-variant/30 p-4 rounded-xl border border-outline-variant/30 relative';
        
        card.innerHTML = `
            <div>
                <label class="block text-xs font-bold text-primary mb-1">Nama Lampiran</label>
                <input type="text" name="nama_lampiran[]" placeholder="Nama file..." class="w-full px-3 py-2 rounded-lg border border-outline/20 outline-none text-xs bg-white"/>
            </div>
            <div class="flex items-center gap-2">
                <div class="flex-grow">
                    <label class="block text-xs font-bold text-primary mb-1">Pilih File</label>
                    <input type="file" name="lampiran[]" class="w-full text-xs text-on-surface-variant" required/>
                </div>
                <button type="button" class="remove-btn text-error hover:bg-error/10 p-1.5 rounded-lg mt-4 shrink-0">
                    <span class="material-symbols-outlined text-lg">delete</span>
                </button>
            </div>
        `;
        
        // Remove button handler
        card.querySelector('.remove-btn').addEventListener('click', () => {
            card.remove();
        });
        
        container.appendChild(card);
    });
</script>
@endsection
