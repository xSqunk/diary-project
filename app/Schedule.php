<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{

    protected $fillable = [
        'term_id', 'class_id', 'teacher_id', 'classroom_id', 'subject_id'
    ];
}
