<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $table = 'subscription';
    protected $primaryKey = "SubscriberID";

    protected $fillable = [
        'SubscriberID',
        'ProviderID',
        'SubscriptionType',
        'StartDate',
        'EndDate',
        'Status',
        'Reason',
        'Products',
        'Price',
        'PointEarned'
    ];

    protected $casts = [
        'Products' => 'array', // Automatically casts the JSON column to/from an array
    ];

    public function provider()
    {
        return $this->belongsTo(User::class, 'ProviderID');
    }

    public function subscriber()
    {
        return $this->belongsTo(User::class, 'SubscriberID');
    }

}
