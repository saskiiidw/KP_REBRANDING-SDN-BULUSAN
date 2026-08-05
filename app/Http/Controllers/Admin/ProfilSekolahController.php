<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfilSekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilSekolahController extends Controller
{
    public function edit()
    {
        $profil = ProfilSekolah::firstOrFail();
        return view('admin.profil.edit', compact('profil'));
    }

    public function update(Request $request)
    {
        $profil = ProfilSekolah::firstOrFail();

        $data = $request->validate([
            'nama_sekolah' => 'required|string|max:255',
            'npsn' => 'required|string|max:50',
            'nss' => 'required|string|max:50',
            'akreditasi' => 'required|string|max:10',
            'alamat' => 'required|string',
            'email' => 'required|email|max:255',
            'telepon' => 'required|string|max:50',
            'jam_kerja' => 'required|array',
            'nama_kepsek' => 'required|string|max:255',
            'nip_kepsek' => 'required|string|max:50',
            'sambutan_kepsek' => 'required|string',
            'foto_kepsek' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'visi' => 'required|string',
            'misi' => 'required|string',
            'sejarah' => 'nullable|string',
            'struktur_organisasi' => 'nullable|image|mimes:jpeg,png,jpg,webp,pdf|max:4096',
        ]);

        if ($request->hasFile('foto_kepsek')) {
            if ($profil->foto_kepsek) {
                Storage::disk('public')->delete($profil->foto_kepsek);
            }
            $data['foto_kepsek'] = $request->file('foto_kepsek')->store('profil', 'public');
        }

        if ($request->hasFile('struktur_organisasi')) {
            if ($profil->struktur_organisasi) {
                Storage::disk('public')->delete($profil->struktur_organisasi);
            }
            $data['struktur_organisasi'] = $request->file('struktur_organisasi')->store('profil', 'public');
        }

        $profil->update($data);

        return redirect()->route('admin.profil.edit')->with('success', 'Profil sekolah berhasil diperbarui.');
    }
}
