<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Crop;
use App\Models\Farmer;
use App\Models\PriceListCrop;

class CropSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create();
        $farmers = Farmer::all();

        $cropNamesByType = [
            'Vegetables' => ['Carrot', 'Lettuce', 'Spinach', 'Tomato', 'Cabbage'],
            'Fruits' => ['Apple', 'Banana', 'Orange', 'Grapes', 'Mango'],
            'Grains' => ['Wheat', 'Rice', 'Corn', 'Barley', 'Oats'],
            'Other' => ['Sunflower', 'Pumpkin Seeds', 'Herbs', 'Flaxseed', 'Misc Crop'],
        ];

        foreach ($farmers as $farmer) {
            for ($i = 0; $i < 5; $i++) {
                $cropType = array_rand($cropNamesByType);
                $cropName = $faker->randomElement($cropNamesByType[$cropType]);

                $crop = Crop::create([
                    'farmer_id' => $farmer->id,
                    'crop_name' => $cropName,
                    'crop_type' => $cropType,
                    'average_amount' => $faker->randomFloat(2, 50, 500),
                    'harvest_cycles' => $faker->numberBetween(1, 3),
                    'crop_image' => 'sample_image.jpg',
                    'availability_start' => now()->subMonths(rand(1, 6))->format('Y-m-d'),
                    'availability_end' => now()->addMonths(rand(1, 6))->format('Y-m-d'),
                ]);

                $pricePerItem = rand(10, 20);
                PriceListCrop::create([
                    'crop_id' => $crop->id,
                    'price_per_item' => $pricePerItem,
                    'price_per_subscription_3' => round($pricePerItem * 3 * 0.95, 2),
                    'price_per_subscription_6' => round($pricePerItem * 6 * 0.90, 2),
                    'price_per_subscription_9' => round($pricePerItem * 9 * 0.85, 2),
                    'price_per_subscription_12' => round($pricePerItem * 12 * 0.80, 2),
                ]);
            }
        }
    }
}
