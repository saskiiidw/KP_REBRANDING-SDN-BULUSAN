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
            <div class="bg-white rounded-[28px] overflow-hidden shadow-[0_8px_30px_rgb(0,0,0,0.01)] border border-outline-variant/30 flex flex-col hover:shadow-md hover:-translate-y-0.5 transition-all group">
                <!-- Image Header -->
                @php
                    $imageName = 'pramuka_illustration.jpg';
                    if(str_contains(strtolower($e['nama']), 'batik')) $imageName = 'batik_illustration.jpg';
                    if(str_contains(strtolower($e['nama']), 'tari')) $imageName = 'tari_illustration.jpg';
                    if(str_contains(strtolower($e['nama']), 'komputer')) $imageName = 'komputer_illustration.jpg';
                    if(str_contains(strtolower($e['nama']), 'rebana')) $imageName = 'rebana_illustration.jpg';
                    if(str_contains(strtolower($e['nama']), 'drumband')) $imageName = 'drumband_illustration.jpg';
                    
                    $bgImage = asset('images/' . $imageName);
                @endphp
                <div class="h-48 relative overflow-hidden bg-surface-variant shrink-0">
                    <img src="{{ $bgImage }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" alt="{{ $e['nama'] }}" loading="lazy">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                    <div class="absolute top-4 right-4 w-12 h-12 rounded-xl bg-white/95 backdrop-blur text-primary flex items-center justify-center shadow-lg">
                        <span class="material-symbols-outlined text-2xl">{{ $e['ikon'] }}</span>
                    </div>
                    <h3 class="absolute bottom-4 left-6 font-headline-md text-xl font-bold text-white">{{ $e['nama'] }}</h3>
                </div>

                <div class="p-6 md:p-8 flex flex-col justify-between flex-grow space-y-6">
                    <p class="text-sm text-on-surface-variant leading-relaxed">{{ $e['deskripsi'] }}</p>

                    <div class="pt-6 border-t border-outline-variant/20 flex justify-between items-center text-xs font-semibold text-primary mt-auto">
                        <span class="text-on-surface-low font-normal">Jadwal Latihan:</span>
                        <span class="bg-surface-variant/70 px-3 py-1 rounded-full text-secondary font-bold">{{ $e['jadwal'] }}</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>
@endsection
