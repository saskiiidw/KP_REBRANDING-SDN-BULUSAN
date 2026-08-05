<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfilSekolahController;
use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\Admin\PengumumanController;
use App\Http\Controllers\Admin\AgendaController;
use App\Http\Controllers\Admin\GuruController;
use App\Http\Controllers\Admin\PrestasiController;
use App\Http\Controllers\Admin\GaleriFotoController;
use App\Http\Controllers\Admin\GaleriVideoController;
use App\Http\Controllers\Admin\TautanLayananController;
use App\Http\Controllers\Admin\KontakPengaduanController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/tentang', [PublicController::class, 'tentang'])->name('tentang');
Route::get('/ppdb', [PublicController::class, 'penerimaan'])->name('penerimaan');
Route::get('/ekstrakurikuler', [PublicController::class, 'ekstrakurikuler'])->name('ekstrakurikuler');
Route::get('/prestasi', [PublicController::class, 'prestasi'])->name('prestasi');
Route::get('/pusat-informasi', [PublicController::class, 'pusatInformasi'])->name('pusat-informasi');
Route::get('/berita/{slug}', [PublicController::class, 'detailBerita'])->name('berita.detail');
Route::get('/galeri', [PublicController::class, 'galeri'])->name('galeri');
Route::get('/galeri/album/{id}', [PublicController::class, 'showAlbum'])->name('galeri.album.show');
Route::get('/kontak', [PublicController::class, 'kontak'])->name('kontak');
Route::post('/kontak', [PublicController::class, 'submitKontak'])->name('kontak.submit');

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| CMS Admin & Guru Routes (Protected)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin,guru'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profil Sekolah
    Route::get('/profil', [ProfilSekolahController::class, 'edit'])->name('profil.edit');
    Route::put('/profil', [ProfilSekolahController::class, 'update'])->name('profil.update');

    // Berita
    Route::resource('berita', BeritaController::class)->except(['show']);

    // Pengumuman
    Route::resource('pengumuman', PengumumanController::class)->except(['show']);
    Route::delete('/pengumuman/attachment/{lampiran}', [PengumumanController::class, 'destroyAttachment'])->name('pengumuman.attachment.destroy');

    // Agenda
    Route::resource('agenda', AgendaController::class)->except(['show']);

    // Guru & Jabatan
    Route::post('/jabatan', [GuruController::class, 'storeJabatan'])->name('jabatan.store');
    Route::resource('guru', GuruController::class)->except(['show']);

    // Prestasi
    Route::post('/tingkat-prestasi', [PrestasiController::class, 'storeTingkat'])->name('tingkat-prestasi.store');
    Route::resource('prestasi', PrestasiController::class)->except(['show']);

    // Galeri Foto (Albums & Photos)
    Route::get('/galeri-foto', [GaleriFotoController::class, 'index'])->name('galeri-foto.index');
    Route::get('/galeri-foto/create', [GaleriFotoController::class, 'create'])->name('galeri-foto.create');
    Route::post('/galeri-foto', [GaleriFotoController::class, 'store'])->name('galeri-foto.store');
    Route::get('/galeri-foto/{album}', [GaleriFotoController::class, 'show'])->name('galeri-foto.show');
    Route::get('/galeri-foto/{album}/edit', [GaleriFotoController::class, 'edit'])->name('galeri-foto.edit');
    Route::put('/galeri-foto/{album}', [GaleriFotoController::class, 'update'])->name('galeri-foto.update');
    Route::delete('/galeri-foto/{album}', [GaleriFotoController::class, 'destroy'])->name('galeri-foto.destroy');
    Route::post('/galeri-foto/{album}/photos', [GaleriFotoController::class, 'storePhotos'])->name('galeri-foto.photos.store');
    Route::delete('/galeri-foto/photos/{foto}', [GaleriFotoController::class, 'destroyPhoto'])->name('galeri-foto.photos.destroy');

    // Galeri Video
    Route::resource('galeri-video', GaleriVideoController::class)->except(['show']);

    // Tautan Layanan
    Route::resource('tautan-layanan', TautanLayananController::class)->except(['show']);

    // Kontak & Pengaduan
    Route::get('/kontak-pengaduan', [KontakPengaduanController::class, 'index'])->name('kontak-pengaduan.index');
    Route::get('/kontak-pengaduan/{message}', [KontakPengaduanController::class, 'show'])->name('kontak-pengaduan.show');
    Route::put('/kontak-pengaduan/{message}/status', [KontakPengaduanController::class, 'updateStatus'])->name('kontak-pengaduan.status.update');
    Route::delete('/kontak-pengaduan/{message}', [KontakPengaduanController::class, 'destroy'])->name('kontak-pengaduan.destroy');
});

