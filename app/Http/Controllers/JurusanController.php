<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.jurusan.index', [
            'title'     => 'Master | Data Jurusan',
            'jurusan'   => Jurusan::latest()->paginate(10)->withQueryString()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.jurusan.create', [
            'title'     => 'Master | Data Jurusan'
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
        $validateData = $request->validate([
            'jurusan'           => 'required|max:128',
            'singkatan'         => 'required|max:10',
            'jenjang'           => 'required|max:2',
            'fakultas'          => 'required|max:30',
            'akreditasi'        => 'required|max:20',
            'nomor_akreditasi'  => 'required|max:50'
        ]);

        Jurusan::create($validateData);
        return redirect('webmin/jurusan')->with('success', 'Data Berhasil Di Simpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jurusan  $jurusan
     * @return \Illuminate\Http\Response
     */
    public function show(Jurusan $jurusan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jurusan  $jurusan
     * @return \Illuminate\Http\Response
     */
    public function edit(Jurusan $jurusan)
    {
        return view('dashboard.jurusan.edit', [
            'title'     => 'Master | Data Jurusan',
            'jurusan'  => $jurusan
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Jurusan  $jurusan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jurusan $jurusan)
    {
        $validateData = $request->validate([
            'jurusan'           => 'required|max:128',
            'singkatan'         => 'required|max:10',
            'jenjang'           => 'required|max:2',
            'fakultas'          => 'required|max:30',
            'akreditasi'        => 'required|max:20',
            'nomor_akreditasi'  => 'required|max:50'
        ]);

        Jurusan::where('id', $jurusan->id)
            ->update($validateData);
        return redirect($request->redirect_to)->with('success', 'Data Berhasil Di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jurusan  $jurusan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Jurusan $jurusan)
    {
        Jurusan::destroy($jurusan->id);
        return redirect($request->redirect_to)->with('success', 'Data Berhasil Di Hapus');
    }
}
