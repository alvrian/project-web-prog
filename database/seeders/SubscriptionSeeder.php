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
    public function run()
    {
        $faker = Faker::create();

        $statusReasons = [
            'Active' => [
                'Farmer' => 'Need to receive fresh crops.',
                'CompostProducer' => 'Want to receive compost regularly.',
                'RestaurantOwner' => 'Want managing waste with the provider.',
            ],
            'Expired' => [
                'Farmer' => '',
                'CompostProducer' => '',
                'RestaurantOwner' => '',
            ],
            'Postponed' => [
                'Farmer' => 'Paused crop delivery due to seasonal adjustments.',
                'CompostProducer' => 'Subscription delayed for compost availability.',
                'RestaurantOwner' => 'Temporary delay in waste pickup services.',
            ],
        ];

        foreach (range(1, 10) as $index) {
            $provider = Farmer::inRandomOrder()->first();
            $product = Crop::inRandomOrder()->first();
            $price = $faker->numberBetween(100, 1000);
            $status = $faker->randomElement(['Active', 'Expired', 'Postponed']);

            Subscription::create([
                'SubscriberID' => RestaurantOwner::inRandomOrder()->first()->user_id,
                'ProviderID' => $provider->user_id,
                'SubscriptionType' => $faker->randomElement([3, 6, 9, 12]),
                'StartDate' => $faker->date(),
                'EndDate' => $faker->date(),
                'Status' => $status,
                'Reason' => $statusReasons[$status]['Farmer'],
                'ProductableType' => 'crops',
                'ProductableID' => $product->id,
                'Price' => $price,
                'PointEarned' => round($price * 0.1, 2),
            ]);
        }

        foreach (range(11, 20) as $index) {
            $provider = CompostProducer::inRandomOrder()->first();
            $product = WasteLog::inRandomOrder()->first();
            $price = $faker->numberBetween(100, 1000);
            $status = $faker->randomElement(['Active', 'Expired', 'Postponed']);

            Subscription::create([
                'SubscriberID' => RestaurantOwner::inRandomOrder()->first()->user_id,
                'ProviderID' => $provider->user_id,
                'SubscriptionType' => $faker->randomElement([3, 6, 9, 12]),
                'StartDate' => $faker->date(),
                'EndDate' => $faker->date(),
                'Status' => $status,
                'Reason' => $statusReasons[$status]['CompostProducer'],
                'ProductableType' => 'waste_log',
                'ProductableID' => $product->id,
                'Price' => $price,
                'PointEarned' => round($price * 0.1, 2),
            ]);
        }

        foreach (range(21, 30) as $index) {
            $provider = RestaurantOwner::inRandomOrder()->first();
            $product = CompostEntry::inRandomOrder()->first();
            $price = $faker->numberBetween(100, 1000);
            $status = $faker->randomElement(['Active', 'Expired', 'Postponed']);

            Subscription::create([
                'SubscriberID' => CompostProducer::inRandomOrder()->first()->user_id,
                'ProviderID' => $provider->user_id,
                'SubscriptionType' => $faker->randomElement([3, 6, 9, 12]),
                'StartDate' => $faker->date(),
                'EndDate' => $faker->date(),
                'Status' => $status,
                'Reason' => $statusReasons[$status]['RestaurantOwner'],
                'ProductableType' => 'compost_entries',
                'ProductableID' => $product->id,
                'Price' => $price,
                'PointEarned' => round($price * 0.1, 2),
            ]);
        }

        foreach (range(31, 40) as $index) {
            $provider = CompostProducer::inRandomOrder()->first();
            $product = CompostEntry::inRandomOrder()->first();
            $price = $faker->numberBetween(100, 1000);
            $status = $faker->randomElement(['Active', 'Expired', 'Postponed']);

            Subscription::create([
                'SubscriberID' => Farmer::inRandomOrder()->first()->user_id,
                'ProviderID' => $provider->user_id,
                'SubscriptionType' => $faker->randomElement([3, 6, 9, 12]),
                'StartDate' => $faker->date(),
                'EndDate' => $faker->date(),
                'Status' => $status,
                'Reason' => $statusReasons[$status]['CompostProducer'],
                'ProductableType' => 'compost_entries',
                'ProductableID' => $product->id,
                'Price' => $price,
                'PointEarned' => round($price * 0.1, 2),
            ]);
        }
    }
}
