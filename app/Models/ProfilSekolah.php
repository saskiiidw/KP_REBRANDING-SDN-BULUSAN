<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable([
    'nama_sekolah',
    'npsn',
    'nss',
    'akreditasi',
    'alamat',
    'email',
    'telepon',
    'jam_kerja',
    'nama_kepsek',
    'nip_kepsek',
    'sambutan_kepsek',
    'foto_kepsek',
    'visi',
    'misi',
    'sejarah',
    'struktur_organisasi'
])]
class ProfilSekolah extends Model
{
    protected $table = 'profil_sekolah';

    protected function casts(): array
    {
        return [
            'jam_kerja' => 'array',
        ];
    }
}
