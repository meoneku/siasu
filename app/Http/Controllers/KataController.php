<?php

namespace App\Http\Controllers;

use App\Models\Kata;
use Illuminate\Http\Request;

class KataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.kata.index', [
            'title'     => 'Master | Daftar Kata Ganti',
            'kata2'     => Kata::latest()->paginate(10)->withQueryString()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.kata.create', [
            'title'     => 'Master | Daftar Kata Ganti',
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
            'kata_cari'  => 'required|max:200',
            'kata_ganti' => 'required|max:200',
        ]);

        Kata::create($validateData);
        return redirect('webmin/kata')->with('success', 'Data Berhasil Di Simpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kata  $kata
     * @return \Illuminate\Http\Response
     */
    public function show(Kata $katum)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kata  $kata
     * @return \Illuminate\Http\Response
     */
    public function edit(Kata $katum)
    {
        return view('dashboard.kata.edit', [
            'title'     => 'Master | Daftar Kata Ganti',
            'kata'      => $katum
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kata  $kata
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kata $katum)
    {
        $validateData = $request->validate([
            'kata_cari'  => 'required|max:200',
            'kata_ganti' => 'required|max:200',
        ]);

        Kata::where('id', $katum->id)
            ->update($validateData);
        return redirect($request->redirect_to)->with('success', 'Data Berhasil Di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kata  $kata
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kata $katum, Request $request)
    {
        Kata::destroy($katum->id);
        return redirect($request->redirect_to)->with('success', 'Data Berhasil Di Hapus');
    }
}
