<?php

namespace App\Imports;

use App\Models\Mahasiswa;
use App\Models\VA;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class VAImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new VA([
            'mahasiswa_id'  => Mahasiswa::where('nim', $row['nim'])->first()->id,
            'kegiatan_id'   => $row['kegiatan'],
            'nomor_va'      => $row['va'],
            'nominal'       => $row['nominal'],
            'mulai_akt'     => date('Y-m-d', ($row['mulai_aktif'] - 25569) * 86400),
            'akhir_akt'     => date('Y-m-d', ($row['akhir_aktif'] - 25569) * 86400),
        ]);
    }
}
