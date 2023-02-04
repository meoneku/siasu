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
        if ($month == 1) {
            $year_semester = $year - 1;
            $semester = $year_semester . '1';
        } elseif ($month >= 2 and $month <= 7) {
            $year_semester = $year - 1;
            $semester = $year_semester . '2';
        } else {
            $semester = $year . '1';
        }
        return $semester;
    }

    public static function getTA($periode)
    {
        $getYear = substr($periode, 0, 4);
        $getNextYear = $getYear + 1;
        $getSemester = substr($periode, 4);

        if ($getSemester % 2 == 0) {
            $TA = 'Genap TA ' . $getYear . '/' . $getNextYear;
        } else {
            $TA = 'Gasal TA ' . $getYear . '/' . $getNextYear;
        }

        return $TA;
    }

    public static function getStatusSkripsi($id)
    {
        if ($id == 0) {
            $result = '-- Pilih Status --';
        } elseif ($id == 1) {
            $result = 'Teruskan Ke Koordinator Skripsi';
        } elseif ($id == 2) {
            $result = 'Teruskan Ke Kaprodi';
        } elseif ($id == 3) {
            $result = 'Penugasan Dosen Pembimbing';
        } elseif ($id == 4) {
            $result = 'Pendaftaran Tidak Diterima';
        } elseif ($id == 5) {
            $result = 'Set Dosen Pembimbing';
        } else {
            $result = 'Error';
        }

        return $result;
    }

    public static function getStatusDaftarSkripsi($id)
    {
        if ($id == 0) {
            $result = '<button class="btn btn-primary btn-xs">Baru</button>';
        } elseif ($id == 1) {
            $result = '<button class="btn btn-warning btn-xs">Proses</button>';
        } elseif ($id == 2) {
            $result = '<button class="btn btn-warning btn-xs">Proses</button>';
        } elseif ($id == 3) {
            $result = '<button class="btn btn-info btn-xs">Penugasan</button>';
        } elseif ($id == 4) {
            $result = '<button class="btn btn-danger btn-xs">Ditolak</button>';
        } elseif ($id == 5) {
            $result = '<button class="btn btn-success btn-xs">Terima</button>';
        } else {
            $result = 'Error';
        }

        return $result;
    }

    public static function getStatusSeminar($id)
    {
        if ($id == 0) {
            $result = '-- Pilih Status --';
        } elseif ($id == 1) {
            $result = 'Teruskan Ke Koordinator Skripsi';
        } elseif ($id == 2) {
            $result = 'Teruskan Ke Kaprodi';
        } elseif ($id == 3) {
            $result = 'Penugasan Dosen Penguji';
        } elseif ($id == 4) {
            $result = 'Seminar Tidak Diterima';
        } elseif ($id == 5) {
            $result = 'Set Dosen Penguji';
        } else {
            $result = 'Error';
        }

        return $result;
    }

    public static function getStatusPI($id)
    {
        if ($id == 0) {
            $result = '<button class="btn btn-primary btn-xs">Baru</button>';
        } elseif ($id == 1) {
            $result = '<button class="btn btn-warning btn-xs">Proses</button>';
        } elseif ($id == 2) {
            $result = '<button class="btn btn-warning btn-xs">Proses</button>';
        } elseif ($id == 3) {
            $result = '<button class="btn btn-info btn-xs">Penugasan</button>';
        } elseif ($id == 4) {
            $result = '<button class="btn btn-success btn-xs">Pelaksanaan</button>';
        } elseif ($id == 5) {
            $result = '<button class="btn btn-info btn-xs">Penjadwalan</button>';
        } elseif ($id == 6) {
            $result = '<button class="btn btn-info btn-xs">Selesai</button>';
        } elseif ($id == 7) {
            $result = '<button class="btn btn-danger btn-xs">Ditolak</button>';
        } else {
            $result = 'Error';
        }

        return $result;
    }
}
