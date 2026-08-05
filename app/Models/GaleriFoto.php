<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['album_galeri_id', 'caption', 'path_foto'])]
class GaleriFoto extends Model
{
    protected $table = 'galeri_foto';

    public function album()
    {
        return $this->belongsTo(AlbumGaleri::class, 'album_galeri_id');
    }
}
