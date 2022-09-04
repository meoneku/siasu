<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{
    public function parameter()
    {
        return view('dashboard.settings.parameter', [
            'title'     => 'Setting | Parameter'
        ]);
    }

    public function parameterStore(Request $request)
    {
        $this->setEnv('GRADUATION_YEAR_BEGIN', $request->tahunlulus);
        $this->setEnv('SEMESTER_YEAR_BEGIN', $request->semester);
        $this->setEnv('SEPARATOR', $request->separator);

        return redirect('webmin/parameter')->with('success', 'Konfigurasi Berhasil Di Rubah');
    }

    public function password()
    {
        return view('dashboard.settings.password', [
            'title'     => 'Setting | Password'
        ]);
    }

    public function passwordStore(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        if (!Hash::check($request->old_password, Auth::guard('admin')->user()->password)) {
            return back()->with("success", "Password Lama Tidak Cocok");
        }

        Admin::whereId(Auth::guard('admin')->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with("success", "Password Berhasil Di Rubah");
    }

    public function profil()
    {
        return view('dashboard.settings.profil', [
            'title'     => 'Setting | Profil'
        ]);
    }

    public function profilStore(Request $request)
    {
        $validateData   = $request->validate([
            'nama'          => 'required|max:100',
            'username'      => 'required|max:100',
            'email'         => 'required|max:100',
            'role'          => 'required|max:20',
        ]);

        Admin::where('id', Auth::guard('admin')->user()->id)
            ->update($validateData);
        return redirect('webmin/profil')->with('success', 'Profil Berhasil Di Rubah');
    }

    public function setEnv($name, $value)
    {
        $path = base_path('.env');
        if (file_exists($path)) {
            file_put_contents($path, str_replace(
                $name . '=' . env($name),
                $name . '=' . $value,
                file_get_contents($path)
            ));
        }
    }
}
