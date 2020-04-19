<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = [
        'student_id', 'teacher_id', 'subject_id',
        'text', 'positiv',
    ];
}
