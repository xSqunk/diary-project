<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{

    public function subject(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Subject::class, 'id', 'subject_id');
    }

    protected $fillable = [
        'term_id', 'class_id', 'teacher_id', 'classroom_id', 'subject_id'
    ];
}
