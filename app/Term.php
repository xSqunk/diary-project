<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Term extends Model
{

    public function getFullStartAttribute(){
         return "{$this->start_hour}:{$this->start_minute}";
    }

    public function getFullEndAttribute(){
         return "{$this->end_hour}:{$this->end_minute}";
    }

    protected $fillable = [
        'start_hour', 'start_minute', 'end_hour', 'end_minute', 'week_day'
    ];
}
