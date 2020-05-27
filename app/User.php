<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Mtvs\EloquentHashids\HasHashid;
use Mtvs\EloquentHashids\HashidRouting;

class User extends Authenticatable
{
    use Notifiable, HasHashid, HashidRouting;

    protected $fillable = [
        'status', 'email', 'password', 'last_login', 'role_admin',
        'role_teacher', 'role_student', 'role_parent', 'role_director'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public const STATUS_IS_ACTIVE = 1;
    public const STATUS_IS_INACTIVE = 0;

    public function meta(): \Illuminate\Database\Eloquent\Relations\HasOne
{
    return $this->hasOne(UserMeta::class);
}

    public function parents(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany( __CLASS__, 'parents', 'student_id', 'parent_id');
    } #############

    public function notes()
    {
        return $this->hasMany( NotesClass::class, 'student_id');
    }

    public function grades()
    {
        return $this->hasMany(Grade::class,'student_id', 'id');
    }

     public function schoolclass()
    {
        return $this->belongsTo(SchoolClass::class, 'id', 'class_id');
    }

    public function getHashIdAttribute(){
        return $this->hashId();
    }

    public function isActive(): bool {
        return $this->status === 1;
    }

    public function getStatusNameAttribute(): ?string{
        $status = $this->status;

        switch( $status ){
            case self::STATUS_IS_INACTIVE:
                return 'Nieaktywny';
                break;
            case self::STATUS_IS_ACTIVE:
                return 'Aktywny';
                break;
            default:
                return '';
        }
    }

    public function getGroupsAttribute(): ?array{

        $groups = array();

        if($this->role_admin) {
            $groups[] = (object) array(
                'key' => 'admin',
                'name' => 'Administratorzy'
            );
        }

        if($this->role_teacher) {
            $groups[] = (object) array(
                'key' => 'teacher',
                'name' => 'Nauczyciele'
            );
        }

        if($this->role_student) {
            $groups[] = (object) array(
                'key' => 'student',
                'name' => 'Uczniowie'
            );
        }

        if($this->role_parent) {
            $groups[] = (object) array(
                'key' => 'parent',
                'name' => 'Rodzice'
            );
        }

        if($this->role_director) {
            $groups[] = (object) array(
                'key' => 'director',
                'name' => 'Dyrektorzy'
            );
        }

        return $groups;
    }

    public function getFullNameAttribute(): ?string{
        return $this->meta->name . ' ' . $this->meta->surname;
    }

    public static function Groups(){
        return array(
            'admin' => array(
                'name' => 'Administratorzy',
                'description' => 'Grupa administratorów'
            ),
            'teacher' => array(
                'name' => 'Nauczyciele',
                'description' => 'Grupa nauczycieli'
            ),
            'student' => array(
                'name' => 'Uczniowie',
                'description' => 'Grupa uczniów'
            ),
            'parent' => array(
                'name' => 'Rodzice',
                'description' => 'Grupa rodziców'
            ),
            'director' => array(
                'name' => 'Dyrektorzy',
                'description' => 'Grupa dyrektorów'
            )
        );
    }

    public function scopeIsAdmin( $query ){
        return $query->where( 'role_admin', '=', 1 );
    }

    public function scopeIsTeacher( $query ){
        return $query->where( 'role_teacher', '=', 1 );
    }

    public function scopeIsStudent( $query ){
        return $query->where( 'role_student', '=', 1 );
    }

    public function scopeIsParent( $query ){
        return $query->where( 'role_parent', '=', 1 );
    }

    public function scopeIsDirector( $query ){
        return $query->where( 'role_director', '=', 1 );
    }

    public function scopeInGroup( $query, $group ){
        return $query->where( "role_$group", '=', 1 );
    }

    public function scopeNotLogged( $query ){
        return $query->where( 'id', '!=', auth()->user()->id );
    }

    public function scopeOnlyActive( $query ){
        return $query->where( 'status', '=', 1 );
    }

    public function scopeInClass( $query, $class_id ){
        return $query->where( 'class_id', '=', $class_id );
    }

    public function scopeNotInClass( $query, $class_id ){
        return $query->where( 'class_id', '!=', $class_id );
    }

}
