<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    public $timestamp = false;

    protected $fillable = [
        'SubscriptionType', 'StartDate', 'EndDate', 'Status'
    ];

    protected $primaryKey = 'WasteLogID';

    public function subscriber()
    {
        return $this->morphTo();
    }

    public function provider()
    {
        return $this->morphTo();
    }
}
