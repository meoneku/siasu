<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suratpi extends Model
{
    use HasFactory;

    protected $table = 'suratpi';

    protected $guarded = ['id'];

    public function mahasiswa()
    {
        return $this->belongsToMany(Mahasiswa::class)->withTimestamps();
    }

    public function surat()
    {
        return $this->hasOne(Surat::class, 'no_surat', 'no_surat')->withDefault(['created_at' => date('Y-m-d')]);
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['tempat'] ?? false, function ($query, $tempat) {
            return $query->where(function ($query) use ($tempat) {
                $query->where('tempat', 'like', '%' . $tempat . '%');
            });
        });

        $query->when(
            $filters['jurusan'] ?? false,
            fn ($query, $jurusan) =>
            $query->whereHas(
                'jurusan',
                fn ($query) =>
                $query->where('jurusan_id', $jurusan)
            )
        );
    }
}
