<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PointsTransaction extends Model
{
    use HasFactory;
    protected $table = 'points_transaction'; 

    protected $primaryKey = 'TransactionID';

    protected $fillable = [
        'ParticipantID',
        'TransactionType',
        'Points',
        'Description',
        'Date',
        'Status'
    ];

    public function restaurantOwner()
    {
        return $this->belongsTo(RestaurantOwner::class, 'ParticipantID');
    }

    public function compostProducer()
    {
        return $this->belongsTo(CompostProducer::class, 'ParticipantID');
    }
    
    public function farmer()
    {
        return $this->belongsTo(Farmer::class, 'ParticipantID');
    }
}
