<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['nama_layanan', 'url', 'ikon', 'urutan', 'is_eksternal'])]
class TautanLayanan extends Model
{
    protected $table = 'tautan_layanan';

    protected function casts(): array
    {
        return [
            'is_eksternal' => 'boolean',
        ];
    }
}
