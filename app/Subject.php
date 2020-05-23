<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Mtvs\EloquentHashids\HasHashid;
use Mtvs\EloquentHashids\HashidRouting;

class Subject extends Model
{
    use Notifiable, HasHashid, HashidRouting;

    protected $table = 'subjects';

    protected $fillable = [
        'name', 'shortcut'
    ];

    public function index( Request $request ){
        $subjects = Subject::isSubject()->get();

        return view( 'dashboard.users.index', [
            'subjects' => $subjects,
            'subject' => null,
            'view_type' => 'subjects',
            'head_text' => 'Lista przedmitów',
        ] );
    }


    public function getNoteSubjectAttribute(): string{
        return $this->subject->meta->name;
    }
    public function getFullNameAttribute(){
        return $this->name . ' (' . $this->getTypeNameAttribute($this->name) . ')';
    }
}
