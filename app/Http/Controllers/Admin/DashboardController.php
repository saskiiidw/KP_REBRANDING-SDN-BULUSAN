<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Pengumuman;
use App\Models\Agenda;
use App\Models\Guru;
use App\Models\Prestasi;
use App\Models\AlbumGaleri;
use App\Models\KontakPengaduan;

class DashboardController extends Controller
{
    public function index()
    {
        $counts = [
            'berita' => Berita::count(),
            'pengumuman' => Pengumuman::count(),
            'agenda' => Agenda::count(),
            'guru' => Guru::count(),
            'prestasi' => Prestasi::count(),
            'album' => AlbumGaleri::count(),
            'kontak' => KontakPengaduan::where('jenis', 'kontak')->count(),
            'pengaduan' => KontakPengaduan::where('jenis', 'pengaduan')->count(),
        ];

        $recent_messages = KontakPengaduan::latest()->take(5)->get();

        return view('admin.dashboard', compact('counts', 'recent_messages'));
    }
}
