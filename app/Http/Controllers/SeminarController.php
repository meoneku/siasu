<?php

namespace App\Http\Controllers;

use App\Helpers\ESurat;
use App\Models\Batch;
use App\Models\Dosen;
use App\Models\Jurusan;
use App\Models\Seminar;
use App\Models\Surat;
use Illuminate\Http\Request;

class SeminarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.skripsi.seminar.index', [
            'title'     => 'Mahasiswa | Data Seminar Skripsi',
            'seminar'   => Seminar::with('mahasiswa')->with('batch')->filter(request(['nama', 'jurusan', 'batch']))->latest()->paginate(10)->withQueryString(),
            'jurusan'   => Jurusan::all(),
            'batchs'    => Batch::where('kegiatan_id', 5)->latest()->limit(5)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.skripsi.seminar.create', [
            'title'     => 'Mahasiswa | Data Pendaftar Seminar Skripsi',
            'batchs'    => Batch::where('kegiatan_id', 5)->get()
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
            'batch_id'          => 'required'
        ]);

        Seminar::create($validateData);
        return redirect($request->redirect_to)->with('success', 'Terimakasih telah melakukan pendaftaran seminar, data pendaftaran akan di verifikasi terlebih dahulu');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Seminar  $seminar
     * @return \Illuminate\Http\Response
     */
    public function show(Seminar $seminar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Seminar  $seminar
     * @return \Illuminate\Http\Response
     */
    public function edit(Seminar $seminar)
    {
        return view('dashboard.skripsi.seminar.edit', [
            'title'     => 'Mahasiswa | Data Pendaftar Seminar Skripsi',
            'batchs'    => Batch::where('kegiatan_id', 5)->get(),
            'seminar'   => $seminar
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Seminar  $seminar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Seminar $seminar)
    {
        $validateData   = $request->validate([
            'mahasiswa_id'      => 'required',
            'judul_skripsi'     => 'required',
            'lokasi_penelitian' => 'required',
            'batch_id'          => 'required'
        ]);

        Seminar::where('id', $seminar->id)
            ->update($validateData);
        return redirect($request->redirect_to)->with('success', 'Data Sudah Berhasil Di Rubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Seminar  $seminar
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seminar $seminar, Request $request)
    {
        Seminar::destroy($seminar->id);
        return redirect($request->redirect_to)->with('success', 'Data Berhasil Di Hapus');
    }

    public function penguji(Seminar $seminar)
    {
        return view('dashboard.skripsi.seminar.penguji', [
            'title'     => 'Mahasiswa | Data Pendaftar Seminar Skripsi',
            'seminar'   => $seminar
        ]);
    }

    public function addpenguji(Seminar $seminar)
    {
        return view('dashboard.skripsi.seminar.addpenguji', [
            'title'     => 'Mahasiswa | Data Pendaftar Seminar Skripsi',
            'seminar'   => $seminar,
            'dosens'    => Dosen::all()
        ]);
    }

    public function destroyPenguji(Seminar $seminar, Request $request)
    {
        Seminar::find($seminar->id)->dosen()->detach($request->dosen_id);
        return redirect($request->redirect_to)->with('success', 'Data Penguji Berhasil Di Hapus');
    }

    public function savePenguji(Request $request, Seminar $seminar)
    {
        Seminar::find($seminar->id)->dosen()->attach($request->dosen_id, ['sebagai' => $request->sebagai, 'ke' => $request->ke]);

        return redirect($request->redirect_to)->with('success', 'Dosen Penguji Berhasil Di Tambahkan');
    }

    public function status(Seminar $seminar)
    {
        return view('dashboard.skripsi.seminar.status', [
            'title'     => 'Mahasiswa | Data Pendaftar Seminar Skripsi',
            'seminar'   => $seminar
        ]);
    }

    public function updateStatus(Seminar $seminar, Request $request)
    {
        $validateData   = $request->validate([
            'status'        => 'required',
            'keterangan'    => ''
        ]);

        Seminar::where('id', $seminar->id)
            ->update($validateData);
        return redirect($request->redirect_to)->with('success', 'Status Sudah Berhasil Di Rubah');
    }

    public function penerbitan(Request $request, Seminar $seminar)
    {
        if ($seminar->dosen()->count() == 0) {
            return redirect(url('webmin/seminar/penguji') . '/' . $seminar->id)->with('success', 'Dosen Penguji Masih Kosong');
        }

        $validateData = $request->validate([
            'tanggal_seminar' => 'required',
            'ruang'         => 'required',
            'jam_mulai'     => 'required',
            'jam_selesai'   => 'required'
        ]);

        $validateData['status'] = 5;

        if (!$seminar->no_surat) {
            $validateData['no_surat'] = ESurat::makeNomorSurat($seminar->mahasiswa->jurusan_id, $seminar->mahasiswa->jurusan->singkatan, $seminar->mahasiswa->jurusan->kode_surat);
            $data = [
                'no_surat'      => $validateData['no_surat'],
                'jurusan_id'    => $seminar->mahasiswa->jurusan_id,
                'jenis_surat'   => 'Penugasan Penguji Skripsi',
                'tahun'         => date('Y')
            ];

            Surat::create($data);
        }

        Seminar::where('id', $seminar->id)
            ->update($validateData);

        return redirect(url('webmin/seminar/penguji') . '/' . $seminar->id)->with('success', 'Surat Penugasan Sudah Berhasil Diterbitkan');
    }

    public function formulir(Seminar $seminar)
    {
        return view('dashboard.skripsi.seminar.formulir', [
            'seminar'       => $seminar,
            'kaprodi'       => Dosen::where('jabatan', 'Kaprodi')->where('jurusan_id', $seminar->mahasiswa->jurusan->id)->first(),
            'koord'         => Dosen::where('jabatan', 'Koordinator Skripsi')->where('jurusan_id', $seminar->mahasiswa->jurusan->id)->first()
        ]);
    }

    public function formuji(Seminar $seminar)
    {
        return view('dashboard.skripsi.seminar.bimbingan', [
            'seminar'       => $seminar
        ]);
    }

    public function penugasan(Seminar $seminar)
    {
        return view('dashboard.skripsi.seminar.penugasan', [
            'seminar'       => $seminar,
            'kaprodi'       => Dosen::where('jurusan_id', $seminar->mahasiswa->jurusan_id)->where('jabatan', 'Kaprodi')->first()
        ]);
    }

    public function berita(Seminar $seminar)
    {
        return view('dashboard.skripsi.seminar.berita', [
            'seminar'       => $seminar
        ]);
    }

    public function jadwal(Request $request)
    {
        if (!$request->batch or !$request->jurusan) {
            return redirect(url('webmin/404'));
        }

        return view('dashboard.skripsi.seminar.jadwal', [
            'seminar'   => Seminar::with('mahasiswa')->with('batch')->with('dosen')->filter(request(['jurusan', 'batch']))->where('status', 5)->orderBy('tanggal_seminar', 'asc')->orderBy('jam_mulai', 'asc')->get(),
            'batch'     => Batch::find($request->batch),
            'jurusan'   => Jurusan::find($request->jurusan),
            'kaprodi'   => Dosen::where('jurusan_id', $request->jurusan)->where('jabatan', 'Kaprodi')->first()
        ]);
    }

    public function pembayaran(Seminar $seminar)
    {
        if ($seminar->status_pembayaran == 'SDH') {
            $data['status_pembayaran'] = 'BLM';
        } else {
            $data['status_pembayaran'] = 'SDH';
        }

        Seminar::where('id', $seminar->id)
            ->update($data);
        return redirect(url('webmin/seminar'))->with('success', 'Status Pembayaran Sudah Berhasil Di Rubah');
    }
}
