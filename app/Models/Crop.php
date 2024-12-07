<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crop extends Model
{
    use HasFactory;

    protected $fillable = [
        'farmer_id',
        'crop_name',
        'crop_type',
        'average_amount',
        'harvest_cycles',
        'crop_image',
        'availability_start',
        'availability_end',
    ];

    protected $casts = [
        'availability_start' => 'datetime',
        'availability_end' => 'datetime',
    ];

    public function farmer()
    {
        return $this->belongsTo(User::class, 'farmer_id');
    }

    public function prices()
    {
        return $this->hasOne(Price::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function priceList()
    {
        return $this->hasOne(PriceListCrop::class, 'crop_id');
    }



}
