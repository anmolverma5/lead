<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = [
        'user_id','lead_id','reminder_date','reminder_for','feedback'
    ];

    public function lead()
    {
        return $this->belongsTo('App\Models\Lead');
    }
}
