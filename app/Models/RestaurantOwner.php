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

    public function subscriptionsAsSubscriber()
    {
        return $this->morphMany(Subscription::class, 'subscriber');
    }

    public function subscriptionsAsProvider()
    {
        return $this->morphMany(Subscription::class, 'provider');
    }
}
