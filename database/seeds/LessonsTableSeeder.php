<?php

use App\Lesson;
use Illuminate\Database\Seeder;
use Carbon\Carbon;


class LessonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $timezone = 'Europe/Warsaw';

        $lessons = array(
            [
                'class_id' => 1,
                'deputy_id' => 3,
                'schedule_id' => 1,
                'lesson_date' =>  Carbon::createFromFormat('Y-m-d', '2020-05-01'),
                'term_id' => 1,
                'school_week' => 1,
                'took_place' => FALSE,
                'presences' => 20,
                'absences' => 5,
            ],
            [
                'class_id' => 2,
                'deputy_id' => 4,
                'schedule_id' => 2,
                'lesson_date' =>  Carbon::createFromFormat('Y-m-d', '2020-04-02'),
                'term_id' => 33,
                'school_week' => 1,
                'took_place' => TRUE,
                'presences' => 21,
                'absences' => 4,
            ],
        );

        foreach($lessons as $lesson) {
            Lesson::create($lesson);
        }
    }
}
