@extends('layouts.public')

@section('title', 'Penerimaan Peserta Didik Baru')

@section('content')
<!-- Header Banner -->
<section class="bg-primary text-white py-16 px-4">
    <div class="max-w-container-max mx-auto px-4 md:px-margin-desktop">
        <h1 class="font-headline-lg text-4xl font-bold">Penerimaan Peserta Didik Baru (PPDB)</h1>
        <p class="text-on-primary/75 mt-2">Panduan, persyaratan, dan alur pendaftaran siswa baru SDN Bulusan Kota Semarang.</p>
    </div>
</section>

<!-- Content Details -->
<section class="py-24 px-4 max-w-container-max mx-auto space-y-16">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 lg:gap-16">
        <!-- Requirements & Flow -->
        <div class="lg:col-span-2 space-y-12">
            <!-- Requirements -->
            <div class="bg-white p-8 md:p-10 rounded-[28px] shadow-sm border border-outline-variant/30 space-y-6">
                <h2 class="font-headline-md text-2xl font-bold text-primary border-b border-outline-variant/20 pb-4">Persyaratan Calon Peserta Didik</h2>
                
                <div class="space-y-4">
                    <div class="flex gap-4 items-start">
                        <span class="material-symbols-outlined text-secondary font-bold text-sm bg-secondary/10 p-2 rounded-full shrink-0">check</span>
                        <div>
                            <h4 class="font-semibold text-primary text-sm">Persyaratan Usia</h4>
                            <p class="text-xs text-on-surface-low mt-1 font-medium leading-relaxed">Calon peserta didik baru kelas 1 SD berusia minimal 6 (enam) tahun pada tanggal 1 Juli tahun ajaran berjalan. Prioritas utama diberikan bagi anak berusia 7 (tujuh) tahun ke atas.</p>
                        </div>
                    </div>

                    <div class="flex gap-4 items-start">
                        <span class="material-symbols-outlined text-secondary font-bold text-sm bg-secondary/10 p-2 rounded-full shrink-0">check</span>
                        <div>
                            <h4 class="font-semibold text-primary text-sm">Fotokopi Akta Kelahiran</h4>
                            <p class="text-xs text-on-surface-low mt-1 font-medium leading-relaxed">Melampirkan fotokopi Akta Kelahiran resmi dari Disdukcapil (serta menunjukkan dokumen aslinya saat verifikasi berkas).</p>
                        </div>
                    </div>

                    <div class="flex gap-4 items-start">
                        <span class="material-symbols-outlined text-secondary font-bold text-sm bg-secondary/10 p-2 rounded-full shrink-0">check</span>
                        <div>
                            <h4 class="font-semibold text-primary text-sm">Fotokopi Kartu Keluarga (KK)</h4>
                            <p class="text-xs text-on-surface-low mt-1 font-medium leading-relaxed">Melampirkan fotokopi Kartu Keluarga (yang diterbitkan minimal 1 tahun sebelum tanggal pendaftaran PPDB) untuk validasi zonasi domisili.</p>
                        </div>
                    </div>

                    <div class="flex gap-4 items-start">
                        <span class="material-symbols-outlined text-secondary font-bold text-sm bg-secondary/10 p-2 rounded-full shrink-0">check</span>
                        <div>
                            <h4 class="font-semibold text-primary text-sm">Mengisi Formulir Pendaftaran</h4>
                            <p class="text-xs text-on-surface-low mt-1 font-medium leading-relaxed">Mengisi data isian lengkap pada lembar formulir pendaftaran fisik di sekolah atau input langsung di portal PPDB online Kota Semarang.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Flow -->
            <div class="bg-white p-8 md:p-10 rounded-[28px] shadow-sm border border-outline-variant/30 space-y-6">
                <h2 class="font-headline-md text-2xl font-bold text-primary border-b border-outline-variant/20 pb-4">Alur Pendaftaran Online</h2>
                
                <div class="relative pl-8 border-l-2 border-outline-variant/40 space-y-8">
                    <!-- Step 1 -->
                    <div class="relative">
                        <div class="absolute -left-12 top-0 bg-primary text-white w-8 h-8 rounded-full flex items-center justify-center font-bold text-sm">1</div>
                        <h4 class="font-semibold text-primary text-sm">Registrasi Akun & Pengajuan Pendaftaran</h4>
                        <p class="text-xs text-on-surface-low mt-1 font-medium leading-relaxed">Calon peserta didik melakukan pendaftaran online di portal PPDB Dinas Pendidikan Kota Semarang dan mengunggah berkas persyaratan.</p>
                    </div>

                    <!-- Step 2 -->
                    <div class="relative">
                        <div class="absolute -left-12 top-0 bg-primary text-white w-8 h-8 rounded-full flex items-center justify-center font-bold text-sm">2</div>
                        <h4 class="font-semibold text-primary text-sm">Verifikasi Berkas</h4>
                        <p class="text-xs text-on-surface-low mt-1 font-medium leading-relaxed">Panitia PPDB sekolah melakukan verifikasi berkas administrasi dan data yang diunggah secara online dengan berkas fisik asli.</p>
                    </div>

                    <!-- Step 3 -->
                    <div class="relative">
                        <div class="absolute -left-12 top-0 bg-primary text-white w-8 h-8 rounded-full flex items-center justify-center font-bold text-sm">3</div>
                        <h4 class="font-semibold text-primary text-sm">Pengumuman Hasil Seleksi</h4>
                        <p class="text-xs text-on-surface-low mt-1 font-medium leading-relaxed">Hasil seleksi dipublikasikan secara resmi melalui website PPDB online Kota Semarang dan papan pengumuman sekolah.</p>
                    </div>

                    <!-- Step 4 -->
                    <div class="relative">
                        <div class="absolute -left-12 top-0 bg-primary text-white w-8 h-8 rounded-full flex items-center justify-center font-bold text-sm">4</div>
                        <h4 class="font-semibold text-primary text-sm">Daftar Ulang</h4>
                        <p class="text-xs text-on-surface-low mt-1 font-medium leading-relaxed">Peserta didik yang dinyatakan diterima wajib melakukan proses lapor diri / daftar ulang di sekolah sesuai jadwal yang ditentukan.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar Call-to-actions -->
        <div class="space-y-8">
            <!-- CTA Box -->
            <div class="bg-white p-6 rounded-[28px] border border-outline-variant/30 shadow-sm space-y-6">
                <h3 class="font-headline-sm text-lg font-bold text-primary border-b border-outline-variant/20 pb-4">Tautan Portal PPDB</h3>
                <p class="text-sm text-on-surface-variant font-medium leading-relaxed">PPDB SD Negeri di Kota Semarang diselenggarakan terpadu secara online melalui portal resmi Dinas Pendidikan Kota Semarang.</p>
                
                @if($tautanPPDB)
                    <a href="{{ str_replace('ppd.semarangkota.go.id', 'spmb.semarangkota.go.id', $tautanPPDB->url) }}" target="_blank" class="w-full bg-primary text-on-primary py-3 rounded-full font-label-md font-bold hover:bg-primary/95 transition-all shadow-md text-center block">
                        Daftar PPDB Online
                    </a>
                @else
                    <a href="https://spmb.semarangkota.go.id/" target="_blank" class="w-full bg-primary text-on-primary py-3 rounded-full font-label-md font-bold hover:bg-primary/95 transition-all shadow-md text-center block">
                        Daftar PPDB Online
                    </a>
                @endif
            </div>

            <!-- Contact Box -->
            <div class="bg-white p-6 rounded-[28px] border border-outline-variant/30 shadow-sm space-y-4">
                <h3 class="font-headline-sm text-lg font-bold text-primary border-b border-outline-variant/20 pb-4">Pusat Bantuan PPDB</h3>
                <p class="text-xs text-on-surface-variant font-medium leading-relaxed">Butuh bantuan atau informasi mengenai kendala pendaftaran? Silakan hubungi meja informasi panitia sekolah:</p>
                
                <ul class="space-y-3 text-xs font-semibold text-primary">
                    <li class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-secondary font-bold text-sm shrink-0">call</span>
                        <span>{{ $profil->telepon }}</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-secondary font-bold text-sm shrink-0">mail</span>
                        <span>{{ $profil->email }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
@endsection
