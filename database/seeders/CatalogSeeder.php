<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Catalog;
use App\Models\RestaurantOwner;
use App\Models\CompostProducer;
use App\Models\Farmer;
use Faker\Factory as Faker;
class CatalogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 5) as $index) {
            Catalog::create([
                'ItemID' => RestaurantOwner::inRandomOrder()->first()->id,
                'ItemType' => 'RestaurantOwner',
                'AvailableItems' => $faker->word,
                'AvailabilityStatus' => $faker->randomElement(['Available', 'Out of Stock']),
            ]);
        }

        foreach (range(1, 5) as $index) {
            Catalog::create([
                'ItemID' => CompostProducer::inRandomOrder()->first()->id,
                'ItemType' => 'CompostProducer',
                'AvailableItems' => $faker->word,
                'AvailabilityStatus' => $faker->randomElement(['Available', 'Out of Stock']),
            ]);
        }

        foreach (range(1, 5) as $index) {
            Catalog::create([
                'ItemID' => Farmer::inRandomOrder()->first()->id,
                'ItemType' => 'Farmer',
                'AvailableItems' => $faker->word,
                'AvailabilityStatus' => $faker->randomElement(['Available', 'Out of Stock']),
            ]);
        }
    }
}
