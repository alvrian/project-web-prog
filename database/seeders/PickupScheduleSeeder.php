<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PickupSchedule;
use App\Models\RestaurantOwner;
use App\Models\CompostProducer;
use App\Models\Farmer;
use Faker\Factory as Faker;

class PickupScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 20) as $index) {
            $senderType = $faker->randomElement(['RestaurantOwner', 'CompostProducer', 'Farmer']);
            $recipientType = $faker->randomElement(['RestaurantOwner', 'CompostProducer', 'Farmer']);

            $pickupSchedule = new PickupSchedule([
                'PickupType' => $faker->randomElement(['Waste Pickup', 'Compost Delivery']),
                'ScheduledDate' => $faker->dateTime,
                'Status' => $faker->randomElement(['Scheduled', 'Completed', 'Missed'])
            ]);

            switch ($senderType) {
                case 'RestaurantOwner':
                    $pickupSchedule->SenderRestaurantOwnerID = RestaurantOwner::inRandomOrder()->first()->id;
                    break;
                case 'CompostProducer':
                    $pickupSchedule->SenderCompostProducerID = CompostProducer::inRandomOrder()->first()->id;
                    break;
                case 'Farmer':
                    $pickupSchedule->SenderFarmerID = Farmer::inRandomOrder()->first()->id;
                    break;
            }

            switch ($recipientType) {
                case 'RestaurantOwner':
                    $pickupSchedule->RecipientRestaurantOwnerID = RestaurantOwner::inRandomOrder()->first()->id;
                    break;
                case 'CompostProducer':
                    $pickupSchedule->RecipientCompostProducerID = CompostProducer::inRandomOrder()->first()->id;
                    break;
                case 'Farmer':
                    $pickupSchedule->RecipientFarmerID = Farmer::inRandomOrder()->first()->id;
                    break;
            }

            $pickupSchedule->save();
        }
    }
}
