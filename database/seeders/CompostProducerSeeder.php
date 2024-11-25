<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CompostProducer;
use Faker\Factory as Faker;

class CompostProducerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            CompostProducer::create([
                'Name' => $faker->company,
                'Location' => $faker->address,
                'CompostTypesProduced' => $faker->words(3, true),
                'AverageCompostAmountPerTerm' => $faker->randomFloat(2, 100, 1000),
                'WasteProcessingCapacity' => $faker->numberBetween(500, 1000),
                'PointsBalance' => $faker->numberBetween(0, 500),
                'AmountBalance' => $faker->numberBetween(0, 5000)
            ]);
        }
    }

}
