<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;
use App\Models\Kemahasiswaan;

class KemahasiswaanApi extends Controller
{
    public function makeSlug(Request $request)
    {
        $slug = SlugService::createSlug(Kemahasiswaan::class, 'slug', $request->nm_menu);
        return response()->json(['slug' => $slug]);
    }
}
