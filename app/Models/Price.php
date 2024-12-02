<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;

    protected $fillable = [
        'crop_id',
        'price_per_kg',
    ];

    public function crop()
    {
        return $this->belongsTo(Crop::class);
    }
}
