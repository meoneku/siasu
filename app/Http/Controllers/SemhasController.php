<?php

namespace App\Http\Controllers;

use App\Helpers\ESurat;
use App\Models\Batch;
use App\Models\Dosen;
use App\Models\Jurusan;
use App\Models\Semhas;
use App\Models\Surat;
use Illuminate\Http\Request;

class SemhasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.skripsi.ujian.index', [
            'title'     => 'Mahasiswa | Data Seminar Hasil Skripsi',
            'semhas'    => Semhas::with('mahasiswa')->with('batch')->filter(request(['nama', 'jurusan', 'batch']))->latest()->paginate(10)->withQueryString(),
            'jurusan'   => Jurusan::all(),
            'batchs'    => Batch::where('kegiatan_id', 6)->latest()->limit(5)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.skripsi.ujian.create', [
            'title'     => 'Mahasiswa | Data Pendaftar Seminar Hasil Skripsi',
            'batchs'    => Batch::where('kegiatan_id', 6)->get()
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

        Semhas::create($validateData);
        return redirect($request->redirect_to)->with('success', 'Terimakasih telah melakukan pendaftaran Seminar Hasil, data pendaftaran akan di verifikasi terlebih dahulu');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UjianSkripsi  $ujianSkripsi
     * @return \Illuminate\Http\Response
     */
    public function show(Semhas $semhas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UjianSkripsi  $ujianSkripsi
     * @return \Illuminate\Http\Response
     */
    public function edit(Semhas $semhas)
    {
        return view('dashboard.skripsi.ujian.edit', [
            'title'     => 'Mahasiswa | Data Pendaftar Seminar Skripsi',
            'batchs'    => Batch::where('kegiatan_id', 6)->get(),
            'seminar'   => $semhas
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UjianSkripsi  $ujianSkripsi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Semhas $semhas)
    {
        $validateData   = $request->validate([
            'mahasiswa_id'      => 'required',
            'judul_skripsi'     => 'required',
            'lokasi_penelitian' => 'required',
            'batch_id'          => 'required'
        ]);

        Semhas::where('id', $semhas->id)
            ->update($validateData);
        return redirect($request->redirect_to)->with('success', 'Data Sudah Berhasil Di Rubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UjianSkripsi  $ujianSkripsi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Semhas $semhas, Request $request)
    {
        Semhas::destroy($semhas->id);
        return redirect($request->redirect_to)->with('success', 'Data Berhasil Di Hapus');
    }

    public function penguji(Semhas $semhas)
    {
        return view('dashboard.skripsi.ujian.penguji', [
            'title'     => 'Mahasiswa | Data Pendaftar Seminar Hasil Skripsi',
            'seminar'   => $semhas
        ]);
    }

    public function addpenguji(Semhas $semhas)
    {
        return view('dashboard.skripsi.ujian.addpenguji', [
            'title'     => 'Mahasiswa | Data Pendaftar Seminar Hasil Skripsi',
            'seminar'   => $semhas,
            'dosens'    => Dosen::all()
        ]);
    }

    public function destroyPenguji(Semhas $semhas, Request $request)
    {
        Semhas::find($semhas->id)->dosen()->detach($request->dosen_id);
        return redirect($request->redirect_to)->with('success', 'Data Penguji Berhasil Di Hapus');
    }

    public function savePenguji(Request $request, Semhas $semhas)
    {
        Semhas::find($semhas->id)->dosen()->attach($request->dosen_id, ['sebagai' => $request->sebagai, 'ke' => $request->ke]);

        return redirect($request->redirect_to)->with('success', 'Dosen Penguji Berhasil Di Tambahkan');
    }

    public function status(Semhas $semhas)
    {
        return view('dashboard.skripsi.ujian.status', [
            'title'     => 'Mahasiswa | Data Pendaftar Seminar Hasil Skripsi',
            'seminar'   => $semhas
        ]);
    }

    public function updateStatus(Semhas $semhas, Request $request)
    {
        $validateData   = $request->validate([
            'status'        => 'required',
            'keterangan'    => ''
        ]);

        Semhas::where('id', $semhas->id)
            ->update($validateData);
        return redirect($request->redirect_to)->with('success', 'Status Sudah Berhasil Di Rubah');
    }

    public function penerbitan(Request $request, Semhas $semhas)
    {
        if ($semhas->dosen()->count() == 0) {
            return redirect(url('webmin/semhas/penguji') . '/' . $semhas->id)->with('success', 'Dosen Penguji Masih Kosong');
        }

        $validateData = $request->validate([
            'tanggal_ujian' => 'required',
            'ruang'         => 'required',
            'jam_mulai'     => 'required',
            'jam_selesai'   => 'required'
        ]);

        $validateData['status'] = 5;

        if (!$semhas->no_surat) {
            $validateData['no_surat'] = ESurat::makeNomorSurat($semhas->mahasiswa->jurusan_id, $semhas->mahasiswa->jurusan->singkatan, $semhas->mahasiswa->jurusan->kode_surat);
            $data = [
                'no_surat'      => $validateData['no_surat'],
                'jurusan_id'    => $semhas->mahasiswa->jurusan_id,
                'jenis_surat'   => 'Penugasan Penguji Skripsi',
                'tahun'         => date('Y')
            ];

            Surat::create($data);
        }

        Semhas::where('id', $semhas->id)
            ->update($validateData);

        return redirect(url('webmin/semhas/penguji') . '/' . $semhas->id)->with('success', 'Surat Penugasan Sudah Berhasil Diterbitkan');
    }

    public function formulir(Semhas $semhas)
    {
        return view('dashboard.skripsi.ujian.formulir', [
            'seminar'       => $semhas,
            'kaprodi'       => Dosen::where('jabatan', 'Kaprodi')->where('jurusan_id', $semhas->mahasiswa->jurusan->id)->first(),
            'koord'         => Dosen::where('jabatan', 'Koordinator Skripsi')->where('jurusan_id', $semhas->mahasiswa->jurusan->id)->first()
        ]);
    }

    public function formuji(Semhas $semhas)
    {
        return view('dashboard.skripsi.ujian.bimbingan', [
            'seminar'       => $semhas
        ]);
    }

    public function penugasan(Semhas $semhas)
    {
        return view('dashboard.skripsi.ujian.penugasan', [
            'seminar'       => $semhas,
            'kaprodi'       => Dosen::where('jurusan_id', $semhas->mahasiswa->jurusan_id)->where('jabatan', 'Kaprodi')->first()
        ]);
    }

    public function berita(Semhas $semhas)
    {
        return view('dashboard.skripsi.ujian.berita', [
            'seminar'       => $semhas
        ]);
    }

    public function jadwal(Request $request)
    {
        if (!$request->batch or !$request->jurusan) {
            return redirect(url('webmin/404'));
        }

        return view('dashboard.skripsi.ujian.jadwal', [
            'seminar'   => Semhas::with('mahasiswa')->with('batch')->with('dosen')->filter(request(['jurusan', 'batch']))->where('status', 5)->orderBy('tanggal_seminar', 'asc')->orderBy('jam_mulai', 'asc')->get(),
            'batch'     => Batch::find($request->batch),
            'jurusan'   => Jurusan::find($request->jurusan),
            'kaprodi'   => Dosen::where('jurusan_id', $request->jurusan)->where('jabatan', 'Kaprodi')->first()
        ]);
    }
}
