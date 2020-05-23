<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Presence extends Model
{
    public function lesson(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Lesson::class, 'id', 'lesson_id');
    }

    public function student(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(User::class, 'id', 'student_id');
    }

    protected $fillable = [
        'presence'
    ];
}
