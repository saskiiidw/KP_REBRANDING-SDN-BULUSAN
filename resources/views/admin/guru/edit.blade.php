@extends('layouts.admin')

@section('title', 'Sunting Guru/Staf')

@section('content')
<div class="space-y-8">
    <!-- Header -->
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.guru.index') }}" class="p-2 hover:bg-surface-variant rounded-full transition-colors">
            <span class="material-symbols-outlined">arrow_back</span>
        </a>
        <div>
            <h2 class="font-headline-md text-3xl font-bold text-primary">Sunting Guru & Staf</h2>
            <p class="text-on-surface-variant mt-1">Perbarui data atau informasi guru/staf.</p>
        </div>
    </div>

    <!-- Form -->
    <form action="{{ route('admin.guru.update', $guru->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Side: Fields -->
            <div class="lg:col-span-2 space-y-6 bg-white p-6 md:p-8 rounded-[24px] shadow-sm border border-outline-variant/30">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-primary mb-2">Nama Lengkap</label>
                        <input type="text" name="nama" value="{{ old('nama', $guru->nama) }}" class="w-full px-4 py-2.5 rounded-xl border border-outline/30 outline-none text-sm" required/>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-primary mb-2">Jabatan</label>
                        <div class="flex gap-2">
                            <select name="jabatan_id" id="jabatan-select" class="flex-grow px-4 py-2.5 rounded-xl border border-outline/30 outline-none text-sm bg-white" required>
                                @foreach($jabatan as $jab)
                                    <option value="{{ $jab->id }}" {{ old('jabatan_id', $guru->jabatan_id) == $jab->id ? 'selected' : '' }}>{{ $jab->nama_jabatan }}</option>
                                @endforeach
                            </select>
                            <button type="button" onclick="openJabatanModal()" class="bg-surface-variant hover:bg-surface-dim text-on-surface-variant px-3 py-2.5 rounded-xl font-bold flex items-center justify-center">
                                <span class="material-symbols-outlined text-sm">add</span>
                            </button>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-primary mb-2">NIP</label>
                        <input type="text" name="nip" value="{{ old('nip', $guru->nip) }}" class="w-full px-4 py-2.5 rounded-xl border border-outline/30 outline-none text-sm"/>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-primary mb-2">NUPTK</label>
                        <input type="text" name="nuptk" value="{{ old('nuptk', $guru->nuptk) }}" class="w-full px-4 py-2.5 rounded-xl border border-outline/30 outline-none text-sm"/>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-primary mb-2">Kelas Diampu</label>
                        <input type="text" name="kelas_diampu" value="{{ old('kelas_diampu', $guru->kelas_diampu) }}" class="w-full px-4 py-2.5 rounded-xl border border-outline/30 outline-none text-sm"/>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-primary mb-2">Urutan Tampilan</label>
                        <input type="number" name="urutan" value="{{ old('urutan', $guru->urutan) }}" class="w-full px-4 py-2.5 rounded-xl border border-outline/30 outline-none text-sm" required/>
                    </div>
                </div>
            </div>

            <!-- Right Side: Config -->
            <div class="space-y-6">
                <div class="bg-white p-6 rounded-[24px] shadow-sm border border-outline-variant/30 space-y-6">
                    <h3 class="font-headline-sm text-lg font-bold text-primary border-b border-outline-variant/20 pb-4">Foto & Status</h3>

                    <div>
                        <label class="block text-sm font-semibold text-primary mb-2">Status Aktif</label>
                        <select name="status" class="w-full px-4 py-2.5 rounded-xl border border-outline/30 outline-none text-sm bg-white" required>
                            <option value="aktif" {{ old('status', $guru->status) === 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="nonaktif" {{ old('status', $guru->status) === 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-primary mb-2">Foto Profil</label>
                        @if($guru->foto)
                            <div class="mb-3">
                                <img src="{{ asset('storage/' . $guru->foto) }}" class="h-32 w-32 object-cover rounded-full border"/>
                            </div>
                        @endif
                        <input type="file" name="foto" class="w-full text-xs text-on-surface-variant"/>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-end gap-4">
            <a href="{{ route('admin.guru.index') }}" class="bg-surface-variant text-on-surface-variant px-8 py-3 rounded-full font-label-md font-bold hover:bg-surface-dim transition-all">
                Batal
            </a>
            <button type="submit" class="bg-primary text-on-primary px-8 py-3 rounded-full font-label-md font-bold hover:bg-primary/95 transition-all shadow-md">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>

<!-- Inline Jabatan Modal -->
<div id="jabatan-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 hidden">
    <div class="bg-white p-6 rounded-[24px] w-full max-w-sm border shadow-2xl relative">
        <h3 class="font-headline-sm text-lg font-bold text-primary mb-4">Tambah Jabatan Baru</h3>
        
        <div class="space-y-4">
            <div>
                <label class="block text-xs font-semibold text-primary mb-1">Nama Jabatan</label>
                <input type="text" id="new-jabatan-input" placeholder="Misal: Guru Matematika" class="w-full px-3 py-2 rounded-xl border outline-none text-xs"/>
            </div>
            
            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeJabatanModal()" class="px-4 py-2 bg-surface-variant text-on-surface-variant rounded-full text-xs font-bold">Batal</button>
                <button type="button" onclick="saveNewJabatan()" class="px-4 py-2 bg-primary text-on-primary rounded-full text-xs font-bold">Simpan</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function openJabatanModal() {
        document.getElementById('jabatan-modal').classList.remove('hidden');
    }

    function closeJabatanModal() {
        document.getElementById('jabatan-modal').classList.add('hidden');
        document.getElementById('new-jabatan-input').value = '';
    }

    function saveNewJabatan() {
        const input = document.getElementById('new-jabatan-input');
        const name = input.value.trim();
        
        if (!name) {
            alert('Nama jabatan tidak boleh kosong!');
            return;
        }

        fetch("{{ route('admin.jabatan.store') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            body: JSON.stringify({ nama_jabatan: name })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const select = document.getElementById('jabatan-select');
                const opt = document.createElement('option');
                opt.value = data.jabatan.id;
                opt.textContent = data.jabatan.nama_jabatan;
                opt.selected = true;
                select.appendChild(opt);
                closeJabatanModal();
            } else {
                alert('Gagal menambahkan jabatan atau nama jabatan sudah terdaftar.');
            }
        })
        .catch(err => {
            console.error(err);
            alert('Terjadi kesalahan koneksi.');
        });
    }
</script>
@endsection
