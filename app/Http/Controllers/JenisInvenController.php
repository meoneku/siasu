<?php

namespace App\Http\Controllers;

use App\Models\JenisInventaris;
use Illuminate\Http\Request;

class JenisInvenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.jenis_inven.index', [
            'title'     => 'Master | Data Jenis Inventaris',
            'jenis'     => JenisInventaris::paginate(10)->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.jenis_inven.create', [
            'title'     => 'Master | Data Jenis Inventaris'
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
            'nama'           => 'required|max:128',
            'kode'           => 'required|max:10'
        ]);

        JenisInventaris::create($validateData);
        return redirect('webmin/jenisinven')->with('success', 'Data Berhasil Di Simpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JenisInventaris  $jenisInventaris
     * @return \Illuminate\Http\Response
     */
    public function show(JenisInventaris $jenisInventaris)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JenisInventaris  $jenisInventaris
     * @return \Illuminate\Http\Response
     */
    public function edit(JenisInventaris $jenisinven)
    {
        return view('dashboard.jenis_inven.edit', [
            'title'     => 'Master | Data Jenis Inventaris',
            'jenis'     => $jenisinven
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JenisInventaris  $jenisInventaris
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JenisInventaris $jenisinven)
    {
        $validateData = $request->validate([
            'nama'           => 'required|max:128',
            'kode'           => 'required|max:10'
        ]);

        JenisInventaris::where('id', $jenisinven->id)
            ->update($validateData);
        return redirect($request->redirect_to)->with('success', 'Data Berhasil Di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JenisInventaris  $jenisInventaris
     * @return \Illuminate\Http\Response
     */
    public function destroy(JenisInventaris $jenisinven, Request $request)
    {
        JenisInventaris::destroy($jenisinven->id);
        return redirect($request->redirect_to)->with('success', 'Data Berhasil Di Hapus');
    }
}
