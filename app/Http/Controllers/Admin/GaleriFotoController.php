<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AlbumGaleri;
use App\Models\GaleriFoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriFotoController extends Controller
{
    public function index(Request $request)
    {
        $query = AlbumGaleri::withCount('foto');

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('nama_album', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%");
        }

        $albums = $query->latest()->paginate(10)->withQueryString();

        return view('admin.galeri-foto.index', compact('albums'));
    }

    public function create()
    {
        return view('admin.galeri-foto.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_album' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        AlbumGaleri::create($data);

        return redirect()->route('admin.galeri-foto.index')->with('success', 'Album galeri berhasil dibuat.');
    }

    public function show(AlbumGaleri $album)
    {
        $album->load('foto');
        return view('admin.galeri-foto.show', compact('album'));
    }

    public function edit(AlbumGaleri $album)
    {
        return view('admin.galeri-foto.edit', compact('album'));
    }

    public function update(Request $request, AlbumGaleri $album)
    {
        $data = $request->validate([
            'nama_album' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $album->update($data);

        return redirect()->route('admin.galeri-foto.index')->with('success', 'Album galeri berhasil diperbarui.');
    }

    public function destroy(AlbumGaleri $album)
    {
        $album->load('foto');
        foreach ($album->foto as $foto) {
            Storage::disk('public')->delete($foto->path_foto);
        }
        $album->delete(); // Cascades delete in DB

        return redirect()->route('admin.galeri-foto.index')->with('success', 'Album galeri beserta seluruh fotonya berhasil dihapus.');
    }

    public function storePhotos(Request $request, AlbumGaleri $album)
    {
        $request->validate([
            'photos' => 'required|array',
            'photos.*' => 'image|mimes:jpeg,png,jpg,webp|max:3072',
            'caption' => 'nullable|array',
            'caption.*' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $index => $file) {
                $path = $file->store('galeri', 'public');
                $caption = $request->input('caption.' . $index) ?? '';

                GaleriFoto::create([
                    'album_galeri_id' => $album->id,
                    'path_foto' => $path,
                    'caption' => $caption,
                ]);
            }
        }

        return redirect()->route('admin.galeri-foto.show', $album->id)->with('success', 'Foto-foto berhasil ditambahkan ke album.');
    }

    public function destroyPhoto(GaleriFoto $foto)
    {
        Storage::disk('public')->delete($foto->path_foto);
        $foto->delete();

        return back()->with('success', 'Foto berhasil dihapus dari album.');
    }
}
