<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class WorkingHour extends Model
{
    protected $fillable = [
      'user_id',
      'start',
      'end',
      'hours_worked',
    ];

    public function user()
    {
        $this->belongsTo('App\User');
    }
}
