<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Jurusan;
use App\Models\Kppi;
use Illuminate\Http\Request;

class PiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.kppi.index', [
            'title'     => 'Mahasiswa | Data Praktik Industri / Kerja Praktik',
            'kppi'      => Kppi::with('mahasiswa')->with('batch')->filter(request(['nama', 'jurusan', 'batch']))->latest()->paginate(10)->withQueryString(),
            'jurusan'   => Jurusan::all(),
            'batchs'    => Batch::where('kegiatan_id', 1)->latest()->limit(5)->get()
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
        $validateData = $request->validate([
            'mahasiswa_id'      => 'required',
            'lokasi'            => 'required',
            'alamat'            => 'required',
            'hp'                => 'required',
            'email'             => 'required',
            'mulai'             => 'required',
            'selesai'           => 'required',
            'batch_id'          => 'required'
        ]);

        Kppi::create($validateData);
        return redirect($request->redirect_to)->with('success', 'Terimakasih telah melakukan pendaftaran Praktik Industri/Kerja Praktik, data pendaftaran akan di verifikasi terlebih dahulu');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kppi  $kppi
     * @return \Illuminate\Http\Response
     */
    public function show(Kppi $kppi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kppi  $kppi
     * @return \Illuminate\Http\Response
     */
    public function edit(Kppi $kppi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kppi  $kppi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kppi $kppi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kppi  $kppi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kppi $kppi)
    {
        //
    }
}
