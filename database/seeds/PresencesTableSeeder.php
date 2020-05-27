<?php

use App\Presence;
use Illuminate\Database\Seeder;
use Carbon\Carbon;


class PresencesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    /*  'lesson_id', 'student_id', 'presence'  */
    public function run()
    {
        $timezone = 'Europe/Warsaw';

        $presences = array(
            [
                'lesson_id' => 1,
                'student_id' => 4,
                'presence' => 1,
            ],
            [
                'lesson_id' => 1,
                'student_id' => 5,
                'presence' => 2,
            ],
            [
                'lesson_id' => 4,
                'student_id' => 4,
                'presence' => 1,
            ],
            [
                'lesson_id' => 4,
                'student_id' => 5,
                'presence' => 2,
            ],
        );

        foreach($presences as $presence) {
            Presence::create($presence);
        }
    }
}
