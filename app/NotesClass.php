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
        'student_id', 'teacher_id', 'subjects_id', 'text', 'positiv', 'created_at'
    ];

    public const POSITIV_IS_ACTIVE = 1;
    public const POSITIV_IS_INACTIVE = 0;

    public function teacher(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(User::class, 'id', 'teacher_id');
    }

    public function getHashIdAttribute(){
        return $this->hashId();
    }
    public function subject(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Subject::class, 'id', 'subject_id');
    }
    public function student(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(User::class, 'id', 'student_id');
    }


    public function getFullNameAttribute(){
        return $this->sign . ' (' . $this->getTypeNameAttribute($this->type) . ')';
    }
    public static function getAvailableTypes() {

    }

    public function getNoteTeacherAttribute(): string{
        return $this->teacher->meta->name . ' ' . $this->teacher->meta->surname;
    }

    public function getNoteStudentAttribute(): string{
        return $this->student->meta->name . ' ' . $this->student->meta->surname;
    }

    public function getNoteSubjectAttribute(): string{
        return $this->subject->meta->name;
    }

    public function getStatusNameAttribute(): ?string{
        $positiv = $this->positiv;
        switch( $positiv ){
            case self::POSITIV_IS_INACTIVE:
                return 'Negatywna';
                break;
            case self::POSITIV_IS_ACTIVE:
                return 'Pozytywna';
                break;
            default:
                return '';
        }
    }


    public function scopeInClass( $query, $class_id ){
        return $query->join('users' ,  'notes.student_id', 'users.id')->where( 'class_id', '=', $class_id );
    }



}
