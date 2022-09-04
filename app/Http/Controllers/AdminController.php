<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    public function index()
    {
        return view('dashboard.login');
    }

    public function auth(Request $request)
    {
        $credentials = $request->validate([
            'username'  => 'required',
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

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }

        return back()->with('message', 'Username atau Password Tidak Cocok!');
    }

    public function logout(Request $request)
    {
        auth()->guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(route('webmin'));
    }

    public function username()
    {
        return 'username';
    }

    public function getAuthPassword()
    {
        return $this->passowrd;
    }
}
