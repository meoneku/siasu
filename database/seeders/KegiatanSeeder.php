<?php

namespace Database\Seeders;

use App\Models\Kegiatan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KegiatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kegiatan::create([
            'nama'      => 'Praktik Industri',
            'desc'      => 'Kegiatan Praktik Industri',
            'created_by'=> 'System'
        ]);

        Kegiatan::create([
            'nama'      => 'ASP',
            'desc'      => 'Asistensi Pendidikan',
            'created_by'=> 'System'
        ]);

        Kegiatan::create([
            'nama'      => 'Magang',
            'desc'      => 'Kegiatan Magang Industri',
            'created_by'=> 'System'
        ]);

        Kegiatan::create([
            'nama'      => 'Skripsi',
            'desc'      => 'Pendaftaran Judul Skripsi',
            'created_by'=> 'System'
        ]);

        Kegiatan::create([
            'nama'      => 'Seminar',
            'desc'      => 'Pendaftaran Seminar Skripsi',
            'created_by'=> 'System'
        ]);

        Kegiatan::create([
            'nama'      => 'Ujian Akhir',
            'desc'      => 'Pendaftaran Ujian Skripsi',
            'created_by'=> 'System'
        ]);
    }
}
