<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Skripsi;
use Illuminate\Http\Request;
use App\Models\Jurusan;

class SkripsiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.skripsi.daftar.index', [
            'title'     => 'Mahasiswa | Data Pendaftar Skripsi',
            'skripsi'   => Skripsi::with('mahasiswa')->with('batch')->filter(request(['nama', 'jurusan', 'batch']))->paginate(10)->withQueryString(),
            'jurusan'   => Jurusan::all(),
            'batchs'    => Batch::latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.skripsi.daftar.create', [
            'title'     => 'Mahasiswa | Data Pendaftar Skripsi',
            'batchs'    => Batch::all()
        ]);
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
            'nomor_handphone'   => 'required',
            'email'             => 'required',
            'sks'               => 'required',
            'ipk'               => 'required',
            'batch_id'          => 'required'
        ]);

        // $validateData['tanggal_daftar'] = date('Y-m-d');

        Skripsi::create($validateData);
        return redirect($request->redirect_to)->with('success', 'Data Berhasil Di Simpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Skripsi  $skripsi
     * @return \Illuminate\Http\Response
     */
    public function show(Skripsi $skripsi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Skripsi  $skripsi
     * @return \Illuminate\Http\Response
     */
    public function edit(Skripsi $skripsi)
    {
        return view('dashboard.skripsi.daftar.edit', [
            'title'     => 'Mahasiswa | Data Pendaftar Skripsi',
            'batchs'    => Batch::all(),
            'skripsi'   => $skripsi
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Skripsi  $skripsi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Skripsi $skripsi)
    {
        $validateData   = $request->validate([
            'mahasiswa_id'      => 'required',
            'judul_skripsi'     => 'required',
            'lokasi_penelitian' => 'required',
            'nomor_handphone'   => 'required',
            'email'             => 'required',
            'sks'               => 'required',
            'ipk'               => 'required',
            'batch_id'          => 'required'
        ]);

        // $validateData['tanggal_daftar'] = date('Y-m-d');

        Skripsi::where('id', $skripsi->id)
            ->update($validateData);
        return redirect($request->redirect_to)->with('success', 'Data Berhasil Di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Skripsi  $skripsi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Skripsi $skripsi, Request $request)
    {
        Skripsi::destroy($skripsi->id);
        return redirect($request->redirect_to)->with('success', 'Data Berhasil Di Hapus');
    }
}
