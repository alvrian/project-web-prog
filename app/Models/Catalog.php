<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catalog extends Model
{
    use HasFactory;
    protected $primaryKey = 'CatalogID';

    protected $fillable = [
        'Type',
        'ItemID',
        'Location',
        'AvailableItems',
        'AvailabilityStatus'
    ];
    
    public function item()
    {
        return $this->morphTo();
    }
}   
