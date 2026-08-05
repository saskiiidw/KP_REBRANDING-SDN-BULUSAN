<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable([
    'penulis_id',
    'nama_kegiatan',
    'deskripsi',
    'tanggal_mulai',
    'tanggal_selesai'
])]
class Agenda extends Model
{
    protected $table = 'agenda';

    protected function casts(): array
    {
        return [
            'tanggal_mulai' => 'date',
            'tanggal_selesai' => 'date',
        ];
    }

    public function penulis()
    {
        return $this->belongsTo(User::class, 'penulis_id');
    }
}
