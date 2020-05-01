<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = [
        'name', 'shortcut'
    ];

    public const SUBJECT_MATEMATYKA = 1;
    public const SUBJECT_BIOLOGIA = 2;
    public const SUBJECT_FIZYKA = 3;
    public const SUBJECT_INFORMATYKA = 4;
    public const SUBJECT_GEOGRAFIA = 5;
    public const SUBJECT_PRZYRODA = 6;
    public const SUBJECT_CHEMIA = 7;
    public const SUBJECT_RELIGIA = 8;
    public const SUBJECT_WF = 9;
    public const SUBJECT_POLSKI = 10;
    public const SUBJECT_ANGIELSKI = 11;
    public const SUBJECT_HISTORIA = 12;
    public const SUBJECT_WOS = 13;
    public const SUBJECT_MUZYKA = 14;
    public const SUBJECT_PLASTYKA = 15;


    public static function getAvailableSubjects() {
        $subjects = array(
            self::SUBJECT_MATEMATYKA => 'Matematyka',
            self::SUBJECT_BIOLOGIA => 'Biologia',
            self::SUBJECT_FIZYKA => 'Fizyka',
            self::SUBJECT_INFORMATYKA => 'Informatyka',
            self::SUBJECT_GEOGRAFIA => 'Geografia',
            self::SUBJECT_PRZYRODA => 'Przyroda',
            self::SUBJECT_CHEMIA => 'Chemia',
            self::SUBJECT_RELIGIA => 'Religia',
            self::SUBJECT_WF => 'Wychowanie Fizyczne',
            self::SUBJECT_POLSKI => 'Język Polski',
            self::SUBJECT_ANGIELSKI => 'Język Angielski',
            self::SUBJECT_HISTORIA => 'Historia',
            self::SUBJECT_WOS => 'Wiedza o społeczeństwie',
            self::SUBJECT_MUZYKA => 'Muzyka',
            self::SUBJECT_PLASTYKA => 'Plastyka',
        );

        return $subjects;
    }

}
