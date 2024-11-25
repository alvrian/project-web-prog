<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RestaurantOwner;
use App\Models\Farmer;
use App\Models\RestaurantOwnerFarmer;

class RestaurantOwnerFarmerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $restaurantOwners = RestaurantOwner::all();
        $farmers = Farmer::all();

        foreach ($restaurantOwners as $restaurantOwner) {
            $farmerIds = $farmers->random(rand(1, 3))->pluck('id')->toArray();
            foreach ($farmerIds as $farmerId) {
                RestaurantOwnerFarmer::create([
                    'RestaurantOwnerID' => $restaurantOwner->id,
                    'FarmerID' => $farmerId
                ]);
            }
        }
    }
}
