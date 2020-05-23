<?php

namespace App;

use App\Schedule;
use Illuminate\Database\Eloquent\Model;

class Term extends Model
{

    public function schedules()
    {
        return $this->hasMany('App\Schedule');
    }

    protected $fillable = [
        'start_hour', 'start_minute', 'end_hour', 'end_minute', 'week_day'
    ];
}
