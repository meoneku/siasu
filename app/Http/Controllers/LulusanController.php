<?php

namespace App\Http\Controllers;

use App\Models\Lulusan;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use App\Exports\LulusanExport;
use App\Imports\LulusanImport;
use Maatwebsite\Excel\Facades\Excel;

class LulusanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.lulusan.index', [
            'title'     => 'Mahasiswa | Data Lulusan',
            'lulusan'   => Lulusan::with('jurusan')->filter(request(['nama', 'jurusan', 'tahun']))->paginate(6)->withQueryString(),
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
        return view('dashboard.lulusan.create', [
            'title'     => 'Mahasiswa | Data Lulusan',
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
            'nim'           => 'required|max:11',
            'nama'          => 'required|max:128',
            'jurusan_id'    => 'required',
            'tempat_lahir'  => 'required|max:128',
            'tanggal_lahir' => 'required',
            'gender'        => 'required',
            'tanggal_lulus' => 'required',
            'tanggal_wisuda' => 'required',
            'pin'           => 'required|max:20',
            'nomorijazah'   => 'required|max:10',
            'judul_skripsi' => 'required',
            'foto'          => 'image|file'
        ]);

        if ($request->file('foto')) {
            $ext = $request->file('foto')->extension();
            $validateData['foto'] = $request->file('foto')->storeAs('lulusan', $request->nim . '.' . $ext);
        }

        Lulusan::create($validateData);
        return redirect('webmin/lulusan')->with('success', 'Data Berhasil Di Simpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lulusan  $lulusan
     * @return \Illuminate\Http\Response
     */
    public function show(Lulusan $lulusan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lulusan  $lulusan
     * @return \Illuminate\Http\Response
     */
    public function edit(Lulusan $lulusan)
    {
        return view('dashboard.lulusan.edit', [
            'title'     => 'Mahasiswa | Data Lulusan',
            'lulusan'   => $lulusan,
            'jurusan'   => Jurusan::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lulusan  $lulusan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lulusan $lulusan)
    {
        $validateData   = $request->validate([
            'nim'           => 'required|max:11',
            'nama'          => 'required|max:128',
            'jurusan_id'    => 'required',
            'tempat_lahir'  => 'required|max:128',
            'tanggal_lahir' => 'required',
            'gender'        => 'required',
            'tanggal_lulus' => 'required',
            'tanggal_wisuda' => 'required',
            'pin'           => 'required|max:20',
            'nomorijazah'   => 'required|max:10',
            'judul_skripsi' => 'required',
            'foto'          => 'image|file'
        ]);

        if ($request->file('foto')) {
            $ext = $request->file('foto')->extension();
            $validateData['foto'] = $request->file('foto')->storeAs('lulusan', $request->nim . '.' . $ext);
        }

        Lulusan::where('id', $lulusan->id)
            ->update($validateData);
        return redirect($request->redirect_to)->with('success', 'Data Berhasil Di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lulusan  $lulusan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lulusan $lulusan, Request $request)
    {
        Lulusan::destroy($lulusan->id);
        return redirect($request->redirect_to)->with('success', 'Data Berhasil Di Hapus');
    }

    public function DownloadTemplate()
    {
        return Excel::download(new LulusanExport, 'Lulusan-Template.xlsx');
    }

    public function import()
    {
        return view('dashboard.lulusan.import', [
            'title'     => 'Mahasiswa | Data Lulusan',
        ]);
    }

    public function importView(Request $request)
    {
        $file   = $request->file('file')->store('import-file');
        $rows   = Excel::toArray(new LulusanImport, $file);
        $jurusan = collect(Jurusan::all());
        return view('dashboard.lulusan.importview', [
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
        Excel::import(new LulusanImport, $file);
        return redirect('webmin/lulusan')->with('success', 'Data Berhasil Di Import');
    }
}
