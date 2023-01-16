<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Jabatan;
use App\Models\Kegiatan;
use Illuminate\Http\Request;

class BatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.batch.index', [
            'title'     => 'Master | Data Batch',
            'batchs'    => Batch::with('kegiatan')->filter(request(['nama', 'tahun']))->latest()->paginate(10)->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.batch.create', [
            'title'     => 'Master | Data Batch',
            'kegiatans' => Kegiatan::all()
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
        $validateData   = $request->validate([
            'nama'          => 'required',
            'kegiatan_id'   => 'required',
            'mulai'         => 'required',
            'selesai'       => 'required',
            'tahun'         => 'required'
        ]);

        Batch::create($validateData);
        return redirect('webmin/batch')->with('success', 'Data Berhasil Di Simpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Batch  $batch
     * @return \Illuminate\Http\Response
     */
    public function show(Batch $batch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Batch  $batch
     * @return \Illuminate\Http\Response
     */
    public function edit(Batch $batch)
    {
        return view('dashboard.batch.edit', [
            'title'     => 'Master | Data Batch',
            'kegiatans' => Kegiatan::all(),
            'batch'     => $batch
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Batch  $batch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Batch $batch)
    {
        $validateData   = $request->validate([
            'nama'          => 'required',
            'kegiatan_id'   => 'required',
            'mulai'         => 'required',
            'selesai'       => 'required',
            'tahun'         => 'required'
        ]);

        Batch::where('id', $batch->id)
            ->update($validateData);
        return redirect($request->redirect_to)->with('success', 'Data Berhasil Di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Batch  $batch
     * @return \Illuminate\Http\Response
     */
    public function destroy(Batch $batch, Request $request)
    {
        Batch::destroy($batch->id);
        return redirect($request->redirect_to)->with('success', 'Data Berhasil Di Hapus');
    }
}
