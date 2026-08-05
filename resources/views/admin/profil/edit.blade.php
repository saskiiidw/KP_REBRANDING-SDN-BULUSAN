@extends('layouts.admin')

@section('title', 'Edit Profil Sekolah')

@section('content')
<div class="space-y-8">
    <div class="flex justify-between items-center">
        <div>
            <h2 class="font-headline-md text-3xl font-bold text-primary">Profil Sekolah</h2>
            <p class="text-on-surface-variant mt-1">Kelola data identitas resmi sekolah dan visi-misi.</p>
        </div>
    </div>

    <form action="{{ route('admin.profil.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Side: Identity Info -->
            <div class="lg:col-span-2 space-y-6 bg-white p-6 md:p-8 rounded-[24px] shadow-sm border border-outline-variant/30">
                <h3 class="font-headline-sm text-xl font-bold text-primary border-b border-outline-variant/20 pb-4">Identitas Sekolah</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-primary mb-2">Nama Sekolah</label>
                        <input type="text" name="nama_sekolah" value="{{ old('nama_sekolah', $profil->nama_sekolah) }}" class="w-full px-4 py-2.5 rounded-xl border border-outline/30 outline-none text-sm" required/>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-primary mb-2">Akreditasi</label>
                        <input type="text" name="akreditasi" value="{{ old('akreditasi', $profil->akreditasi) }}" class="w-full px-4 py-2.5 rounded-xl border border-outline/30 outline-none text-sm" required/>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-primary mb-2">NPSN</label>
                        <input type="text" name="npsn" value="{{ old('npsn', $profil->npsn) }}" class="w-full px-4 py-2.5 rounded-xl border border-outline/30 outline-none text-sm" required/>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-primary mb-2">NSS</label>
                        <input type="text" name="nss" value="{{ old('nss', $profil->nss) }}" class="w-full px-4 py-2.5 rounded-xl border border-outline/30 outline-none text-sm" required/>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-primary mb-2">Email</label>
                        <input type="email" name="email" value="{{ old('email', $profil->email) }}" class="w-full px-4 py-2.5 rounded-xl border border-outline/30 outline-none text-sm" required/>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-primary mb-2">Telepon</label>
                        <input type="text" name="telepon" value="{{ old('telepon', $profil->telepon) }}" class="w-full px-4 py-2.5 rounded-xl border border-outline/30 outline-none text-sm" required/>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-primary mb-2">Alamat Sekolah</label>
                    <textarea name="alamat" rows="3" class="w-full px-4 py-2.5 rounded-xl border border-outline/30 outline-none text-sm" required>{{ old('alamat', $profil->alamat) }}</textarea>
                </div>

                <h3 class="font-headline-sm text-xl font-bold text-primary border-b border-outline-variant/20 pt-6 pb-4">Visi & Misi</h3>
                
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-semibold text-primary mb-2">Visi Sekolah</label>
                        <textarea name="visi" rows="3" class="w-full px-4 py-2.5 rounded-xl border border-outline/30 outline-none text-sm" required>{{ old('visi', $profil->visi) }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-primary mb-2">Misi Sekolah (Pisahkan per baris)</label>
                        <textarea name="misi" rows="6" class="w-full px-4 py-2.5 rounded-xl border border-outline/30 outline-none text-sm" required>{{ old('misi', $profil->misi) }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-primary mb-2">Sejarah Singkat Sekolah</label>
                        <textarea name="sejarah" rows="6" class="w-full px-4 py-2.5 rounded-xl border border-outline/30 outline-none text-sm">{{ old('sejarah', $profil->sejarah) }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Right Side: Headmaster & Operational -->
            <div class="space-y-6">
                <!-- Headmaster Details -->
                <div class="bg-white p-6 rounded-[24px] shadow-sm border border-outline-variant/30 space-y-6">
                    <h3 class="font-headline-sm text-xl font-bold text-primary border-b border-outline-variant/20 pb-4">Kepala Sekolah</h3>
                    
                    <div>
                        <label class="block text-sm font-semibold text-primary mb-2">Nama Kepala Sekolah</label>
                        <input type="text" name="nama_kepsek" value="{{ old('nama_kepsek', $profil->nama_kepsek) }}" class="w-full px-4 py-2.5 rounded-xl border border-outline/30 outline-none text-sm" required/>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-primary mb-2">NIP Kepala Sekolah</label>
                        <input type="text" name="nip_kepsek" value="{{ old('nip_kepsek', $profil->nip_kepsek) }}" class="w-full px-4 py-2.5 rounded-xl border border-outline/30 outline-none text-sm" required/>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-primary mb-2">Sambutan Kepala Sekolah</label>
                        <textarea name="sambutan_kepsek" rows="6" class="w-full px-4 py-2.5 rounded-xl border border-outline/30 outline-none text-sm" required>{{ old('sambutan_kepsek', $profil->sambutan_kepsek) }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-primary mb-2">Foto Kepala Sekolah</label>
                        @if($profil->foto_kepsek)
                            <div class="mb-3">
                                <img src="{{ asset('storage/' . $profil->foto_kepsek) }}" class="h-32 w-auto object-cover rounded-xl border"/>
                            </div>
                        @endif
                        <input type="file" name="foto_kepsek" class="w-full text-xs text-on-surface-variant"/>
                    </div>
                </div>

                <!-- Operational Hours -->
                <div class="bg-white p-6 rounded-[24px] shadow-sm border border-outline-variant/30 space-y-4">
                    <h3 class="font-headline-sm text-xl font-bold text-primary border-b border-outline-variant/20 pb-4">Jam Kerja</h3>
                    
                    @foreach($profil->jam_kerja as $hari => $jam)
                        <div>
                            <label class="block text-xs font-semibold text-primary mb-1">{{ $hari }}</label>
                            <input type="text" name="jam_kerja[{{ $hari }}]" value="{{ $jam }}" class="w-full px-3 py-2 rounded-lg border border-outline/30 outline-none text-xs"/>
                        </div>
                    @endforeach
                </div>

                <!-- Organization Chart -->
                <div class="bg-white p-6 rounded-[24px] shadow-sm border border-outline-variant/30 space-y-4">
                    <h3 class="font-headline-sm text-xl font-bold text-primary border-b border-outline-variant/20 pb-4">Struktur Organisasi</h3>
                    
                    @if($profil->struktur_organisasi)
                        <div class="mb-3">
                            <a href="{{ asset('storage/' . $profil->struktur_organisasi) }}" target="_blank" class="text-sm text-secondary hover:underline font-semibold flex items-center gap-1">
                                <span class="material-symbols-outlined text-sm">open_in_new</span> Lihat Dokumen Struktur
                            </a>
                        </div>
                    @endif
                    <input type="file" name="struktur_organisasi" class="w-full text-xs text-on-surface-variant"/>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end gap-4">
            <button type="submit" class="bg-primary text-on-primary px-8 py-3 rounded-full font-label-md font-bold hover:bg-primary/95 transition-all shadow-md">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
