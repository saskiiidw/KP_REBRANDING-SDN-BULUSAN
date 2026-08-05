@extends('layouts.admin')

@section('title', 'Kelola Agenda')

@section('content')
<div class="space-y-8">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h2 class="font-headline-md text-3xl font-bold text-primary">Kelola Agenda</h2>
            <p class="text-on-surface-variant mt-1">Buat jadwal agenda kegiatan akademik maupun non-akademik sekolah.</p>
        </div>
        <a href="{{ route('admin.agenda.create') }}" class="bg-primary text-on-primary px-6 py-2.5 rounded-full font-label-md font-bold hover:bg-primary/95 transition-all shadow-md inline-flex items-center gap-2">
            <span class="material-symbols-outlined text-sm">add</span> Tambah Kegiatan
        </a>
    </div>

    <!-- Search -->
    <div class="bg-white p-6 rounded-[20px] shadow-sm border border-outline-variant/30">
        <form action="{{ route('admin.agenda.index') }}" method="GET" class="flex gap-4">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kegiatan..." class="flex-grow px-4 py-2.5 rounded-xl border border-outline/30 outline-none text-sm"/>
            <button type="submit" class="bg-secondary text-white px-8 py-2.5 rounded-xl font-label-md hover:bg-secondary/95 transition-colors text-sm font-semibold">
                Cari
            </button>
            @if(request('search'))
                <a href="{{ route('admin.agenda.index') }}" class="bg-surface-variant text-on-surface-variant px-4 py-2.5 rounded-xl hover:bg-surface-dim transition-colors text-sm font-semibold flex items-center justify-center">
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
                        <th class="p-6">Nama Kegiatan</th>
                        <th class="p-6">Deskripsi</th>
                        <th class="p-6">Tanggal Mulai</th>
                        <th class="p-6">Tanggal Selesai</th>
                        <th class="p-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant/20 text-sm">
                    @forelse($agenda as $item)
                        <tr class="hover:bg-surface-variant/10 transition-colors">
                            <td class="p-6 font-semibold text-primary max-w-xs">
                                {{ $item->nama_kegiatan }}
                            </td>
                            <td class="p-6 text-on-surface-variant max-w-sm">
                                <span class="line-clamp-2">{{ $item->deskripsi }}</span>
                            </td>
                            <td class="p-6 text-on-surface-variant font-medium">
                                {{ $item->tanggal_mulai->format('d M Y') }}
                            </td>
                            <td class="p-6 text-on-surface-variant font-medium">
                                {{ $item->tanggal_selesai->format('d M Y') }}
                            </td>
                            <td class="p-6 text-right">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.agenda.edit', $item->id) }}" class="p-2 text-secondary hover:bg-secondary/10 rounded-lg transition-colors" title="Sunting Agenda">
                                        <span class="material-symbols-outlined text-sm">edit</span>
                                    </a>
                                    <form action="{{ route('admin.agenda.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus agenda ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-error hover:bg-error/10 rounded-lg transition-colors" title="Hapus Agenda">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-16 text-center text-on-surface-low">
                                <span class="material-symbols-outlined text-5xl block mb-2">calendar_today</span>
                                Belum ada kegiatan agenda yang terdaftar.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($agenda->hasPages())
            <div class="p-6 border-t border-outline-variant/30 bg-surface-variant/10">
                {{ $agenda->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
