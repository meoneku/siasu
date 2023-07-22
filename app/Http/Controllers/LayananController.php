<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LayananController extends Controller
{
    public function login()
    {
        return view('layanan.login');
    }

    public function aktivasi()
    {
        return view('layanan.aktivasi');
    }
}
