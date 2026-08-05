<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable([
    'jabatan_id',
    'nama',
    'nip',
    'nuptk',
    'kelas_diampu',
    'foto',
    'status',
    'urutan'
])]
class Guru extends Model
{
    protected $table = 'guru';

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'jabatan_id');
    }
}
