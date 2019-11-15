<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkingHour extends Model
{
    protected $fillable = [
        'start',
        'end',
        'hours_worked',
        'user_id'
    ];

    public function users()
    {
        return $this->belongsTo('App\User');
    }
}
