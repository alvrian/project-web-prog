<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceListWasteLog extends Model
{
    use HasFactory;

    protected $table = 'price_list';

    protected $fillable = [
        'WasteLogID',
        'price_per_kg',
        'price_per_subscription_3',
        'price_per_subscription_6',
        'price_per_subscription_9',
        'price_per_subscription_12',
    ];

    public function wasteLog()
    {
        return $this->belongsTo(WasteLog::class, 'WasteLogID');
    }
}
