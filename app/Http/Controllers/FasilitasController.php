<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FasilitasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.home.fasilitas.index', [
            'title'     => 'Homepage | Data Fasilitas',
            'fasilitas' => Fasilitas::latest()->paginate(10)->withQueryString()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.home.fasilitas.create', [
            'title'     => 'Homepage | Data Fasilitas'
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
            'deskripsi'           => 'required|max:128',
        ]);

        if ($request->file('gambar')) {
            $ext = $request->file('gambar')->extension();
            $validateData['gambar'] = $request->file('gambar')->storeAs('fasilitas', Str::random() . '.' . $ext);
        }

        Fasilitas::create($validateData);
        return redirect(route('fasilitas.index'))->with('success', 'Data Berhasil Di Simpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fasilitas  $fasilitas
     * @return \Illuminate\Http\Response
     */
    public function show(Fasilitas $fasilitas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fasilitas  $fasilitas
     * @return \Illuminate\Http\Response
     */
    public function edit(Fasilitas $fasilita)
    {
        return view('dashboard.home.fasilitas.edit', [
            'title'     => 'Homepage | Data Fasilitas',
            'fasilitas' => $fasilita
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fasilitas  $fasilitas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fasilitas $fasilita)
    {
        $validateData = $request->validate([
            'deskripsi'           => 'required|max:128',
        ]);

        if ($request->file('gambar')) {
            $ext = $request->file('gambar')->extension();
            $validateData['gambar'] = $request->file('gambar')->storeAs('fasilitas', Str::random() . '.' . $ext);
        }
        Fasilitas::where('id', $fasilita->id)->update($validateData);
        return redirect($request->redirect_to)->with('success', 'Data Berhasil Di Simpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fasilitas  $fasilitas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fasilitas $fasilita, Request $request)
    {
        Fasilitas::destroy($fasilita->id);
        return redirect($request->redirect_to)->with('success', 'Data Berhasil Di Hapus');
    }
}
