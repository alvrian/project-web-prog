<?php

namespace Database\Seeders;

use App\Models\CompostEntry;
use Illuminate\Database\Seeder;

class CompostEntrySeeder extends Seeder
{
    public function run()
    {
        CompostEntry::create([
            'compost_producer_id' => 1,
            'compost_producer_name' => 'John Doe',
            'compost_types_produced' => 'Organic Compost',
            'average_compost_amount' => 50.25,
            'kitchen_waste_capacity' => 75.00,
            'date_logged' => now(),
        ]);
    }
}
