<?php

namespace App\Http\Controllers;

use App\Models\Kalender;
use Illuminate\Http\Request;
use App\Helpers\Summernote;

class KalenderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.home.kalender.edit', [
            'title'     => 'Homepage | Kalender Akademik',
            'kalender'  => Kalender::find(1)
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
     * @param  \App\Models\Kalender  $kalender
     * @return \Illuminate\Http\Response
     */
    public function show(Kalender $kalender)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kalender  $kalender
     * @return \Illuminate\Http\Response
     */
    public function edit(Kalender $kalender)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kalender  $kalender
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kalender $kalender)
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

        Kalender::where('id', $kalender->id)->update($validateData);
        return redirect(route('kalender.index'))->with('success', 'Data Berhasil Di Simpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kalender  $kalender
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kalender $kalender)
    {
        //
    }
}
