<?php

namespace Database\Seeders;

use App\Models\Jabatan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Jabatan::create([
            'jabatan'   => 'Dekan',
            'slug'      => 'dekan',
            'deskripsi' => 'No Desc'
        ]);

        Jabatan::create([
            'jabatan'   => 'Wakil Dekan',
            'slug'      => 'wakil-dekan',
            'deskripsi' => 'No Desc'
        ]);
        Jabatan::create([
            'jabatan'   => 'Kaprodi',
            'slug'      => 'kaprodi',
            'deskripsi' => 'No Desc'
        ]);
    }
}
