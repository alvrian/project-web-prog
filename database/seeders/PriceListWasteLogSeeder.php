<?php

namespace Database\Seeders;

use App\Models\PriceListWasteLog;
use Illuminate\Database\Seeder;
use App\Models\WasteLog;
use App\Models\RestaurantOwner;

class PriceListWasteLogSeeder extends Seeder
{
    public function run()
    {
        $restaurantOwners = RestaurantOwner::all();

        if ($restaurantOwners->isEmpty()) {
            $this->command->info('No Restaurant Owners found! Please seed RestaurantOwners first.');
            return;
        }

        foreach ($restaurantOwners as $owner) {
            $wasteLog = WasteLog::create([
                'RestaurantOwnerID' => $owner->user_id,
                'WasteType' => fake()->randomElement(['Vegetable', 'Meat', 'Dairy', 'Grain']),
                'Weight' => fake()->randomFloat(2, 1, 100),
                'DateLogged' => fake()->dateTimeThisYear,
            ]);

            PriceListWasteLog::create([
                'WasteLogID' => $wasteLog->id,
                'price_per_kg' => fake()->randomFloat(2, 1, 10),
                'price_per_subscription_3' => fake()->randomFloat(2, 10, 30),
                'price_per_subscription_6' => fake()->randomFloat(2, 20, 60),
                'price_per_subscription_9' => fake()->randomFloat(2, 30, 90),
                'price_per_subscription_12' => fake()->randomFloat(2, 40, 120),
            ]);
        }

        $this->command->info('Waste Logs and Price Lists seeded successfully!');
    }
}
