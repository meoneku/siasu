<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Skripsi;
use App\Models\Batch;
use App\Models\Jurusan;
use App\Models\Semhas;
use App\Models\Seminar;

class LaporanController extends Controller
{
    public function indexSkripsi()
    {
        return view('dashboard.laporan.skripsi.index', [
            'title'     => 'Laporan | Pendaftar Judul Skripsi',
            'batch'     => Batch::all(),
            'jurusan'   => Jurusan::all(),
        ]);
    }

    public function viewSkripsi(Request $request)
    {
        return view('dashboard.laporan.skripsi.view', [
            'skripsi'   => Skripsi::with('mahasiswa')->with('batch')->filter(request(['jurusan', 'batch', 'tahun']))->get()
        ]);
    }

    public function viewSeminar(Request $request)
    {
        return view('dashboard.laporan.seminar.view', [
            'seminar'   => Seminar::with('mahasiswa')->with('batch')->filter(request(['jurusan', 'batch']))->get()
        ]);
    }

    public function viewSemhas(Request $request)
    {
        return view('dashboard.laporan.semhas.view', [
            'semhas'   => Semhas::with('mahasiswa')->with('batch')->filter(request(['jurusan', 'batch']))->get()
        ]);
    }
}
