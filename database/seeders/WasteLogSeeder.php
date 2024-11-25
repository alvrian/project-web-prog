<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\WasteLog;
use App\Models\RestaurantOwner;
use Faker\Factory as Faker;

class WasteLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        if (RestaurantOwner::count() == 0) {
            $this->command->info("No restaurant owners available to link with WasteLog entries.");
            return;
        }

        $faker = Faker::create();

        foreach (range(1, 20) as $index) {
            $restaurantOwner = RestaurantOwner::inRandomOrder()->first();

            WasteLog::create([
                'RestaurantOwnerID' => $restaurantOwner->id,
                'WasteType' => $faker->word(),
                'Weight' => $faker->randomFloat(2, 1, 100),
                'DateLogged' => $faker->dateTimeThisYear()
            ]);
        }
    }
}
