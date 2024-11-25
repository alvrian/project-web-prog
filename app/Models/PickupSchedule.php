<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PickupSchedule extends Model
{
    use HasFactory;

    protected $fillable = ['PickupType', 'ScheduledDate', 'Status'];

    public function participant()
    {
        return $this->morphTo();
    }

    public $timestamp = false;
    protected $primaryKey = 'PickupID';
}
