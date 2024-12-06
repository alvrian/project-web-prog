<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Farmer extends Model
{
    use HasFactory;

    protected $table = 'farmer';
    protected $primaryKey = 'user_id';
    public $incrementing = false;
    protected $fillable = ['Name', 'user_id', 'Location', 'CropTypesProduced', 'HarvestSchedule', 'AverageCropAmount', 'PointsBalance', 'AmountBalance'];

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

    public function compostProducers(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(
            CompostProducer::class,
            'compost_producer_farmer',
            'FarmerID',
            'CompostProducerID'
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function totalPoints()
    {
        $earned = $this->pointsTransactions()->where('TransactionType', 'Earned')->where('Status', 'Completed')->sum('Points');
        $redeemed = $this->pointsTransactions()->where('TransactionType', 'Redeemed')->where('Status', 'Completed')->sum('Points');
        return $earned - $redeemed;
    }

    public function PointsBalance()
    {
       return $this->pointsTransactions()->sum('points');
    }


}
