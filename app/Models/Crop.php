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

    public function farmer()
    {
        return $this->belongsTo(User::class, 'farmer_id');
    }
}


