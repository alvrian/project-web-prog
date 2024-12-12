<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PickupSchedule extends Model
{
    use HasFactory;

    protected $table = 'pickup_schedule';

    protected $fillable = [
        'SenderRestaurantOwnerID',
        'SenderCompostProducerID',
        'SenderFarmerID',
        'RecipientRestaurantOwnerID',
        'RecipientCompostProducerID',
        'RecipientFarmerID',
        'PickupType',
        'ScheduledDate',
        'Status'
    ];

    // Relationship untuk CompostProducer
    public function senderCompostProducer()
    {
        return $this->belongsTo(CompostProducer::class, 'SenderCompostProducerID', 'user_id');
    }

    // Relationship untuk RestaurantOwner
    public function recipientRestaurantOwner()
    {
        return $this->belongsTo(RestaurantOwner::class, 'RecipientRestaurantOwnerID', 'user_id');
    }
}
