<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['nama_album', 'deskripsi'])]
class AlbumGaleri extends Model
{
    protected $table = 'album_galeri';

    public function foto()
    {
        return $this->hasMany(GaleriFoto::class, 'album_galeri_id');
    }
}
