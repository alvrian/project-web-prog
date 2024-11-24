<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WasteLog extends Model
{
    use HasFactory;
    public $timestamp = false;

    protected $fillable = [
        'WasteType', 'Weight',
    ];
    protected $primaryKey = 'WasteLogID';

}
