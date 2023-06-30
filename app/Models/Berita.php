<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Berita extends Model
{
    use HasFactory, Sluggable;

    protected $table = 'berita';

    protected $guarded = ['id'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'judul'
            ]
        ];
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class)->withDefault(['kategori' => 'Deleted',]);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['judul'] ?? false, function ($query, $judul) {
            return $query->where(function ($query) use ($judul) {
                $query->where('judul', 'like', '%' . $judul . '%');
            });
        });

        $query->when(
            $filters['kategori'] ?? false,
            function ($query, $kategori) {
                return $query->whereHas('kategori', function ($query) use ($kategori) {
                    return $query->where('slug', $kategori);
                });
            }
        );
    }
}
