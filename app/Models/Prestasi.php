<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable([
    'tingkat_prestasi_id',
    'nama_siswa',
    'lomba',
    'peringkat',
    'tahun',
    'foto',
    'deskripsi'
])]
class Prestasi extends Model
{
    protected $table = 'prestasi';

    public function tingkat()
    {
        return $this->belongsTo(TingkatPrestasi::class, 'tingkat_prestasi_id');
    }
}
