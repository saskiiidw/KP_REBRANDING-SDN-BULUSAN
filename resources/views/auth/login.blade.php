@extends('layouts.auth')

@section('content')
<div class="bg-white p-8 md:p-10 rounded-[24px] shadow-2xl border border-outline-variant/30 text-on-surface">
    <!-- Header -->
    <div class="text-center mb-8">
        <img alt="School Logo" class="h-16 w-auto mx-auto mb-4" src="{{ asset('images/logo.png') }}" loading="lazy"/>
        <h2 class="font-headline-md text-2xl font-bold text-primary tracking-wide">LOGIN</h2>
        <p class="text-sm text-on-surface-variant mt-2">SDN Bulusan Kota Semarang</p>
    </div>

    <!-- Error Alerts -->
    @if ($errors->any())
        <div class="mb-6 p-4 bg-error-container text-on-error-container rounded-lg text-sm font-semibold flex items-center gap-2">
            <span class="material-symbols-outlined">error</span>
            <span>{{ $errors->first() }}</span>
        </div>
    @endif

    <!-- Form -->
    <form action="{{ route('login') }}" method="POST" class="space-y-6">
        @csrf
        <div>
            <label for="email" class="block text-sm font-semibold text-primary mb-2">Alamat Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                   class="w-full px-4 py-3 rounded-xl border border-outline/30 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all text-sm"/>
        </div>

        <div>
            <label for="password" class="block text-sm font-semibold text-primary mb-2">Password</label>
            <input type="password" name="password" id="password" required
                   class="w-full px-4 py-3 rounded-xl border border-outline/30 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all text-sm"/>
        </div>

        <div class="flex items-center justify-between">
            <label class="flex items-center gap-2 text-sm text-on-surface-variant cursor-pointer">
                <input type="checkbox" name="remember" class="rounded text-primary focus:ring-primary"/>
                <span>Ingat Saya</span>
            </label>
        </div>

        <button type="submit" class="w-full bg-primary hover:bg-primary/95 text-on-primary py-3 rounded-full font-label-md font-bold transition-all shadow-md">
            Masuk Sekarang
        </button>
    </form>

    <div class="mt-8 pt-6 border-t border-outline-variant/30 text-center">
        <a href="{{ route('home') }}" class="text-secondary hover:text-secondary-fixed transition-colors outline-none font-label-md font-semibold text-sm inline-flex items-center gap-2">
            <span class="material-symbols-outlined text-sm">arrow_back</span>
            Kembali ke Beranda
        </a>
    </div>
</div>
@endsection
