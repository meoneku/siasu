<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class Codes
{
    public static function getPeriodeDikti($periode)
    {
        $semester = substr($periode, 4);
        $tahun    = substr($periode, 0, 4);
        if ($semester % 2 == 0) {
            $tahunmin = $tahun - 1;
            $period = $tahunmin . '2';
        } else {
            $period = $tahun . '1';
        }
        return $period;
    }

    public static function getNIYDosen($dosen)
    {
        $resultDosen = DB::table('dosen')
            ->where('nama', $dosen)
            ->value('niy');
        return $resultDosen;
    }

    public static function getSemesterNow()
    {
        $month = date('m');
        $year  = date('Y');
        if ($month == 1 ) {
            $year_semester = $year - 1;
            $semester = $year_semester . '1';
        } elseif ($month >= 2 AND $month <= 7) {
            $year_semester = $year - 1;
            $semester = $year_semester . '2';
        } else {
            $semester = $year . '1';
        }
        return $semester;
    }
}