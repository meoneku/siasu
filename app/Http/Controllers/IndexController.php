<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Batch;
use App\Models\Jurusan;

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

    public function semhas()
    {
        $now = date('Y-m-d');
        $batch = Batch::where('kegiatan_id', 6)->whereRaw('? between mulai and selesai', $now)->first();
        return view('semhas', [
            'batch'     => $batch
        ]);
    }

    public function kppi()
    {
        $now = date('Y-m-d');
        $batch = Batch::where('kegiatan_id', 1)->whereRaw('? between mulai and selesai', $now)->first();
        return view('kppi', [
            'batch'     => $batch
        ]);
    }

    public function suratpi()
    {
        return view('suratpi', [
            'jurusan'      => Jurusan::all()
        ]);
    }
}
