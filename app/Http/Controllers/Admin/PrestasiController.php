<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Prestasi;
use App\Models\TingkatPrestasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PrestasiController extends Controller
{
    public function index(Request $request)
    {
        $query = Prestasi::with('tingkat');

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('nama_siswa', 'like', "%{$search}%")
                  ->orWhere('lomba', 'like', "%{$search}%")
                  ->orWhere('peringkat', 'like', "%{$search}%")
                  ->orWhere('tahun', 'like', "%{$search}%");
        }

        $prestasi = $query->latest()->paginate(10)->withQueryString();

        return view('admin.prestasi.index', compact('prestasi'));
    }

    public function create()
    {
        $tingkat = TingkatPrestasi::all();
        return view('admin.prestasi.create', compact('tingkat'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_siswa' => 'required|string|max:255',
            'tingkat_prestasi_id' => 'required|exists:tingkat_prestasi,id',
            'lomba' => 'required|string|max:255',
            'peringkat' => 'required|string|max:255',
            'tahun' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'deskripsi' => 'nullable|string',
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('prestasi', 'public');
        }

        Prestasi::create($data);

        return redirect()->route('admin.prestasi.index')->with('success', 'Data prestasi berhasil ditambahkan.');
    }

    public function storeTingkat(Request $request)
    {
        $data = $request->validate([
            'nama_tingkat' => 'required|string|max:255|unique:tingkat_prestasi,nama_tingkat',
        ]);

        $tingkat = TingkatPrestasi::create($data);

        return response()->json([
            'success' => true,
            'tingkat' => $tingkat
        ]);
    }

    public function edit(Prestasi $prestasi)
    {
        $tingkat = TingkatPrestasi::all();
        return view('admin.prestasi.edit', compact('prestasi', 'tingkat'));
    }

    public function update(Request $request, Prestasi $prestasi)
    {
        $data = $request->validate([
            'nama_siswa' => 'required|string|max:255',
            'tingkat_prestasi_id' => 'required|exists:tingkat_prestasi,id',
            'lomba' => 'required|string|max:255',
            'peringkat' => 'required|string|max:255',
            'tahun' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'deskripsi' => 'nullable|string',
        ]);

        if ($request->hasFile('foto')) {
            if ($prestasi->foto) {
                Storage::disk('public')->delete($prestasi->foto);
            }
            $data['foto'] = $request->file('foto')->store('prestasi', 'public');
        }

        $prestasi->update($data);

        return redirect()->route('admin.prestasi.index')->with('success', 'Data prestasi berhasil diperbarui.');
    }

    public function destroy(Prestasi $prestasi)
    {
        if ($prestasi->foto) {
            Storage::disk('public')->delete($prestasi->foto);
        }
        $prestasi->delete();

        return redirect()->route('admin.prestasi.index')->with('success', 'Data prestasi berhasil dihapus.');
    }
}
