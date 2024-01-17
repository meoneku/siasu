<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticate;

class Mahasiswa extends Authenticate
{
    use HasFactory;

    protected $table = 'mahasiswa';

    protected $guarded = ['id'];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    public function kegiatan()
    {
        return $this->belongsToMany(Kegiatan::class)->withPivot('va', 'status');
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['nama'] ?? false, function ($query, $nama) {
            return $query->where(function ($query) use ($nama) {
                $query->where('nama', 'like', '%' . $nama . '%');
            });
        });

        $query->when($filters['jurusan'] ?? false, fn ($query, $jurusan) =>
            $query->whereHas('jurusan', fn ($query) =>
                $query->where('jurusan_id', $jurusan)
            )
        );
    }
}
