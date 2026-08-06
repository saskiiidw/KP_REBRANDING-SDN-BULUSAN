@extends('layouts.admin')

@section('title', 'Data Guru & Staf')

@section('content')
<div class="space-y-8">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h2 class="font-headline-md text-3xl font-bold text-primary">Guru & Staf</h2>
            <p class="text-on-surface-variant mt-1">Kelola data tenaga pendidik dan kependidikan beserta nomor identitas resmi.</p>
        </div>
        <a href="{{ route('admin.guru.create') }}" class="bg-primary text-on-primary px-6 py-2.5 rounded-full font-label-md font-bold hover:bg-primary/95 transition-all shadow-md inline-flex items-center gap-2">
            <span class="material-symbols-outlined text-sm">add</span> Tambah Guru/Staf
        </a>
    </div>

    <!-- Search -->
    <div class="bg-white p-6 rounded-[20px] shadow-sm border border-outline-variant/30">
        <form action="{{ route('admin.guru.index') }}" method="GET" class="flex gap-4">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari berdasarkan nama, NIP, atau NUPTK..." class="flex-grow px-4 py-2.5 rounded-xl border border-outline/30 outline-none text-sm"/>
            <button type="submit" class="bg-secondary text-white px-8 py-2.5 rounded-xl font-label-md hover:bg-secondary/95 transition-colors text-sm font-semibold">
                Cari
            </button>
            @if(request('search'))
                <a href="{{ route('admin.guru.index') }}" class="bg-surface-variant text-on-surface-variant px-4 py-2.5 rounded-xl hover:bg-surface-dim transition-colors text-sm font-semibold flex items-center justify-center">
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
                        <th class="p-6">Foto</th>
                        <th class="p-6">Nama</th>
                        <th class="p-6">Jabatan</th>
                        <th class="p-6">Kelas Diampu</th>
                        <th class="p-6">Status</th>
                        <th class="p-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant/20 text-sm">
                    @forelse($guru as $item)
                        <tr class="hover:bg-surface-variant/10 transition-colors">
                            <td class="p-6 font-bold text-primary">
                                #{{ $item->urutan }}
                            </td>
                            <td class="p-6">
                                @if($item->foto)
                                    <img src="{{ asset('storage/' . $item->foto) }}" class="h-12 w-12 object-cover rounded-full border"/>
                                @else
                                    <div class="h-12 w-12 bg-primary/10 rounded-full flex items-center justify-center text-primary font-bold">
                                        {{ strtoupper(substr($item->nama, 0, 1)) }}
                                    </div>
                                @endif
                            </td>
                            <td class="p-6 font-semibold text-primary">
                                {{ $item->nama }}
                                <span class="text-xs text-on-surface-low font-normal block mt-1">NIP: {{ $item->nip ?: '-' }} | NUPTK: {{ $item->nuptk ?: '-' }}</span>
                            </td>
                            <td class="p-6 text-on-surface-variant font-medium">
                                {{ $item->jabatan->nama_jabatan }}
                            </td>
                            <td class="p-6 text-on-surface-variant font-medium">
                                {{ $item->kelas_diampu ?: '-' }}
                            </td>
                            <td class="p-6">
                                <span class="capitalize px-3 py-1 rounded-full text-xs font-bold
                                    {{ $item->status === 'aktif' ? 'bg-secondary/15 text-secondary' : 'bg-surface-variant text-on-surface-variant' }}">
                                    {{ $item->status }}
                                </span>
                            </td>
                            <td class="p-6 text-center">
                                <div class="flex justify-center gap-2">
                                    <a href="{{ route('admin.guru.edit', $item->id) }}" class="p-2 text-secondary hover:bg-secondary/10 rounded-lg transition-colors" title="Sunting Guru">
                                        <span class="material-symbols-outlined text-sm">edit</span>
                                    </a>
                                    <form action="{{ route('admin.guru.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data guru ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-error hover:bg-error/10 rounded-lg transition-colors" title="Hapus Guru">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="p-16 text-center text-on-surface-low">
                                <span class="material-symbols-outlined text-5xl block mb-2">badge</span>
                                Belum ada data guru yang terdaftar.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($guru->hasPages())
            <div class="p-6 border-t border-outline-variant/30 bg-surface-variant/10">
                {{ $guru->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
