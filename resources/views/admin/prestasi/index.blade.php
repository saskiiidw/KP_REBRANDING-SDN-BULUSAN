@extends('layouts.admin')

@section('title', 'Kelola Data Prestasi')

@section('content')
<div class="space-y-8">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h2 class="font-headline-md text-3xl font-bold text-primary">Kelola Prestasi</h2>
            <p class="text-on-surface-variant mt-1">Daftar pencapaian penghargaan prestasi siswa SDN Bulusan.</p>
        </div>
        <a href="{{ route('admin.prestasi.create') }}" class="bg-primary text-on-primary px-6 py-2.5 rounded-full font-label-md font-bold hover:bg-primary/95 transition-all shadow-md inline-flex items-center gap-2">
            <span class="material-symbols-outlined text-sm">add</span> Tambah Prestasi
        </a>
    </div>

    <!-- Search -->
    <div class="bg-white p-6 rounded-[20px] shadow-sm border border-outline-variant/30">
        <form action="{{ route('admin.prestasi.index') }}" method="GET" class="flex gap-4">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari berdasarkan nama siswa, lomba, peringkat, atau tahun..." class="flex-grow px-4 py-2.5 rounded-xl border border-outline/30 outline-none text-sm"/>
            <button type="submit" class="bg-secondary text-white px-8 py-2.5 rounded-xl font-label-md hover:bg-secondary/95 transition-colors text-sm font-semibold">
                Cari
            </button>
            @if(request('search'))
                <a href="{{ route('admin.prestasi.index') }}" class="bg-surface-variant text-on-surface-variant px-4 py-2.5 rounded-xl hover:bg-surface-dim transition-colors text-sm font-semibold flex items-center justify-center">
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
                        <th class="p-6">Foto</th>
                        <th class="p-6">Nama Siswa</th>
                        <th class="p-6">Kegiatan Lomba</th>
                        <th class="p-6">Tingkat</th>
                        <th class="p-6">Peringkat</th>
                        <th class="p-6">Tahun</th>
                        <th class="p-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant/20 text-sm">
                    @forelse($prestasi as $item)
                        <tr class="hover:bg-surface-variant/10 transition-colors">
                            <td class="p-6">
                                @if($item->foto)
                                    <img src="{{ asset('storage/' . $item->foto) }}" class="h-12 w-16 object-cover rounded-lg border"/>
                                @else
                                    <div class="h-12 w-16 bg-surface-variant rounded-lg border flex items-center justify-center text-on-surface-variant text-xs font-semibold">No Photo</div>
                                @endif
                            </td>
                            <td class="p-6 font-semibold text-primary">
                                {{ $item->nama_siswa }}
                            </td>
                            <td class="p-6 text-on-surface-variant font-medium">
                                {{ $item->lomba }}
                            </td>
                            <td class="p-6">
                                <span class="bg-secondary-container text-on-secondary-container px-3 py-1 rounded-full text-xs font-semibold">
                                    {{ $item->tingkat->nama_tingkat }}
                                </span>
                            </td>
                            <td class="p-6 text-on-surface-variant font-medium">
                                {{ $item->peringkat }}
                            </td>
                            <td class="p-6 text-on-surface-variant font-medium">
                                {{ $item->tahun }}
                            </td>
                            <td class="p-6 text-center">
                                <div class="flex justify-center gap-2">
                                    <a href="{{ route('admin.prestasi.edit', $item->id) }}" class="p-2 text-secondary hover:bg-secondary/10 rounded-lg transition-colors" title="Sunting Prestasi">
                                        <span class="material-symbols-outlined text-sm">edit</span>
                                    </a>
                                    <form action="{{ route('admin.prestasi.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data prestasi ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-error hover:bg-error/10 rounded-lg transition-colors" title="Hapus Prestasi">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="p-16 text-center text-on-surface-low">
                                <span class="material-symbols-outlined text-5xl block mb-2">emoji_events</span>
                                Belum ada data prestasi yang terdaftar.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($prestasi->hasPages())
            <div class="p-6 border-t border-outline-variant/30 bg-surface-variant/10">
                {{ $prestasi->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
