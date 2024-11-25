<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantOwner extends Model
{
    use HasFactory;
    protected $primaryKey = 'RestaurantOwnerID';

    public function wasteLogs()
    {
        return $this->hasMany(WasteLog::class, 'RestaurantOwnerID');
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class, 'SubscriberID');
    }

    public function pointsTransactions()
    {
        return $this->hasMany(PointsTransaction::class, 'ParticipantID');
    }

    public function farmers()
    {
        return $this->belongsToMany(Farmer::class, 'restaurant_owner_farmer', 'RestaurantOwnerID', 'FarmerID');
    }

    public function compostProducers()
    {
        return $this->belongsToMany(CompostProducer::class, 'compost_producer_farmer', 'RestaurantOwnerID', 'CompostProducerID');
    }
}
