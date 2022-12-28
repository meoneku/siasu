<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lulusan extends Model
{
    use HasFactory;

    protected $table = 'lulusan';

    protected $guarded = ['id'];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['nama'] ?? false, function ($query, $nama) {
            return $query->where(function ($query) use ($nama) {
                $query->where('nama', 'like', '%' . $nama . '%');
            });
        });

        $query->when($filters['tahun'] ?? false, function ($query, $tahun) {
            return $query->whereYear('tanggal_lulus', $tahun);
        });

        $query->when($filters['jurusan'] ?? false, fn ($query, $jurusan) =>
            $query->whereHas('jurusan', fn ($query) =>
                $query->where('jurusan_id', $jurusan)
            )
        );
    }
}
