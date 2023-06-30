<?php

namespace App\Http\Controllers;

use App\Models\Hmp;
use Illuminate\Http\Request;
use App\Helpers\Summernote;

class HmpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.home.hmp.index', [
            'title'     => 'Homepage | HMP',
            'hmp'       => Hmp::filter(request(['judul']))->paginate(6)->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.home.hmp.create', [
            'title'     => 'Homepage | HMP'
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

        Hmp::create($validateData);
        return redirect(route('hmp.index'))->with('success', 'Data Berhasil Di Simpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hmp  $hmp
     * @return \Illuminate\Http\Response
     */
    public function show(Hmp $hmp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hmp  $hmp
     * @return \Illuminate\Http\Response
     */
    public function edit(Hmp $hmp)
    {
        return view('dashboard.home.hmp.edit', [
            'title'     => 'Homepage | HMP',
            'hmp'       => $hmp
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Hmp  $hmp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hmp $hmp)
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

        Hmp::where('id', $hmp->id)->update($validateData);
        return redirect($request->redirect_to)->with('success', 'Data Berhasil Di Simpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hmp  $hmp
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hmp $hmp, Request $request)
    {
        Hmp::destroy($hmp->id);
        return redirect($request->redirect_to)->with('success', 'Data Berhasil Di Hapus');
    }
}
