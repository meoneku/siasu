<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skripsi extends Model
{
    use HasFactory;

    protected $table    = 'skripsi';
    protected $guarded  = ['id'];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class)->withDefault(['nama' => 'Tidak Terdefinisi']);
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class)->withDefault(['nama' => '']);
    }

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }

    public function surat()
    {
        return $this->hasOne(Surat::class,'no_surat','no_surat')->withDefault(['created_at' => date('Y-m-d')]);
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
            $filters['batch'] ?? false,
            fn ($query, $batch) =>
            $query->whereHas(
                'batch',
                fn ($query) =>
                $query->where('batch_id', $batch)
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
    }
}
