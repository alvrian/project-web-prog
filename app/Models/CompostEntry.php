<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompostEntry extends Model
{
    use HasFactory;

    protected $fillable = [
        'compost_producer_id',
        'compost_producer_name',
        'compost_types_produced',
        'average_compost_amount',
        'kitchen_waste_capacity',
        'date_logged',
    ];
}

