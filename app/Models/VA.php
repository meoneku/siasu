<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VA extends Model
{
    use HasFactory;

    protected $table = 'virtual_account';

    protected $guarded = ['id'];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class);
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
            $filters['kegiatan'] ?? false,
            fn ($query, $kegiatan) =>
            $query->whereHas(
                'kegiatan',
                fn ($query) =>
                $query->where('kegiatan_id', $kegiatan)
            )
        );

        $query->when(
            $filters['jurusan'] ?? false,
            fn ($query, $jurusan) => $query->whereHas(
                'mahasiswa',
                fn ($query) => $query->whereHas(
                    'jurusan',
                    fn ($query) => $query->where('jurusan_id', $jurusan)
                )
            )
        );
    }
}
