<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GaleriVideo;
use Illuminate\Http\Request;

class GaleriVideoController extends Controller
{
    public function index(Request $request)
    {
        $query = GaleriVideo::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('judul', 'like', "%{$search}%");
        }

        $videos = $query->latest()->paginate(10)->withQueryString();

        return view('admin.galeri-video.index', compact('videos'));
    }

    public function create()
    {
        return view('admin.galeri-video.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'url_video' => 'required|url',
        ]);

        $data['url_video'] = $this->formatYoutubeUrl($data['url_video']);

        GaleriVideo::create($data);

        return redirect()->route('admin.galeri-video.index')->with('success', 'Video berhasil ditambahkan.');
    }

    public function edit(GaleriVideo $video)
    {
        return view('admin.galeri-video.edit', compact('video'));
    }

    public function update(Request $request, GaleriVideo $video)
    {
        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'url_video' => 'required|url',
        ]);

        $data['url_video'] = $this->formatYoutubeUrl($data['url_video']);

        $video->update($data);

        return redirect()->route('admin.galeri-video.index')->with('success', 'Video berhasil diperbarui.');
    }

    public function destroy(GaleriVideo $video)
    {
        $video->delete();
        return redirect()->route('admin.galeri-video.index')->with('success', 'Video berhasil dihapus.');
    }

    private function formatYoutubeUrl($url)
    {
        $youtubeId = '';
        
        // Match standard watch URLs or share URLs
        if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match)) {
            $youtubeId = $match[1];
        }

        if (!empty($youtubeId)) {
            return "https://www.youtube.com/embed/" . $youtubeId;
        }

        return $url;
    }
}
