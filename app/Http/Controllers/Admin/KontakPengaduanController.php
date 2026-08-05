<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KontakPengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KontakPengaduanController extends Controller
{
    public function index(Request $request)
    {
        $query = KontakPengaduan::with('petugas');

        if ($request->has('jenis')) {
            $jenis = $request->input('jenis');
            if (in_array($jenis, ['kontak', 'pengaduan'])) {
                $query->where('jenis', $jenis);
            }
        }

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('subjek', 'like', "%{$search}%")
                  ->orWhere('isi_pesan', 'like', "%{$search}%");
            });
        }

        $messages = $query->latest()->paginate(10)->withQueryString();

        return view('admin.kontak-pengaduan.index', compact('messages'));
    }

    public function show(KontakPengaduan $message)
    {
        return view('admin.kontak-pengaduan.show', compact('message'));
    }

    public function updateStatus(Request $request, KontakPengaduan $message)
    {
        $data = $request->validate([
            'status_penanganan' => 'required|in:baru,diproses,selesai',
        ]);

        $data['ditangani_oleh'] = Auth::id();

        $message->update($data);

        return redirect()->route('admin.kontak-pengaduan.show', $message->id)
            ->with('success', 'Status penanganan pesan berhasil diperbarui.');
    }

    public function destroy(KontakPengaduan $message)
    {
        $message->delete();
        return redirect()->route('admin.kontak-pengaduan.index')->with('success', 'Pesan berhasil dihapus.');
    }
}
