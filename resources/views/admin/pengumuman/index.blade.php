@extends('layouts.admin')

@section('title', 'Kelola Pengumuman')

@section('content')
<div class="space-y-8">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h2 class="font-headline-md text-3xl font-bold text-primary">Kelola Pengumuman</h2>
            <p class="text-on-surface-variant mt-1">Buat pengumuman edaran resmi sekolah beserta lampirannya.</p>
        </div>
        <a href="{{ route('admin.pengumuman.create') }}" class="bg-primary text-on-primary px-6 py-2.5 rounded-full font-label-md font-bold hover:bg-primary/95 transition-all shadow-md inline-flex items-center gap-2">
            <span class="material-symbols-outlined text-sm">add</span> Buat Pengumuman
        </a>
    </div>

    <!-- Search -->
    <div class="bg-white p-6 rounded-[20px] shadow-sm border border-outline-variant/30">
        <form action="{{ route('admin.pengumuman.index') }}" method="GET" class="flex gap-4">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari berdasarkan judul pengumuman..." class="flex-grow px-4 py-2.5 rounded-xl border border-outline/30 outline-none text-sm"/>
            <button type="submit" class="bg-secondary text-white px-8 py-2.5 rounded-xl font-label-md hover:bg-secondary/95 transition-colors text-sm font-semibold">
                Cari
            </button>
            @if(request('search'))
                <a href="{{ route('admin.pengumuman.index') }}" class="bg-surface-variant text-on-surface-variant px-4 py-2.5 rounded-xl hover:bg-surface-dim transition-colors text-sm font-semibold flex items-center justify-center">
                    Reset
                </a>
            @endif
        </form>
    </div>

    <!-- Table List -->
    <div class="bg-white rounded-[24px] shadow-sm border border-outline-variant/30 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-surface-variant/30 text-primary border-b border-outline-variant/30 text-xs font-bold uppercase">
                        <th class="p-6">Judul</th>
                        <th class="p-6">Tgl Terbit</th>
                        <th class="p-6">Tgl Berakhir</th>
                        <th class="p-6">Lampiran</th>
                        <th class="p-6">Status</th>
                        <th class="p-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant/20 text-sm">
                    @forelse($pengumuman as $item)
                        <tr class="hover:bg-surface-variant/10 transition-colors">
                            <td class="p-6 font-semibold text-primary max-w-sm">
                                <span class="line-clamp-2">{{ $item->judul }}</span>
                                <span class="text-xs text-on-surface-low font-normal block mt-1">Oleh: {{ $item->penulis->name }}</span>
                            </td>
                            <td class="p-6 text-on-surface-variant font-medium">
                                {{ $item->tanggal_terbit->format('d M Y') }}
                            </td>
                            <td class="p-6 text-on-surface-variant font-medium">
                                {{ $item->tanggal_berakhir ? $item->tanggal_berakhir->format('d M Y') : 'Selamanya' }}
                            </td>
                            <td class="p-6">
                                <span class="bg-primary-fixed text-primary px-3 py-1 rounded-full text-xs font-semibold">
                                    {{ $item->lampiran->count() }} File
                                </span>
                            </td>
                            <td class="p-6">
                                <span class="capitalize px-3 py-1 rounded-full text-xs font-bold
                                    {{ $item->status === 'published' ? 'bg-secondary/15 text-secondary' : 'bg-surface-variant text-on-surface-variant' }}">
                                    {{ $item->status }}
                                </span>
                            </td>
                            <td class="p-6 text-center">
                                <div class="flex justify-center gap-2">
                                    <a href="{{ route('admin.pengumuman.edit', $item->id) }}" class="p-2 text-secondary hover:bg-secondary/10 rounded-lg transition-colors" title="Sunting Pengumuman">
                                        <span class="material-symbols-outlined text-sm">edit</span>
                                    </a>
                                    <form action="{{ route('admin.pengumuman.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengumuman ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-error hover:bg-error/10 rounded-lg transition-colors" title="Hapus Pengumuman">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-16 text-center text-on-surface-low">
                                <span class="material-symbols-outlined text-5xl block mb-2">campaign</span>
                                Belum ada pengumuman yang tersedia.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($pengumuman->hasPages())
            <div class="p-6 border-t border-outline-variant/30 bg-surface-variant/10">
                {{ $pengumuman->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
