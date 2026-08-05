@extends('layouts.public')

@section('title', 'Ekstrakurikuler')

@section('content')
<!-- Header Banner -->
<section class="bg-primary text-white py-16 px-4">
    <div class="max-w-container-max mx-auto px-4 md:px-margin-desktop">
        <h1 class="font-headline-lg text-4xl font-bold">Ekstrakurikuler</h1>
        <p class="text-on-primary/75 mt-2">Mengembangkan minat, bakat, kreativitas, dan karakter unggul siswa.</p>
    </div>
</section>

<!-- Extracurricular Grid -->
<section class="py-24 px-4 max-w-container-max mx-auto space-y-16">
    <div class="text-center max-w-2xl mx-auto space-y-4">
        <h2 class="font-headline-lg text-3xl font-bold text-primary">Program Pengembangan Diri</h2>
        <p class="text-on-surface-variant leading-relaxed text-sm font-semibold">Kami membimbing siswa di luar jam akademik wajib untuk mengasah keterampilan, fisik, dan kepekaan sosial melalui klub ekstrakurikuler terpadu.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($ekskul as $e)
            <div class="bg-white p-8 md:p-10 rounded-[28px] shadow-[0_8px_30px_rgb(0,0,0,0.01)] border border-outline-variant/30 flex flex-col justify-between hover:shadow-md hover:-translate-y-0.5 transition-all group">
                <div class="space-y-6">
                    <div class="w-14 h-14 rounded-full bg-secondary/15 text-secondary flex items-center justify-center shrink-0 group-hover:bg-secondary group-hover:text-white transition-all">
                        <span class="material-symbols-outlined text-3xl">{{ $e['ikon'] }}</span>
                    </div>
                    
                    <div class="space-y-3">
                        <h3 class="font-headline-md text-xl font-bold text-primary group-hover:text-secondary transition-colors">{{ $e['nama'] }}</h3>
                        <p class="text-sm text-on-surface-variant leading-relaxed">{{ $e['deskripsi'] }}</p>
                    </div>
                </div>

                <div class="pt-6 mt-6 border-t border-outline-variant/20 flex justify-between items-center text-xs font-semibold text-primary">
                    <span class="text-on-surface-low font-normal">Jadwal Latihan:</span>
                    <span class="bg-surface-variant/70 px-3 py-1 rounded-full text-secondary font-bold">{{ $e['jadwal'] }}</span>
                </div>
            </div>
        @endforeach
    </div>
</section>
@endsection
