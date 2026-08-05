<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TautanLayanan;
use Illuminate\Http\Request;

class TautanLayananController extends Controller
{
    public function index(Request $request)
    {
        $query = TautanLayanan::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('nama_layanan', 'like', "%{$search}%")
                  ->orWhere('url', 'like', "%{$search}%");
        }

        $tautan = $query->orderBy('urutan')->paginate(10)->withQueryString();

        return view('admin.tautan-layanan.index', compact('tautan'));
    }

    public function create()
    {
        return view('admin.tautan-layanan.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_layanan' => 'required|string|max:255',
            'url' => 'required|url',
            'ikon' => 'required|string|max:100',
            'urutan' => 'required|integer|min:0',
            'is_eksternal' => 'required|boolean',
        ]);

        TautanLayanan::create($data);

        return redirect()->route('admin.tautan-layanan.index')->with('success', 'Tautan layanan berhasil ditambahkan.');
    }

    public function edit(TautanLayanan $tautan)
    {
        return view('admin.tautan-layanan.edit', compact('tautan'));
    }

    public function update(Request $request, TautanLayanan $tautan)
    {
        $data = $request->validate([
            'nama_layanan' => 'required|string|max:255',
            'url' => 'required|url',
            'ikon' => 'required|string|max:100',
            'urutan' => 'required|integer|min:0',
            'is_eksternal' => 'required|boolean',
        ]);

        $tautan->update($data);

        return redirect()->route('admin.tautan-layanan.index')->with('success', 'Tautan layanan berhasil diperbarui.');
    }

    public function destroy(TautanLayanan $tautan)
    {
        $tautan->delete();
        return redirect()->route('admin.tautan-layanan.index')->with('success', 'Tautan layanan berhasil dihapus.');
    }
}
