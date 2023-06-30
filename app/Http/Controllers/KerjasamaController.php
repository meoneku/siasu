<?php

namespace App\Http\Controllers;

use App\Models\Kerjasama;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KerjasamaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.home.kerjasama.index', [
            'title'     => 'Homepage | Data Kerjasama',
            'kerjasama' => Kerjasama::latest()->paginate(10)->withQueryString()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.home.kerjasama.create', [
            'title'     => 'Homepage | Data Kerjasama'
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
            'nm_instansi'   => 'required|max:128',
        ]);

        if ($request->file('logo')) {
            $ext = $request->file('logo')->extension();
            $validateData['logo'] = $request->file('logo')->storeAs('kerjasama', Str::random() . '.' . $ext);
        }

        Kerjasama::create($validateData);
        return redirect(route('kerjasama.index'))->with('success', 'Data Berhasil Di Simpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kerjasama  $kerjasama
     * @return \Illuminate\Http\Response
     */
    public function show(Kerjasama $kerjasama)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kerjasama  $kerjasama
     * @return \Illuminate\Http\Response
     */
    public function edit(Kerjasama $kerjasama)
    {
        return view('dashboard.home.kerjasama.edit', [
            'title'     => 'Homepage | Data Kerjasama',
            'kerjasama' => $kerjasama
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kerjasama  $kerjasama
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kerjasama $kerjasama)
    {
        $validateData = $request->validate([
            'nm_instansi'   => 'required|max:128',
        ]);

        if ($request->file('logo')) {
            $ext = $request->file('logo')->extension();
            $validateData['logo'] = $request->file('logo')->storeAs('kerjasama', Str::random() . '.' . $ext);
        }

        Kerjasama::where('id', $kerjasama->id)->update($validateData);
        return redirect($request->redirect_to)->with('success', 'Data Berhasil Di Simpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kerjasama  $kerjasama
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kerjasama $kerjasama, Request $request)
    {
        Kerjasama::destroy($kerjasama->id);
        return redirect($request->redirect_to)->with('success', 'Data Berhasil Di Hapus');
    }
}
