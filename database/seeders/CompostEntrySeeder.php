<?php

namespace Database\Seeders;

use App\Models\CompostEntry;
use Illuminate\Database\Seeder;
use App\Models\PriceListCompost;
use Faker\Factory as Faker;
class CompostEntrySeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $compostEntries = CompostEntry::all();

        if ($compostEntries->isEmpty()) {
            for ($i = 0; $i < 10; $i++) {
                $compostEntries[] = CompostEntry::create([
                    'compost_producer_id' => $faker->numberBetween(1, 10),
                    'compost_producer_name' => $faker->company,
                    'compost_types_produced' => $faker->randomElement(['Type A', 'Type B', 'Type C']),
                    'average_compost_amount' => $faker->randomFloat(2, 50, 500),
                    'kitchen_waste_capacity' => $faker->randomFloat(2, 100, 1000), 
                    'date_logged' => $faker->date(),
                ]);
            }
        }

        foreach ($compostEntries as $compostEntry) {
            PriceListCompost::create([
                'compost_entry_id' => $compostEntry->id,
                'price_per_item' => $faker->randomFloat(2, 5, 20),
                'price_per_subscription_3' => $faker->randomFloat(2, 20, 50),
                'price_per_subscription_6' => $faker->randomFloat(2, 40, 80),
                'price_per_subscription_9' => $faker->randomFloat(2, 60, 120),
                'price_per_subscription_12' => $faker->randomFloat(2, 80, 150),
            ]);
        }
    }
}
