<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Pengumuman extends Model
{
    use HasFactory, Sluggable;

    protected $table = 'pengumuman';

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

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['judul'] ?? false, function ($query, $judul) {
            return $query->where(function ($query) use ($judul) {
                $query->where('judul', 'like', '%' . $judul . '%');
            });
        });
    }
}
