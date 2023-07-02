<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Helpers\Summernote;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.home.berita.index', [
            'title'     => 'Homepage | Berita',
            'beritas'   => Berita::latest()->with('kategori')->filter(request(['judul', 'kategori']))->paginate(6)->withQueryString(),
            'kategoris' => Kategori::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.home.berita.create', [
            'title'     => 'Homepage | Berita',
            'kategoris' => Kategori::all()
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
            'kategori_id'     => 'required',
            'penulis'         => 'required',
            'is_banner'       => ''
        ]);

        if ($request->publish_at) {
            $validateData['publish_at'] = $request->publish_at;
        }

        if ($request->file('gambar')) {
            $ext = $request->file('gambar')->extension();
            $validateData['gambar'] = $request->file('gambar')->storeAs('images', Str::random() . '.' . $ext);
        }

        $validateData['body'] = Summernote::ImgUpload($request->body);

        Berita::create($validateData);
        return redirect(route('berita.index'))->with('success', 'Data Berhasil Di Simpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function show(Berita $beritum)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function edit(Berita $beritum)
    {
        return view('dashboard.home.berita.edit', [
            'title'     => 'Homepage | Berita',
            'kategoris' => Kategori::all(),
            'berita'    => $beritum
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Berita $beritum)
    {
        $validateData = $request->validate([
            'judul'           => 'required|max:128',
            'slug'            => 'required',
            'body'            => 'required',
            'kategori_id'     => 'required',
            'penulis'         => 'required',
            'is_banner'       => ''
        ]);

        if ($request->publish_at) {
            $validateData['publish_at'] = $request->publish_at;
        }

        if ($request->file('gambar')) {
            $ext = $request->file('gambar')->extension();
            $validateData['gambar'] = $request->file('gambar')->storeAs('images', Str::random() . '.' . $ext);
        }

        $validateData['body'] = Summernote::ImgUpload($request->body);

        Berita::where('id', $beritum->id)->update($validateData);
        return redirect($request->redirect_to)->with('success', 'Data Berhasil Di Simpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function destroy(Berita $beritum, Request $request)
    {
        Berita::destroy($beritum->id);
        return redirect($request->redirect_to)->with('success', 'Data Berhasil Di Hapus');
    }
}
