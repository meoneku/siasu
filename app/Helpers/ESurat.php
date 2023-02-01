<?php

namespace App\Helpers;

use App\Models\Surat;

class ESurat
{
    public static function makeNomorSurat($id_jurusan, $jurusan, $kode_surat)
    {
        $begin = 'UNHASY/EL/' . $jurusan . '/' . $kode_surat;
        $roma = array("", "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");
        $surat = Surat::latest()->where('tahun', date('Y'))->where('jurusan_id', $id_jurusan)->first();
        $number = 1;
        if ($surat) {
            $lastNumber = substr($surat->no_surat, 0, 3);
            $intNumber =  preg_replace('/[0]/', '', $lastNumber);
            $autonumber = sprintf("%03s", abs($intNumber + 1)) . '/' . $begin . '/' . $roma[date('n')] . '/' . date('Y');
        } else {
            $autonumber = sprintf("%03s", $number) . '/' . $begin . '/' . $roma[date('n')] . '/' . date('Y');
        }

        return $autonumber;
    }
}
