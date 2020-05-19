<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{

    public function scopeLessonDaysInMonth($query, $year, $month){
        return $query->where( 'lesson_date', '=',  $year.'-'.$month.'-'.$day); #2020-05-01
    }

    protected $fillable = [
        'deputy_id', 'schedule_id', 'lesson_date', 'term_id',
        'school_week', 'took_place', 'presences', 'absences'
    ];
}
