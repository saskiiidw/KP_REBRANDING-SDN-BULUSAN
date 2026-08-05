<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['nama_tingkat'])]
class TingkatPrestasi extends Model
{
    protected $table = 'tingkat_prestasi';

    public function prestasi()
    {
        return $this->hasMany(Prestasi::class, 'tingkat_prestasi_id');
    }
}
