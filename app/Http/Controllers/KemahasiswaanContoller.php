<?php

namespace App\Http\Controllers;

use App\Models\Kemahasiswaan;
use Illuminate\Http\Request;
use App\Helpers\Summernote;

class KemahasiswaanContoller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.home.kemahasiswaan.index', [
            'title'     => 'Homepage | Kemahsiswaan',
            'kemahasiswaan' => Kemahasiswaan::filter(request(['judul']))->paginate(6)->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.home.kemahasiswaan.create', [
            'title'     => 'Homepage | Kemahsiswaan'
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
            'judul'           => 'required|max:128',
            'slug'            => 'required',
            'nm_menu'         => 'required',

        ]);

        if ($request->publish_at) {
            $validateData['publish_at'] = $request->publish_at;
        }

        $validateData['body'] = Summernote::ImgUpload($request->body);

        Kemahasiswaan::create($validateData);
        return redirect(route('kemahasiswaan.index'))->with('success', 'Data Berhasil Di Simpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kemahasiswaan  $kemahasiswaan
     * @return \Illuminate\Http\Response
     */
    public function show(Kemahasiswaan $kemahasiswaan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kemahasiswaan  $kemahasiswaan
     * @return \Illuminate\Http\Response
     */
    public function edit(Kemahasiswaan $kemahasiswaan)
    {
        return view('dashboard.home.kemahasiswaan.edit', [
            'title'     => 'Homepage | Kemahsiswaan',
            'kemahasiswaan' => $kemahasiswaan
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kemahasiswaan  $kemahasiswaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kemahasiswaan $kemahasiswaan)
    {
        $validateData = $request->validate([
            'judul'           => 'required|max:128',
            'slug'            => 'required',
            'nm_menu'         => 'required',

        ]);

        if ($request->publish_at) {
            $validateData['publish_at'] = $request->publish_at;
        }

        $validateData['body'] = Summernote::ImgUpload($request->body);

        Kemahasiswaan::where('id', $kemahasiswaan->id)->update($validateData);
        return redirect($request->redirect_to)->with('success', 'Data Berhasil Di Simpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kemahasiswaan  $kemahasiswaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kemahasiswaan $kemahasiswaan, Request $request)
    {
        Kemahasiswaan::destroy($kemahasiswaan->id);
        return redirect($request->redirect_to)->with('success', 'Data Berhasil Di Hapus');
    }
}
