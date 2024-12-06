<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $table = 'subscription';
    protected $primaryKey = "SubscriptionID";

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

    public function provider()
    {
        return $this->belongsTo(User::class, 'ProviderID');
    }

    public function productable()
    {
        return $this->morphTo();
    }


    public function subscriber()
    {
        return $this->belongsTo(User::class, 'SubscriberID');
    }

}
