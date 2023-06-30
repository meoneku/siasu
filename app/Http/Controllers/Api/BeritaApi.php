<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use App\Models\Berita;

class BeritaApi extends Controller
{
    public function makeSlug(Request $request)
    {
        $slug = SlugService::createSlug(Berita::class, 'slug', $request->judul);
        return response()->json(['slug' => $slug]);
    }
}
