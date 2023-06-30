<?php

namespace App\Http\Controllers;

use App\Models\Sejarah;
use Illuminate\Http\Request;
use App\Helpers\Summernote;

class SejarahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.home.sejarah.edit', [
            'title'     => 'Homepage | Sejarah',
            'sejarah'   => Sejarah::find(1)
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
     * @param  \App\Models\Sejarah  $sejarah
     * @return \Illuminate\Http\Response
     */
    public function show(Sejarah $sejarah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sejarah  $sejarah
     * @return \Illuminate\Http\Response
     */
    public function edit(Sejarah $sejarah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sejarah  $sejarah
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sejarah $sejarah)
    {
        $validateData = $request->validate([
            'judul'           => 'required|max:128',
            'singkat'         => 'required',
            'body'            => 'required',
        ]);

        if ($request->publish_at) {
            $validateData['publish_at'] = $request->publish_at;
        }

        $validateData['body'] = Summernote::ImgUpload($request->body);
        $validateData['singkat'] = Summernote::ImgUpload($request->singkat);

        Sejarah::where('id', $sejarah->id)->update($validateData);
        return redirect(route('sejarah.index'))->with('success', 'Data Berhasil Di Simpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sejarah  $sejarah
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sejarah $sejarah)
    {
        //
    }
}
