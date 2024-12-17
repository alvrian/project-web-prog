<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\RestaurantOwner;
use App\Models\Farmer;
use App\Models\CompostProducer;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $restaurantNames = ['The Gourmet Table', 'Urban Eats Bistro', 'Golden Spoon Cafe', 'Flavor Haven', 'The Culinary Spot', 'Epicurean Hub'];
        $compostNames = ['GreenCycle Works', 'EcoFusion Compost', 'Nature’s Balance', 'Earth Enrichers', 'Green Bloom Co.', 'CompostWorks Studio'];
        $farmNames = ['Harvest Valley Farms', 'Golden Fields Agri', 'FreshCrop Solutions', 'Green Acres Collective', 'Fertile Roots Farms', 'Sunny Harvest Co.'];


        $restaurantLocations = ['Central Jakarta', 'South Jakarta', 'Surabaya City Center', 'Bandung Downtown', 'Denpasar'];
        $compostLocations = ['Bekasi', 'Tangerang', 'Sidoarjo', 'Cikarang', 'Bogor'];
        $farmLocations = ['Garut', 'Kebumen', 'Klaten', 'Banyuwangi', 'Tabanan'];

        $compostTypes = [
            'Green Compost',
            'Brown Compost',
            'Manure-Based Compost',
            'Mushroom Compost',
            'Humus Compost',
            'Other'
        ];

        $cropTypes = [
            'Vegetables',
            'Fruits',
            'Grains',
            'Other'
        ];

        $daysOfWeek = [
            'Monday',
            'Tuesday',
            'Wednesday',
            'Thursday',
            'Friday',
            'Saturday',
            'Sunday'
        ];
        for ($i = 1; $i <= 6; $i++) {
            $name = $restaurantNames[$i - 1];
            $email = "restaurant$i@farmbyte.com";

            $user = User::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make('1234567890'),
                'role' => 'restaurant_owner'
            ]);

            RestaurantOwner::create([
                'Name' => $name,
                'user_id' => $user->id,
                'Location' => $restaurantLocations[array_rand($restaurantLocations)],
                'Type' => 'Restaurant',
                'AverageFoodWastePerMonth' => rand(100, 500),
                'PointsBalance' => rand(0, 1000),
                'AmountBalance' => rand(0, 10000),
            ]);
        }

        for ($i = 1; $i <= 6; $i++) {
            $name = $compostNames[$i - 1];
            $email = "composter$i@farmbyte.com";

            $user = User::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make('1234567890'),
                'role' => 'compost_producer'
            ]);

            CompostProducer::create([
                'Name' => $name,
                'user_id' => $user->id,
                'Location' => $compostLocations[array_rand($compostLocations)],
                'CompostTypesProduced' => $compostTypes[array_rand($compostTypes)],
                'AverageCompostAmountPerTerm' => rand(100, 1000),
                'WasteProcessingCapacity' => rand(500, 1000),
                'PointsBalance' => rand(0, 500),
                'AmountBalance' => rand(0, 5000),
            ]);
        }

        for ($i = 1; $i <= 6; $i++) {
            $name = $farmNames[$i - 1];
            $email = "farmer$i@farmbyte.com";

            $user = User::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make('1234567890'),
                'role' => 'farmer'
            ]);

            Farmer::create([
                'Name' => $name,
                'user_id' => $user->id,
                'Location' => $farmLocations[array_rand($farmLocations)],
                'CropTypesProduced' => $cropTypes[array_rand($cropTypes)],
                'HarvestSchedule' => $daysOfWeek[array_rand($daysOfWeek)],
                'AverageCropAmount' => rand(50, 200),
                'PointsBalance' => rand(0, 1000),
                'AmountBalance' => rand(0, 10000),
            ]);
        }
    }
}
