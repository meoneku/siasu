<?php

namespace App\Http\Controllers;

use App\Models\Bem;
use Illuminate\Http\Request;
use App\Helpers\Summernote;

class BemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.home.bem.edit', [
            'title'     => 'Homepage | BEM',
            'bem'       => Bem::find(1)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bem  $bem
     * @return \Illuminate\Http\Response
     */
    public function show(Bem $bem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bem  $bem
     * @return \Illuminate\Http\Response
     */
    public function edit(Bem $bem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bem  $bem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bem $bem)
    {
        $validateData = $request->validate([
            'judul'           => 'required|max:128',
            'body'            => 'required',
        ]);

        if ($request->publish_at) {
            $validateData['publish_at'] = $request->publish_at;
        }

        $validateData['body'] = Summernote::ImgUpload($request->body);

        Bem::where('id', $bem->id)->update($validateData);
        return redirect(route('bem.index'))->with('success', 'Data Berhasil Di Simpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bem  $bem
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bem $bem)
    {
        //
    }
}
