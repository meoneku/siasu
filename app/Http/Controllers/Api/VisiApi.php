<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use App\Models\Visi;

class VisiApi extends Controller
{
    public function makeSlug(Request $request)
    {
        $slug = SlugService::createSlug(Visi::class, 'slug', $request->nm_menu);
        return response()->json(['slug' => $slug]);
    }
}
