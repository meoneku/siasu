<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Batch;

class IndexController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function skripsi()
    {
        $now = date('Y-m-d');
        $batch = Batch::where('kegiatan_id', 4)->whereRaw('? between mulai and selesai', $now)->first();
        return view('skripsi', [
            'batch'     => $batch
        ]);
    }

    public function seminar()
    {
        $now = date('Y-m-d');
        $batch = Batch::where('kegiatan_id', 5)->whereRaw('? between mulai and selesai', $now)->first();
        return view('seminar', [
            'batch'     => $batch
        ]);
    }
}
