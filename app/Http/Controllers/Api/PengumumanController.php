<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use App\Models\Pengumuman;


class PengumumanController extends Controller
{
    public function makeSlug(Request $request)
    {
        $slug = SlugService::createSlug(Pengumuman::class, 'slug', $request->judul);
        return response()->json(['slug' => $slug]);
    }
}
