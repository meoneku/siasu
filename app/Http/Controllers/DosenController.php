<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use App\Exports\DosenExport;
use App\Imports\DosenImport;
use Maatwebsite\Excel\Facades\Excel;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.dosen.index', [
            'title'     => 'Dosen | Data Dosen',
            'dosen'     => Dosen::with('jurusan')->filter(request(['nama', 'jurusan']))->paginate(6)->withQueryString(),
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
        $jabatan    = ["Tenaga Pengajar", "Dekan", "Wakil Dekan", "Kaprodi", "GPM", "Pembina Ormawa", "Koordinator Skripsi"];
        $jafung     = ["Dosen", "Asisten Ahli", "Lektor", "Lektor Kepala", "Guru Besar"];
        $golongan   = ["III/a", "III/b", "III/c", "III/d", "IV/a", "IV/b", "IV/c", "IV/d"];
        $status     = ["Dosen Tetap", "Dosen Tidak Tetap"];
        $pendidikan = ["S1", "S2", "S3"];

        return view('dashboard.dosen.create', [
            'title'     => 'Dosen | Data Dosen',
            'jurusan'   => Jurusan::all(),
            'jabatan'   => $jabatan,
            'jafung'    => $jafung,
            'golongan'  => $golongan,
            'status'    => $status,
            'pendidikan' => $pendidikan
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
            'niy'           => 'required|max:20',
            'nidn'          => 'required|max:15',
            'nama'          => 'required|max:200',
            'rekening'      => 'required|max:50',
            'jurusan_id'    => 'required',
            'tmt'           => 'required',
            'jabatan'       => 'required',
            'jafung'        => 'required',
            'golongan'      => 'required',
            'pendidikan'    => 'required',
            'status'        => 'required',
            'email'         => 'required|email:rfc,dns',
            'foto'          => 'image|file'
        ]);

        if ($request->file('foto')) {
            $ext = $request->file('foto')->extension();
            $validateData['foto'] = $request->file('foto')->storeAs('dosen', $request->niy . '.' . $ext);
        }

        Dosen::create($validateData);
        return redirect('webmin/dosen')->with('success', 'Data Berhasil Di Simpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function show(Dosen $dosen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function edit(Dosen $dosen)
    {
        $jabatan    = ["Tenaga Pengajar", "Dekan", "Wakil Dekan", "Kaprodi", "GPM", "Pembina Ormawa", "Koordinator Skripsi"];
        $jafung     = ["Dosen", "Asisten Ahli", "Lektor", "Lektor Kepala", "Guru Besar"];
        $golongan   = ["III/a", "III/b", "III/c", "III/d", "IV/a", "IV/b", "IV/c", "IV/d"];
        $status     = ["Dosen Tetap", "Dosen Tidak Tetap"];
        $pendidikan = ["S1", "S2", "S3"];

        return view('dashboard.dosen.edit', [
            'title'     => 'Dosen | Data Dosen',
            'jurusan'   => Jurusan::all(),
            'jabatan'   => $jabatan,
            'jafung'    => $jafung,
            'golongan'  => $golongan,
            'dosen'     => $dosen,
            'status'    => $status,
            'pendidikan' => $pendidikan
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dosen $dosen)
    {
        $validateData   = $request->validate([
            'niy'           => 'required|max:20',
            'nidn'          => 'required|max:15',
            'nama'          => 'required|max:200',
            'rekening'      => 'required|max:50',
            'jurusan_id'    => 'required',
            'tmt'           => 'required',
            'jabatan'       => 'required',
            'jafung'        => 'required',
            'golongan'      => 'required',
            'pendidikan'    => 'required',
            'status'        => 'required',
            'email'         => 'required|email:rfc,dns',
            'foto'          => 'image|file'
        ]);

        if ($request->file('foto')) {
            $ext = $request->file('foto')->extension();
            $validateData['foto'] = $request->file('foto')->storeAs('dosen', $request->niy . '.' . $ext);
        }

        Dosen::where('id', $dosen->id)
            ->update($validateData);
        return redirect($request->redirect_to)->with('success', 'Data Berhasil Di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dosen $dosen, Request $request)
    {
        Dosen::destroy($dosen->id);
        return redirect($request->redirect_to)->with('success', 'Data Berhasil Di Hapus');
    }

    public function DownloadTemplate()
    {
        return Excel::download(new DosenExport, 'Dosen-Template.xlsx');
    }

    public function import()
    {
        return view('dashboard.dosen.import', [
            'title'     => 'Dosen | Data Dosen',
        ]);
    }

    public function importView(Request $request)
    {
        $file   = $request->file('file')->store('import-file');
        $rows   = Excel::toArray(new DosenImport, $file);
        $jurusan = collect(Jurusan::all());
        return view('dashboard.dosen.importview', [
            'title'     => 'Mahasiswa | Data Lulusan',
            'rows'      => $rows[0],
            'CountRows' => count($rows[0]),
            'jurusan'   => $jurusan,
            'file'      => $file,
        ]);
    }

    public function importData(Request $request)
    {
        $file =  'uploads/' . $request->file;
        Excel::import(new DosenImport, $file);
        return redirect('webmin/dosen')->with('success', 'Data Berhasil Di Import');
    }
}
