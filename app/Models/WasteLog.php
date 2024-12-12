<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

    protected $casts = [
        'DateLogged' => 'datetime',
    ];


    public function restaurantOwner()
    {
        return $this->belongsTo(RestaurantOwner::class, 'RestaurantOwnerID');
    }

    public function priceList()
    {
        return $this->hasOne(PriceListWasteLog::class, 'WasteLogID');
    }
    public function compostProducer(): HasOne
    {
        return $this->hasOne(CompostProducer::class, 'user_id', 'id');
    }


}
