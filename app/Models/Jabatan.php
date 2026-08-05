<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['nama_jabatan'])]
class Jabatan extends Model
{
    protected $table = 'jabatan';

    public function guru()
    {
        return $this->hasMany(Guru::class, 'jabatan_id');
    }
}
