<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            //jadi restoarant_owner, compost producer, sama farmer seeder digabungin jadi 1 di userSeeder
            UserSeeder::class,
            // RestaurantOwnerSeeder::class,
            // CompostProducerSeeder::class,
            // FarmerSeeder::class,
            CompostProducerFarmerSeeder::class,
            RestaurantOwnerFarmerSeeder::class,
            CatalogSeeder::class,
            WasteLogSeeder::class,
            PickupScheduleSeeder::class,
            PointsTransactionSeeder::class,
            SubscriptionSeeder::class,
        ]);
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
