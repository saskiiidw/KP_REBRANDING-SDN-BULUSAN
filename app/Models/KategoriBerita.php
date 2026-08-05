<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['nama', 'slug'])]
class KategoriBerita extends Model
{
    protected $table = 'kategori_berita';

    public function berita()
    {
        return $this->hasMany(Berita::class, 'kategori_berita_id');
    }
}
