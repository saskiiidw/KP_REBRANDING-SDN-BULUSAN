<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['judul', 'url_video'])]
class GaleriVideo extends Model
{
    protected $table = 'galeri_video';
}
