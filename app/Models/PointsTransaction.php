<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PointsTransaction extends Model
{
    use HasFactory;
    protected $primaryKey = 'TransactionID';

    protected $fillable = [
        'ParticipantID', 
        'ParticipantType', 
        'TransactionType', 
        'Points', 
        'Description', 
        'Date'
    ];

    public $timestamp = false;

    public function participant()
    {
        return $this->morphTo();
    }
}
