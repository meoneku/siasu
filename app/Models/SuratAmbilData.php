<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suratambildata extends Model
{
    use HasFactory;

    protected $table = 'surat_ambildata';

    protected $guarded = ['id'];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function surat()
    {
        return $this->hasOne(Surat::class, 'no_surat', 'no_surat')->withDefault(['created_at' => date('Y-m-d')]);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when(
            $filters['nama'] ?? false,
            fn ($query, $nama) =>
            $query->whereHas(
                'mahasiswa',
                fn ($query) =>
                $query->where('nama', 'like', '%' . $nama . '%')
            )
        );

        $query->when(
            $filters['jurusan'] ?? false,
            fn ($query, $jurusan) =>
            $query->whereHas(
                'mahasiswa',
                fn ($query) =>
                $query->whereHas(
                    'jurusan',
                    fn ($query) =>
                    $query->where('jurusan_id', $jurusan)
                )
            )
        );

        $query->when($filters['lembaga'] ?? false, function ($query, $lembaga) {
            return $query->where(function ($query) use ($lembaga) {
                $query->where('lembaga', 'like', '%' . $lembaga . '%');
            });
        });
    }
}
