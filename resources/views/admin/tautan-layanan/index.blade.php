@extends('layouts.admin')

@section('title', 'Kelola Tautan Layanan')

@section('content')
<div class="space-y-8">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h2 class="font-headline-md text-3xl font-bold text-primary">Tautan Layanan</h2>
            <p class="text-on-surface-variant mt-1">Kelola tautan layanan eksternal pemerintah (PPD, Sang Juara, dll.) untuk tombol aksi.</p>
        </div>
        <a href="{{ route('admin.tautan-layanan.create') }}" class="bg-primary text-on-primary px-6 py-2.5 rounded-full font-label-md font-bold hover:bg-primary/95 transition-all shadow-md inline-flex items-center gap-2">
            <span class="material-symbols-outlined text-sm">add</span> Tambah Tautan
        </a>
    </div>

    <!-- Search -->
    <div class="bg-white p-6 rounded-[20px] shadow-sm border border-outline-variant/30">
        <form action="{{ route('admin.tautan-layanan.index') }}" method="GET" class="flex gap-4">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari berdasarkan nama layanan..." class="flex-grow px-4 py-2.5 rounded-xl border border-outline/30 outline-none text-sm"/>
            <button type="submit" class="bg-secondary text-white px-8 py-2.5 rounded-xl font-label-md hover:bg-secondary/95 transition-colors text-sm font-semibold">
                Cari
            </button>
            @if(request('search'))
                <a href="{{ route('admin.tautan-layanan.index') }}" class="bg-surface-variant text-on-surface-variant px-4 py-2.5 rounded-xl hover:bg-surface-dim transition-colors text-sm font-semibold flex items-center justify-center">
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
                        <th class="p-6">Urutan</th>
                        <th class="p-6">Ikon</th>
                        <th class="p-6">Nama Layanan</th>
                        <th class="p-6">URL Tujuan</th>
                        <th class="p-6">Jenis Link</th>
                        <th class="p-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant/20 text-sm">
                    @forelse($tautan as $item)
                        <tr class="hover:bg-surface-variant/10 transition-colors">
                            <td class="p-6 font-bold text-primary">
                                #{{ $item->urutan }}
                            </td>
                            <td class="p-6">
                                <span class="material-symbols-outlined text-2xl text-primary bg-primary/10 w-10 h-10 rounded-full flex items-center justify-center">
                                    {{ $item->ikon }}
                                </span>
                            </td>
                            <td class="p-6 font-semibold text-primary">
                                {{ $item->nama_layanan }}
                            </td>
                            <td class="p-6 text-on-surface-variant font-medium max-w-xs truncate">
                                <a href="{{ $item->url }}" target="_blank" class="hover:underline text-secondary">{{ $item->url }}</a>
                            </td>
                            <td class="p-6">
                                <span class="px-3 py-1 rounded-full text-xs font-bold
                                    {{ $item->is_eksternal ? 'bg-tertiary-container/30 text-tertiary' : 'bg-primary-fixed text-primary' }}">
                                    {{ $item->is_eksternal ? 'Eksternal' : 'Internal' }}
                                </span>
                            </td>
                            <td class="p-6 text-right">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.tautan-layanan.edit', $item->id) }}" class="p-2 text-secondary hover:bg-secondary/10 rounded-lg transition-colors" title="Edit Tautan">
                                        <span class="material-symbols-outlined text-sm">edit</span>
                                    </a>
                                    <form action="{{ route('admin.tautan-layanan.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus tautan layanan ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-error hover:bg-error/10 rounded-lg transition-colors" title="Hapus Tautan">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-16 text-center text-on-surface-low">
                                <span class="material-symbols-outlined text-5xl block mb-2">link</span>
                                Belum ada tautan layanan yang terdaftar.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($tautan->hasPages())
            <div class="p-6 border-t border-outline-variant/30 bg-surface-variant/10">
                {{ $tautan->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
