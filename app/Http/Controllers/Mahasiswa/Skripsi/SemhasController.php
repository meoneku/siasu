<?php

namespace App\Http\Controllers\Mahasiswa\Skripsi;

use App\Http\Controllers\Controller;
use App\Models\Semhas;
use App\Models\Batch;
use App\Models\VA;
use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SemhasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('mahasiswa.skripsi.semhas.index', [
            'title'         => 'Pendaftaran Seminar Hasil',
            'menu'          => 'skripsi.semhas',
            'breadcumbs'    => array(['judul' => 'Beranda', 'link' => route('mahasiswa.beranda')], ['judul' => 'Daftar Semhas', 'link' => '']),
            'semhass'       => Semhas::with('mahasiswa')->with('batch')->where('mahasiswa_id', Auth::guard('mahasiswa')->user()->id)->filter(request(['judul']))->latest()->paginate(10)->withQueryString()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $now = date('Y-m-d');
        $batch = Batch::where('kegiatan_id', 5)->whereRaw('? between mulai and selesai', $now)->first();

        return view('mahasiswa.skripsi.semhas.create', [
            'title'         => 'Pendaftaran Seminar Hasil',
            'menu'          => 'skripsi.semhas',
            'breadcumbs'    => array(['judul' => 'Beranda', 'link' => route('mahasiswa.beranda')], ['judul' => 'List Semhas', 'link' => route('semhas.index')], ['judul' => 'Daftar Semhas', 'link' => '']),
            'batch'         => $batch,
            'semhas'        => Semhas::where([['mahasiswa_id', Auth::guard('mahasiswa')->user()->id], ['status', 5]])->first()
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

        $va = VA::where([['mahasiswa_id', $request->mahasiswa_id], ['kegiatan_id', 6], ['status', 'AKT']])->first();

        if (empty($va)) {
            $validateData['va']     = 'UNDIFINED';
            $validateData['nominal'] = 0;
        } else {
            $validateData['va']     = $va->nomor_va;
            $validateData['nominal'] = $va->nominal;
        }

        Semhas::create($validateData);
        return redirect(route('semhas.index'))->with('success', 'Data Telah Tersimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Semhas $semhas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($semhas)
    {
        $id = decrypt($semhas);
        $data = Semhas::find($id);

        return view('mahasiswa.skripsi.semhas.edit', [
            'title'         => 'Pendaftaran Seminar Hasil',
            'menu'          => 'skripsi.semhas',
            'breadcumbs'    => array(['judul' => 'Beranda', 'link' => route('mahasiswa.beranda')], ['judul' => 'List Semhas', 'link' => route('semhas.index')], ['judul' => 'Edit Pendaftaran Semhas', 'link' => '']),
            'data'          => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $semhas)
    {
        $id = decrypt($semhas);

        $validateData   = $request->validate([
            'mahasiswa_id'      => 'required',
            'judul_skripsi'     => 'required',
            'lokasi_penelitian' => 'required',
            'batch_id'          => 'required'
        ]);

        Semhas::where('id', $id)
            ->update($validateData);
        return redirect(route('semhas.index'))->with('success', 'Data Berhasil Di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Semhas $semhas)
    {
        //
    }

    public function cetakForm($id)
    {
        $id = decrypt($id);
        $seminar = Semhas::find($id);

        return view('dashboard.skripsi.ujian.formulir', [
            'seminar'       => $seminar,
            'kaprodi'       => Dosen::where('jabatan', 'Kaprodi')->where('jurusan_id', $seminar->mahasiswa->jurusan->id)->first(),
        ]);
    }

    public function cetakPeng($id)
    {
        $id = decrypt($id);
        $seminar = Semhas::find($id);

        if ($seminar->status != 5) {
            return redirect(route('semhas.index'))->with('success', 'Error 501');
        }

        return view('dashboard.skripsi.ujian.bimbingan', [
            'seminar'       => $seminar
        ]);
    }

    public function cetakBrica($id)
    {
        $id = decrypt($id);
        $seminar = Semhas::find($id);

        if ($seminar->status != 5) {
            return redirect(route('semhas.index'))->with('success', 'Error 501');
        }

        return view('dashboard.skripsi.ujian.berita', [
            'seminar'       => $seminar
        ]);
    }

    public function cetakSurat($id)
    {
        $id = decrypt($id);
        $seminar = Semhas::find($id);

        if ($seminar->status != 5) {
            return redirect(route('semhas.index'))->with('success', 'Error 501');
        }

        return view('dashboard.skripsi.ujian.penugasan', [
            'seminar'       => $seminar,
            'kaprodi'       => Dosen::where('jurusan_id', $seminar->mahasiswa->jurusan_id)->where('jabatan', 'Kaprodi')->first()
        ]);
    }

    public function formUnggah($id)
    {
        $id = decrypt($id);
        $data = Semhas::find($id);

        return view('mahasiswa.skripsi.semhas.upload', [
            'title'         => 'Pendaftaran Seminar Hasil',
            'menu'          => 'skripsi.semhas',
            'breadcumbs'    => array(['judul' => 'Beranda', 'link' => route('mahasiswa.beranda')], ['judul' => 'List Semhas', 'link' => route('semhas.index')], ['judul' => 'Unggah Berkas', 'link' => '']),
            'data'          => $data
        ]);
    }

    public function Unggah($id, Request $request)
    {
        $id = decrypt($id);
        $data = Semhas::find($id);

        if ($request->file('file_pembayaran')) {
            $ext = $request->file('file_pembayaran')->extension();
            $validateData['file_pembayaran'] = $request->file('file_pembayaran')->storeAs('semhas', 'bukti-bayar-' . $data->mahasiswa->nim . '.' . $ext);
        }

        if ($request->file('file_brica_seminar')) {
            $ext = $request->file('file_brica_seminar')->extension();
            $validateData['file_brica_seminar'] = $request->file('file_brica_seminar')->storeAs('semhas', 'brica-seminar-' . $data->mahasiswa->nim . '.' . $ext);
        }

        Semhas::where('id', $data->id)
            ->update($validateData);
        return redirect(route('semhas.index'))->with('success', 'Data Berhasil Di Unggah');
    }
}
