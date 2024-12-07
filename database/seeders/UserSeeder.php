<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Faker\Factory as Faker;
use App\Models\RestaurantOwner;
use App\Models\Farmer;
use App\Models\CompostProducer;

class UserSeeder extends Seeder
{
    public function run(): void{
        $faker = Faker::create();
    
        foreach(range(1, 10) as $i) {
            $name = $faker->company;
            $email = $faker->unique()->safeEmail;
            User::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make('1234567890'),
                'role' => 'restaurant_owner'
            ]);
            RestaurantOwner::create([
                'Name' => $name,
                'user_id' => $i,
                'Location' => $faker->address,
                'Type' => 'Restaurant',
                'AverageFoodWastePerMonth' => $faker->randomFloat(2, 100, 500),
                'PointsBalance' => $faker->numberBetween(0, 1000),
                'AmountBalance' => $faker->numberBetween(0, 10000),
            ]);
        }
        foreach(range(11, 20) as $i) {
            $name = $faker->company;
            $email = $faker->unique()->safeEmail;

            User::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make('1234567890'),
                'role' => 'compost_producer'
            ]);
            CompostProducer::create([
                'Name' => $name,
                'user_id'=> $i, 
                'Location' => $faker->address,
                'CompostTypesProduced' => $faker->words(3, true),
                'AverageCompostAmountPerTerm' => $faker->randomFloat(2, 100, 1000),
                'WasteProcessingCapacity' => $faker->numberBetween(500, 1000),
                'PointsBalance' => $faker->numberBetween(0, 500),
                'AmountBalance' => $faker->numberBetween(0, 5000)
            ]);
        }
        foreach(range(21, 30) as $i) {
            $name = $faker->company;
            $email = $faker->unique()->safeEmail;

            User::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make('1234567890'),
                'role' => 'farmer'
            ]);
            Farmer::create([
                'Name' => $faker->name,
                'Location' => $faker->address,
                'user_id' => $i,
                'CropTypesProduced' => $faker->words(4, true),
                'HarvestSchedule' => $faker->dayOfWeek,
                'AverageCropAmount' => $faker->randomFloat(2, 50, 200),
                'PointsBalance' => $faker->numberBetween(0, 1000),
                'AmountBalance' => $faker->numberBetween(0, 10000),
            ]);
        }
    }
}
