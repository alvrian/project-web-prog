<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantOwner extends Model
{
    use HasFactory;

    protected $fillable = [
        'Name', 'Location', 'Type', 'AverageFoodWastePerMonth', 'PointsBalance'
    ];

    public $timestamp = false;
    protected $primaryKey = 'RestaurantOwnerID';

    public function wasteLogs()
    {
        return $this->hasMany(WasteLog::class, 'RestaurantOwnerID', 'RestaurantOwnerID');
    }

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
}
