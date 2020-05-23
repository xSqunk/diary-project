<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassSubjects extends Model
{
    protected $table = 'class_subjects';

    protected $fillable = [
        'class_id', 'subjects_id', 'hours_count'
    ];

    // public function schoolclass()
    // {
    //     return $this->belongsTo(SchoolClass::class, 'id', 'class_id');
    // }

    public function subjects()
    {
        return $this->belongsTo(Subject::class,'subjects_id', 'id');
    }

}
