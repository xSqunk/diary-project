<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{

    protected $fillable = [
        'class_id', 'deputy_id', 'schedule_id', 'lesson_date', 'term_id',
        'school_week', 'took_place', 'presences', 'absences'
    ];

    private $days = [
        '', 'Poniedziałek', 'Wtorek', 'Środa', 'Czwartek', 'Piątek', 'Sobota', 'Niedziela'
    ];

    private $months = [
        '', 'Stycznia', 'Lutego', 'Marca', 'Kwietnia', 'Maja', 'Czerwca', 'Lipca', 'Sierpnia', 'Września', 'Października', 'Listopada', 'Grudnia'
    ];

    public function schedule() {
        return $this->belongsTo(Schedule::class);
    }

    public function presences()
    {
        return $this->hasMany('App\Schedule');
    }

    public function getLessonDateTextAttribute(): ?string{
        $lesson_date = strtotime($this->lesson_date);
        $name_of_day = '' . $this->days[date('w', $lesson_date)] . ', ' . date(' j ', $lesson_date) . $this->months[date('n', $lesson_date)];

        return $name_of_day;
    }
}
