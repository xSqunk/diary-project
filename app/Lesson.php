<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{

    public function presences()
    {
        return $this->hasMany('App\Schedule');
    }

    protected $fillable = [
        'class_id', 'deputy_id', 'schedule_id', 'lesson_date', 'term_id',
        'school_week', 'took_place', 'presences', 'absences'
    ];
}
