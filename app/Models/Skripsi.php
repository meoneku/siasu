<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skripsi extends Model
{
    use HasFactory;

    protected $table    = 'skripsi';
    protected $guarded  = ['id'];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class)->withDefault(['nama' => 'Tidak Terdefinisi']);
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class)->withDefault(['nama' => 'Dosen Pembimbing Belum Di Set']);
    }
}
