<?php

namespace Database\Seeders;

use App\Models\Sejarah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SejarahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sejarah::create([
            'judul'         => 'Sejarah Fakultas Teknik',
            'body'          => '<p>Hello World</p>',
            'singkat'       => '<p>Hello World</p>',
        ]);
    }
}
