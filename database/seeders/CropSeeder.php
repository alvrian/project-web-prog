<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Crop;
use Illuminate\Support\Facades\Storage;

class CropSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 10; $i++) {
            Crop::create([
                'farmer_id' => $faker->numberBetween(1, 10),
                'crop_name' => $faker->word(),
                'crop_type' => $faker->randomElement(['Vegetables', 'Fruits', 'Grains', 'Other']),
                'average_amount' => $faker->randomFloat(2, 50, 1000),
                'harvest_cycles' => $faker->numberBetween(1, 5),
                'crop_image' => 'sample_image.jpg',
                'availability_start' => $faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
                'availability_end' => $faker->dateTimeBetween('now', '+1 year')->format('Y-m-d'),
            ]);
        }


    }

}


