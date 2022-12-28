<?php

namespace App\Imports;

use App\Models\Lulusan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class LulusanImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Lulusan([
            'nim'           => $row['nim'],
            'nama'          => $row['nama'],
            'jurusan_id'    => $row['jurusan'],
            'tempat_lahir'  => $row['tempat_lahir'],
            'tanggal_lahir' => date('Y-m-d', ($row['tanggal_lahir'] - 25569) * 86400),
            'gender'        => $row['jenis_kelamin'],
            'tanggal_lulus' => date('Y-m-d', ($row['tanggal_lulus'] - 25569) * 86400),
            'tanggal_wisuda' => date('Y-m-d', ($row['tanggal_wisuda'] - 25569) * 86400),
            'pin'           => $row['pin'],
            'nomorijazah'   => $row['nomor_ijazah'],
            'judul_skripsi' => $row['judul_skripsi'],
        ]);
    }
}
