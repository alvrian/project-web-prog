<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Farmer extends Model
{
    use HasFactory;
    protected $table = 'farmer';
    protected $primaryKey = 'FarmerID';

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class, 'ProviderID');
    }

    public function pointsTransactions()
    {
        return $this->hasMany(PointsTransaction::class, 'ParticipantID');
    }

    public function restaurantOwners()
    {
        return $this->belongsToMany(RestaurantOwner::class, 'restaurant_owner_farmer', 'FarmerID', 'RestaurantOwnerID');
    }

    public function compostProducers()
    {
        return $this->belongsToMany(CompostProducer::class, 'compost_producer_farmer', 'FarmerID', 'CompostProducerID');
    }
}
