<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;
    protected $primaryKey = 'FeedbackID';

    protected $fillable = [
        'ReviewerID', 
        'ReviewerType', 
        'RevieweeID', 
        'RevieweeType', 
        'Rating', 
        'Comments', 
        'Date'
    ];

    public function reviewer()
    {
        return $this->morphTo();
    }

    public function reviewee()
    {
        return $this->morphTo();
    }
}
