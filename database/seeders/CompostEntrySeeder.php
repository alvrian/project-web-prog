<?php

namespace Database\Seeders;

use App\Models\CompostEntry;
use Illuminate\Database\Seeder;
use App\Models\PriceListCompost;
use App\Models\User;

class CompostEntrySeeder extends Seeder
{
    public function run()
    {
        $compostTypes = [
            'Green Compost',
            'Brown Compost',
            'Manure-Based Compost',
            'Mushroom Compost',
            'Humus Compost',
            'Other'
        ];

        $compostProducers = User::where('role', 'compost_producer')->get();

        if (CompostEntry::count() === 0) {
            foreach ($compostProducers as $producer) {
                for ($i = 1; $i <= 5; $i++) {
                    $compostEntry = CompostEntry::create([
                        'compost_producer_id' => $producer->id,
                        'compost_producer_name' => $producer->name,
                        'compost_types_produced' => $compostTypes[array_rand($compostTypes)],
                        'average_compost_amount' => rand(100, 1000),
                        'kitchen_waste_capacity' => rand(500, 2000),
                        'date_logged' => now()->subDays(rand(0, 30)),
                    ]);

                    $pricePerItem = rand(10, 20);
                    $priceList = [
                        'price_per_item' => $pricePerItem,
                        'price_per_subscription_3' => $pricePerItem * 3 * 0.95,
                        'price_per_subscription_6' => $pricePerItem * 6 * 0.90,
                        'price_per_subscription_9' => $pricePerItem * 9 * 0.85,
                        'price_per_subscription_12' => $pricePerItem * 12 * 0.80,
                    ];

                    PriceListCompost::create([
                        'compost_entry_id' => $compostEntry->id,
                        'price_per_item' => $priceList['price_per_item'],
                        'price_per_subscription_3' => round($priceList['price_per_subscription_3'], 2),
                        'price_per_subscription_6' => round($priceList['price_per_subscription_6'], 2),
                        'price_per_subscription_9' => round($priceList['price_per_subscription_9'], 2),
                        'price_per_subscription_12' => round($priceList['price_per_subscription_12'], 2),
                    ]);
                }
            }
        }
    }
}
