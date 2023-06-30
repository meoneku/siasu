<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;
use App\Models\Profil;

class ProfilApi extends Controller
{
    public function makeSlug(Request $request)
    {
        $slug = SlugService::createSlug(Profil::class, 'slug', $request->nm_menu);
        return response()->json(['slug' => $slug]);
    }
}
