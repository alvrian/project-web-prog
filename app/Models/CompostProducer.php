<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompostProducer extends Model
{
    use HasFactory;

    protected $fillable = [
        'Name', 
        'Location', 
        'CompostTypesProduced',
        'AverageCompostAmountPerTerm', 
        'KitchenWasteProcessingCapacity',
        'PointsBalance'
    ];

    public $timestamp = false;
    protected $primaryKey = 'CompostProducerID';

    public function subscriptionsAsSubscriber()
    {
        return $this->morphMany(Subscription::class, 'subscriber');
    }

    public function subscriptionsAsProvider()
    {
        return $this->morphMany(Subscription::class, 'provider');
    }

    public function pickupSchedules()
    {
        return $this->morphMany(PickupSchedule::class, 'participant');
    }
    public function pointsTransactions()
    {
        return $this->morphMany(PointsTransaction::class, 'participant');
    }

    public function givenFeedbacks()
    {
        return $this->morphMany(Feedback::class, 'reviewer');
    }

    public function receivedFeedbacks()
    {
        return $this->morphMany(Feedback::class, 'reviewee');
    }

    public function catalogs()
    {
        return $this->morphMany(Catalog::class, 'item');
    }
}
