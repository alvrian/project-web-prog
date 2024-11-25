<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Farmer extends Model
{
    use HasFactory;

    protected $fillable = [
        'Name', 'Location', 'CropTypesProduced', 'HarvestSchedule', 'AverageCropAmountPerQuarter','PointsBalance'
    ];
    
    public $timestamp = false;
    protected $primaryKey = 'FarmerID';

    public function subscriptionsAsProvider()
    {
        return $this->morphMany(Subscription::class, 'provider');
    }

    public function pickupSchedules()
    {
        return $this->morphMany(PickupSchedule::class, 'participant');
    }
}
