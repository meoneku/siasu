<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Codes;

class UjiController extends Controller
{
    public function index(Request $request)
    {
        echo ltrim('011', '0');
    }
}
