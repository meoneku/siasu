<?php

namespace App\Imports;

use App\Models\Dosen;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DosenImport implements ToModel, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function model(array $row)
    {
        return new Dosen([
            'niy'           => $row['niy'],
            'nidn'          => $row['nidn'],
            'nama'          => $row['nama'],
            'rekening'      => $row['rekening'],
            'email'         => $row['email'],
            'jurusan_id'    => $row['jurusan'],
            'tmt'           => date('Y-m-d', ($row['tmt'] - 25569) * 86400),
            'jabatan'       => $row['jabatan'],
            'jafung'        => $row['jafung'],
            'golongan'      => $row['golongan'],
            'pendidikan'    => $row['pendidikan'],
            'status'        => $row['status'],
        ]);
    }
}
