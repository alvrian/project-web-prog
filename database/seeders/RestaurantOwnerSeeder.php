<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RestaurantOwner;
use Faker\Factory as Faker;
class RestaurantOwnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();
        
        foreach (range(1, 10) as $index) {
            RestaurantOwner::create([
                'Name' => $faker->company,
                'Location' => $faker->address,
                'Type' => 'Restaurant',
                'AverageFoodWastePerMonth' => $faker->randomFloat(2, 100, 500),
                'PointsBalance' => $faker->numberBetween(0, 1000),
                'AmountBalance' => $faker->numberBetween(0, 10000),
            ]);
        }
    }
}
