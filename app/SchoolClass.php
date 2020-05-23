<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Mtvs\EloquentHashids\HasHashid;
use Mtvs\EloquentHashids\HashidRouting;

class SchoolClass extends Model
{
    use Notifiable, HasHashid, HashidRouting;

    protected $table = 'classes';

    protected $fillable = [
        'teacher_id', 'sign', 'description', 'type', 'max_members'
    ];

    public const CLASS_PODSTAWOWA = 1;
    public const CLASS_LICEUM = 2;
    public const CLASS_TECHNIKUM = 3;

    public function teacher(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(User::class, 'id', 'teacher_id');
    }

    public function students()
    {
        return $this->hasMany(User::class, 'class_id', 'id');
    }

    public function getHashIdAttribute(){
        return $this->hashId();
    }

    public function getTypeNameAttribute(): ?string{
        switch( $this->type ){
            case self::CLASS_PODSTAWOWA:
                return 'Szkoła Podstawowa';
                break;
            case self::CLASS_LICEUM:
                return 'Liceum';
                break;
            case self::CLASS_TECHNIKUM:
                return 'Technikum';
                break;
            default:
                return '';
        }
    }

    public function getClassTeacherAttribute(): string{
        return $this->teacher->meta->name . ' ' . $this->teacher->meta->surname;
    }

    public function getFullNameAttribute(){
        return $this->sign . ' (' . $this->getTypeNameAttribute($this->type) . ')';
    }

    public static function getAvailableTypes() {
        $types = array(
            self::CLASS_PODSTAWOWA => 'Szkoła Podstawowa',
            self::CLASS_LICEUM => 'Liceum',
            self::CLASS_TECHNIKUM => 'Technikum'
        );

        return $types;
    }

    public function classsubjects()
    {
        return $this->hasMany(ClassSubjects::class, 'class_id', 'id');
    }
}
