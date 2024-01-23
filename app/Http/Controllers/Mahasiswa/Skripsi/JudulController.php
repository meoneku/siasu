<?php

namespace App\Http\Controllers\Mahasiswa\Skripsi;

use App\Http\Controllers\Controller;
use App\Models\Skripsi;
use App\Models\Batch;
use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JudulController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('mahasiswa.skripsi.judul.index', [
            'title'         => 'Pendaftaran Judul Skripsi',
            'menu'          => 'skripsi.judul',
            'breadcumbs'    => array(['judul' => 'Beranda', 'link' => route('mahasiswa.beranda')], ['judul' => 'Daftar Judul', 'link' => '']),
            'skripsis'      => Skripsi::with('mahasiswa')->with('batch')->where('mahasiswa_id', Auth::guard('mahasiswa')->user()->id )->filter(request(['judul']))->latest()->paginate(10)->withQueryString()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $now = date('Y-m-d');
        $batch = Batch::where('kegiatan_id', 4)->whereRaw('? between mulai and selesai', $now)->first();

        return view('mahasiswa.skripsi.judul.create', [
            'title'         => 'Pendaftaran Judul Skripsi',
            'menu'          => 'skripsi.judul',
            'breadcumbs'    => array(['judul' => 'Beranda', 'link' => route('mahasiswa.beranda')], ['judul' => 'List Judul', 'link' => route('judul.index')], ['judul' => 'Daftar Judul', 'link' => '']),
            'batch'         => $batch
        ]);
    }

    /**
     * Store a newly created resource in storage.
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
        return redirect(route('judul.index'))->with('success', 'Data Telah Tersimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Skripsi $judul)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($judul)
    {
        $id = decrypt($judul);
        $data = Skripsi::findOrFail($id);

        return view('mahasiswa.skripsi.judul.edit', [
            'title'         => 'Pendaftaran Judul Skripsi',
            'menu'          => 'skripsi.judul',
            'breadcumbs'    => array(['judul' => 'Beranda', 'link' => route('mahasiswa.beranda')], ['judul' => 'List Judul', 'link' => route('judul.index')], ['judul' => 'Edit Judul', 'link' => '']),
            'data'          => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($judul, Request $request)
    {
        $id = decrypt($judul);

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

        Skripsi::where('id', $id)
            ->update($validateData);
        return redirect($request->redirect_to)->with('success', 'Data Berhasil Di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Skripsi $judul)
    {
        //
    }

    public function cetakForm($id)
    {
        $id = decrypt($id);
        $skripsi = Skripsi::findOrFail($id);

        return view('dashboard.skripsi.daftar.form', [
            'skripsi'       => $skripsi,
            'kaprodi'       => Dosen::where('jabatan', 'Kaprodi')->where('jurusan_id', $skripsi->mahasiswa->jurusan->id)->first(),
        ]);
    }

    public function cetakFormBimb($id)
    {
        $id = decrypt($id);
        $skripsi = Skripsi::findOrFail($id);

        if ($skripsi->status != 5) {
            return redirect(route('judul.index'))->with('success', 'Error 501');
        }

        return view('dashboard.skripsi.daftar.bimbingan', [
            'skripsi'       => $skripsi
        ]);
    }

    public function cetakSurat($id)
    {
        $id = decrypt($id);
        $skripsi = Skripsi::findOrFail($id);

        if ($skripsi->status != 5) {
            return redirect(route('judul.index'))->with('success', 'Error 501');
        }

        return view('dashboard.skripsi.daftar.penugasan', [
            'skripsi'       => $skripsi,
            'kaprodi'       => Dosen::where('jurusan_id', $skripsi->mahasiswa->jurusan_id)->where('jabatan', 'Kaprodi')->first()
        ]);
    }
}
