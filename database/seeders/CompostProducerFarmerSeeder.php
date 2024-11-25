<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CompostProducer;
use App\Models\Farmer;
use App\Models\CompostProducerFarmer;

class CompostProducerFarmerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $compostProducers = CompostProducer::all();
        $farmers = Farmer::all();

        foreach ($compostProducers as $compostProducer) {
            $farmerIds = $farmers->random(rand(1, 3))->pluck('id')->toArray();
            foreach ($farmerIds as $farmerId) {
                CompostProducerFarmer::create([
                    'CompostProducerID' => $compostProducer->id,
                    'FarmerID' => $farmerId
                ]);
            }
        }
    }
}
