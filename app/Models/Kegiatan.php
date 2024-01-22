<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;

    protected $table = 'kegiatan';

    protected $guarded = ['id'];

    public function mahasiswa()
    {
        return $this->belongsToMany(Mahasiswa::class)->withPivot('va', 'nominal', 'status');
    }
}
