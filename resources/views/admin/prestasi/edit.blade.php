@extends('layouts.admin')

@section('title', 'Sunting Prestasi')

@section('content')
<div class="space-y-8">
    <!-- Header -->
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.prestasi.index') }}" class="p-2 hover:bg-surface-variant rounded-full transition-colors">
            <span class="material-symbols-outlined">arrow_back</span>
        </a>
        <div>
            <h2 class="font-headline-md text-3xl font-bold text-primary">Sunting Prestasi</h2>
            <p class="text-on-surface-variant mt-1">Perbarui data pencapaian penghargaan prestasi siswa.</p>
        </div>
    </div>

    <!-- Form -->
    <form action="{{ route('admin.prestasi.update', $prestasi->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Side: Fields -->
            <div class="lg:col-span-2 space-y-6 bg-white p-6 md:p-8 rounded-[24px] shadow-sm border border-outline-variant/30">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-primary mb-2">Nama Siswa / Tim</label>
                        <input type="text" name="nama_siswa" value="{{ old('nama_siswa', $prestasi->nama_siswa) }}" class="w-full px-4 py-2.5 rounded-xl border border-outline/30 outline-none text-sm" required/>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-primary mb-2">Tingkat Prestasi</label>
                        <div class="flex gap-2">
                            <select name="tingkat_prestasi_id" id="tingkat-select" class="flex-grow px-4 py-2.5 rounded-xl border border-outline/30 outline-none text-sm bg-white" required>
                                @foreach($tingkat as $tk)
                                    <option value="{{ $tk->id }}" {{ old('tingkat_prestasi_id', $prestasi->tingkat_prestasi_id) == $tk->id ? 'selected' : '' }}>{{ $tk->nama_tingkat }}</option>
                                @endforeach
                            </select>
                            <button type="button" onclick="openTingkatModal()" class="bg-surface-variant hover:bg-surface-dim text-on-surface-variant px-3 py-2.5 rounded-xl font-bold flex items-center justify-center">
                                <span class="material-symbols-outlined text-sm">add</span>
                            </button>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-primary mb-2">Kategori Lomba / Bidang</label>
                        <input type="text" name="lomba" value="{{ old('lomba', $prestasi->lomba) }}" class="w-full px-4 py-2.5 rounded-xl border border-outline/30 outline-none text-sm" required/>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-primary mb-2">Peringkat / Juara</label>
                        <input type="text" name="peringkat" value="{{ old('peringkat', $prestasi->peringkat) }}" class="w-full px-4 py-2.5 rounded-xl border border-outline/30 outline-none text-sm" required/>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-primary mb-2">Tahun Penghargaan</label>
                        <input type="number" name="tahun" value="{{ old('tahun', $prestasi->tahun) }}" class="w-full px-4 py-2.5 rounded-xl border border-outline/30 outline-none text-sm" required/>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-primary mb-2">Deskripsi / Detail Tambahan</label>
                    <textarea name="deskripsi" rows="5" class="w-full px-4 py-2.5 rounded-xl border border-outline/30 outline-none text-sm">{{ old('deskripsi', $prestasi->deskripsi) }}</textarea>
                </div>
            </div>

            <!-- Right Side: Documentation -->
            <div class="space-y-6">
                <div class="bg-white p-6 rounded-[24px] shadow-sm border border-outline-variant/30 space-y-6">
                    <h3 class="font-headline-sm text-lg font-bold text-primary border-b border-outline-variant/20 pb-4">Dokumentasi</h3>

                    <div>
                        <label class="block text-sm font-semibold text-primary mb-2">Foto Penghargaan / Lomba</label>
                        @if($prestasi->foto)
                            <div class="mb-3">
                                <img src="{{ asset('storage/' . $prestasi->foto) }}" class="h-32 w-auto object-cover rounded-xl border"/>
                            </div>
                        @endif
                        <input type="file" name="foto" class="w-full text-xs text-on-surface-variant"/>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-end gap-4">
            <a href="{{ route('admin.prestasi.index') }}" class="bg-surface-variant text-on-surface-variant px-8 py-3 rounded-full font-label-md font-bold hover:bg-surface-dim transition-all">
                Batal
            </a>
            <button type="submit" class="bg-primary text-on-primary px-8 py-3 rounded-full font-label-md font-bold hover:bg-primary/95 transition-all shadow-md">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>

<!-- Inline Tingkat Modal -->
<div id="tingkat-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 hidden">
    <div class="bg-white p-6 rounded-[24px] w-full max-w-sm border shadow-2xl relative">
        <h3 class="font-headline-sm text-lg font-bold text-primary mb-4">Tambah Tingkat Prestasi</h3>
        
        <div class="space-y-4">
            <div>
                <label class="block text-xs font-semibold text-primary mb-1">Nama Tingkat Prestasi</label>
                <input type="text" id="new-tingkat-input" placeholder="Misal: Tingkat Nasional" class="w-full px-3 py-2 rounded-xl border outline-none text-xs"/>
            </div>
            
            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeTingkatModal()" class="px-4 py-2 bg-surface-variant text-on-surface-variant rounded-full text-xs font-bold">Batal</button>
                <button type="button" onclick="saveNewTingkat()" class="px-4 py-2 bg-primary text-on-primary rounded-full text-xs font-bold">Simpan</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function openTingkatModal() {
        document.getElementById('tingkat-modal').classList.remove('hidden');
    }

    function closeTingkatModal() {
        document.getElementById('tingkat-modal').classList.add('hidden');
        document.getElementById('new-tingkat-input').value = '';
    }

    function saveNewTingkat() {
        const input = document.getElementById('new-tingkat-input');
        const name = input.value.trim();
        
        if (!name) {
            alert('Nama tingkat tidak boleh kosong!');
            return;
        }

        fetch("{{ route('admin.tingkat-prestasi.store') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            body: JSON.stringify({ nama_tingkat: name })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const select = document.getElementById('tingkat-select');
                const opt = document.createElement('option');
                opt.value = data.tingkat.id;
                opt.textContent = data.tingkat.nama_tingkat;
                opt.selected = true;
                select.appendChild(opt);
                closeTingkatModal();
            } else {
                alert('Gagal menambahkan tingkat prestasi.');
            }
        })
        .catch(err => {
            console.error(err);
            alert('Terjadi kesalahan koneksi.');
        });
    }
</script>
@endsection
