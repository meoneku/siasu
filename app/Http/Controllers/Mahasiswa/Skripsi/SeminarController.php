<?php

namespace App\Http\Controllers\Mahasiswa\Skripsi;

use App\Http\Controllers\Controller;
use App\Models\Seminar;
use App\Models\Batch;
use App\Models\Skripsi;
use App\Models\Dosen;
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
            'seminars'      => Seminar::with('mahasiswa')->with('batch')->where('mahasiswa_id', Auth::guard('mahasiswa')->user()->id)->filter(request(['judul']))->latest()->paginate(10)->withQueryString()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $now = date('Y-m-d');
        $batch = Batch::where('kegiatan_id', 5)->whereRaw('? between mulai and selesai', $now)->first();

        return view('mahasiswa.skripsi.seminar.create', [
            'title'         => 'Pendaftaran Seminar Skripsi',
            'menu'          => 'skripsi.seminar',
            'breadcumbs'    => array(['judul' => 'Beranda', 'link' => route('mahasiswa.beranda')], ['judul' => 'List Seminar', 'link' => route('seminar.index')], ['judul' => 'Daftar Seminar', 'link' => '']),
            'batch'         => $batch,
            'skripsi'       => Skripsi::where([['mahasiswa_id', Auth::guard('mahasiswa')->user()->id], ['status', 5]])->first()
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

        $va = VA::where([['mahasiswa_id', $request->mahasiswa_id], ['kegiatan_id', 5], ['status', 'AKT']])->first();

        if (empty($va)) {
            $validateData['va']     = 'UNDIFINED';
            $validateData['nominal'] = 0;
        } else {
            $validateData['va']     = $va->nomor_va;
            $validateData['nominal'] = $va->nominal;
        }

        Seminar::create($validateData);
        return redirect(route('seminar.index'))->with('success', 'Data Telah Tersimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show($seminar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($seminar)
    {
        $id = decrypt($seminar);
        $data = Seminar::find($id);

        return view('mahasiswa.skripsi.seminar.edit', [
            'title'         => 'Pendaftaran Seminar Skripsi',
            'menu'          => 'skripsi.seminar',
            'breadcumbs'    => array(['judul' => 'Beranda', 'link' => route('mahasiswa.beranda')], ['judul' => 'List Seminar', 'link' => route('seminar.index')], ['judul' => 'Edit Pendaftaran Seminar', 'link' => '']),
            'data'          => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($seminar, Request $request)
    {
        $id = decrypt($seminar);

        $validateData   = $request->validate([
            'mahasiswa_id'      => 'required',
            'judul_skripsi'     => 'required',
            'lokasi_penelitian' => 'required',
            'batch_id'          => 'required'
        ]);

        Seminar::where('id', $id)
            ->update($validateData);
        return redirect($request->redirect_to)->with('success', 'Data Berhasil Di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Seminar $seminar)
    {
        //
    }

    public function cetakForm($id)
    {
        $id = decrypt($id);
        $seminar = Seminar::find($id);

        return view('dashboard.skripsi.seminar.formulir', [
            'seminar'       => $seminar,
            'kaprodi'       => Dosen::where('jabatan', 'Kaprodi')->where('jurusan_id', $seminar->mahasiswa->jurusan->id)->first(),
        ]);
    }

    public function cetakPeng($id)
    {
        $id = decrypt($id);
        $seminar = Seminar::find($id);

        if ($seminar->status != 5) {
            return redirect(route('seminar.index'))->with('success', 'Error 501');
        }

        return view('dashboard.skripsi.seminar.bimbingan', [
            'seminar'       => $seminar
        ]);
    }

    public function cetakBrica($id)
    {
        $id = decrypt($id);
        $seminar = Seminar::find($id);

        if ($seminar->status != 5) {
            return redirect(route('seminar.index'))->with('success', 'Error 501');
        }

        return view('dashboard.skripsi.seminar.berita', [
            'seminar'       => $seminar
        ]);
    }

    public function cetakSurat($id)
    {
        $id = decrypt($id);
        $seminar = Seminar::find($id);

        if ($seminar->status != 5) {
            return redirect(route('seminar.index'))->with('success', 'Error 501');
        }

        return view('dashboard.skripsi.seminar.penugasan', [
            'seminar'       => $seminar,
            'kaprodi'       => Dosen::where('jurusan_id', $seminar->mahasiswa->jurusan_id)->where('jabatan', 'Kaprodi')->first()
        ]);
    }

    public function formUnggah($id)
    {
        $id = decrypt($id);
        $data = Seminar::find($id);

        return view('mahasiswa.skripsi.seminar.upload', [
            'title'         => 'Pendaftaran Seminar Skripsi',
            'menu'          => 'skripsi.seminar',
            'breadcumbs'    => array(['judul' => 'Beranda', 'link' => route('mahasiswa.beranda')], ['judul' => 'List Seminar', 'link' => route('seminar.index')], ['judul' => 'Unggah Berkas', 'link' => '']),
            'data'          => $data
        ]);
    }

    public function Unggah($id, Request $request)
    {
        $id = decrypt($id);
        $data = Seminar::find($id);

        if ($request->file('file_pembayaran')) {
            $ext = $request->file('file_pembayaran')->extension();
            $validateData['file_pembayaran'] = $request->file('file_pembayaran')->storeAs('seminar', 'bukti-bayar-' . $data->mahasiswa->nim . '.' . $ext);
        }

        if ($request->file('file_krs')) {
            $ext = $request->file('file_krs')->extension();
            $validateData['file_krs'] = $request->file('file_krs')->storeAs('seminar', 'krs-' . $data->mahasiswa->nim . '.' . $ext);
        }

        Seminar::where('id', $data->id)
            ->update($validateData);
        return redirect(route('seminar.index'))->with('success', 'Data Berhasil Di Unggah');
    }
}
