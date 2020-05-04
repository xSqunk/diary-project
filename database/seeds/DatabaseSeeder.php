<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        #$this->call(SubjectsTableSeeder::class);
        #$this->call(ClassesTableSeeder::class);
        #$this->call(UsersTableSeeder::class);
        $this->call(TermsTableSeeder::class);
        $this->call(SchedulesTableSeeder::class);
        $this->call(LessonsTableSeeder::class);
    }
}
