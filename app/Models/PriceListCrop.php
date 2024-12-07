<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceListCrop extends Model
{
    use HasFactory;

    protected $table = 'crop_price_list';

    protected $fillable = [
        'crop_id',
        'price_per_item',
        'price_per_subscription_3',
        'price_per_subscription_6',
        'price_per_subscription_9',
        'price_per_subscription_12',
    ];

    public function crop()
    {
        return $this->belongsTo(Crop::class);
    }
}
