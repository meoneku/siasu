<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventaris extends Model
{
    use HasFactory;

    protected $table = 'inventaris';

    protected $guarded = ['id'];

    public function jenis()
    {
        return $this->belongsTo(JenisInventaris::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['nama_barang'] ?? false, function ($query, $nama) {
            return $query->where(function ($query) use ($nama) {
                $query->where('nama_barang', 'like', '%' . $nama . '%');
            });
        });

        $query->when($filters['kondisi'] ?? false, function ($query, $kondisi) {
            return $query->where(function ($query) use ($kondisi) {
                $query->where('kondisi', $kondisi);
            });
        });

        $query->when($filters['tahun'] ?? false, function ($query, $tahun) {
            return $query->where(function ($query) use ($tahun) {
                $query->where('tahun', $tahun);
            });
        });

        $query->when($filters['penempatan'] ?? false, function ($query, $penempatan) {
            return $query->where(function ($query) use ($penempatan) {
                $query->where('penempatan', $penempatan);
            });
        });
    }
}
