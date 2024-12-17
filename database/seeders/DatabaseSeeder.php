<?php

namespace Database\Seeders;

use App\Http\Controllers\WasteLogController;
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
            CompostEntrySeeder::class,
            CropSeeder::class,
            WasteLogSeeder::class,
//            PickupScheduleSeeder::class,
//            PointsTransactionSeeder::class,

//            OrdersTableSeeder::class,
//            PricesTableSeeder::class,
//            PriceListCompostSeeder::class,
//            SubscriptionSeeder::class,
//            CropPriceListSeeder::class,
//            PriceListWasteLogSeeder::class,
        ]);
    }
}
