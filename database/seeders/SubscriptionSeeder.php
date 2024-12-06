<?php

namespace Database\Seeders;

use App\Models\CompostEntry;
use App\Models\Farmer;
use App\Models\CompostProducer;
use App\Models\Crop;
use App\Models\RestaurantOwner;
use App\Models\Subscription;
use App\Models\WasteLog;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            $provider = Farmer::inRandomOrder()->first();
            $product = Crop::inRandomOrder()->first();

            Subscription::create([
                'SubscriberID' => RestaurantOwner::inRandomOrder()->first()->user_id,
                'ProviderID' => $provider->user_id,
                'SubscriptionType' => $faker->randomElement([3, 6, 9, 12]),
                'StartDate' => $faker->date(),
                'EndDate' => $faker->date(),
                'Status' => $faker->randomElement(['Active', 'Expired']),
                'Reason' => $faker->sentence,
                'ProductableType' => 'crops',
                'ProductableID' => $product->id,
                'Price' => $faker->numberBetween(100, 1000),
                'PointEarned' => $faker->numberBetween(10, 50),
            ]);
        }

        foreach (range(11, 20) as $index) {
            $provider = CompostProducer::inRandomOrder()->first();
            $product = WasteLog::inRandomOrder()->first();

            Subscription::create([
                'SubscriberID' => RestaurantOwner::inRandomOrder()->first()->user_id,
                'ProviderID' => $provider->user_id,
                'SubscriptionType' => $faker->randomElement([3, 6, 9, 12]),
                'StartDate' => $faker->date(),
                'EndDate' => $faker->date(),
                'Status' => $faker->randomElement(['Active', 'Expired']),
                'Reason' => $faker->sentence,
                'ProductableType' => 'waste_log',
                'ProductableID' => $product->id,
                'Price' => $faker->numberBetween(100, 1000),
                'PointEarned' => $faker->numberBetween(10, 50),
            ]);
        }

       foreach (range(21, 30) as $index) {
            $provider = RestaurantOwner::inRandomOrder()->first();
            $product = CompostEntry::inRandomOrder()->first();

            Subscription::create([
                'SubscriberID' => CompostProducer::inRandomOrder()->first()->user_id,
                'ProviderID' => $provider->user_id,
                'SubscriptionType' => $faker->randomElement([3, 6, 9, 12]),
                'StartDate' => $faker->date(),
                'EndDate' => $faker->date(),
                'Status' => $faker->randomElement(['Active', 'Expired', 'Postponed']),
                'Reason' => $faker->sentence,
                'ProductableType' => 'compost_entries',
                'ProductableID' => $product->id,
                'Price' => $faker->numberBetween(100, 1000),
                'PointEarned' => $faker->numberBetween(10, 50),
            ]);
        }
    }
}
