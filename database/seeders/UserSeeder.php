<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    
    public function run(): void{
        $faker = Faker::create();
    
        foreach(range(1, 10) as $i) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('1234567890'),
                'role' => 'farmer'
            ]);
        }
        foreach(range(11, 20) as $i) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('1234567890'),
                'role' => 'compost_producer'
            ]);
        }
        foreach(range(21, 30) as $i) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('1234567890'),
                'role' => 'restaurant_owner'
            ]);
        }
    }
}
