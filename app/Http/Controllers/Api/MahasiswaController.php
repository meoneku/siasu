<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Skripsi;

class MahasiswaController extends Controller
{
    public function index()
    {
        echo "404";
    }

    public function getMahasiswa(Request $request)
    {
        $search     = $request->search;

        if ($search == '') {
            $datas    = Mahasiswa::orderby('nama', 'asc')->with('jurusan')->limit(10)->get();
        } else {
            $datas    = Mahasiswa::orderby('nama', 'asc')->where('nama', 'like', '%' . $search . '%')->with('jurusan')->limit(10)->get();
        }

        $response = array();
        foreach ($datas as $mahasiswa) {
            $response[] = array(
                "nim"       => $mahasiswa->nim,
                "label"     => $mahasiswa->nim . ' | ' . $mahasiswa->nama . ' | ' . $mahasiswa->jurusan->jurusan,
                "nama"      => $mahasiswa->nama,
                "jurusan"   => $mahasiswa->jurusan->jenjang . ' ' . $mahasiswa->jurusan->jurusan,
                "id"        => $mahasiswa->id
            );
        }

        return response()->json($response);
    }

    public function getDataSkripsi(Request $request)
    {
        $search     = $request->search;

        if ($search == '') {
            $datas    = Skripsi::orderby('mahasiswa_id', 'asc')->with('mahasiswa')->limit(10)->get();
        } else {
            $datas    = Skripsi::with('mahasiswa')->with('batch')->filter(request(['search']))->where('status', '!=', 4)->limit(10)->get();
        }

        $response = array();
        foreach ($datas as $data) {
            $response[] = array(
                "nim"       => $data->mahasiswa->nim,
                "label"     => $data->mahasiswa->nim . ' | ' . $data->mahasiswa->nama . ' | ' . $data->mahasiswa->jurusan->jurusan,
                "nama"      => $data->mahasiswa->nama,
                "jurusan"   => $data->mahasiswa->jurusan->jenjang . ' ' . $data->mahasiswa->jurusan->jurusan,
                "id"        => $data->mahasiswa->id,
                "dosen_id"  => $data->dosen_id,
                "dosen"     => $data->dosen->nama,
                "lokasi"    => $data->lokasi_penelitian,
                "judul"     => $data->judul_skripsi
            );
        }

        return response()->json($response);
    }
}
