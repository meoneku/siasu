<?php

namespace Database\Seeders;

use App\Models\Kalender;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KalenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kalender::create([
            'judul'         => 'Kalender Akademik Semester Gasak 2023/2024',
            'body'          => '<p>Hello World</p>',
        ]);
    }
}
