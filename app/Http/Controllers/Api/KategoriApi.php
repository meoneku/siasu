<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use App\Models\Kategori;

class KategoriApi extends Controller
{
    public function makeSlug(Request $request)
    {
        $slug = SlugService::createSlug(Kategori::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }
}
