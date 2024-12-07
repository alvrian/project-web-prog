<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            DB::table('orders')->insert([
                'crop_id' => $faker->numberBetween(1, 10), // Assuming there are 10 crops in the database
                'restaurant_id' => $faker->numberBetween(1, 5), // Assuming there are 5 restaurant users
                'quantity' => $faker->numberBetween(1, 100),
                'total_price' => $faker->randomFloat(2, 10, 1000), // Random total price between 10 and 1000
                'status' => $faker->randomElement(['Pending', 'Processed', 'Shipped', 'Delivered']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
