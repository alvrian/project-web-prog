<?php
namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PointsTransaction;
use App\Models\RestaurantOwner;
use App\Models\CompostProducer;
use App\Models\Farmer;

use Faker\Factory as Faker;
use Exception;

class PointsTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        $this->seedParticipantData(RestaurantOwner::class, 7, $faker);
        $this->seedParticipantData(CompostProducer::class, 7, $faker);
        $this->seedParticipantData(Farmer::class, 7, $faker);
    }

    /**
     * Seed data for a specific participant type.
     *
     * @param string $participantType The class name of the participant type.
     * @param int $count The number of records to seed.
     * @param \Faker\Generator $faker The Faker instance.
     */
    private function seedParticipantData(string $participantType, int $count, $faker)
    {
        $participantModel = app($participantType);

        foreach (range(1, $count) as $index) {
            $participant = $participantModel::inRandomOrder()->first();

            if (!$participant) {
                throw new Exception("No participant found for type: " . $participantType);
            }

            PointsTransaction::create([
                'ParticipantID' => $participant->id,
                'TransactionType' => $faker->randomElement(['Earned', 'Redeemed']),
                'Points' => $faker->numberBetween(10, 1000),
                'Description' => $faker->sentence(),
                'Date' => $faker->date(),
                'Status' => $faker->randomElement(['Completed', 'Pending', 'Failed']),
            ]);
        }
    }
}