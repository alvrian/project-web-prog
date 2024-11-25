<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WasteLog extends Model
{
    use HasFactory;
    protected $table = 'waste_log';

    protected $fillable = [
        'RestaurantOwnerID',
        'WasteType',
        'Weight',
        'DateLogged'
    ];

    public function restaurantOwner()
    {
        return $this->belongsTo(RestaurantOwner::class, 'RestaurantOwnerID');
    }
}
