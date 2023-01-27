<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Skripsi;
use App\Models\Dosen;
use App\Models\Nilai;
use App\Models\Surat;
use Illuminate\Http\Request;
use App\Models\Jurusan;

class SkripsiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.skripsi.daftar.index', [
            'title'     => 'Mahasiswa | Data Pendaftar Skripsi',
            'skripsi'   => Skripsi::with('mahasiswa')->with('batch')->filter(request(['nama', 'jurusan', 'batch']))->latest()->paginate(10)->withQueryString(),
            'jurusan'   => Jurusan::all(),
            'batchs'    => Batch::where('kegiatan_id', 4)->latest()->limit(5)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.skripsi.daftar.create', [
            'title'     => 'Mahasiswa | Data Pendaftar Skripsi',
            'batchs'    => Batch::all()
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
            'nomor_handphone'   => 'required',
            'email'             => 'required',
            'sks'               => 'required',
            'ipk'               => 'required',
            'batch_id'          => 'required'
        ]);

        // $validateData['tanggal_daftar'] = date('Y-m-d');

        Skripsi::create($validateData);
        return redirect($request->redirect_to)->with('success', 'Terimakasih telah melakukan pendaftaran, data pendaftaran akan di verifikasi terlebih dahulu');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Skripsi  $skripsi
     * @return \Illuminate\Http\Response
     */
    public function show(Skripsi $skripsi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Skripsi  $skripsi
     * @return \Illuminate\Http\Response
     */
    public function edit(Skripsi $skripsi)
    {
        return view('dashboard.skripsi.daftar.edit', [
            'title'     => 'Mahasiswa | Data Pendaftar Skripsi',
            'batchs'    => Batch::all(),
            'skripsi'   => $skripsi
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Skripsi  $skripsi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Skripsi $skripsi)
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

        Skripsi::where('id', $skripsi->id)
            ->update($validateData);
        return redirect($request->redirect_to)->with('success', 'Data Berhasil Di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Skripsi  $skripsi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Skripsi $skripsi, Request $request)
    {
        Skripsi::destroy($skripsi->id);
        return redirect($request->redirect_to)->with('success', 'Data Berhasil Di Hapus');
    }

    public function form(Skripsi $skripsi)
    {
        return view('dashboard.skripsi.daftar.form', [
            'skripsi'       => $skripsi,
            'kaprodi'       => Dosen::where('jabatan', 'Kaprodi')->where('jurusan_id', $skripsi->mahasiswa->jurusan->id)->first(),
            'koord'         => Dosen::where('jabatan', 'Koordinator Skripsi')->where('jurusan_id', $skripsi->mahasiswa->jurusan->id)->first()
        ]);
    }

    public function setpembimbing(Skripsi $skripsi)
    {
        if ($skripsi->status <= 2 or $skripsi->status == 4) {
            return redirect(url('webmin/skripsi'))->with('success', 'Error 501');
        }

        return view('dashboard.skripsi.daftar.setbimbing', [
            'title'     => 'Mahasiswa | Data Pendaftar Skripsi',
            'batchs'    => Batch::all(),
            'skripsi'   => $skripsi,
            'dosens'    => Dosen::all()
        ]);
    }

    public function addpembimbing(Skripsi $skripsi)
    {
        if ($skripsi->status <= 2 or $skripsi->status == 4) {
            return redirect(url('webmin/skripsi'))->with('success', 'Error 501');
        }

        return view('dashboard.skripsi.daftar.addbimbing', [
            'title'     => 'Mahasiswa | Data Pendaftar Skripsi',
            'dosens'    => Dosen::all(),
            'skripsi'   => $skripsi
        ]);
    }

    public function updatebimbing(Request $request, Skripsi $skripsi)
    {
        $validateData   = $request->validate([
            'dosen_id'      => 'required',
            'pembimbing'    => 'required',
            'mulai'         => 'required',
            'selesai'       => 'required',
        ]);

        Skripsi::find($skripsi->id)->dosen()->attach($validateData['dosen_id'], ['pembimbing' => $validateData['pembimbing'], 'mulai' => $validateData['mulai'], 'selesai' => $validateData['selesai']]);

        return redirect($request->redirect_to)->with('success', 'Dosen Pembimbing Berhasil Di Tambahkan');
    }

    public function destroybimbing(Request $request, Skripsi $skripsi)
    {
        Skripsi::find($skripsi->id)->dosen()->detach($request->dosen_id);
        return redirect($request->redirect_to)->with('success', 'Data Pembimbing Berhasil Di Hapus');
    }

    public function penerbitan(Skripsi $skripsi, Request $request)
    {
        $validateData['status'] = 5;

        if (!$skripsi->no_surat) {
            $validateData['no_surat'] = $this->NoSurat('94', 'A', $skripsi->mahasiswa->jurusan->kode_surat);
            $data = [
                'no_surat'      => $validateData['no_surat'],
                'jurusan_id'    => 94,
                'jenis_surat'   => 'Penugasan Pembimbing Skripsi',
                'tahun'         => date('Y')
            ];
            Surat::create($data);
        }

        Skripsi::where('id', $skripsi->id)
             ->update($validateData);

        return redirect($request->redirect_to)->with('success', 'Surat Penugasan Sudah Berhasil Diterbitkan');
    }

    public function persetujuan(Skripsi $skripsi)
    {
        $mata_kuliah = Nilai::where('nim', $skripsi->mahasiswa->nim)->distinct()->orderBy('mk_jenis', 'asc')->orderBy('level', 'asc')->get(['kd_mk', 'mk_jenis', 'level']);
        $countNilai = collect([]);
        $jumlahSKS = 0;
        // $jumlahNilai = 0;
        // $no = 1;

        foreach ($mata_kuliah as $mk) {
            $cek_mk = Nilai::where([['nim', $skripsi->mahasiswa->nim], ['kd_mk', $mk['kd_mk']]])->get();
            $cari_nilai = collect([]);

            foreach ($cek_mk as $cmk) {
                $cari_nilai->push([
                    // 'no'            => $no,
                    // 'separator'     => 0,
                    'kdmk'          => $cmk->kd_mk,
                    'mk'            => $cmk->mata_kuliah,
                    'sks'           => $cmk->sks,
                    'nilai'         => $cmk->nilai,
                ]);
            }
            $sorted = $cari_nilai->sortByDesc('nilai')->first();
            $stringMK = preg_replace_callback(
                '/\b(?=[LXIVCDM]+\b)([a-z]+)\b/i',
                function ($matches) {
                    return strtoupper($matches[0]);
                },
                ucwords(strtolower($sorted['mk']))
            );

            $String_MK_MAP = implode('-', array_map('ucfirst', explode('-', $stringMK)));
            // $stringMataKuliah = $this->gantiKata($String_MK_MAP);
            $stringMataKuliah = TranskripController::gantiKata($String_MK_MAP);

            $countNilai->push([
                // 'no'            => $sorted['no'],
                // 'separator'     => $sorted['separator'],
                'kdmk'          => $sorted['kdmk'],
                'mk'            => $stringMataKuliah,
                'sks'           => $sorted['sks'],
                'nilai'         => $sorted['nilai'],
            ]);
            $jumlahSKS += $sorted['sks'];
            // $jumlahNilai += $sorted['nilai'] * $sorted['sks'];
            // $no++;
            //echo $jumlahSKS . '<br/>';
        }
        $NilaiDE = $countNilai->where('nilai', '<=', 1);

        $phone = $skripsi->nomor_handphone;
        if (preg_match('/^0/', $phone)) {
            $str = ltrim($phone, '0');
            $phonenumber = '+62' . $str;
        } else {
            $phonenumber = $phone;
        }

        return view('dashboard.skripsi.daftar.approve', [
            'title'     => 'Mahasiswa | Data Pendaftar Skripsi',
            'skripsi'   => $skripsi,
            'nilai'     => $NilaiDE,
            'sks'       => $jumlahSKS,
            'hp'        => $phonenumber
        ]);
    }

    public function updatestatus(Request $request, Skripsi $skripsi)
    {
        $validateData   = $request->validate([
            'status'        => 'required',
            'keterangan'    => '',
        ]);

        Skripsi::where('id', $skripsi->id)
            ->update($validateData);
        return redirect($request->redirect_to)->with('success', 'Status Berhasil Di Update');
    }

    public function surattugas(Skripsi $skripsi)
    {

        $tanggal = [];
        foreach($skripsi->dosen as $dosen) {
            array_push($tanggal, $dosen->pivot->selesai);
        }
        return view('dashboard.skripsi.daftar.st', [
            'skripsi'   => $skripsi,
            'dekan'     => Dosen::where('jabatan', 'Dekan')->first(),
            'selesai'   => $tanggal[0]
        ]);
    }

    public static function getStatusPendaftaran($id)
    {
        if ($id == 0) {
            $result = '<button class="btn btn-primary btn-xs">Baru</button>';
        } elseif ($id == 1) {
            $result = '<button class="btn btn-warning btn-xs">Proses</button>';
        } elseif ($id == 2) {
            $result = '<button class="btn btn-warning btn-xs">Proses</button>';
        } elseif ($id == 3) {
            $result = '<button class="btn btn-info btn-xs">Penugasan</button>';
        } elseif ($id == 4) {
            $result = '<button class="btn btn-danger btn-xs">Ditolak</button>';
        } elseif ($id == 5) {
            $result = '<button class="btn btn-success btn-xs">Terima</button>';
        } else {
            $result = 'Error';
        }

        return $result;
    }

    public function formpembimbing(Skripsi $skripsi)
    {
        if ($skripsi->status != 5) {
            return redirect(url('webmin/skripsi'))->with('success', 'Error 501');
        }

        return view('dashboard.skripsi.daftar.bimbingan', [
            'skripsi'       => $skripsi
        ]);
    }

    public static function getStatus($id)
    {
        if ($id == 0) {
            $result = '-- Pilih Status --';
        } elseif ($id == 1) {
            $result = 'Teruskan Ke Koordinator Skripsi';
        } elseif ($id == 2) {
            $result = 'Teruskan Ke Kaprodi';
        } elseif ($id == 3) {
            $result = 'Penugasan Dosen Pembimbing';
        } elseif ($id == 4) {
            $result = 'Pendaftaran Tidak Diterima';
        } elseif ($id == 5) {
            $result = 'Set Dosen Pembimbing';
        } else {
            $result = 'Error';
        }

        return $result;
    }

    public static function NoSurat($id_jurusan, $jurusan, $kode_surat)
    {
        $begin = 'UNHASY/EL/' . $jurusan . '/' . $kode_surat;
        $roma = array("", "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");
        $surat = Surat::latest()->where('tahun', date('Y'))->where('jurusan_id', $id_jurusan)->first();
        $number = 1;
        if ($surat) {
            $lastNumber = substr($surat->no_surat, 0, 3);
            $intNumber =  preg_replace('/[0]/', '', $lastNumber);
            $autonumber = sprintf("%03s", abs($intNumber + 1)) . '/' . $begin . '/' . $roma[date('n')] . '/' . date('Y');
        } else {
            $autonumber = sprintf("%03s", $number) . '/' . $begin . '/' . $roma[date('n')] . '/' . date('Y');
        }

        return $autonumber;
    }
}
