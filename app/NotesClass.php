<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Mtvs\EloquentHashids\HasHashid;
use Mtvs\EloquentHashids\HashidRouting;

class NotesClass extends Model
{
    use Notifiable, HasHashid, HashidRouting;

    protected $table = 'notes';

    protected $fillable = [
        'student_id', 'teacher_id', 'subjects_id', 'postiv', 'created_at'
    ];

    public function teacher(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(User::class, 'id', 'teacher_id');
    }

    public function getHashIdAttribute(){
        return $this->hashId();
    }


    public function getFullNameAttribute(){
        return $this->sign . ' (' . $this->getTypeNameAttribute($this->type) . ')';
    }
    public static function getAvailableTypes() {


    }

}
