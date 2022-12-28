<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mahasiswa;

class MahasiswaController extends Controller
{
    public function index()
    {
        echo "404";
    }

    public function getMahasiswa(Request $request)
    {
        $search     = $request->search;

        if($search == ''){
            $datas    = Mahasiswa::orderby('nama','asc')->with('jurusan')->limit(10)->get();
        } else {
            $datas    = Mahasiswa::orderby('nama','asc')->where('nama', 'like', '%'. $search .'%')->with('jurusan')->limit(10)->get();
        }

        $response = array();
        foreach ($datas as $mahasiswa) {
            $response[] = array(
                "nim"       => $mahasiswa->nim,
                "label"     => $mahasiswa->nim .' | '. $mahasiswa->nama .' | '. $mahasiswa->jurusan->jurusan,
                "nama"      => $mahasiswa->nama,
                "jurusan"   => $mahasiswa->jurusan->jenjang . ' ' .$mahasiswa->jurusan->jurusan,
            );
        }

        return response()->json($response);
    }
}
