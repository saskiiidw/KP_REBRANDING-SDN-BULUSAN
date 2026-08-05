<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['pengumuman_id', 'nama_lampiran', 'path_file'])]
class LampiranPengumuman extends Model
{
    protected $table = 'lampiran_pengumuman';

    public function pengumuman()
    {
        return $this->belongsTo(Pengumuman::class, 'pengumuman_id');
    }
}
