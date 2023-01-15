<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    use HasFactory;

    protected $table = 'batch';

    protected $guarded = ['id'];

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['nama'] ?? false, function ($query, $nama) {
            return $query->where(function ($query) use ($nama) {
                $query->where('nama', 'like', '%' . $nama . '%');
            });
        });

        $query->when($filters['tahun'] ?? false, function ($query, $tahun) {
            return $query->where(function ($query) use ($tahun) {
                $query->where('tahun', $tahun);
            });
        });
    }
}
