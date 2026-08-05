@extends('layouts.admin')

@section('title', 'Detail Pesan')

@section('content')
<div class="space-y-8">
    <!-- Header -->
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.kontak-pengaduan.index') }}" class="p-2 hover:bg-surface-variant rounded-full transition-colors">
            <span class="material-symbols-outlined">arrow_back</span>
        </a>
        <div>
            <h2 class="font-headline-md text-3xl font-bold text-primary">Detail Pesan Masuk</h2>
            <p class="text-on-surface-variant mt-1">Lihat pengirim, subjek, isi pesan, dan kelola status penanganan.</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Message Details -->
        <div class="lg:col-span-2 space-y-6 bg-white p-6 md:p-8 rounded-[24px] shadow-sm border border-outline-variant/30">
            <div class="flex justify-between items-start border-b border-outline-variant/20 pb-4">
                <div>
                    <span class="text-xs uppercase px-2.5 py-1 rounded-full font-bold
                        {{ $message->jenis === 'pengaduan' ? 'bg-error-container text-on-error-container' : 'bg-secondary-container text-on-secondary-container' }}">
                        {{ $message->jenis }}
                    </span>
                    <h3 class="font-headline-md text-xl font-bold text-primary mt-3">{{ $message->subjek }}</h3>
                </div>
                <span class="text-xs text-on-surface-low font-medium">{{ $message->created_at->format('d M Y, H:i') }}</span>
            </div>

            <!-- Content -->
            <div class="space-y-6">
                <div>
                    <h4 class="text-xs font-bold text-primary uppercase tracking-wider mb-2">Isi Pesan / Pengaduan</h4>
                    <div class="p-6 bg-surface-variant/30 rounded-xl border text-sm text-primary leading-relaxed whitespace-pre-line">
                        {{ $message->isi_pesan }}
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 pt-4 border-t border-outline-variant/20">
                    <div>
                        <h5 class="text-xs font-bold text-on-surface-low uppercase mb-1">Nama Pengirim</h5>
                        <p class="text-sm font-semibold text-primary">{{ $message->nama }}</p>
                    </div>
                    <div>
                        <h5 class="text-xs font-bold text-on-surface-low uppercase mb-1">Email</h5>
                        <p class="text-sm font-semibold text-primary">{{ $message->email }}</p>
                    </div>
                    <div>
                        <h5 class="text-xs font-bold text-on-surface-low uppercase mb-1">No. Kontak / WA</h5>
                        <p class="text-sm font-semibold text-primary">{{ $message->no_kontak }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Management / Status Panel -->
        <div class="space-y-6">
            <div class="bg-white p-6 rounded-[24px] shadow-sm border border-outline-variant/30 space-y-6">
                <h3 class="font-headline-sm text-lg font-bold text-primary border-b border-outline-variant/20 pb-4">Status Penanganan</h3>

                <form action="{{ route('admin.kontak-pengaduan.status.update', $message->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-semibold text-primary mb-2">Ubah Status</label>
                        <select name="status_penanganan" class="w-full px-4 py-2.5 rounded-xl border border-outline/30 outline-none text-sm bg-white" required>
                            <option value="baru" {{ $message->status_penanganan === 'baru' ? 'selected' : '' }}>Baru Masuk</option>
                            <option value="diproses" {{ $message->status_penanganan === 'diproses' ? 'selected' : '' }}>Sedang Diproses</option>
                            <option value="selesai" {{ $message->status_penanganan === 'selesai' ? 'selected' : '' }}>Selesai / Ditutup</option>
                        </select>
                    </div>

                    @if($message->ditangani_oleh)
                        <div class="bg-surface-variant/30 p-4 rounded-xl border text-xs">
                            <span class="font-bold text-primary block mb-1">Ditangani Oleh:</span>
                            <span class="text-on-surface-variant font-medium">{{ $message->petugas->name }}</span>
                        </div>
                    @endif

                    <button type="submit" class="w-full bg-primary text-on-primary py-2.5 rounded-full font-label-md font-bold hover:bg-primary/95 transition-all shadow-md">
                        Simpan Status
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
