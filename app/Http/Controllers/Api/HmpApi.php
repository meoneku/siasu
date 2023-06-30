<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;
use App\Models\Hmp;

class HmpApi extends Controller
{
    public function makeSlug(Request $request)
    {
        $slug = SlugService::createSlug(Hmp::class, 'slug', $request->nm_menu);
        return response()->json(['slug' => $slug]);
    }
}
