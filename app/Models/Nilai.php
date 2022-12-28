<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;

    protected $table = 'nilai';

    protected $guarded = ['id'];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'nim', 'nim');
    }

    public function jurusan()
    {
        return $this->belongsTo(jurusan::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['semester'] ?? false, function ($query, $semester) {
            return $query->where(function ($query) use ($semester) {
                $query->where('semester', $semester);
            });
        });

        $query->when($filters['nim'] ?? false, function ($query, $nim) {
            return $query->where(function ($query) use ($nim) {
                $query->where('nim', $nim);
            });
        });

        $query->when($filters['mk'] ?? false, function ($query, $mk) {
            return $query->where(function ($query) use ($mk) {
                $query->where('mata_kuliah', 'like', '%' . $mk . '%');
            });
        });

        $query->when($filters['jurusan'] ?? false, fn ($query, $jurusan) =>
            $query->whereHas('mahasiswa', fn ($query) =>
                $query->whereHas('jurusan', fn ($query) =>
                    $query->where('jurusan_id', $jurusan)
                )
            )
        );

        $query->when($filters['nama'] ?? false, fn ($query, $nama) =>
            $query->whereHas('mahasiswa', fn ($query) =>
                $query->where('nama', 'like', '%' . $nama . '%')
            )
        );
    }
}
