<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ParentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = array(
            [
                'email' => 'parent1@admin.pl',
                'password' => 'admin',
                'status' => 1,
                'role_admin' => 0,
                'role_teacher' => 0,
                'role_student' => 0,
                'role_parent' => 1,
                'role_director' => 0,
                'meta' => [
                    'name' => 'Mateusz',
                    'surname' => 'Dziedzic',
                    'phone' => '512849338',
                    'birth_date' => '1980-02-15',
                    'PESEL' => '80021533934',
                ]
            ],
            [
                'email' => 'parent2@admin.pl',
                'password' => 'admin',
                'status' => 1,
                'role_admin' => 0,
                'role_teacher' => 0,
                'role_student' => 0,
                'role_parent' => 1,
                'role_director' => 0,
                'meta' => [
                    'name' => 'Wiktor',
                    'surname' => 'Wilczyński',
                    'phone' => '758374843',
                    'birth_date' => '1978-11-09',
                    'PESEL' => '78110938473',
                ]
            ],
            [
                'email' => 'parent3@admin.pl',
                'password' => 'admin',
                'status' => 1,
                'role_admin' => 0,
                'role_teacher' => 0,
                'role_student' => 0,
                'role_parent' => 1,
                'role_director' => 0,
                'meta' => [
                    'name' => 'Barbara',
                    'surname' => 'Grabowska',
                    'phone' => '755940393',
                    'birth_date' => '1981-03-19',
                    'PESEL' => '81031929203',
                ]
            ],
            [
                'email' => 'parent4@admin.pl',
                'password' => 'admin',
                'status' => 1,
                'role_admin' => 0,
                'role_teacher' => 0,
                'role_student' => 0,
                'role_parent' => 1,
                'role_director' => 0,
                'meta' => [
                    'name' => 'Jan',
                    'surname' => 'Cebulak',
                    'phone' => '550494383',
                    'birth_date' => '1977-09-10',
                    'PESEL' => '77091029393',
                ]
            ],
            [
                'email' => 'parent5admin.pl',
                'password' => 'admin',
                'status' => 1,
                'role_admin' => 0,
                'role_teacher' => 0,
                'role_student' => 0,
                'role_parent' => 1,
                'role_director' => 0,
                'meta' => [
                    'name' => 'Maria',
                    'surname' => 'Rutkowska',
                    'phone' => '757496383',
                    'birth_date' => '1982-10-21',
                    'PESEL' => '82102129392',
                ]
            ],
        );

        $parents = array(
            [
                'parent_id' => 33,
                'student_id' => 32,
            ],
            [
                'parent_id' => 34,
                'student_id' => 29,
            ],
            [
                'parent_id' => 35,
                'student_id' => 28,
            ],
            [
                'parent_id' => 36,
                'student_id' => 24,
            ],
            [
                'parent_id' => 37,
                'student_id' => 27,
            ],
        );

        foreach($users as $user) {
            $row = new User();
            $row->class_id = $user['class_id'] ?? 0;
            $row->email = $user['email'];
            $row->password = Hash::make($user['password']);
            $row->status = $user['status'];
            $row->role_admin = $user['role_admin'];
            $row->role_teacher = $user['role_teacher'];
            $row->role_student = $user['role_student'];
            $row->role_parent = $user['role_parent'];
            $row->role_director = $user['role_director'];

            $row->save();

            $row->meta()->create([
                'name' => $user['meta']['name'],
                'surname' => $user['meta']['surname'],
                'phone' => $user['meta']['phone'],
                'birth_date' => $user['meta']['birth_date'],
                'PESEL' => $user['meta']['PESEL'],
                'avatar' => 'user.png',
            ]);
        }
        foreach($parents as $parent) {
            \App\Parents::create($parent);
        }
    }
}
