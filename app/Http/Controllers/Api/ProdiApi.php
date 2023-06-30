<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;
use App\Models\Prodi;

class ProdiApi extends Controller
{
    public function makeSlug(Request $request)
    {
        $slug = SlugService::createSlug(Prodi::class, 'slug', $request->nm_menu);
        return response()->json(['slug' => $slug]);
    }
}
