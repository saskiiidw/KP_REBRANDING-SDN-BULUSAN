@extends('layouts.admin')

@section('title', 'Sunting Pengumuman')

@section('content')
<div class="space-y-8">
    <!-- Header -->
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.pengumuman.index') }}" class="p-2 hover:bg-surface-variant rounded-full transition-colors">
            <span class="material-symbols-outlined">arrow_back</span>
        </a>
        <div>
            <h2 class="font-headline-md text-3xl font-bold text-primary">Sunting Pengumuman</h2>
            <p class="text-on-surface-variant mt-1">Perbarui detail edaran pengumuman resmi sekolah.</p>
        </div>
    </div>

    <!-- Form -->
    <form action="{{ route('admin.pengumuman.update', $pengumuman->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Side: Content -->
            <div class="lg:col-span-2 space-y-6 bg-white p-6 md:p-8 rounded-[24px] shadow-sm border border-outline-variant/30">
                <div>
                    <label class="block text-sm font-semibold text-primary mb-2">Judul Pengumuman</label>
                    <input type="text" name="judul" value="{{ old('judul', $pengumuman->judul) }}" class="w-full px-4 py-2.5 rounded-xl border border-outline/30 outline-none text-sm" required/>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-primary mb-2">Isi Pengumuman</label>
                    <textarea name="konten" rows="12" class="w-full px-4 py-2.5 rounded-xl border border-outline/30 outline-none text-sm" required>{{ old('konten', $pengumuman->konten) }}</textarea>
                </div>

                <!-- Existing Attachments -->
                @if($pengumuman->lampiran->isNotEmpty())
                    <div>
                        <h4 class="text-sm font-semibold text-primary mb-3">Lampiran Saat Ini</h4>
                        <div class="space-y-2">
                            @foreach($pengumuman->lampiran as $lampiran)
                                <div class="flex justify-between items-center bg-surface-variant/40 px-4 py-2.5 rounded-xl border border-outline-variant/20 text-xs">
                                    <span class="font-semibold text-primary">{{ $lampiran->nama_lampiran }}</span>
                                    <div class="flex gap-2">
                                        <a href="{{ asset('storage/' . $lampiran->path_file) }}" target="_blank" class="p-1 text-primary hover:bg-white rounded">
                                            <span class="material-symbols-outlined text-sm">open_in_new</span>
                                        </a>
                                        <button type="button" onclick="deleteAttachment({{ $lampiran->id }})" class="p-1 text-error hover:bg-white rounded">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- New Attachments Section -->
                <div>
                    <div class="flex justify-between items-center border-b border-outline-variant/20 pb-2 mb-4">
                        <label class="text-sm font-semibold text-primary">Tambah File Lampiran Baru (PDF, PNG, JPG)</label>
                        <button type="button" id="add-attachment-btn" class="text-xs text-secondary font-bold hover:underline flex items-center gap-1">
                            <span class="material-symbols-outlined text-xs">add</span> Tambah Lampiran
                        </button>
                    </div>

                    <div id="attachments-container" class="space-y-4">
                        <!-- Javascript appends dynamically here -->
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
                            <option value="draft" {{ old('status', $pengumuman->status) === 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="published" {{ old('status', $pengumuman->status) === 'published' ? 'selected' : '' }}>Published</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-primary mb-2">Tanggal Terbit</label>
                        <input type="date" name="tanggal_terbit" value="{{ old('tanggal_terbit', $pengumuman->tanggal_terbit->format('Y-m-d')) }}" class="w-full px-4 py-2.5 rounded-xl border border-outline/30 outline-none text-sm bg-white" required/>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-primary mb-2">Tanggal Berakhir (Opsional)</label>
                        <input type="date" name="tanggal_berakhir" value="{{ old('tanggal_berakhir', $pengumuman->tanggal_berakhir ? $pengumuman->tanggal_berakhir->format('Y-m-d') : '') }}" class="w-full px-4 py-2.5 rounded-xl border border-outline/30 outline-none text-sm bg-white"/>
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
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>

<!-- Hidden Delete Form -->
<form id="delete-attachment-form" action="" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>
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
                <input type="text" name="nama_lampiran[]" placeholder="Nama file..." class="w-full px-3 py-2 rounded-lg border border-outline/20 outline-none text-xs bg-white" required/>
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
        
        card.querySelector('.remove-btn').addEventListener('click', () => {
            card.remove();
        });
        
        container.appendChild(card);
    });

    function deleteAttachment(id) {
        if (confirm('Apakah Anda yakin ingin menghapus lampiran ini?')) {
            const form = document.getElementById('delete-attachment-form');
            form.action = `/admin/pengumuman/attachment/${id}`;
            form.submit();
        }
    }
</script>
@endsection
