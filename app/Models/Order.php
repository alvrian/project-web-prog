<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'crop_id',
        'restaurant_id',
        'quantity',
        'total_price',
        'status', //Pending, Approved, Rejected
    ];

    public function crop()
    {
        return $this->belongsTo(Crop::class);
    }

    public function restaurant()
    {
        return $this->belongsTo(User::class, 'restaurant_id');
    }
}
