<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('mahasiswa.home');
    }

    public function addPassword()
    {
        $mahasiswas = Mahasiswa::where('jurusan_id', 10)->get();

        foreach ($mahasiswas as $mahasiswa) {
            // echo $mahasiswa->nim .' '. bcrypt($mahasiswa->nim).'</br>';
            echo 'Sedang di Proses ....';
            Mahasiswa::where('id', $mahasiswa->id)->update(['password' => bcrypt($mahasiswa->nim)]);
        }
    }
}
