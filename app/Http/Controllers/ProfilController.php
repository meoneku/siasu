<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use Illuminate\Http\Request;
use App\Helpers\Summernote;

class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.home.profil.index', [
            'title'     => 'Homepage | Profil',
            'profil'      => Profil::filter(request(['judul']))->paginate(6)->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.home.profil.create', [
            'title'     => 'Homepage | Profil'
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

        Profil::create($validateData);
        return redirect(route('profil.index'))->with('success', 'Data Berhasil Di Simpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profil  $profil
     * @return \Illuminate\Http\Response
     */
    public function show(Profil $profil)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profil  $profil
     * @return \Illuminate\Http\Response
     */
    public function edit(Profil $profil)
    {
        return view('dashboard.home.profil.edit', [
            'title'     => 'Homepage | Profil',
            'profil'    => $profil
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profil  $profil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profil $profil)
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

        Profil::where('id', $profil->id)->update($validateData);
        return redirect($request->redirect_to)->with('success', 'Data Berhasil Di Simpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profil  $profil
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profil $profil, Request $request)
    {
        Profil::destroy($profil->id);
        return redirect($request->redirect_to)->with('success', 'Data Berhasil Di Hapus');
    }
}
