<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Helpers\Summernote;

class PengumumanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.home.pengumuman.index', [
            'title'     => 'Homepage | Pengumuman',
            'pengumumans'   => Pengumuman::latest()->filter(request(['tahun']))->paginate(6)->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.home.pengumuman.create', [
            'title'     => 'Homepage | Pengumuman'
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
            'body'            => 'required',

        ]);

        if ($request->publish_at) {
            $validateData['publish_at'] = $request->publish_at;
        }

        if ($request->file('gambar')) {
            $ext = $request->file('gambar')->extension();
            $validateData['gambar'] = $request->file('gambar')->storeAs('pengumuman', Str::random() . '.' . $ext);
        }

        if ($request->file('file')) {
            $ext = $request->file('file')->extension();
            $validateData['file'] = $request->file('file')->storeAs('pengumuman', Str::random() . '.' . $ext);
        }

        $validateData['body'] = Summernote::ImgUpload($request->body);

        Pengumuman::create($validateData);
        return redirect(route('pengumuman.index'))->with('success', 'Data Berhasil Di Simpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pengumuman  $pengumuman
     * @return \Illuminate\Http\Response
     */
    public function show(Pengumuman $pengumuman)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pengumuman  $pengumuman
     * @return \Illuminate\Http\Response
     */
    public function edit(Pengumuman $pengumuman)
    {
        return view('dashboard.home.pengumuman.edit', [
            'title'     => 'Homepage | Pengumuman',
            'pengumuman' => $pengumuman
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pengumuman  $pengumuman
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pengumuman $pengumuman)
    {
        $validateData = $request->validate([
            'judul'           => 'required|max:128',
            'slug'            => 'required',
            'body'            => 'required',
        ]);

        if ($request->publish_at) {
            $validateData['publish_at'] = $request->publish_at;
        }

        if ($request->file('gambar')) {
            $ext = $request->file('gambar')->extension();
            $validateData['gambar'] = $request->file('gambar')->storeAs('pengumuman', Str::random() . '.' . $ext);
        }

        if ($request->file('file')) {
            $ext = $request->file('file')->extension();
            $validateData['file'] = $request->file('file')->storeAs('pengumuman', Str::random() . '.' . $ext);
        }

        $validateData['body'] = Summernote::ImgUpload($request->body);

        Pengumuman::where('id', $pengumuman->id)->update($validateData);
        return redirect($request->redirect_to)->with('success', 'Data Berhasil Di Simpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pengumuman  $pengumuman
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pengumuman $pengumuman, Request $request)
    {
        Pengumuman::destroy($pengumuman->id);
        return redirect($request->redirect_to)->with('success', 'Data Berhasil Di Hapus');
    }
}
