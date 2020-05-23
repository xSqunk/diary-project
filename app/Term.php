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

    public function getFullHourAttribute(){
        $start_minute = strlen($this->start_minute) === 1 ? '0' . $this->start_minute : $this->start_minute;
        $end_minute = strlen($this->end_minute) === 1 ? '0' . $this->end_minute : $this->end_minute;

        return $this->start_hour . ':' . $start_minute . ' - ' . $this->end_hour . ':' . $end_minute;
    }
}
