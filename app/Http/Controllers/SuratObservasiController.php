<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Suratobservasi;
use Illuminate\Http\Request;

class SuratObservasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.surat.observasi.index', [
            'title'     => 'Mahasiswa | Data Pemohon Observasi',
            'observasi' => Suratobservasi::with('mahasiswa')->filter(request(['nama', 'jurusan', 'lembaga']))->latest()->paginate(10)->withQueryString(),
            'jurusan'   => Jurusan::all()
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
            'lembaga'           => 'required',
            'alamat'            => 'required',
            'kecamatan'         => 'required',
            'kabupaten'         => 'required',
            'provinsi'          => 'required',
            'mahasiswa_id'      => 'required',
            'judul_skripsi'     => 'required'
        ]);

        Suratobservasi::create($validateData);

        return redirect($request->redirect_to)->with('success', 'Terimakasih, data permohonan akan di verifikasi terlebih dahulu');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Suratoservasi  $suratoservasi
     * @return \Illuminate\Http\Response
     */
    public function show(Suratobservasi $suratoservasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Suratoservasi  $suratoservasi
     * @return \Illuminate\Http\Response
     */
    public function edit(Suratobservasi $suratoservasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Suratoservasi  $suratoservasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Suratobservasi $suratoservasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Suratoservasi  $suratoservasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Suratobservasi $suratoservasi)
    {
        //
    }
}
