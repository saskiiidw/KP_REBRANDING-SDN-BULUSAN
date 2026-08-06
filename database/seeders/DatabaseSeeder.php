<?php
 
namespace Database\Seeders;
 
use App\Models\User;
use App\Models\ProfilSekolah;
use App\Models\Jabatan;
use App\Models\TingkatPrestasi;
use App\Models\KategoriBerita;
use App\Models\TautanLayanan;
use App\Models\Guru;
use App\Models\Berita;
use App\Models\Pengumuman;
use App\Models\Prestasi;
use App\Models\Agenda;
use App\Models\AlbumGaleri;
use App\Models\GaleriFoto;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;
 
class DatabaseSeeder extends Seeder
{
    /**
     * Helper to download images from URL and save locally
     */
    private function downloadImage($url, $destinationPath, $isPublic = false)
    {
        $fullPath = $isPublic ? public_path($destinationPath) : storage_path('app/public/' . $destinationPath);
        
        File::ensureDirectoryExists(dirname($fullPath));
        
        try {
            echo "Downloading: {$url} -> {$destinationPath}... ";
            $response = Http::withoutVerifying()->timeout(60)->get($url);
            if ($response->successful()) {
                File::put($fullPath, $response->body());
                echo "Success!\n";
                return true;
            } else {
                echo "Failed (Status: " . $response->status() . ")\n";
            }
        } catch (\Exception $e) {
            echo "Error: " . $e->getMessage() . "\n";
        }
        return false;
    }

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Download visual assets
        echo "=== START DOWNLOADING VISUAL ASSETS ===\n";
        $this->downloadImage('https://sdnbulusan.dikdas.semarangkota.go.id/uploads/school_content/logo/front_logo-6385ba83548253.37497120.jpeg', 'images/logo.png', true);
        $this->downloadImage('http://sdnbulusan.dikdas.semarangkota.go.id/uploads/gallery/media/WhatsApp%20Image%202021-06-10%20at%2008.35.17-1623690000.jpeg', 'images/hero_school.jpg', true);
        $this->downloadImage('http://sdnbulusan.dikdas.semarangkota.go.id/uploads/gallery/media/WhatsApp%20Image%202022-10-25%20at%2008.52.54.jpeg', 'images/default_kepsek.jpg', true);
        $this->downloadImage('http://sdnbulusan.dikdas.semarangkota.go.id/uploads/gallery/media/WhatsApp%20Image%202022-10-25%20at%2008.52.54.jpeg', 'profil/foto_kepsek.jpg');
        $this->downloadImage('http://sdnbulusan.dikdas.semarangkota.go.id/uploads/gallery/media/WhatsApp%20Image%202021-04-21%20at%2008.21.29.jpeg', 'images/kegiatan_1.jpg', true);
        $this->downloadImage('http://sdnbulusan.dikdas.semarangkota.go.id/uploads/gallery/media/WhatsApp%20Image%202021-06-08%20at%2008.01.24.jpeg', 'images/kegiatan_2.jpg', true);
        $this->downloadImage('http://sdnbulusan.dikdas.semarangkota.go.id/uploads/gallery/media/WhatsApp%20Image%202021-04-06%20at%2012.25.25.jpeg', 'images/kegiatan_3.jpg', true);
        
        $this->downloadImage('http://sdnbulusan.dikdas.semarangkota.go.id/uploads/gallery/media/WhatsApp%20Image%202021-04-21%20at%2008.21.29.jpeg', 'galeri/kegiatan_belajar_1.jpg');
        $this->downloadImage('http://sdnbulusan.dikdas.semarangkota.go.id/uploads/gallery/media/WhatsApp%20Image%202021-06-08%20at%2008.01.24.jpeg', 'galeri/kegiatan_belajar_2.jpg');
        $this->downloadImage('http://sdnbulusan.dikdas.semarangkota.go.id/uploads/gallery/media/WhatsApp%20Image%202021-04-06%20at%2012.25.25.jpeg', 'galeri/kegiatan_belajar_3.jpg');
        $this->downloadImage('https://sdnbulusan.dikdas.semarangkota.go.id/uploads/gallery/media/WhatsApp%20Image%202024-08-20%20at%2013.34.53_d183a9bf.jpg', 'galeri/kegiatan_belajar_4.jpg');
        
        $this->downloadImage('https://sdnbulusan.dikdas.semarangkota.go.id/uploads/gallery/media/WhatsApp%20Image%202024-08-20%20at%2013.34.53_d183a9bf.jpg', 'prestasi/mapsi.jpg');
        $this->downloadImage('http://sdnbulusan.dikdas.semarangkota.go.id/uploads/gallery/media/WhatsApp%20Image%202021-04-06%20at%2012.25.25.jpeg', 'prestasi/o2sn.jpg');
        $this->downloadImage('https://sdnbulusan.dikdas.semarangkota.go.id/uploads/gallery/media/WhatsApp%20Image%202024-08-20%20at%2013.34.53_d183a9bf.jpg', 'berita/mapsi_thumb.jpg');
        $this->downloadImage('https://sdnbulusan.dikdas.semarangkota.go.id/uploads/gallery/media/Rukiyem.jpg', 'guru/sri_sunarni.jpg');
        $this->downloadImage('http://sdnbulusan.dikdas.semarangkota.go.id/uploads/gallery/media/WhatsApp%20Image%202022-10-25%20at%2008.52.54.jpeg', 'guru/harmana.jpg');
        echo "=== FINISHED DOWNLOADING VISUAL ASSETS ===\n\n";

        // 1. Users
        $admin = User::create([
            'name' => 'Administrator',
            'email' => 'admin@sdnbulusan.sch.id',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);
 
        $guruUser = User::create([
            'name' => 'Guru Operator',
            'email' => 'guru@sdnbulusan.sch.id',
            'password' => Hash::make('guru123'),
            'role' => 'guru',
        ]);
 
        // 2. Profil Sekolah
        ProfilSekolah::create([
            'nama_sekolah' => 'SD Negeri Bulusan',
            'npsn' => '20328906',
            'nss' => '101036306004',
            'akreditasi' => 'A',
            'alamat' => 'Jl. Bulusan Selatan Raya, Kec. Tembalang, Semarang',
            'email' => 'sdnegeribulusan@gmail.com',
            'telepon' => '(024) 76482524',
            'jam_kerja' => [
                'Senin - Kamis' => '07:00 - 14:00',
                'Jumat' => '07:00 - 11:30',
                'Sabtu - Minggu' => 'Tutup'
            ],
            'nama_kepsek' => 'Harmana, S.Pd.SD',
            'nip_kepsek' => '196803121990031007',
            'sambutan_kepsek' => "Asalamualaikum warohmatullahi wabarokatuh.\n\nSalam sehat, bahagia dan sejahtera selalu untuk kita semua. Izinkan saya selaku Kepala Sekolah Dasar Negeri Bulusan Kota Semarang untuk mengenalkan profil sekolah kami melalui website ini.\n\nAlhamdulillah, puji syukur senantiasa kita panjatkan ke hadirat Tuhan Yang Maha Kuasa atas semua limpahan rahmat dan hidayahNya kepada kita, terutama nikmat sehat, sehingga kita masih diberi kesempatan untuk bersama-sama berkarya...",
            'foto_kepsek' => 'profil/foto_kepsek.jpg',
            'visi' => 'Terwujudnya peserta didik yang beriman, bertakwa, berakhlak mulia, berprestasi, berkarakter, dan berbudaya lingkungan.',
            'misi' => "Menyelenggarakan pendidikan yang bermutu, inovatif, dan inklusif.\nMembina karakter siswa melalui pembiasaan positif.\nMeningkatkan prestasi akademik dan non-akademik di tingkat regional maupun nasional.\nMembudayakan perilaku cinta dan peduli terhadap lingkungan hidup.",
            'sejarah' => 'SD Negeri Bulusan didirikan untuk melayani kebutuhan pendidikan dasar berkualitas bagi masyarakat Bulusan, Kec. Tembalang, Semarang.',
            'struktur_organisasi' => null,
        ]);
 
        // 3. Jabatan
        $kepsekJabatan = Jabatan::create(['nama_jabatan' => 'Kepala Sekolah']);
        $guruKelasJabatan = Jabatan::create(['nama_jabatan' => 'Guru Kelas']);
        $guruAgamaJabatan = Jabatan::create(['nama_jabatan' => 'Guru Agama']);
        $stafJabatan = Jabatan::create(['nama_jabatan' => 'Tenaga Kependidikan']);
 
        // 4. Guru
        Guru::create([
            'jabatan_id' => $kepsekJabatan->id,
            'nama' => 'Harmana, S.Pd.SD',
            'nip' => '196803121990031007',
            'nuptk' => '8239746648200032',
            'kelas_diampu' => null,
            'foto' => 'guru/harmana.jpg',
            'status' => 'aktif',
            'urutan' => 1
        ]);
 
        Guru::create([
            'jabatan_id' => $guruKelasJabatan->id,
            'nama' => 'Sri Sunarni, S.Pd.',
            'nip' => '197204151996032001',
            'nuptk' => '1234567890123456',
            'kelas_diampu' => 'Kelas 1',
            'foto' => 'guru/sri_sunarni.jpg',
            'status' => 'aktif',
            'urutan' => 2
        ]);
 
        // 5. Tingkat Prestasi
        $tkSekolah = TingkatPrestasi::create(['nama_tingkat' => 'Sekolah']);
        $tkKecamatan = TingkatPrestasi::create(['nama_tingkat' => 'Kecamatan']);
        $tkKota = TingkatPrestasi::create(['nama_tingkat' => 'Kota']);
        $tkProvinsi = TingkatPrestasi::create(['nama_tingkat' => 'Provinsi']);
        $tkNasional = TingkatPrestasi::create(['nama_tingkat' => 'Nasional']);
        $tkInternasional = TingkatPrestasi::create(['nama_tingkat' => 'Internasional']);
 
        // 6. Prestasi
        Prestasi::create([
            'tingkat_prestasi_id' => $tkKecamatan->id,
            'nama_siswa' => 'Ahmad Fauzi & Tim',
            'lomba' => 'Lomba MAPSI',
            'peringkat' => 'Juara 1',
            'tahun' => 2024,
            'foto' => 'prestasi/mapsi.jpg',
            'deskripsi' => 'Meraih Juara 1 Lomba MAPSI 2024 Tingkat Kecamatan Tembalang.'
        ]);
 
        Prestasi::create([
            'tingkat_prestasi_id' => $tkKota->id,
            'nama_siswa' => 'Budi Santoso',
            'lomba' => 'O2SN Atletik',
            'peringkat' => 'Juara 2',
            'tahun' => 2023,
            'foto' => 'prestasi/o2sn.jpg',
            'deskripsi' => 'Juara 2 Atletik Putra O2SN Tingkat Kota Semarang.'
        ]);
 
        // 7. Kategori Berita
        $catAkademik = KategoriBerita::create(['nama' => 'Akademik', 'slug' => 'akademik']);
        $catPrestasi = KategoriBerita::create(['nama' => 'Prestasi', 'slug' => 'prestasi']);
        $catKegiatan = KategoriBerita::create(['nama' => 'Kegiatan', 'slug' => 'kegiatan']);
 
        // 8. Berita
        Berita::create([
            'kategori_berita_id' => $catPrestasi->id,
            'penulis_id' => $admin->id,
            'judul' => 'SDN BULUSAN BERPRESTASI LOMBA MAPSI',
            'slug' => Str::slug('SDN BULUSAN BERPRESTASI LOMBA MAPSI'),
            'ringkasan' => 'Prestasi membanggakan diraih oleh siswa-siswi SDN Bulusan dalam ajang Lomba MAPSI tingkat kota.',
            'konten' => 'Prestasi membanggakan kembali diukir oleh perwakilan siswa-siswi SDN Bulusan Semarang. Dalam ajang Lomba MAPSI tingkat kota yang diselenggarakan baru-baru ini, delegasi sekolah berhasil menyabet juara di berbagai kategori. Kepala Sekolah menyampaikan apresiasi sebesar-sebesarnya kepada pembimbing dan para siswa yang telah berjuang keras.',
            'thumbnail' => 'berita/mapsi_thumb.jpg',
            'status' => 'published',
        ]);
 
        // 9. Pengumuman
        Pengumuman::create([
            'penulis_id' => $admin->id,
            'judul' => 'Edaran MPLS - Transisi PAUD ke SD Tahun 2024',
            'slug' => Str::slug('Edaran MPLS - Transisi PAUD ke SD Tahun 2024'),
            'konten' => 'Masa Pengenalan Lingkungan Sekolah (MPLS) untuk tahun ajaran baru akan segera dilaksanakan. Diharapkan orang tua murid mempersiapkan putra-putrinya sesuai panduan transisi PAUD ke SD yang menyenangkan.',
            'status' => 'published',
            'tanggal_terbit' => now()->format('Y-m-d'),
            'tanggal_berakhir' => now()->addDays(30)->format('Y-m-d'),
        ]);
 
        // 10. Agenda
        Agenda::create([
            'penulis_id' => $admin->id,
            'nama_kegiatan' => 'Rapat Pleno Orang Tua Wali Murid',
            'deskripsi' => 'Sosialisasi program sekolah tahun ajaran berjalan bersama Komite Sekolah.',
            'tanggal_mulai' => now()->addDays(5)->format('Y-m-d'),
            'tanggal_selesai' => now()->addDays(5)->format('Y-m-d'),
        ]);
 
        // 11. Tautan Layanan
        TautanLayanan::create([
            'nama_layanan' => 'Sang Juara',
            'url' => 'https://portaldisdik.semarangkota.go.id/',
            'ikon' => 'emoji_events',
            'urutan' => 1,
            'is_eksternal' => true
        ]);

        TautanLayanan::create([
            'nama_layanan' => 'SPMB',
            'url' => 'https://spmb.semarangkota.go.id/',
            'ikon' => 'school',
            'urutan' => 2,
            'is_eksternal' => true
        ]);

        TautanLayanan::create([
            'nama_layanan' => 'SIGAP',
            'url' => 'https://sigap-disdik.semarangkota.go.id/',
            'ikon' => 'security',
            'urutan' => 3,
            'is_eksternal' => true
        ]);
        
        // 12. Album & Galeri Foto
        $album = AlbumGaleri::create([
            'nama_album' => 'Kegiatan Belajar Mengajar',
            'deskripsi' => 'Foto dokumentasi kegiatan belajar mengajar sehari-hari di SDN Bulusan.'
        ]);

        GaleriFoto::create([
            'album_galeri_id' => $album->id,
            'caption' => 'Hari Kartini di SDN Bulusan',
            'path_foto' => 'galeri/kegiatan_belajar_1.jpg'
        ]);

        GaleriFoto::create([
            'album_galeri_id' => $album->id,
            'caption' => 'Hari Transportasi Umum',
            'path_foto' => 'galeri/kegiatan_belajar_2.jpg'
        ]);

        GaleriFoto::create([
            'album_galeri_id' => $album->id,
            'caption' => 'Lomba FLS2N Kriya Anyam',
            'path_foto' => 'galeri/kegiatan_belajar_3.jpg'
        ]);

        GaleriFoto::create([
            'album_galeri_id' => $album->id,
            'caption' => 'Kegiatan Lomba MAPSI',
            'path_foto' => 'galeri/kegiatan_belajar_4.jpg'
        ]);
    }
}
