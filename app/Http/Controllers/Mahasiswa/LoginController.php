<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('mahasiswa.login');
    }

    public function auth(Request $request)
    {
        $credentials = $request->validate([
            'nim'       => 'required',
            'password'  => 'required'
        ]);

        // if (auth()->guard('admin')->attempt(['username' => $request->username,  'password' => $request->password])) {
        //     $user = auth()->guard('admin')->user();
        //     if ($user->is_admin == 1) {
        //         return redirect()->route('dashboard')->with('message', 'Berhasil Masuk');
        //     }
        // } else {
        //     return back()->with('message', 'Username atau Password Tidak Cocok!');
        // }

        if (Auth::guard('mahasiswa')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('mahasiswa.beranda');
        }

        return back()->with('message', 'NIM atau Password Tidak Cocok!');
    }

    public function logout(Request $request)
    {
        auth()->guard('mahasiswa')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(route('mahasiswa.login'));
    }

    public function nim()
    {
        return 'nim';
    }

    public function getAuthPassword()
    {
        return $this->password;
    }
}
