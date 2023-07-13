<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lab;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;

class LabApi extends Controller
{
    public function makeSlug(Request $request)
    {
        $slug = SlugService::createSlug(Lab::class, 'slug', $request->nm_menu);
        return response()->json(['slug' => $slug]);
    }
}
