<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    protected $table = 'dosen';

    protected $guarded = ['id'];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    public function seminar()
    {
        return $this->belongsToMany(Seminar::class);
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
