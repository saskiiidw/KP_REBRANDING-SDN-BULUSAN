@extends('layouts.admin')

@section('title', 'Kelola Berita')

@section('content')
<div class="space-y-8">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h2 class="font-headline-md text-3xl font-bold text-primary">Kelola Berita</h2>
            <p class="text-on-surface-variant mt-1">Tulis dan sunting artikel berita publikasi sekolah.</p>
        </div>
        <a href="{{ route('admin.berita.create') }}" class="bg-primary text-on-primary px-6 py-2.5 rounded-full font-label-md font-bold hover:bg-primary/95 transition-all shadow-md inline-flex items-center gap-2">
            <span class="material-symbols-outlined text-sm">add</span> Tulis Berita
        </a>
    </div>

    <!-- Filters & Search -->
    <div class="bg-white p-6 rounded-[20px] shadow-sm border border-outline-variant/30">
        <form action="{{ route('admin.berita.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="md:col-span-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari berdasarkan judul atau konten..." class="w-full px-4 py-2.5 rounded-xl border border-outline/30 outline-none text-sm"/>
            </div>
            <div>
                <select name="kategori" class="w-full px-4 py-2.5 rounded-xl border border-outline/30 outline-none text-sm bg-white">
                    <option value="">Semua Kategori</option>
                    @foreach($kategori as $cat)
                        <option value="{{ $cat->id }}" {{ request('kategori') == $cat->id ? 'selected' : '' }}>{{ $cat->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex gap-2">
                <button type="submit" class="bg-secondary text-white px-6 py-2.5 rounded-xl font-label-md hover:bg-secondary/95 transition-colors text-sm font-semibold flex-grow">
                    Filter
                </button>
                @if(request()->anyFilled(['search', 'kategori']))
                    <a href="{{ route('admin.berita.index') }}" class="bg-surface-variant text-on-surface-variant px-4 py-2.5 rounded-xl hover:bg-surface-dim transition-colors text-sm font-semibold flex items-center justify-center">
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Table List -->
    <div class="bg-white rounded-[24px] shadow-sm border border-outline-variant/30 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-surface-variant/30 text-primary border-b border-outline-variant/30 text-xs font-bold uppercase">
                        <th class="p-6">Thumbnail</th>
                        <th class="p-6">Judul</th>
                        <th class="p-6">Kategori</th>
                        <th class="p-6">Penulis</th>
                        <th class="p-6">Status</th>
                        <th class="p-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant/20 text-sm">
                    @forelse($berita as $item)
                        <tr class="hover:bg-surface-variant/10 transition-colors">
                            <td class="p-6">
                                @if($item->thumbnail)
                                    <img src="{{ asset('storage/' . $item->thumbnail) }}" class="h-12 w-20 object-cover rounded-lg border"/>
                                @else
                                    <div class="h-12 w-20 bg-surface-variant rounded-lg border flex items-center justify-center text-on-surface-variant text-xs font-semibold">No Image</div>
                                @endif
                            </td>
                            <td class="p-6 font-semibold text-primary max-w-xs">
                                <span class="line-clamp-2">{{ $item->judul }}</span>
                                <span class="text-xs text-on-surface-low font-normal block mt-1">Dibuat: {{ $item->created_at->format('d M Y') }}</span>
                            </td>
                            <td class="p-6">
                                <span class="bg-primary-fixed text-primary px-3 py-1 rounded-full text-xs font-semibold">
                                    {{ $item->kategori->nama }}
                                </span>
                            </td>
                            <td class="p-6 text-on-surface-variant font-medium">
                                {{ $item->penulis->name }}
                            </td>
                            <td class="p-6">
                                <span class="capitalize px-3 py-1 rounded-full text-xs font-bold
                                    {{ $item->status === 'published' ? 'bg-secondary/15 text-secondary' : ($item->status === 'draft' ? 'bg-surface-variant text-on-surface-variant' : 'bg-tertiary-container/30 text-tertiary') }}">
                                    {{ $item->status }}
                                </span>
                            </td>
                            <td class="p-6 text-right">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.berita.edit', $item->id) }}" class="p-2 text-secondary hover:bg-secondary/10 rounded-lg transition-colors" title="Sunting Berita">
                                        <span class="material-symbols-outlined text-sm">edit</span>
                                    </a>
                                    <form action="{{ route('admin.berita.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-error hover:bg-error/10 rounded-lg transition-colors" title="Hapus Berita">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-16 text-center text-on-surface-low">
                                <span class="material-symbols-outlined text-5xl block mb-2">article</span>
                                Belum ada data berita yang tersedia.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($berita->hasPages())
            <div class="p-6 border-t border-outline-variant/30 bg-surface-variant/10">
                {{ $berita->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
