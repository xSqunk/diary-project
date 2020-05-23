<?php

use App\Schedule;
use Illuminate\Database\Seeder;

class SchedulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $schedules = [
            [
                'term_id' => 1,
                'class_id' => 1,
                'teacher_id' => 1,
                'classroom_id' => 1,
                'subject_id' => 1,
            ],
            [
                'term_id' => 2,
                'class_id' => 33,
                'teacher_id' => 2,
                'classroom_id' => 2,
                'subject_id' => 2,
            ],
        ];

        foreach($schedules as $schedule) {
            Schedule::create($schedule);
        }
    }
}
