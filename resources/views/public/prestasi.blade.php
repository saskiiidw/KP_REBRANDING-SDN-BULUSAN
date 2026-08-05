@extends('layouts.public')

@section('title', 'Prestasi Siswa')

@section('content')
<!-- Header Banner -->
<section class="bg-primary text-white py-16 px-4">
    <div class="max-w-container-max mx-auto px-4 md:px-margin-desktop">
        <h1 class="font-headline-lg text-4xl font-bold">Prestasi Siswa</h1>
        <p class="text-on-primary/75 mt-2">Kebanggaan SDN Bulusan di kancah akademik maupun non-akademik.</p>
    </div>
</section>

<!-- Main Area -->
<section class="py-24 px-4 max-w-container-max mx-auto space-y-12">
    <!-- Search & Filter Form -->
    <div class="bg-white p-6 rounded-[28px] shadow-[0_8px_30px_rgb(0,0,0,0.01)] border border-outline-variant/30">
        <form action="{{ route('prestasi') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="md:col-span-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama siswa, lomba, tahun..." class="w-full px-4 py-2.5 rounded-xl border border-outline/30 outline-none text-sm"/>
            </div>
            
            <div>
                <select name="tingkat" class="w-full px-4 py-2.5 rounded-xl border border-outline/30 outline-none text-sm bg-white">
                    <option value="">Semua Tingkat</option>
                    @foreach($tingkat as $tk)
                        <option value="{{ $tk->id }}" {{ request('tingkat') == $tk->id ? 'selected' : '' }}>{{ $tk->nama_tingkat }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex gap-2">
                <button type="submit" class="bg-secondary text-white px-6 py-2.5 rounded-xl font-label-md hover:bg-secondary/95 transition-colors text-sm font-semibold flex-grow">
                    Saring
                </button>
                @if(request()->anyFilled(['search', 'tingkat']))
                    <a href="{{ route('prestasi') }}" class="bg-surface-variant text-on-surface-variant px-4 py-2.5 rounded-xl hover:bg-surface-dim transition-colors text-sm font-semibold flex items-center justify-center">
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Achievements Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($prestasi as $item)
            <div class="bg-white rounded-[24px] overflow-hidden shadow-[0_8px_30px_rgb(0,0,0,0.01)] border border-outline-variant/30 flex flex-col justify-between hover:shadow-md transition-shadow group">
                <div>
                    <!-- Photo -->
                    <div class="aspect-video relative overflow-hidden bg-surface-variant border-b">
                        @if($item->foto)
                            <img src="{{ asset('storage/' . $item->foto) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="{{ $item->lomba }}" loading="lazy"/>
                        @else
                            <div class="w-full h-full flex flex-col items-center justify-center text-primary/10 select-none">
                                <span class="material-symbols-outlined text-6xl">emoji_events</span>
                            </div>
                        @endif
                        
                        <!-- Rank Badge -->
                        <span class="absolute top-4 left-4 bg-secondary text-white px-3 py-1.5 rounded-full text-xs font-bold shadow-lg">
                            {{ $item->peringkat }}
                        </span>
                    </div>

                    <!-- Details -->
                    <div class="p-6 space-y-4">
                        <div>
                            <span class="bg-primary-fixed text-primary px-3 py-1 rounded-full text-xs font-bold">
                                Tingkat {{ $item->tingkat->nama_tingkat }}
                            </span>
                            <span class="text-xs text-on-surface-low font-bold ml-2">{{ $item->tahun }}</span>
                        </div>
                        
                        <div class="space-y-2">
                            <h3 class="font-headline-sm text-lg font-bold text-primary leading-tight">{{ $item->lomba }}</h3>
                            <h4 class="text-sm font-semibold text-secondary">Oleh: {{ $item->nama_siswa }}</h4>
                            @if($item->deskripsi)
                                <p class="text-xs text-on-surface-variant leading-relaxed line-clamp-3">{{ $item->deskripsi }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-1 lg:col-span-3 bg-white p-16 text-center text-on-surface-low rounded-[24px] border border-outline-variant/30 shadow-sm">
                <span class="material-symbols-outlined text-5xl block mb-2">emoji_events</span>
                Belum ada prestasi terdaftar yang memenuhi kriteria pencarian Anda.
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($prestasi->hasPages())
        <div class="pt-8">
            {{ $prestasi->links() }}
        </div>
    @endif
</section>
@endsection
