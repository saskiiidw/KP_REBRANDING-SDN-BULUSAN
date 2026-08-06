@extends('layouts.admin')

@section('title', 'Kontak & Pengaduan')

@section('content')
<div class="space-y-8">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <h2 class="font-headline-md text-3xl font-bold text-primary">Kontak & Pengaduan</h2>
            <p class="text-on-surface-variant mt-1">Kelola feedback, pertanyaan, dan pengaduan yang dikirimkan oleh publik.</p>
        </div>
    </div>

    <!-- Filters & Search -->
    <div class="bg-white p-6 rounded-[20px] shadow-sm border border-outline-variant/30">
        <form action="{{ route('admin.kontak-pengaduan.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="md:col-span-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari berdasarkan nama, email, subjek..." class="w-full px-4 py-2.5 rounded-xl border border-outline/30 outline-none text-sm"/>
            </div>
            <div>
                <select name="jenis" class="w-full px-4 py-2.5 rounded-xl border border-outline/30 outline-none text-sm bg-white">
                    <option value="">Semua Jenis</option>
                    <option value="kontak" {{ request('jenis') === 'kontak' ? 'selected' : '' }}>Kontak (Tanya Biasa)</option>
                    <option value="pengaduan" {{ request('jenis') === 'pengaduan' ? 'selected' : '' }}>Pengaduan Resmi</option>
                </select>
            </div>
            <div class="flex gap-2">
                <button type="submit" class="bg-secondary text-white px-6 py-2.5 rounded-xl font-label-md hover:bg-secondary/95 transition-colors text-sm font-semibold flex-grow">
                    Filter
                </button>
                @if(request()->anyFilled(['search', 'jenis']))
                    <a href="{{ route('admin.kontak-pengaduan.index') }}" class="bg-surface-variant text-on-surface-variant px-4 py-2.5 rounded-xl hover:bg-surface-dim transition-colors text-sm font-semibold flex items-center justify-center">
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Messages List -->
    <div class="bg-white rounded-[24px] shadow-sm border border-outline-variant/30 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-surface-variant/30 text-primary border-b border-outline-variant/30 text-xs font-bold uppercase">
                        <th class="p-6">Jenis</th>
                        <th class="p-6">Pengirim</th>
                        <th class="p-6">Subjek</th>
                        <th class="p-6">Tgl Masuk</th>
                        <th class="p-6">Status</th>
                        <th class="p-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant/20 text-sm">
                    @forelse($messages as $msg)
                        <tr class="hover:bg-surface-variant/10 transition-colors">
                            <td class="p-6">
                                <span class="uppercase px-3 py-1 rounded-full text-xs font-bold
                                    {{ $msg->jenis === 'pengaduan' ? 'bg-error-container text-on-error-container' : 'bg-secondary-container text-on-secondary-container' }}">
                                    {{ $msg->jenis }}
                                </span>
                            </td>
                            <td class="p-6 font-semibold text-primary">
                                {{ $msg->nama }}
                                <span class="text-xs text-on-surface-low font-normal block mt-1">{{ $msg->email }} · {{ $msg->no_kontak }}</span>
                            </td>
                            <td class="p-6 text-on-surface-variant font-medium max-w-xs truncate">
                                {{ $msg->subjek }}
                            </td>
                            <td class="p-6 text-on-surface-variant font-medium">
                                {{ $msg->created_at->format('d M Y H:i') }}
                            </td>
                            <td class="p-6">
                                <span class="capitalize px-3 py-1 rounded-full text-xs font-bold
                                    {{ $msg->status_penanganan === 'selesai' ? 'bg-secondary/15 text-secondary' : ($msg->status_penanganan === 'diproses' ? 'bg-primary-fixed text-primary' : 'bg-surface-variant text-on-surface-variant') }}">
                                    {{ $msg->status_penanganan }}
                                </span>
                            </td>
                            <td class="p-6 text-center">
                                <div class="flex justify-center gap-2">
                                    <a href="{{ route('admin.kontak-pengaduan.show', $msg->id) }}" class="p-2 text-secondary hover:bg-secondary/10 rounded-lg transition-colors" title="Buka Detail Pesan">
                                        <span class="material-symbols-outlined text-sm">visibility</span>
                                    </a>
                                    <form action="{{ route('admin.kontak-pengaduan.destroy', $msg->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesan ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-error hover:bg-error/10 rounded-lg transition-colors" title="Hapus Pesan">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-16 text-center text-on-surface-low">
                                <span class="material-symbols-outlined text-5xl block mb-2">inbox</span>
                                Belum ada pesan masuk yang terdaftar.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($messages->hasPages())
            <div class="p-6 border-t border-outline-variant/30 bg-surface-variant/10">
                {{ $messages->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
