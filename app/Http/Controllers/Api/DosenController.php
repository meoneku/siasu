<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        echo "log b10";
    }

    public function getDosen(Request $request)
    {
        $search     = $request->search;

        if($search == ''){
            $dosens    = Dosen::orderby('nama','asc')->with('jurusan')->limit(10)->get();
        } else {
            $dosens    = Dosen::orderby('nama','asc')->where('nama', 'like', '%'. $search .'%')->with('jurusan')->limit(10)->get();
        }

        $response = array();
        foreach ($dosens as $dosen) {
            $response[] = array(
                "niy"       => $dosen->niy,
                "label"     => $dosen->niy .'| '. $dosen->nama .'| '. $dosen->jurusan->jurusan,
                "nama"      => $dosen->nama,
                "jurusan"   => $dosen->jurusan->jenjang . ' ' .$dosen->jurusan->jurusan,
                "nidn"      => $dosen->nidn
            );
        }

        return response()->json($response);
    }
}
