<?php

namespace App\Http\Controllers;

use App\Helpers\ESurat;
use App\Models\Dosen;
use App\Models\Jurusan;
use App\Models\Suket;
use App\Models\Surat;
use Illuminate\Http\Request;

class SuketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.surat.suket.index', [
            'title'     => 'Mahasiswa | Data Pemohon Keterangan Aktif',
            'surat'     => Suket::with('mahasiswa')->filter(request(['nama', 'jurusan']))->latest()->paginate(10)->withQueryString(),
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
        return view('dashboard.surat.suket.create', [
            'title'     => 'Mahasiswa | Data Pemohon Keterangan Aktif'
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
            'keperluan'         => 'required',
            'semester'          => 'required',
            'angkatan'          => 'required'
        ]);

        Suket::create($validateData);

        return redirect($request->redirect_to)->with('success', 'Terimakasih, data permohonan akan di verifikasi terlebih dahulu');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Suket  $suket
     * @return \Illuminate\Http\Response
     */
    public function show(Suket $suket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Suket  $suket
     * @return \Illuminate\Http\Response
     */
    public function edit(Suket $suket)
    {
        return view('dashboard.surat.suket.edit', [
            'title'     => 'Mahasiswa | Data Pemohon Keterangan Aktif',
            'surat'     => $suket
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Suket  $suket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Suket $suket)
    {
        $validateData   = $request->validate([
            'mahasiswa_id'      => 'required',
            'keperluan'         => 'required',
            'semester'          => 'required',
            'angkatan'          => 'required'
        ]);

        Suket::where('id', $suket->id)
            ->update($validateData);

        return redirect($request->redirect_to)->with('success', 'Status Telah Dirubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Suket  $suket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Suket $suket, Request $request)
    {
        Suket::destroy($suket->id);
        return redirect($request->redirect_to)->with('success', 'Data Berhasil Di Hapus');
    }

    public function status(Request $request, Suket $suket)
    {
        $nosurat = "";
        if ($request->datastatus == 1) {
            $nosurat = ESurat::makeNomorSurat($suket->mahasiswa->jurusan_id, $suket->mahasiswa->jurusan->singkatan, $suket->mahasiswa->jurusan->kode_surat);
            $data = [
                'no_surat'      => $nosurat,
                'jurusan_id'    => $suket->mahasiswa->jurusan_id,
                'jenis_surat'   => 'Surat Keterangan Aktif Mahasiswa',
                'tahun'         => date('Y')
            ];
            Surat::create($data);
        }

        $dataU = [
            'status'        => $request->datastatus,
            'no_surat'      => $nosurat
        ];

        Suket::where('id', $suket->id)->update($dataU);
        return redirect($request->redirect_to)->with('success', 'Status Telah Dirubah');
    }

    public function cetak(Suket $suket)
    {
        return view('dashboard.surat.suket.surat', [
            'surat'     => $suket,
            'kaprodi'   => Dosen::where('jurusan_id', $suket->mahasiswa->jurusan_id)->where('jabatan', 'Kaprodi')->first()
        ]);
    }
}
