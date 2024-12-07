<?php

namespace Database\Seeders;

use App\Models\Crop;
use Illuminate\Database\Seeder;
use App\Models\PriceListCrop;
use Faker\Factory as Faker;

class CropPriceListSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $crops = Crop::all();

        foreach ($crops as $crop) {
            PriceListCrop::create([
                'crop_id' => $crop->id,
                'price_per_item' => $faker->randomFloat(2, 10, 50),
                'price_per_subscription_3' => $faker->randomFloat(2, 30, 100),
                'price_per_subscription_6' => $faker->randomFloat(2, 60, 200),
                'price_per_subscription_9' => $faker->randomFloat(2, 90, 300),
                'price_per_subscription_12' => $faker->randomFloat(2, 120, 400),
            ]);
        }
    }
}
