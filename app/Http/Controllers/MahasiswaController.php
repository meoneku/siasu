<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use App\Exports\MahasiswaExport;
use App\Imports\MahasiswaImport;
use Maatwebsite\Excel\Facades\Excel;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.mahasiswa.index', [
            'title'     => 'Mahasiswa | Data Mahasiswa',
            'mahasiswa' => Mahasiswa::with('jurusan')->filter(request(['nama', 'jurusan']))->paginate(6)->withQueryString(),
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
        $status = ['Aktif', 'Cuti', 'Lulus', 'Mengundurkan Diri'];
        return view('dashboard.mahasiswa.create', [
            'title'     => 'Mahasiswa | Data Mahasiswa',
            'jurusan'   => Jurusan::all(),
            'status'    => $status
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
            'nim'           => 'required|max:10',
            'nama'          => 'required|max:128',
            'jurusan_id'    => 'required',
            'status'        => 'required',
            'foto'          => 'image|file'
        ]);

        if ($request->file('foto')) {
            $ext = $request->file('foto')->extension();
            $validateData['foto'] = $request->file('foto')->storeAs('mahasiswa', $request->nim . '.' . $ext);
        }

        Mahasiswa::create($validateData);
        return redirect('webmin/mahasiswa')->with('success', 'Data Berhasil Di Simpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function show(Mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function edit(Mahasiswa $mahasiswa)
    {
        $status = ['Aktif', 'Cuti', 'Lulus', 'Mengundurkan Diri'];
        return view('dashboard.mahasiswa.edit', [
            'title'     => 'Mahasiswa | Data Mahasiswa',
            'jurusan'   => Jurusan::all(),
            'status'    => $status,
            'mahasiswa' => $mahasiswa
        ]); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $validateData   = $request->validate([
            'nim'           => 'required|max:10',
            'nama'          => 'required|max:128',
            'jurusan_id'    => 'required',
            'status'        => 'required',
            'foto'          => 'image|file'
        ]);

        if ($request->file('foto')) {
            $ext = $request->file('foto')->extension();
            $validateData['foto'] = $request->file('foto')->storeAs('mahasiswa', $request->nim . '.' . $ext);
        }

        Mahasiswa::where('id', $mahasiswa->id)
            ->update($validateData);
        return redirect($request->redirect_to)->with('success', 'Data Berhasil Di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mahasiswa $mahasiswa, Request $request)
    {
        Mahasiswa::destroy($mahasiswa->id);
        return redirect($request->redirect_to)->with('success', 'Data Berhasil Di Hapus');
    }

    public function DownloadTemplate()
    {
        return Excel::download(new MahasiswaExport, 'Mahasiswa-Template.xlsx');
    }

    public function import()
    {
        return view('dashboard.mahasiswa.import', [
            'title'     => 'Mahasiswa | Data Mahasiswa',
        ]);
    }

    public function importView(Request $request)
    {
        $file   = $request->file('file')->store('import-file');
        $rows   = Excel::toArray(new MahasiswaImport, $file);
        $jurusan = collect(Jurusan::all());
        return view('dashboard.mahasiswa.importview', [
            'title'     => 'Mahasiswa | Data Mahasiswa',
            'rows'      => $rows[0],
            'CountRows' => count($rows[0]),
            'jurusan'   => $jurusan,
            'file'      => $file,
        ]);
    }

    public function importData(Request $request)
    {
        $file =  'uploads/' . $request->file;
        Excel::import(new MahasiswaImport, $file);
        return redirect('webmin/mahasiswa')->with('success', 'Data Berhasil Di Import');
    }
}
