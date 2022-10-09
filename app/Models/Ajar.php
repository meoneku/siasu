<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ajar extends Model
{
    use HasFactory;

    protected $table = 'ajar';

    protected $guarded = ['id'];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'niy', 'niy');
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['semester'] ?? false, function ($query, $semester) {
            return $query->where(function ($query) use ($semester) {
                $query->where('semester', $semester);
            });
        });

        $query->when($filters['nama'] ?? false, fn ($query, $nama) =>
            $query->whereHas('dosen', fn ($query) =>
                $query->where('nama', 'like', '%' . $nama . '%')
            )
        );

        $query->when($filters['jurusan'] ?? false, fn ($query, $jurusan) =>
            $query->whereHas('dosen', fn ($query) =>
                $query->whereHas('jurusan', fn ($query) =>
                    $query->where('jurusan_id', $jurusan)
                )
            )
        );
    }
}
