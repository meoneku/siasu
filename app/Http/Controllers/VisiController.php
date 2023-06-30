<?php

namespace App\Http\Controllers;

use App\Models\Visi;
use Illuminate\Http\Request;
use App\Helpers\Summernote;

class VisiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.home.visi.index', [
            'title'     => 'Homepage | Visi Misi',
            'visi'      => Visi::filter(request(['judul']))->paginate(6)->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.home.visi.create', [
            'title'     => 'Homepage | Visi Misi'
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

        Visi::create($validateData);
        return redirect(route('visi.index'))->with('success', 'Data Berhasil Di Simpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Visi  $visi
     * @return \Illuminate\Http\Response
     */
    public function show(Visi $visi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Visi  $visi
     * @return \Illuminate\Http\Response
     */
    public function edit(Visi $visi)
    {
        return view('dashboard.home.visi.edit', [
            'title'     => 'Homepage | Visi Misi',
            'visi'      => $visi
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Visi  $visi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Visi $visi)
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

        Visi::where('id', $visi->id)->update($validateData);
        return redirect($request->redirect_to)->with('success', 'Data Berhasil Di Simpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Visi  $visi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Visi $visi, Request $request)
    {
        Visi::destroy($visi->id);
        return redirect($request->redirect_to)->with('success', 'Data Berhasil Di Hapus');
    }
}
