<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable([
    'nama',
    'email',
    'no_kontak',
    'jenis',
    'subjek',
    'isi_pesan',
    'status_penanganan',
    'ditangani_oleh'
])]
class KontakPengaduan extends Model
{
    protected $table = 'kontak_pengaduan';

    public function petugas()
    {
        return $this->belongsTo(User::class, 'ditangani_oleh');
    }
}
