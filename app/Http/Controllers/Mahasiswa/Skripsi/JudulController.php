<?php

namespace App\Http\Controllers\Mahasiswa\Skripsi;

use App\Http\Controllers\Controller;
use App\Models\Skripsi;
use App\Models\Batch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JudulController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('mahasiswa.skripsi.judul.index', [
            'title'         => 'Pendaftaran Judul Skripsi',
            'breadcumbs'    => array(['judul' => 'Beranda', 'link' => route('mahasiswa.beranda')], ['judul' => 'Daftar Judul', 'link' => '']),
            'skripsis'      => Skripsi::with('mahasiswa')->with('batch')->where('mahasiswa_id', Auth::guard('mahasiswa')->user()->id )->filter(request(['judul']))->latest()->paginate(10)->withQueryString()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $now = date('Y-m-d');
        $batch = Batch::where('kegiatan_id', 4)->whereRaw('? between mulai and selesai', $now)->first();

        return view('mahasiswa.skripsi.judul.create', [
            'title'         => 'Pendaftaran Judul Skripsi',
            'breadcumbs'    => array(['judul' => 'Beranda', 'link' => route('mahasiswa.beranda')], ['judul' => 'List Judul', 'link' => route('judul.index')], ['judul' => 'Daftar Judul', 'link' => '']),
            'batch'         => $batch
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Skripsi $skripsi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Skripsi $skripsi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Skripsi $skripsi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Skripsi $skripsi)
    {
        //
    }
}
