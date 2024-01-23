<?php

namespace App\Http\Controllers\Mahasiswa\Skripsi;

use App\Http\Controllers\Controller;
use App\Models\Seminar;
use App\Models\Batch;
use App\Models\Skripsi;
use App\Models\VA;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SeminarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('mahasiswa.skripsi.seminar.index', [
            'title'         => 'Pendaftaran Seminar Skripsi',
            'menu'          => 'skripsi.seminar',
            'breadcumbs'    => array(['judul' => 'Beranda', 'link' => route('mahasiswa.beranda')], ['judul' => 'Daftar Seminar', 'link' => '']),
            'seminars'      => Seminar::with('mahasiswa')->with('batch')->where('mahasiswa_id', Auth::guard('mahasiswa')->user()->id )->filter(request(['judul']))->latest()->paginate(10)->withQueryString()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $now = date('Y-m-d');
        $batch = Batch::where('kegiatan_id', 4)->whereRaw('? between mulai and selesai', $now)->first();

        return view('mahasiswa.skripsi.seminar.create', [
            'title'         => 'Pendaftaran Seminar Skripsi',
            'menu'          => 'skripsi.seminar',
            'breadcumbs'    => array(['judul' => 'Beranda', 'link' => route('mahasiswa.beranda')], ['judul' => 'List Seminar', 'link' => route('seminar.index')], ['judul' => 'Daftar Seminar', 'link' => '']),
            'batch'         => $batch,
            'skripsi'       => Skripsi::where('mahasiswa_id', Auth::guard('mahasiswa')->user()->id)->first()
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
            'batch_id'          => 'required'
        ]);

        $va = VA::where([['mahasiswa_id', $request->mahasiswa_id], ['kegiatan_id', 5]])->first();
        
        $validateData['va']     = $va->nomor_va;
        $validateData['nominal']= $va->nominal;

        Seminar::create($validateData);
        return redirect(route('seminar.index'))->with('success', 'Data Telah Tersimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Seminar $seminar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Seminar $seminar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Seminar $seminar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Seminar $seminar)
    {
        //
    }
}
