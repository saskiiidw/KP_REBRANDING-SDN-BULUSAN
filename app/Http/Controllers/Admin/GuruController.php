<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GuruController extends Controller
{
    public function index(Request $request)
    {
        $query = Guru::with('jabatan');

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('nama', 'like', "%{$search}%")
                  ->orWhere('nip', 'like', "%{$search}%")
                  ->orWhere('nuptk', 'like', "%{$search}%")
                  ->orWhere('kelas_diampu', 'like', "%{$search}%");
        }

        $guru = $query->orderBy('urutan')->paginate(10)->withQueryString();

        return view('admin.guru.index', compact('guru'));
    }

    public function create()
    {
        $jabatan = Jabatan::all();
        return view('admin.guru.create', compact('jabatan'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan_id' => 'required|exists:jabatan,id',
            'nip' => 'nullable|string|max:50',
            'nuptk' => 'nullable|string|max:50',
            'kelas_diampu' => 'nullable|string|max:50',
            'status' => 'required|in:aktif,nonaktif',
            'urutan' => 'required|integer|min:0',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('guru', 'public');
        }

        Guru::create($data);

        return redirect()->route('admin.guru.index')->with('success', 'Data guru berhasil ditambahkan.');
    }

    public function storeJabatan(Request $request)
    {
        $data = $request->validate([
            'nama_jabatan' => 'required|string|max:255|unique:jabatan,nama_jabatan',
        ]);

        $jabatan = Jabatan::create($data);

        return response()->json([
            'success' => true,
            'jabatan' => $jabatan
        ]);
    }

    public function edit(Guru $guru)
    {
        $jabatan = Jabatan::all();
        return view('admin.guru.edit', compact('guru', 'jabatan'));
    }

    public function update(Request $request, Guru $guru)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan_id' => 'required|exists:jabatan,id',
            'nip' => 'nullable|string|max:50',
            'nuptk' => 'nullable|string|max:50',
            'kelas_diampu' => 'nullable|string|max:50',
            'status' => 'required|in:aktif,nonaktif',
            'urutan' => 'required|integer|min:0',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            if ($guru->foto) {
                Storage::disk('public')->delete($guru->foto);
            }
            $data['foto'] = $request->file('foto')->store('guru', 'public');
        }

        $guru->update($data);

        return redirect()->route('admin.guru.index')->with('success', 'Data guru berhasil diperbarui.');
    }

    public function destroy(Guru $guru)
    {
        if ($guru->foto) {
            Storage::disk('public')->delete($guru->foto);
        }
        $guru->delete();

        return redirect()->route('admin.guru.index')->with('success', 'Data guru berhasil dihapus.');
    }
}
