<?php

namespace Database\Seeders;

use App\Models\Visitor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;

class VisitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $startDate = Carbon::now();
        $endDate = $startDate->copy()->addYear();

        for ($i = 1; $i <= 2500; $i++) {
            $timestamp = $faker->dateTimeBetween($startDate, $endDate);

            Visitor::create([
                'ip' => $faker->ipv4,
                'visit_id' => hash('sha256', date('Ymd H')),
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ]);
        }
    }
}
