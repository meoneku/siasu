<?php

namespace App\Http\Controllers;

use App\Helpers\ESurat;
use App\Models\Jurusan;
use App\Models\Dosen;
use App\Models\Surat;
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
        return view('dashboard.surat.observasi.create', [
            'title'     => 'Mahasiswa | Data Pemohon Observasi',
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
    public function show(Suratobservasi $suratobservasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Suratoservasi  $suratoservasi
     * @return \Illuminate\Http\Response
     */
    public function edit(Suratobservasi $suratobservasi)
    {
        return view('dashboard.surat.observasi.edit', [
            'title'     => 'Mahasiswa | Data Pemohon Observasi',
            'surat'     => $suratobservasi
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Suratoservasi  $suratoservasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Suratobservasi $suratobservasi)
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

        Suratobservasi::where('id', $suratobservasi->id)
            ->update($validateData);

        return redirect($request->redirect_to)->with('success', 'Status Telah Dirubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Suratoservasi  $suratoservasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Suratobservasi $suratobservasi, Request $request)
    {
        Suratobservasi::destroy($suratobservasi->id);
        return redirect($request->redirect_to)->with('success', 'Data Berhasil Di Hapus');
    }

    public function status(Request $request, Suratobservasi $suratobservasi)
    {
        $nosurat = "";
        if ($request->datastatus == 1) {
            $nosurat = ESurat::makeNomorSurat($suratobservasi->mahasiswa->jurusan_id, $suratobservasi->mahasiswa->jurusan->singkatan, $suratobservasi->mahasiswa->jurusan->kode_surat);
            $data = [
                'no_surat'      => $nosurat,
                'jurusan_id'    => $suratobservasi->mahasiswa->jurusan_id,
                'jenis_surat'   => 'Surat Izin Observasi',
                'tahun'         => date('Y')
            ];
            Surat::create($data);
        }

        $dataU = [
            'status'        => $request->datastatus,
            'no_surat'      => $nosurat
        ];

        Suratobservasi::where('id', $suratobservasi->id)->update($dataU);
        return redirect($request->redirect_to)->with('success', 'Status Telah Dirubah');
    }

    public function cetak(Suratobservasi $suratobservasi)
    {
        return view('dashboard.surat.observasi.surat', [
            'surat'     => $suratobservasi,
            'kaprodi'   => Dosen::where('jurusan_id', $suratobservasi->mahasiswa->jurusan_id)->where('jabatan', 'Kaprodi')->first()
        ]);
    }
}
