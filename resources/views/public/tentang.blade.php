@extends('layouts.public')

@section('title', 'Profil Sekolah')

@section('content')
<!-- Header Banner -->
<section class="bg-primary text-white py-16 px-4">
    <div class="max-w-container-max mx-auto px-4 md:px-margin-desktop">
        <h1 class="font-headline-lg text-4xl font-bold">Profil Sekolah</h1>
        <p class="text-on-primary/75 mt-2">Mengenal visi, misi, sejarah, dan struktur organisasi SDN Bulusan Semarang.</p>
    </div>
</section>

<!-- Main Details -->
<section class="pt-20 pb-12 px-4 md:px-margin-desktop max-w-container-max mx-auto">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 lg:gap-16">
        <!-- Visi, Misi & Sejarah -->
        <div class="lg:col-span-2 space-y-12">
            <!-- Visi & Misi -->
            <div id="visi-misi" class="scroll-mt-[96px] bg-white p-8 md:p-10 rounded-[28px] shadow-sm border border-outline-variant/30 space-y-6">
                <h2 class="font-headline-md text-2xl font-bold text-primary border-b border-outline-variant/20 pb-4">Visi & Misi</h2>
                
                <div>
                    <h3 class="font-semibold text-secondary uppercase tracking-wider text-sm mb-2">Visi Sekolah</h3>
                    <p class="font-body-lg text-primary leading-relaxed font-semibold">{{ $profil->visi }}</p>
                </div>
                
                <div>
                    <h3 class="font-semibold text-secondary uppercase tracking-wider text-sm mb-2">Misi Sekolah</h3>
                    <div class="text-on-surface-variant leading-relaxed text-sm whitespace-pre-line space-y-2">
                        {{ $profil->misi }}
                    </div>
                </div>
            </div>

            <!-- Sejarah -->
            @if($profil->sejarah)
                <div id="tentang" class="scroll-mt-[96px] bg-white p-8 md:p-10 rounded-[28px] shadow-sm border border-outline-variant/30 space-y-6">
                    <h2 class="font-headline-md text-2xl font-bold text-primary border-b border-outline-variant/20 pb-4">Tentang Sekolah</h2>
                    <p class="text-on-surface-variant leading-relaxed text-sm whitespace-pre-line">
                        {{ $profil->sejarah }}
                    </p>
                </div>
            @endif


        </div>

        <!-- Right Side: Identity Cards & Headmaster Welcome -->
        <div class="space-y-8">
            <!-- Identity card -->
            <div class="bg-white p-6 rounded-[28px] border border-outline-variant/30 shadow-sm space-y-6">
                <h3 class="font-headline-sm text-lg font-bold text-primary border-b border-outline-variant/20 pb-4">Identitas Sekolah</h3>
                <ul class="space-y-4 text-sm font-semibold text-primary">
                    <li class="flex justify-between border-b pb-2">
                        <span class="text-on-surface-low font-normal">Nama</span>
                        <span>{{ $profil->nama_sekolah }}</span>
                    </li>
                    <li class="flex justify-between border-b pb-2">
                        <span class="text-on-surface-low font-normal">NPSN</span>
                        <span>{{ $profil->npsn }}</span>
                    </li>
                    <li class="flex justify-between border-b pb-2">
                        <span class="text-on-surface-low font-normal">NSS</span>
                        <span>{{ $profil->nss }}</span>
                    </li>
                    <li class="flex justify-between border-b pb-2">
                        <span class="text-on-surface-low font-normal">Akreditasi</span>
                        <span class="bg-secondary text-on-secondary px-2.5 py-0.5 rounded text-xs font-bold">{{ $profil->akreditasi }}</span>
                    </li>
                    <li class="flex justify-between border-b pb-2">
                        <span class="text-on-surface-low font-normal">Email</span>
                        <span class="text-xs font-medium text-secondary truncate max-w-[180px]">{{ $profil->email }}</span>
                    </li>
                    <li class="flex justify-between">
                        <span class="text-on-surface-low font-normal">Telepon</span>
                        <span>{{ $profil->telepon }}</span>
                    </li>
                </ul>
            </div>

            <!-- Headmaster full message -->
            <div id="sambutan" class="scroll-mt-[96px] bg-white p-6 rounded-[28px] border border-outline-variant/30 shadow-sm space-y-4">
                <h3 class="font-headline-sm text-lg font-bold text-primary border-b border-outline-variant/20 pb-4">Sambutan Lengkap</h3>
                <div class="flex items-center gap-3">
                    <div class="w-14 h-14 rounded-full overflow-hidden border">
                        @if($profil->foto_kepsek)
                            <img src="{{ asset('storage/' . $profil->foto_kepsek) }}" class="w-full h-full object-cover" alt="Kepsek" loading="lazy"/>
                        @else
                            <img src="{{ asset('images/default_kepsek.jpg') }}" class="w-full h-full object-cover" alt="Kepsek" loading="lazy"/>
                        @endif
                    </div>
                    <div>
                        <h4 class="font-semibold text-primary text-sm">{{ $profil->nama_kepsek }}</h4>
                        <span class="text-xs text-on-surface-variant font-medium">Kepala Sekolah</span>
                    </div>
                </div>
                <div class="text-xs text-on-surface-variant leading-relaxed whitespace-pre-line border-t pt-4 space-y-4">
                    {{ $profil->sambutan_kepsek }}
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Guru & Staf Section -->
<section id="guru-staf" class="scroll-mt-[96px] pt-12 pb-24 bg-surface-variant/20 border-t border-outline-variant/10">
    <div class="max-w-container-max mx-auto px-4 md:px-margin-desktop">
        <div class="text-center mb-16">
            <span class="font-label-md text-secondary uppercase tracking-wider font-bold block mb-4">Tim Pendidik</span>
            <h2 class="font-headline-lg text-3xl md:text-4xl text-primary font-bold mb-4">Guru & Staf Akademik</h2>
            <p class="font-body-lg text-on-surface-variant max-w-2xl mx-auto text-sm font-semibold">Para pendidik berdedikasi yang siap membimbing putra-putri Anda meraih masa depan cerah.</p>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @forelse($guru as $item)
                <div class="group bg-white rounded-[28px] overflow-hidden shadow-[0_8px_30px_rgb(0,0,0,0.02)] border border-outline-variant/30 hover:shadow-lg hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between h-full">
                    <div>
                        <!-- Avatar Frame -->
                        <div class="aspect-square bg-surface-variant/40 flex items-center justify-center overflow-hidden relative border-b border-outline-variant/10">
                            @if($item->foto)
                                <img src="{{ asset('storage/' . $item->foto) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="{{ $item->nama }}" loading="lazy"/>
                            @else
                                <div class="w-full h-full bg-primary/5 flex items-center justify-center text-primary/30 font-bold text-7xl select-none uppercase">
                                    {{ substr($item->nama, 0, 1) }}
                                </div>
                            @endif
                        </div>

                        <!-- Content -->
                        <div class="p-6 space-y-3">
                            <span class="text-xs font-bold text-secondary uppercase tracking-wider block">
                                {{ $item->jabatan->nama_jabatan }}
                            </span>
                            <h3 class="font-headline-md text-lg font-bold text-primary leading-tight">{{ $item->nama }}</h3>
                            
                            @if($item->kelas_diampu)
                                <span class="text-xs text-on-surface-low font-semibold bg-surface-variant/60 px-3 py-1 rounded-full inline-block">
                                    Wali Kelas: {{ $item->kelas_diampu }}
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Footer Info -->
                    <div class="p-6 pt-0">
                        <div class="pt-4 border-t border-outline-variant/10 text-xs text-on-surface-variant/80 space-y-1.5 font-medium">
                            <div class="flex justify-between">
                                <span class="text-on-surface-low font-normal">NIP:</span>
                                <span class="font-bold text-primary/80">{{ $item->nip ?: '-' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-on-surface-low font-normal">NUPTK:</span>
                                <span class="font-bold text-primary/80">{{ $item->nuptk ?: '-' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-1 sm:col-span-4 bg-white p-16 text-center text-on-surface-low rounded-[24px] border border-outline-variant/30 shadow-sm">
                    <span class="material-symbols-outlined text-5xl block mb-2">badge</span>
                    Belum ada data guru/staf yang dipublikasikan.
                </div>
            @endforelse
        </div>
    </div>
</section>
@endsection
