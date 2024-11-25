<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PointsTransaction;
use App\Models\RestaurantOwner;
use App\Models\CompostProducer;
use App\Models\Farmer;
use Faker\Factory as Faker;
class PointsTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 20) as $index) {

            $participantType = $faker->randomElement(['RestaurantOwner', 'Farmer', 'CompostProducer']);
            $participantId = null;


            switch ($participantType) {
                case 'RestaurantOwner':
                    $participantId = RestaurantOwner::inRandomOrder()->first()->RestaurantOwnerID;
                    break;
                case 'Farmer':
                    $participantId = Farmer::inRandomOrder()->first()->FarmerID;
                    break;
                case 'CompostProducer':
                    $participantId = CompostProducer::inRandomOrder()->first()->CompostProducerID;
                    break;
            }

            PointsTransaction::create([
                'ParticipantID' => $participantId,
                'TransactionType' => $faker->randomElement(['Earned', 'Redeemed']),
                'Points' => $faker->numberBetween(10, 100),
                'Description' => $faker->sentence,
                'Date' => $faker->date(),
                'Status' => $faker->randomElement(['Completed', 'Pending']),
            ]);
        }
    }
}
