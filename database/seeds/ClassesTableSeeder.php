<?php

use App\SchoolClass;
use Illuminate\Database\Seeder;

class ClassesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $classes = array(
            [
                'teacher_id' => 33,
                'sign' => '4A',
                'description' => 'Klasa wybitna',
                'type' => 1,
                'max_members' => 20
            ],
            [
                'teacher_id' => 34,
                'sign' => '4B',
                'description' => 'Klasa słabsza',
                'type' => 1,
                'max_members' => 25
            ],
            [
                'teacher_id' => 35,
                'sign' => '1H',
                'description' => '-',
                'type' => 2,
                'max_members' => 20
            ],
            [
                'teacher_id' => 36,
                'sign' => '6A',
                'description' => '',
                'type' => 1,
                'max_members' => 15
            ],
        );

        foreach($classes as $class) {
            SchoolClass::create($class);
        }
    }
}
