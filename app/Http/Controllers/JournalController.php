<?php

namespace App\Http\Controllers;

use App\Models\Ejournal;
use Illuminate\Http\Request;

class JournalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.home.ejournal.index', [
            'title'     => 'Homepage | Link EJournal',
            'journal'   => Ejournal::latest()->paginate(10)->withQueryString()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.home.ejournal.create', [
            'title'     => 'Homepage | Link EJournal'
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
            'nm_menu'      => 'required|max:128',
            'link'         => 'required'
        ]);

        Ejournal::create($validateData);
        return redirect(route('ejournal.index'))->with('success', 'Data Berhasil Di Simpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ejournal  $ejournal
     * @return \Illuminate\Http\Response
     */
    public function show(Ejournal $ejournal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ejournal  $ejournal
     * @return \Illuminate\Http\Response
     */
    public function edit(Ejournal $ejournal)
    {
        return view('dashboard.home.ejournal.edit', [
            'title'     => 'Homepage | Link EJournal',
            'journal'   => $ejournal
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ejournal  $ejournal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ejournal $ejournal)
    {
        $validateData = $request->validate([
            'nm_menu'      => 'required|max:128',
            'link'         => 'required'
        ]);

        Ejournal::where('id', $ejournal->id)->update($validateData);
        return redirect($request->redirect_to)->with('success', 'Data Berhasil Di Simpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ejournal  $ejournal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ejournal $ejournal, Request $request)
    {
        Ejournal::destroy($ejournal->id);
        return redirect($request->redirect_to)->with('success', 'Data Berhasil Di Hapus');
    }
}
