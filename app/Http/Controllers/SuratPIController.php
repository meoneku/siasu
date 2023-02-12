<?php

namespace App\Http\Controllers;

use App\Helpers\ESurat;
use App\Models\Dosen;
use App\Models\Jurusan;
use App\Models\Surat;
use App\Models\Suratpi;
use Illuminate\Http\Request;

class SuratPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.surat.pi.index', [
            'title'     => 'Mahasiswa | Data Pemohon Surat PI/KP',
            'suratpi'   => Suratpi::with('jurusan')->filter(request(['tempat', 'jurusan']))->latest()->paginate(10)->withQueryString(),
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
        return view('dashboard.surat.pi.create', [
            'title'     => 'Mahasiswa | Data Pemohon Surat PI/KP',
            'jurusan'   => Jurusan::all()
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
            'tempat'            => 'required',
            'alamat'            => 'required',
            'kecamatan'         => 'required',
            'kabupaten'         => 'required',
            'provinsi'          => 'required',
            'mulai_tanggal'     => 'required',
            'selesai_tanggal'   => 'required',
            'jurusan_id'        => 'required'
        ]);

        $suratpi = Suratpi::create($validateData);
        $suratpi->mahasiswa()->sync($request->mahasiswa_id);

        return redirect($request->redirect_to)->with('success', 'Terimakasih, data permohonan akan di verifikasi terlebih dahulu');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Suratpi  $suratpi
     * @return \Illuminate\Http\Response
     */
    public function show(Suratpi $suratpi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Suratpi  $suratpi
     * @return \Illuminate\Http\Response
     */
    public function edit(Suratpi $suratpi)
    {
        return view('dashboard.surat.pi.edit', [
            'title'     => 'Mahasiswa | Data Pemohon Surat PI/KP',
            'jurusan'   => Jurusan::all(),
            'suratpi'   => $suratpi
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Suratpi  $suratpi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Suratpi $suratpi)
    {
        $validateData   = $request->validate([
            'tempat'            => 'required',
            'alamat'            => 'required',
            'kecamatan'         => 'required',
            'kabupaten'         => 'required',
            'provinsi'          => 'required',
            'mulai_tanggal'     => 'required',
            'selesai_tanggal'   => 'required',
            'jurusan_id'        => 'required'
        ]);

        $pisurat = Suratpi::where('id', $suratpi->id)
            ->update($validateData);
        $pisurat->mahasiswa()->sync($request->mahasiswa_id);

        return redirect($request->redirect_to)->with('success', 'Data Sudah Berhasil Di Rubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Suratpi  $suratpi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Suratpi $suratpi, Request $request)
    {
        Suratpi::destroy($suratpi->id);
        Suratpi::find($suratpi->id)->mahasiswa()->detach();
        return redirect($request->redirect_to)->with('success', 'Data Berhasil Di Hapus');
    }

    public function status(Request $request, Suratpi $suratpi)
    {
        $nosurat = "";
        if ($request->datastatus == 1) {
            $nosurat = ESurat::makeNomorSurat($suratpi->jurusan_id, $suratpi->jurusan->singkatan, $suratpi->jurusan->kode_surat);
            $data = [
                'no_surat'      => $nosurat,
                'jurusan_id'    => $suratpi->jurusan_id,
                'jenis_surat'   => 'Surat Izin Praktik Industri',
                'tahun'         => date('Y')
            ];
            Surat::create($data);
        }

        $dataU = [
            'status'        => $request->datastatus,
            'no_surat'      => $nosurat
        ];

        Suratpi::where('id', $suratpi->id)->update($dataU);
        return redirect($request->redirect_to)->with('success', 'Status Telah Dirubah');
    }

    public function cetak(Suratpi $suratpi)
    {
        return view('dashboard.surat.pi.surat', [
            'surat'     => $suratpi,
            'kaprodi'   => Dosen::where('jurusan_id', $suratpi->jurusan_id)->where('jabatan', 'Kaprodi')->first()
        ]);
    }
}
