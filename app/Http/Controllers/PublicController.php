<?php

namespace App\Http\Controllers;

use App\Models\ProfilSekolah;
use App\Models\Berita;
use App\Models\Pengumuman;
use App\Models\Agenda;
use App\Models\Guru;
use App\Models\Prestasi;
use App\Models\TingkatPrestasi;
use App\Models\AlbumGaleri;
use App\Models\GaleriVideo;
use App\Models\TautanLayanan;
use App\Models\KontakPengaduan;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function home()
    {
        $profil = ProfilSekolah::first();
        $tautan = TautanLayanan::orderBy('urutan')->get();
        
        $berita = Berita::with('kategori')
            ->where('status', 'published')
            ->latest()
            ->take(3)
            ->get();
            
        $pengumuman = Pengumuman::where('status', 'published')
            ->latest()
            ->take(3)
            ->get();
            
        $agenda = Agenda::latest()
            ->take(3)
            ->get();

        $stats = [
            'guru' => Guru::where('status', 'aktif')->count(),
            'prestasi' => Prestasi::count(),
            'album' => AlbumGaleri::count(),
            'video' => GaleriVideo::count(),
        ];

        return view('public.home', compact('profil', 'tautan', 'berita', 'pengumuman', 'agenda', 'stats'));
    }

    public function tentang()
    {
        $profil = ProfilSekolah::first();
        $guru = Guru::with('jabatan')
            ->where('status', 'aktif')
            ->orderBy('urutan')
            ->get();
            
        return view('public.tentang', compact('profil', 'guru'));
    }

    public function penerimaan()
    {
        $profil = ProfilSekolah::first();
        $tautanPPDB = TautanLayanan::where('url', 'like', '%ppd%')->first();
        return view('public.penerimaan', compact('profil', 'tautanPPDB'));
    }

    public function ekstrakurikuler()
    {
        $profil = ProfilSekolah::first();
        
        // Mock data matching the PRD description
        $ekskul = [
            [
                'nama' => 'Pramuka',
                'deskripsi' => 'Pengembangan karakter, kedisiplinan, kepemimpinan, dan kemandirian siswa melalui kegiatan kepramukaan wajib.',
                'ikon' => 'explore',
                'jadwal' => 'Jumat, 14:00 - 15:30'
            ],
            [
                'nama' => 'Batik',
                'deskripsi' => 'Melestarikan warisan budaya lokal Kota Semarang dengan melatih ketelitian dan kreativitas membatik sejak dini.',
                'ikon' => 'palette',
                'jadwal' => 'Rabu, 13:00 - 14:30'
            ],
            [
                'nama' => 'Seni Tari',
                'deskripsi' => 'Wadah ekspresi seni tari tradisional Jawa untuk mengembangkan kepekaan rasa dan kebugaran fisik siswa.',
                'ikon' => 'interpreter_mode',
                'jadwal' => 'Selasa, 13:00 - 14:30'
            ],
            [
                'nama' => 'Komputer & TIK',
                'deskripsi' => 'Membekali siswa dengan literasi digital dasar, pengenalan aplikasi Office, dan pemanfaatan teknologi yang sehat.',
                'ikon' => 'computer',
                'jadwal' => 'Kamis, 13:00 - 14:30'
            ],
            [
                'nama' => 'Rebana',
                'deskripsi' => 'Pengembangan bakat seni musik religi untuk menanamkan nilai-nilai religius dan kerja sama tim.',
                'ikon' => 'music_note',
                'jadwal' => 'Sabtu, 08:00 - 10:00'
            ],
            [
                'nama' => 'Drumband',
                'deskripsi' => 'Latihan kedisiplinan, harmoni musik, dan kerja sama tim melalui formasi baris-berbaris dan alat musik perkusi.',
                'ikon' => 'audiotrack',
                'jadwal' => 'Sabtu, 10:00 - 12:00'
            ]
        ];

        return view('public.ekstrakurikuler', compact('profil', 'ekskul'));
    }

    public function prestasi(Request $request)
    {
        $profil = ProfilSekolah::first();
        $tingkat = TingkatPrestasi::all();

        $query = Prestasi::with('tingkat');

        if ($request->has('tingkat') && $request->input('tingkat') != '') {
            $query->where('tingkat_prestasi_id', $request->input('tingkat'));
        }

        if ($request->has('search') && $request->input('search') != '') {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('nama_siswa', 'like', "%{$search}%")
                  ->orWhere('lomba', 'like', "%{$search}%")
                  ->orWhere('peringkat', 'like', "%{$search}%")
                  ->orWhere('tahun', 'like', "%{$search}%");
            });
        }

        $prestasi = $query->latest()->paginate(9)->withQueryString();

        return view('public.prestasi', compact('profil', 'prestasi', 'tingkat'));
    }

    public function pusatInformasi(Request $request)
    {
        $profil = ProfilSekolah::first();
        $tab = $request->input('tab', 'berita');

        // Fetch Berita
        $queryBerita = Berita::with('kategori')
            ->where('status', 'published');
        if ($tab === 'berita' && $request->has('search')) {
            $search = $request->input('search');
            $queryBerita->where('judul', 'like', "%{$search}%");
        }
        $berita = $queryBerita->latest()->paginate(6, ['*'], 'page_berita')->withQueryString();

        // Fetch Pengumuman
        $queryPengumuman = Pengumuman::with('lampiran')
            ->where('status', 'published');
        if ($tab === 'pengumuman' && $request->has('search')) {
            $search = $request->input('search');
            $queryPengumuman->where('judul', 'like', "%{$search}%");
        }
        $pengumuman = $queryPengumuman->latest()->paginate(6, ['*'], 'page_pengumuman')->withQueryString();

        // Fetch Agenda
        $queryAgenda = Agenda::query();
        if ($tab === 'agenda' && $request->has('search')) {
            $search = $request->input('search');
            $queryAgenda->where('nama_kegiatan', 'like', "%{$search}%");
        }
        $agenda = $queryAgenda->latest()->paginate(6, ['*'], 'page_agenda')->withQueryString();

        return view('public.pusat-informasi', compact('profil', 'berita', 'pengumuman', 'agenda', 'tab'));
    }

    public function detailBerita($slug)
    {
        $profil = ProfilSekolah::first();
        $berita = Berita::with('kategori', 'penulis')
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();
            
        $recent_berita = Berita::where('status', 'published')
            ->where('id', '!=', $berita->id)
            ->latest()
            ->take(5)
            ->get();

        return view('public.detail-berita', compact('profil', 'berita', 'recent_berita'));
    }

    public function galeri()
    {
        $profil = ProfilSekolah::first();
        $albums = AlbumGaleri::with('foto')->withCount('foto')->latest()->get();
        $videos = GaleriVideo::latest()->get();

        return view('public.galeri', compact('profil', 'albums', 'videos'));
    }

    public function showAlbum($id)
    {
        $profil = ProfilSekolah::first();
        $album = AlbumGaleri::with('foto')->findOrFail($id);

        return view('public.album-show', compact('profil', 'album'));
    }

    public function kontak()
    {
        $profil = ProfilSekolah::first();
        return view('public.kontak', compact('profil'));
    }

    public function submitKontak(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'no_kontak' => 'required|string|max:20',
            'jenis' => 'required|in:kontak,pengaduan',
            'subjek' => 'required|string|max:255',
            'isi_pesan' => 'required|string',
        ]);

        $data['status_penanganan'] = 'baru';

        KontakPengaduan::create($data);

        return redirect()->route('kontak')->with('success', 'Pesan Anda telah berhasil terkirim. Terima kasih atas feedback Anda!');
    }
}
