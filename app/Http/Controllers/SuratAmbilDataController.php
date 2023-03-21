<?php

namespace App\Http\Controllers;

use App\Helpers\ESurat;
use App\Models\Dosen;
use App\Models\Jurusan;
use App\Models\Surat;
use App\Models\Suratambildata;
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
        return view('dashboard.surat.ambildata.index', [
            'title'     => 'Mahasiswa | Data Pemohon Pengambilan Data',
            'surat'     => Suratambildata::with('mahasiswa')->filter(request(['nama', 'jurusan', 'lembaga']))->latest()->paginate(10)->withQueryString(),
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
        return view('dashboard.surat.ambildata.create', [
            'title'     => 'Mahasiswa | Data Pemohon Pengambilan Data',
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
            'lembaga'           => 'required',
            'alamat'            => 'required',
            'kecamatan'         => 'required',
            'kabupaten'         => 'required',
            'provinsi'          => 'required',
            'mahasiswa_id'      => 'required',
            'judul_skripsi'     => 'required',
            'kebutuhan'         => 'required'
        ]);

        $validateData['kebutuhan'] = implode(';', $request->kebutuhan);

        SuratAmbilData::create($validateData);

        return redirect($request->redirect_to)->with('success', 'Terimakasih, data permohonan akan di verifikasi terlebih dahulu');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SuratAmbilData  $suratAmbilData
     * @return \Illuminate\Http\Response
     */
    public function show(Suratambildata $suratambildata)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SuratAmbilData  $suratAmbilData
     * @return \Illuminate\Http\Response
     */
    public function edit(Suratambildata $suratambildata)
    {
        return view('dashboard.surat.ambildata.edit', [
            'title'     => 'Mahasiswa | Data Pemohon Pengambilan Data',
            'surat'     => $suratambildata,
            'butuh'     => explode(";", $suratambildata->kebutuhan)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SuratAmbilData  $suratAmbilData
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Suratambildata $suratambildata)
    {
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

        Suratambildata::where('id', $suratambildata->id)
            ->update($validateData);

        return redirect($request->redirect_to)->with('success', 'Status Telah Dirubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SuratAmbilData  $suratAmbilData
     * @return \Illuminate\Http\Response
     */
    public function destroy(Suratambildata $suratambildata, Request $request)
    {
        Suratambildata::destroy($suratambildata->id);
        return redirect($request->redirect_to)->with('success', 'Data Berhasil Di Hapus');
    }

    public function status(Request $request, Suratambildata $suratambildata)
    {
        $nosurat = "";
        if ($request->datastatus == 1) {
            $nosurat = ESurat::makeNomorSurat($suratambildata->mahasiswa->jurusan_id, $suratambildata->mahasiswa->jurusan->singkatan, $suratambildata->mahasiswa->jurusan->kode_surat);
            $data = [
                'no_surat'      => $nosurat,
                'jurusan_id'    => $suratambildata->mahasiswa->jurusan_id,
                'jenis_surat'   => 'Surat Izin Observasi',
                'tahun'         => date('Y')
            ];
            Surat::create($data);
        }

        $dataU = [
            'status'        => $request->datastatus,
            'no_surat'      => $nosurat
        ];

        Suratambildata::where('id', $suratambildata->id)->update($dataU);
        return redirect($request->redirect_to)->with('success', 'Status Telah Dirubah');
    }

    public function cetak(Suratambildata $suratambildata)
    {
        return view('dashboard.surat.ambildata.surat', [
            'surat'     => $suratambildata,
            'kaprodi'   => Dosen::where('jurusan_id', $suratambildata->mahasiswa->jurusan_id)->where('jabatan', 'Kaprodi')->first()
        ]);
    }
}
