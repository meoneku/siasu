<?php

namespace App\Exports;

use App\Models\Jurusan;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DosenExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('dashboard.dosen.expTemplate', [
            'jurusan'   => Jurusan::all()
        ]);
    }
}
