<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Mtvs\EloquentHashids\HasHashid;
use Mtvs\EloquentHashids\HashidRouting;

class Grade extends Model
{

	use Notifiable, HasHashid, HashidRouting;

    protected $fillable = [
        'teacher_id', 'student_id', 'subject_id',
        'grade', 'weight', 'description'
    ];

    public function teacher(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(User::class, 'id', 'teacher_id');
    }

    public function student(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(User::class, 'id', 'student_id');
    }

    public function subject(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Subject::class, 'id', 'subject_id');
    }

    public function getHashIdAttribute(){
        return $this->hashId();
    }

    public function scopeInClass( $query, $class_id ){
        return $query->join('users' ,  'grades.student_id', 'users.id')->where( 'class_id', '=', $class_id );
    }


}
