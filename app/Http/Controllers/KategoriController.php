<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.home.kategori.index', [
            'title'     => 'Homepage | Data Kategori Berita',
            'kategori'  => Kategori::latest()->paginate(10)->withQueryString()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.home.kategori.create', [
            'title'     => 'Homepage | Data Kategoi Berita'
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
            'name'      => 'required|max:128',
            'slug'      => 'required'
        ]);

        Kategori::create($validateData);
        return redirect(route('kategori.index'))->with('success', 'Data Berhasil Di Simpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function show(Kategori $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function edit(Kategori $kategori)
    {
        return view('dashboard.home.kategori.edit', [
            'title'     => 'Homepage | Data Kategoi Berita',
            'kategori'  => $kategori
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kategori $kategori)
    {
        $validateData = $request->validate([
            'name'      => 'required|max:128',
            'slug'      => 'required'
        ]);

        Kategori::where('id', $kategori->id)->update($validateData);
        return redirect($request->redirect_to)->with('success', 'Data Berhasil Di Simpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kategori $kategori, Request $request)
    {
        Kategori::destroy($kategori->id);
        return redirect($request->redirect_to)->with('success', 'Data Berhasil Di Hapus');
    }
}
