<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $fillable = [
        'teacher_id', 'student_id', 'subject_id',
        'grade', 'weight', 'description'
    ];
}
