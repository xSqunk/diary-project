<?php

use App\Subject;
use Illuminate\Database\Seeder;

class SubjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $subjects = [
            [
                'name' => 'Matematyka',
                'shortcut' => 'mat',
            ],
            [
                'name' => 'Biologia',
                'shortcut' => 'biol',
            ],
            [
                'name' => 'Fizyka',
                'shortcut' => 'fiz',
            ],
            [
                'name' => 'Informatyka',
                'shortcut' => 'inf',
            ],
            [
                'name' => 'Geografia',
                'shortcut' => 'geo',
            ],
            [
                'name' => 'Przyroda',
                'shortcut' => 'prz',
            ],
            [
                'name' => 'Chemia',
                'shortcut' => 'chem',
            ],
            [
                'name' => 'Religia',
                'shortcut' => 'rel',
            ],
            [
                'name' => 'Wychowanie fizyczne',
                'shortcut' => 'wf',
            ],
            [
                'name' => 'J. Polski',
                'shortcut' => 'pol',
            ],
            [
                'name' => 'J.Angielski',
                'shortcut' => 'ang',
            ],
            [
                'name' => 'Historia',
                'shortcut' => 'his',
            ],
            [
                'name' => 'Wiedza o społeczeństwie',
                'shortcut' => 'wos',
            ],
            [
                'name' => 'Muzyka',
                'shortcut' => 'muz',
            ],
            [
                'name' => 'Plastyka',
                'shortcut' => 'plas',
            ],
        ];

        foreach($subjects as $subject) {
            Subject::create($subject);
        }
    }
}
