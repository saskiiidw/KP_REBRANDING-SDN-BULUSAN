@extends('layouts.admin')

@section('title', 'Tambah Agenda Baru')

@section('content')
<div class="space-y-8">
    <!-- Header -->
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.agenda.index') }}" class="p-2 hover:bg-surface-variant rounded-full transition-colors">
            <span class="material-symbols-outlined">arrow_back</span>
        </a>
        <div>
            <h2 class="font-headline-md text-3xl font-bold text-primary">Tambah Agenda Baru</h2>
            <p class="text-on-surface-variant mt-1">Buat agenda kegiatan baru pada kalender sekolah.</p>
        </div>
    </div>

    <!-- Form -->
    <form action="{{ route('admin.agenda.store') }}" method="POST" class="space-y-8">
        @csrf

        <div class="max-w-3xl space-y-6 bg-white p-6 md:p-8 rounded-[24px] shadow-sm border border-outline-variant/30">
            <div>
                <label class="block text-sm font-semibold text-primary mb-2">Nama Kegiatan</label>
                <input type="text" name="nama_kegiatan" value="{{ old('nama_kegiatan') }}" placeholder="Ketikkan nama kegiatan..." class="w-full px-4 py-2.5 rounded-xl border border-outline/30 outline-none text-sm" required/>
            </div>

            <div>
                <label class="block text-sm font-semibold text-primary mb-2">Deskripsi Kegiatan</label>
                <textarea name="deskripsi" rows="6" placeholder="Tuliskan detail mengenai kegiatan..." class="w-full px-4 py-2.5 rounded-xl border border-outline/30 outline-none text-sm" required>{{ old('deskripsi') }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-primary mb-2">Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai" value="{{ old('tanggal_mulai', date('Y-m-d')) }}" class="w-full px-4 py-2.5 rounded-xl border border-outline/30 outline-none text-sm bg-white" required/>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-primary mb-2">Tanggal Selesai</label>
                    <input type="date" name="tanggal_selesai" value="{{ old('tanggal_selesai', date('Y-m-d')) }}" class="w-full px-4 py-2.5 rounded-xl border border-outline/30 outline-none text-sm bg-white" required/>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-start gap-4">
            <a href="{{ route('admin.agenda.index') }}" class="bg-surface-variant text-on-surface-variant px-8 py-3 rounded-full font-label-md font-bold hover:bg-surface-dim transition-all">
                Batal
            </a>
            <button type="submit" class="bg-primary text-on-primary px-8 py-3 rounded-full font-label-md font-bold hover:bg-primary/95 transition-all shadow-md">
                Simpan Agenda
            </button>
        </div>
    </form>
</div>
@endsection
