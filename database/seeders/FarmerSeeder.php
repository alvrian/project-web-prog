<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Farmer;
use Faker\Factory as Faker;
class FarmerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            Farmer::create([
                'Name' => $faker->name,
                'Location' => $faker->address,
                'CropTypesProduced' => $faker->words(4, true),
                'HarvestSchedule' => $faker->dayOfWeek,
                'AverageCropAmount' => $faker->randomFloat(2, 50, 200),
                'PointsBalance' => $faker->numberBetween(0, 1000),
                'AmountBalance' => $faker->numberBetween(0, 10000),
            ]);
        }
    }
}
