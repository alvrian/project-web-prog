<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CompostProducerFarmerSeeder::class,
            RestaurantOwnerFarmerSeeder::class,
            CatalogSeeder::class,
            PriceListWasteLogSeeder::class,
            PickupScheduleSeeder::class,
            PointsTransactionSeeder::class,
            CompostEntrySeeder::class,
            CropSeeder::class,
            OrdersTableSeeder::class,
            PricesTableSeeder::class,
            PriceListCompostSeeder::class,
            SubscriptionSeeder::class,
            CropPriceListSeeder::class,
            PriceListWasteLogSeeder::class,
        ]);
    }
}
