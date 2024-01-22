<?php

namespace App\Http\Controllers;

use App\Exports\VAExport;
use App\Imports\VAImport;
use App\Models\VA;
use App\Models\Jurusan;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class VAController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.va.index', [
            'title'     => 'Master | Virtual Account',
            'vas'       => VA::with('mahasiswa')->with('kegiatan')->filter(request(['nama', 'kegiatan', 'jurusan']))->paginate(20)->withQueryString(),
            'jurusans'  => Jurusan::all(),
            'kegiatans' => Kegiatan::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(VA $va)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(va $va)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, VA $va)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VA $va)
    {
        //
    }

    public function import()
    {
        return view('dashboard.va.import', [
            'title'     => 'Master | Virtual Account',
        ]);
    }

    public function templateImport()
    {
        return Excel::download(new VAExport, 'VA-Template.xlsx');
    }

    public function importData(Request $request)
    {
        $file   = $request->file('file')->store('import-file');
        Excel::import(new VAImport, $file);
        return redirect(route('va.index'))->with('success', 'Data Berhasil Di Import');
    }
}
