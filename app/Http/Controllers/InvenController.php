<?php

namespace App\Http\Controllers;

use App\Models\Inventaris;
use App\Models\JenisInventaris;
use Illuminate\Http\Request;

class InvenController extends Controller
{
    private $penempatan = ['Kantor Fakultas', 'Kantor Prodi', 'Kantor Laboratorium', 'Kelas Perkuliahan', 'Laboratorium'];
    private $asal = ['Universitas', 'Fakultas', 'Prodi', 'Bantuan', 'Hibah', 'Lain-lain'];
    private $kondisi = ['Baik', 'Sedang', 'Rusak'];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.inventaris.index', [
            'title'     => 'Master | Data Inventaris',
            'penempatan' => $this->penempatan,
            'inventaris' => Inventaris::latest()->with('jenis')->filter(request(['nama', 'kondisi', 'tahun', 'penempatan']))->paginate(10)->withQueryString()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.inventaris.create', [
            'title'     => 'Master | Data Inventaris',
            'penempatan' => $this->penempatan,
            'asal'      => $this->asal,
            'kondisi'      => $this->kondisi,
            'jenis'     => JenisInventaris::all()
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
            'nama_barang'           => 'required',
            'penempatan'            => 'required',
            'kondisi'               => 'required',
            'no_inventaris'         => 'required',
            'asal_barang'           => 'required',
            'jenis_inventaris_id'   => 'required',
            'tanggal_pembelian'     => 'required'
        ]);

        if ($request->harga_barang) {
            $validateData['harga_barang'] = preg_replace('/[^0-9-,]+/', '', $request->harga_barang);
        }

        $validateData['status'] = "in_house";

        Inventaris::create($validateData);
        return redirect('webmin/inventaris')->with('success', 'Data Berhasil Di Simpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inventaris  $inventaris
     * @return \Illuminate\Http\Response
     */
    public function show(Inventaris $inventari)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inventaris  $inventaris
     * @return \Illuminate\Http\Response
     */
    public function edit(Inventaris $inventari)
    {
        return view('dashboard.inventaris.edit', [
            'title'     => 'Master | Data Inventaris',
            'penempatan' => $this->penempatan,
            'asal'      => $this->asal,
            'kondisi'   => $this->kondisi,
            'jenis'     => JenisInventaris::all(),
            'inven'     => $inventari
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inventaris  $inventaris
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inventaris $inventari)
    {
        $validateData   = $request->validate([
            'nama_barang'           => 'required',
            'penempatan'            => 'required',
            'kondisi'               => 'required',
            'no_inventaris'         => 'required',
            'asal_barang'           => 'required',
            'jenis_inventaris_id'   => 'required',
            'tanggal_pembelian'     => 'required'
        ]);

        if ($request->harga_barang) {
            $validateData['harga_barang'] = preg_replace('/[^0-9-,]+/', '', $request->harga_barang);
        }

        Inventaris::where('id', $inventari->id)->update($validateData);
        return redirect($request->redirect_to)->with('success', 'Data Berhasil Di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inventaris  $inventaris
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inventaris $inventari, Request $request)
    {
        Inventaris::destroy($inventari->id);
        return redirect($request->redirect_to)->with('success', 'Data Berhasil Di Hapus');
    }
}
