@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-8">
    <div>
        <h2 class="font-headline-md text-3xl font-bold text-primary">Selamat Datang Admin</h2>
        <p class="text-on-surface-variant mt-1">Kelola informasi publik dan data operasional SDN Bulusan.</p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Berita Card -->
        <div class="bg-white p-6 rounded-[20px] shadow-sm border border-outline-variant/30 flex justify-between items-center hover:shadow-md transition-shadow group">
            <div>
                <span class="text-sm font-semibold text-on-surface-low">Total Berita</span>
                <h3 class="text-3xl font-bold text-primary mt-2">{{ $counts['berita'] }}</h3>
            </div>
            <div class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition-all">
                <span class="material-symbols-outlined">article</span>
            </div>
        </div>

        <!-- Pengumuman Card -->
        <div class="bg-white p-6 rounded-[20px] shadow-sm border border-outline-variant/30 flex justify-between items-center hover:shadow-md transition-shadow group">
            <div>
                <span class="text-sm font-semibold text-on-surface-low">Pengumuman</span>
                <h3 class="text-3xl font-bold text-primary mt-2">{{ $counts['pengumuman'] }}</h3>
            </div>
            <div class="w-12 h-12 bg-secondary/10 rounded-full flex items-center justify-center text-secondary group-hover:bg-secondary group-hover:text-white transition-all">
                <span class="material-symbols-outlined">campaign</span>
            </div>
        </div>

        <!-- Agenda Card -->
        <div class="bg-white p-6 rounded-[20px] shadow-sm border border-outline-variant/30 flex justify-between items-center hover:shadow-md transition-shadow group">
            <div>
                <span class="text-sm font-semibold text-on-surface-low">Agenda Kegiatan</span>
                <h3 class="text-3xl font-bold text-primary mt-2">{{ $counts['agenda'] }}</h3>
            </div>
            <div class="w-12 h-12 bg-tertiary-container/10 rounded-full flex items-center justify-center text-tertiary group-hover:bg-tertiary group-hover:text-white transition-all">
                <span class="material-symbols-outlined">calendar_today</span>
            </div>
        </div>

        <!-- Guru Card -->
        <div class="bg-white p-6 rounded-[20px] shadow-sm border border-outline-variant/30 flex justify-between items-center hover:shadow-md transition-shadow group">
            <div>
                <span class="text-sm font-semibold text-on-surface-low">Guru & Staf</span>
                <h3 class="text-3xl font-bold text-primary mt-2">{{ $counts['guru'] }}</h3>
            </div>
            <div class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition-all">
                <span class="material-symbols-outlined">badge</span>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Message Panel -->
        <div class="lg:col-span-2 bg-white p-6 md:p-8 rounded-[24px] shadow-sm border border-outline-variant/30 space-y-6">
            <div class="flex justify-between items-center border-b border-outline-variant/30 pb-4">
                <h3 class="font-headline-md text-xl font-bold text-primary">Pesan Masuk Terbaru</h3>
                <a href="{{ route('admin.kontak-pengaduan.index') }}" class="text-sm text-secondary hover:underline font-semibold flex items-center gap-1">
                    Lihat Semua <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </a>
            </div>

            <div class="divide-y divide-outline-variant/20">
                @forelse($recent_messages as $msg)
                    <div class="py-4 first:pt-0 last:pb-0 flex justify-between items-start gap-4">
                        <div>
                            <div class="flex items-center gap-2">
                                <h4 class="font-semibold text-primary text-sm">{{ $msg->nama }}</h4>
                                <span class="text-xs uppercase px-2 py-0.5 rounded font-bold {{ $msg->jenis === 'pengaduan' ? 'bg-error-container text-on-error-container' : 'bg-secondary-container text-on-secondary-container' }}">
                                    {{ $msg->jenis }}
                                </span>
                            </div>
                            <p class="text-xs text-on-surface-variant mt-1">{{ $msg->email }} · {{ $msg->created_at->diffForHumans() }}</p>
                            <p class="text-sm text-on-surface mt-2 font-medium line-clamp-1">{{ $msg->subjek }}</p>
                        </div>
                        <div>
                            <span class="text-xs px-2.5 py-1 rounded-full font-bold capitalize
                                {{ $msg->status_penanganan === 'selesai' ? 'bg-secondary/15 text-secondary' : ($msg->status_penanganan === 'diproses' ? 'bg-primary-fixed text-primary' : 'bg-surface-variant text-on-surface-variant') }}">
                                {{ $msg->status_penanganan }}
                            </span>
                        </div>
                    </div>
                @empty
                    <div class="py-12 flex items-center justify-center gap-2 text-on-surface-low text-sm">
                        <span class="material-symbols-outlined text-xl">inbox</span>
                        <span>Tidak ada pesan masuk terbaru.</span>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Quick Access panel -->
        <div class="bg-white p-6 md:p-8 rounded-[24px] shadow-sm border border-outline-variant/30 space-y-6">
            <h3 class="font-headline-md text-xl font-bold text-primary border-b border-outline-variant/30 pb-4">Akses Cepat</h3>
            
            <div class="space-y-4">
                <a href="{{ route('admin.berita.create') }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-surface-variant transition-colors text-sm font-semibold text-primary">
                    <div class="bg-primary/10 w-10 h-10 rounded-full flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-primary">edit_document</span>
                    </div>
                    Tulis Berita Baru
                </a>

                <a href="{{ route('admin.pengumuman.create') }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-surface-variant transition-colors text-sm font-semibold text-primary">
                    <div class="bg-secondary/10 w-10 h-10 rounded-full flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-secondary">campaign</span>
                    </div>
                    Buat Pengumuman Baru
                </a>

                <a href="{{ route('admin.guru.create') }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-surface-variant transition-colors text-sm font-semibold text-primary">
                    <div class="bg-primary/10 w-10 h-10 rounded-full flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-primary">person_add</span>
                    </div>
                    Tambah Data Guru
                </a>

                <a href="{{ route('admin.galeri-foto.create') }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-surface-variant transition-colors text-sm font-semibold text-primary">
                    <div class="bg-secondary/10 w-10 h-10 rounded-full flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-secondary">create_new_folder</span>
                    </div>
                    Buat Album Galeri
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
