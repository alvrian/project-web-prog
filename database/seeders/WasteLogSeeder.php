<?php

namespace Database\Seeders;

use App\Models\PriceListWasteLog;
use App\Models\RestaurantOwner;
use App\Models\User;
use App\Models\WasteLog;
use Illuminate\Database\Seeder;

class WasteLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $wasteTypes = ['Fruit Waste', 'Vegetable Waste', 'Coffee Grounds', 'Tea Leaves', 'Eggshells', 'Food Scraps', 'Other'];

        $restaurantOwners = User::where('role', 'restaurant_owner')->get();

        foreach ($restaurantOwners as $owner) {
            for ($i = 0; $i < 5; $i++) {
                $wasteLog = WasteLog::create([
                    'RestaurantOwnerID' => $owner->id,
                    'WasteType' => $wasteTypes[array_rand($wasteTypes)],
                    'Weight' => rand(5, 50),
                    'DateLogged' => now()->subDays(rand(0, 30)),
                ]);
                $price_per_kg = rand(10, 20);
                $priceList = [
                    'price_per_kg' => $price_per_kg,
                    'price_per_subscription_3' => $price_per_kg * 3 * 0.95,
                    'price_per_subscription_6' => $price_per_kg * 6 * 0.90,
                    'price_per_subscription_9' => $price_per_kg * 9 * 0.85,
                    'price_per_subscription_12' => $price_per_kg * 12 * 0.80,
                ];
                PriceListWasteLog::create([
                    'WasteLogID' => $wasteLog->id,
                    'price_per_kg' => fake()->randomFloat(2, 1, 10),
                    'price_per_subscription_3' => round($priceList['price_per_subscription_3'], 2),
                    'price_per_subscription_6' => round($priceList['price_per_subscription_6'], 2),
                    'price_per_subscription_9' => round($priceList['price_per_subscription_9'], 2),
                    'price_per_subscription_12' => round($priceList['price_per_subscription_12'], 2),
                ]);
            }
        }
    }
}
