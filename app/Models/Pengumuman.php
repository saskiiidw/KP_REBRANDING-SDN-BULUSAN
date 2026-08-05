<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable([
    'penulis_id',
    'judul',
    'slug',
    'konten',
    'status',
    'tanggal_terbit',
    'tanggal_berakhir'
])]
class Pengumuman extends Model
{
    protected $table = 'pengumuman';

    protected function casts(): array
    {
        return [
            'tanggal_terbit' => 'date',
            'tanggal_berakhir' => 'date',
        ];
    }

    public function penulis()
    {
        return $this->belongsTo(User::class, 'penulis_id');
    }

    public function lampiran()
    {
        return $this->hasMany(LampiranPengumuman::class, 'pengumuman_id');
    }
}
