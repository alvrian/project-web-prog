<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class RestaurantOwnerFarmer extends Pivot
{
    protected $table = 'restaurant_owner_farmer';

    protected $fillable = [
        'RestaurantOwnerID',
        'FarmerID'
    ];
}
