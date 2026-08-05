<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable([
    'kategori_berita_id',
    'penulis_id',
    'judul',
    'slug',
    'ringkasan',
    'konten',
    'thumbnail',
    'status',
    'meta_title',
    'meta_description'
])]
class Berita extends Model
{
    protected $table = 'berita';

    public function kategori()
    {
        return $this->belongsTo(KategoriBerita::class, 'kategori_berita_id');
    }

    public function penulis()
    {
        return $this->belongsTo(User::class, 'penulis_id');
    }
}
