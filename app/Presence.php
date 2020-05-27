<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Presence extends Model
{

    protected $fillable = [
        'lesson_id', 'student_id', 'presence'
    ];

    public function lesson(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Lesson::class, 'id', 'lesson_id');
    }

    public function student(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(User::class, 'id', 'student_id');
    }

    public static function getStatuses(): array {
        return [
            0 => 'Nieobecny',
            1 => 'Obecny',
            2 => 'Obecny (spóźniony)',
            3 => 'Nieobecny (usprawiedliwiony)',
            4 => 'Zwolniony',
        ];
    }
}
