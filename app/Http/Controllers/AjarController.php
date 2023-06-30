<?php

namespace App\Http\Controllers;

use App\Models\Ajar;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class AjarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.ajar.index', [
            'title'     => 'Dosen | Data Ajar',
            'ajar'   => Ajar::with('dosen')->filter(request(['nama', 'jurusan', 'semester']))->latest()->paginate(10)->withQueryString(),
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
        return view('dashboard.ajar.create', [
            'title'     => 'Dosen | Data Ajar',
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
            'niy'           => 'required',
            'semester'      => 'required',
            'sks'           => 'required',
            'kjm_pasca'     => '',
            'kjm_fai'       => '',
            'kjm_ft'        => '',
            'kjm_fti'       => '',
            'kjm_fe'        => '',
            'kjm_fip'       => '',
            'kjm_sore'      => '',
            'kjm_piba'      => '',
        ]);

        Ajar::create($validateData);
        return redirect('webmin/ajar?semester=' . $request->semester)->with('success', 'Data Berhasil Di Simpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ajar  $ajar
     * @return \Illuminate\Http\Response
     */
    public function show(Ajar $ajar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ajar  $ajar
     * @return \Illuminate\Http\Response
     */
    public function edit(Ajar $ajar)
    {
        return view('dashboard.ajar.edit', [
            'title'     => 'Dosen | Data Ajar',
            'ajar'      => $ajar
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ajar  $ajar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ajar $ajar)
    {
        $validateData   = $request->validate([
            'niy'           => 'required',
            'semester'      => 'required',
            'sks'           => 'required',
            'kjm_pasca'     => '',
            'kjm_fai'       => '',
            'kjm_ft'        => '',
            'kjm_fti'       => '',
            'kjm_fe'        => '',
            'kjm_fip'       => '',
            'kjm_sore'      => '',
            'kjm_piba'      => '',
        ]);

        Ajar::where('id', $ajar->id)
            ->update($validateData);
        return redirect($request->redirect_to)->with('success', 'Data Berhasil Di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ajar  $ajar
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Ajar $ajar)
    {
        Ajar::destroy($ajar->id);
        return redirect($request->redirect_to)->with('success', 'Data Berhasil Di Hapus');
    }
}
