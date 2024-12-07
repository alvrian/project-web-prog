<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catalog extends Model
{
    use HasFactory;

    protected $table = 'catalog';

    protected $fillable = [
        'ItemID',
        'ItemType',
        'AvailableItems',
        'AvailabilityStatus'
    ];

    public function item()
    {
        return $this->morphTo();
    }
}
