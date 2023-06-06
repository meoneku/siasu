<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Inventaris;
use App\Models\JenisInventaris;
use Illuminate\Http\Request;

class InventarisController extends Controller
{
    public function getNoInventaris(Request $request)
    {
        $tahun = substr($request->tanggal, 0, 4);
        $bulan = (int)substr($request->tanggal, 5, 2);
        $jenis = JenisInventaris::find($request->jenis);
        $begin = 'INV/FT/' . $jenis->kode;
        $roma  = array("", "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");
        $inven = Inventaris::latest()->whereYear('tanggal_pembelian', $tahun)->first();
        $number = 1;
        if ($request->num_inv == "")
            if ($inven) {
                $lastNumber = substr($inven->no_inventaris, 0, 3);
                $intNumber =  ltrim($lastNumber, '0');
                $autonumber = sprintf("%03s", abs($intNumber + 1)) . '/' . $begin . '/' . $roma[$bulan] . '/' . $tahun;
            } else {
                $autonumber = sprintf("%03s", $number) . '/' . $begin . '/' . $roma[$bulan] . '/' . $tahun;
            }
        else {
            if ($tahun == $request->tahun) {
                $oldnumber = substr($request->num_inv, 0, 3);
                $autonumber = $oldnumber . '/' . $begin . '/' . $roma[$bulan] . '/' . $tahun;
            } else {
                if ($inven) {
                    $lastNumber = substr($inven->no_inventaris, 0, 3);
                    $intNumber =  ltrim($lastNumber, '0');
                    $autonumber = sprintf("%03s", abs($intNumber + 1)) . '/' . $begin . '/' . $roma[$bulan] . '/' . $tahun;
                } else {
                    $autonumber = sprintf("%03s", $number) . '/' . $begin . '/' . $roma[$bulan] . '/' . $tahun;
                }
            }
        }

        return $autonumber;
    }
}
