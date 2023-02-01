<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Jurusan;
use App\Models\Semhas;
use Illuminate\Http\Request;

class SemhasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.skripsi.seminar.index', [
            'title'     => 'Mahasiswa | Data Seminar Skripsi',
            'seminar'   => Semhas::with('mahasiswa')->with('batch')->filter(request(['nama', 'jurusan', 'batch']))->latest()->paginate(10)->withQueryString(),
            'jurusan'   => Jurusan::all(),
            'batchs'    => Batch::where('kegiatan_id', 6)->latest()->limit(5)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData   = $request->validate([
            'mahasiswa_id'      => 'required',
            'judul_skripsi'     => 'required',
            'lokasi_penelitian' => 'required',
            'batch_id'          => 'required'
        ]);

        Semhas::create($validateData);
        return redirect($request->redirect_to)->with('success', 'Terimakasih telah melakukan pendaftaran Seminar Hasil, data pendaftaran akan di verifikasi terlebih dahulu');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UjianSkripsi  $ujianSkripsi
     * @return \Illuminate\Http\Response
     */
    public function show(Semhas $semhas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UjianSkripsi  $ujianSkripsi
     * @return \Illuminate\Http\Response
     */
    public function edit(Semhas $semhas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UjianSkripsi  $ujianSkripsi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Semhas $semhas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UjianSkripsi  $ujianSkripsi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Semhas $semhas)
    {
        //
    }
}
