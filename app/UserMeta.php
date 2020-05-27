<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserMeta extends Model
{

    protected $table = 'user_meta';

    protected $fillable = [
        'user_id', 'name', 'phone', 'surname',
        'birth_date', 'PESEL', 'avatar'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function getAvatarUrl() {
        $avatarFile = $this->avatar;
        $baseDir    = 'upload/';

        if( $avatarFile && file_exists( public_path( $baseDir . $avatarFile ) ) ){
            return asset( $baseDir . $avatarFile );
        }

        return asset( $baseDir . 'avatars/user.png' );
    }

    public function scopeInClass( $query, $class_id ){
        return $query->join('users' ,  'user_meta.user_id', 'users.id')->where( 'class_id', '=', $class_id );
    }

    public function scopeIsStudent($query){
        return $query->join('users' ,  'user_meta.user_id', 'users.id')->where( 'role_student', '=', '1' );
    }
}
