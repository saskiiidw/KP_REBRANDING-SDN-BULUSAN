@extends('layouts.public')

@section('title', 'Hubungi Kami')

@section('content')
<!-- Header Banner -->
<section class="bg-primary text-white py-16 px-4">
    <div class="max-w-container-max mx-auto px-4 md:px-margin-desktop">
        <h1 class="font-headline-lg text-4xl font-bold">Hubungi Kami</h1>
        <p class="text-on-primary/75 mt-2">Kirimkan pertanyaan, feedback, atau aduan resmi untuk SDN Bulusan.</p>
    </div>
</section>

<!-- Main Details -->
<section class="py-24 px-4 max-w-container-max mx-auto">
    <!-- Success Alert -->
    @if(session('success'))
        <div class="mb-12 p-6 bg-secondary-container text-on-secondary-container border-l-4 border-secondary rounded-2xl shadow flex items-center gap-3">
            <span class="material-symbols-outlined text-2xl">check_circle</span>
            <span class="font-semibold">{{ session('success') }}</span>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16">
        <!-- Contact Information & Map -->
        <div class="lg:col-span-5 space-y-8">
            <div class="bg-white p-8 rounded-[28px] border border-outline-variant/30 shadow-sm space-y-6">
                <h3 class="font-headline-sm text-xl font-bold text-primary border-b border-outline-variant/20 pb-4">Kontak Administrasi</h3>
                
                <ul class="space-y-4 text-sm font-semibold text-primary">
                    <li class="flex items-start gap-4">
                        <span class="material-symbols-outlined text-secondary font-bold text-lg bg-secondary/10 p-2 rounded-full shrink-0">location_on</span>
                        <div>
                            <span class="text-xs text-on-surface-low font-normal block mb-1">Alamat Lengkap</span>
                            <span>{{ $profil->alamat }}</span>
                        </div>
                    </li>
                    <li class="flex items-start gap-4">
                        <span class="material-symbols-outlined text-secondary font-bold text-lg bg-secondary/10 p-2 rounded-full shrink-0">call</span>
                        <div>
                            <span class="text-xs text-on-surface-low font-normal block mb-1">Nomor Telepon</span>
                            <span>{{ $profil->telepon }}</span>
                        </div>
                    </li>
                    <li class="flex items-start gap-4">
                        <span class="material-symbols-outlined text-secondary font-bold text-lg bg-secondary/10 p-2 rounded-full shrink-0">mail</span>
                        <div>
                            <span class="text-xs text-on-surface-low font-normal block mb-1">Alamat Email</span>
                            <span>{{ $profil->email }}</span>
                        </div>
                    </li>
                </ul>
            </div>

            <!-- Jam Kerja -->
            <div class="bg-white p-8 rounded-[28px] border border-outline-variant/30 shadow-sm space-y-4">
                <h3 class="font-headline-sm text-lg font-bold text-primary border-b border-outline-variant/20 pb-4">Jam Pelayanan</h3>
                <ul class="space-y-3 text-sm font-semibold text-primary">
                    @foreach($profil->jam_kerja as $hari => $jam)
                        <li class="flex justify-between border-b border-outline-variant/10 pb-2 last:border-0 last:pb-0">
                            <span class="text-on-surface-low font-normal">{{ $hari }}</span>
                            <span>{{ $jam }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Map Location -->
            <div class="rounded-[28px] overflow-hidden border shadow-sm aspect-video bg-surface-variant">
                <iframe class="w-full h-full" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3959.584742588145!2d110.4384666!3d-7.058!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e708c02c63c500b%3A0xe5a1c324c4bd0c8f!2sSDN%20Bulusan!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid" frameborder="0" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>

        <!-- Contact/Complaint Form -->
        <div class="lg:col-span-7 bg-white p-8 md:p-10 rounded-[28px] border border-outline-variant/30 shadow-sm space-y-8">
            <div>
                <h3 class="font-headline-md text-2xl font-bold text-primary">Formulir Pesan & Pengaduan</h3>
                <p class="text-sm text-on-surface-variant mt-1">Gunakan formulir di bawah ini untuk mengirimkan kritik, saran, pertanyaan, atau aduan resmi.</p>
            </div>

            @if ($errors->any())
                <div class="p-4 bg-error-container text-on-error-container rounded-xl text-xs font-semibold flex items-center gap-2">
                    <span class="material-symbols-outlined">error</span>
                    <span>Terdapat kesalahan pengisian formulir. Harap periksa kembali.</span>
                </div>
            @endif

            <form action="{{ route('kontak.submit') }}" method="POST" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="nama" class="block text-sm font-semibold text-primary mb-2">Nama Lengkap</label>
                        <input type="text" name="nama" id="nama" value="{{ old('nama') }}" placeholder="Ketikkan nama Anda..." required
                               class="w-full px-4 py-2.5 rounded-xl border border-outline/30 outline-none text-sm"/>
                        @error('nama') <p class="text-xs text-error mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-semibold text-primary mb-2">Alamat Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="Ketikkan email aktif..." required
                               class="w-full px-4 py-2.5 rounded-xl border border-outline/30 outline-none text-sm"/>
                        @error('email') <p class="text-xs text-error mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="no_kontak" class="block text-sm font-semibold text-primary mb-2">Nomor Telepon / WhatsApp</label>
                        <input type="text" name="no_kontak" id="no_kontak" value="{{ old('no_kontak') }}" placeholder="Ketikkan nomor telepon..." required
                               class="w-full px-4 py-2.5 rounded-xl border border-outline/30 outline-none text-sm"/>
                        @error('no_kontak') <p class="text-xs text-error mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="jenis" class="block text-sm font-semibold text-primary mb-2">Jenis Pesan</label>
                        <select name="jenis" id="jenis" class="w-full px-4 py-2.5 rounded-xl border border-outline/30 outline-none text-sm bg-white" required>
                            <option value="kontak" {{ old('jenis') === 'kontak' ? 'selected' : '' }}>Kontak (Tanya Biasa)</option>
                            <option value="pengaduan" {{ old('jenis') === 'pengaduan' ? 'selected' : '' }}>Pengaduan Resmi</option>
                        </select>
                        @error('jenis') <p class="text-xs text-error mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label for="subjek" class="block text-sm font-semibold text-primary mb-2">Subjek Pesan</label>
                    <input type="text" name="subjek" id="subjek" value="{{ old('subjek') }}" placeholder="Ketikkan perihal pesan..." required
                           class="w-full px-4 py-2.5 rounded-xl border border-outline/30 outline-none text-sm"/>
                    @error('subjek') <p class="text-xs text-error mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="isi_pesan" class="block text-sm font-semibold text-primary mb-2">Isi Pesan Lengkap</label>
                    <textarea name="isi_pesan" id="isi_pesan" rows="6" placeholder="Ketikkan rincian pesan Anda di sini..." required
                              class="w-full px-4 py-2.5 rounded-xl border border-outline/30 outline-none text-sm">{{ old('isi_pesan') }}</textarea>
                    @error('isi_pesan') <p class="text-xs text-error mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="flex justify-end pt-4">
                    <button type="submit" class="bg-primary text-on-primary px-10 py-3.5 rounded-full font-label-md font-bold hover:bg-primary/95 transition-all shadow-md">
                        Kirim Pesan
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
