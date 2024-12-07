<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PricesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            DB::table('prices')->insert([
                'crop_id' => $faker->numberBetween(1, 10),
                'price_per_kg' => $faker->randomFloat(2, 1, 100), 
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
