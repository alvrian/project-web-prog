<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompostProducer extends Model
{
    use HasFactory;

    protected $primaryKey = 'CompostProducerID';

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class, 'ProviderID');
    }

    public function pointsTransactions()
    {
        return $this->hasMany(PointsTransaction::class, 'ParticipantID');
    }

    public function farmers()
    {
        return $this->belongsToMany(Farmer::class, 'compost_producer_farmer', 'CompostProducerID', 'FarmerID');
    }

    public function restaurants()
    {
        return $this->belongsToMany(RestaurantOwner::class, 'restaurant_owner_compost_producer', 'CompostProducerID', 'RestaurantOwnerID');
    }
}
