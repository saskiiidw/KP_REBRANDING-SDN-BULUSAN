<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
use App\Models\LampiranPengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PengumumanController extends Controller
{
    public function index(Request $request)
    {
        $query = Pengumuman::with('penulis', 'lampiran');

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('judul', 'like', "%{$search}%")
                  ->orWhere('konten', 'like', "%{$search}%");
        }

        $pengumuman = $query->latest()->paginate(10)->withQueryString();

        return view('admin.pengumuman.index', compact('pengumuman'));
    }

    public function create()
    {
        return view('admin.pengumuman.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'status' => 'required|in:draft,published',
            'tanggal_terbit' => 'required|date',
            'tanggal_berakhir' => 'nullable|date|after_or_equal:tanggal_terbit',
            'lampiran' => 'nullable|array',
            'lampiran.*' => 'file|mimes:pdf,jpeg,png,jpg,webp|max:5120',
            'nama_lampiran' => 'nullable|array',
            'nama_lampiran.*' => 'string|max:255',
        ]);

        $data['slug'] = Str::slug($data['judul']);
        $count = Pengumuman::where('slug', 'like', $data['slug'].'%')->count();
        if ($count > 0) {
            $data['slug'] = $data['slug'] . '-' . ($count + 1);
        }

        $data['penulis_id'] = Auth::id();

        $pengumuman = Pengumuman::create($data);

        // Attachments
        if ($request->hasFile('lampiran')) {
            foreach ($request->file('lampiran') as $index => $file) {
                $name = $request->input('nama_lampiran.' . $index) ?: $file->getClientOriginalName();
                $path = $file->store('pengumuman', 'public');

                LampiranPengumuman::create([
                    'pengumuman_id' => $pengumuman->id,
                    'nama_lampiran' => $name,
                    'path_file' => $path,
                ]);
            }
        }

        return redirect()->route('admin.pengumuman.index')->with('success', 'Pengumuman berhasil ditambahkan.');
    }

    public function edit(Pengumuman $pengumuman)
    {
        return view('admin.pengumuman.edit', compact('pengumuman'));
    }

    public function update(Request $request, Pengumuman $pengumuman)
    {
        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'status' => 'required|in:draft,published',
            'tanggal_terbit' => 'required|date',
            'tanggal_berakhir' => 'nullable|date|after_or_equal:tanggal_terbit',
            'lampiran' => 'nullable|array',
            'lampiran.*' => 'file|mimes:pdf,jpeg,png,jpg,webp|max:5120',
            'nama_lampiran' => 'nullable|array',
            'nama_lampiran.*' => 'string|max:255',
        ]);

        if ($pengumuman->judul !== $data['judul']) {
            $data['slug'] = Str::slug($data['judul']);
            $count = Pengumuman::where('slug', 'like', $data['slug'].'%')->where('id', '!=', $pengumuman->id)->count();
            if ($count > 0) {
                $data['slug'] = $data['slug'] . '-' . ($count + 1);
            }
        }

        $pengumuman->update($data);

        // Attachments
        if ($request->hasFile('lampiran')) {
            foreach ($request->file('lampiran') as $index => $file) {
                $name = $request->input('nama_lampiran.' . $index) ?: $file->getClientOriginalName();
                $path = $file->store('pengumuman', 'public');

                LampiranPengumuman::create([
                    'pengumuman_id' => $pengumuman->id,
                    'nama_lampiran' => $name,
                    'path_file' => $path,
                ]);
            }
        }

        return redirect()->route('admin.pengumuman.index')->with('success', 'Pengumuman berhasil diperbarui.');
    }

    public function destroy(Pengumuman $pengumuman)
    {
        // Delete attachment files
        foreach ($pengumuman->lampiran as $lampiran) {
            Storage::disk('public')->delete($lampiran->path_file);
        }
        $pengumuman->delete(); // Cascades delete in database

        return redirect()->route('admin.pengumuman.index')->with('success', 'Pengumuman berhasil dihapus.');
    }

    public function destroyAttachment(LampiranPengumuman $lampiran)
    {
        Storage::disk('public')->delete($lampiran->path_file);
        $lampiran->delete();

        return back()->with('success', 'Lampiran berhasil dihapus.');
    }
}
