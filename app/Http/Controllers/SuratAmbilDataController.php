<?php

namespace App\Http\Controllers;

use App\Models\SuratAmbilData;
use Illuminate\Http\Request;

class SuratAmbilDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        dd($request->all());

        $validateData   = $request->validate([
            'lembaga'           => 'required',
            'alamat'            => 'required',
            'kecamatan'         => 'required',
            'kabupaten'         => 'required',
            'provinsi'          => 'required',
            'mahasiswa_id'      => 'required',
            'judul_skripsi'     => 'required',
            'kebutuhan'         => 'required'
        ]);

        SuratAmbilData::create($validateData);

        return redirect($request->redirect_to)->with('success', 'Terimakasih, data permohonan akan di verifikasi terlebih dahulu');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SuratAmbilData  $suratAmbilData
     * @return \Illuminate\Http\Response
     */
    public function show(SuratAmbilData $suratAmbilData)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SuratAmbilData  $suratAmbilData
     * @return \Illuminate\Http\Response
     */
    public function edit(SuratAmbilData $suratAmbilData)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SuratAmbilData  $suratAmbilData
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SuratAmbilData $suratAmbilData)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SuratAmbilData  $suratAmbilData
     * @return \Illuminate\Http\Response
     */
    public function destroy(SuratAmbilData $suratAmbilData)
    {
        //
    }
}
