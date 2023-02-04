<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Dosen;
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
            'title'     => 'Mahasiswa | Data Praktik Industri/Kerja Praktik',
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
        return view('dashboard.kppi.create', [
            'title'     => 'Mahasiswa | Data Praktik Industri/Kerja Praktik',
            'batchs'    => Batch::where('kegiatan_id', 1)->get()
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
        return view('dashboard.kppi.edit', [
            'title'     => 'Mahasiswa | Data Praktik Industri/Kerja Praktik',
            'batchs'    => Batch::where('kegiatan_id', 1)->get(),
            'kppi'      => $kppi
        ]);
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

        Kppi::where('id', $kppi->id)
            ->update($validateData);
        return redirect($request->redirect_to)->with('success', 'Data Sudah Berhasil Di Rubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kppi  $kppi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kppi $kppi, Request $request)
    {
        Kppi::destroy($kppi->id);
        return redirect($request->redirect_to)->with('success', 'Data Berhasil Di Hapus');
    }

    public function formulir(Kppi $kppi)
    {
        return view('dashboard.kppi.formulir', [
            'kppi'      => $kppi,
            'kaprodi'   => Dosen::where('jurusan_id', $kppi->mahasiswa->jurusan_id)->where('jabatan', 'Kaprodi')->first()
        ]);
    }

    public function status(Kppi $kppi)
    {
        return view('dashboard.kppi.status', [
            'title'     => 'Mahasiswa | Data Praktik Industri/Kerja Praktik',
            'kppi'      => $kppi
        ]);
    }

    public function updateStatus(Kppi $kppi, Request $request)
    {
        $validateData   = $request->validate([
            'status'        => 'required',
            'keterangan'    => ''
        ]);

        Kppi::where('id', $kppi->id)
            ->update($validateData);
        return redirect($request->redirect_to)->with('success', 'Status Sudah Berhasil Di Rubah');
    }
}
