<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WasteLog extends Model
{
    use HasFactory;
    public $timestamp = false;

    protected $fillable = ['RestaurantOwnerID', 'WasteType', 'Weight', 'DateLogged'];

    
    protected $primaryKey = 'WasteLogID';

    public function restaurantOwner()
    {
        return $this->belongsTo(RestaurantOwner::class, 'RestaurantOwnerID', 'RestaurantOwnerID');
    }
}
