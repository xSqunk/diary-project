<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TeachersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $users = array(
            [
                'email' => 'teacher1admin.pl',
                'password' => 'admin',
                'status' => 1,
                'role_admin' => 0,
                'role_teacher' => 1,
                'role_student' => 0,
                'role_parent' => 0,
                'role_director' => 0,
                'meta' => [
                    'name' => 'Jakub',
                    'surname' => 'Wrona',
                    'phone' => '505393282',
                    'birth_date' => '1972-04-21',
                    'PESEL' => '72042184944',
                ]
            ],
            [
                'email' => 'teacher2admin.pl',
                'password' => 'admin',
                'status' => 1,
                'role_admin' => 0,
                'role_teacher' => 1,
                'role_student' => 0,
                'role_parent' => 1,
                'role_director' => 0,
                'meta' => [
                    'name' => 'Zuzanna',
                    'surname' => 'Maciejewska',
                    'phone' => '771928393',
                    'birth_date' => '1988-02-19',
                    'PESEL' => '88021920993',
                ]
            ],
            [
                'email' => 'teacher3admin.pl',
                'password' => 'admin',
                'status' => 1,
                'role_admin' => 0,
                'role_teacher' => 1,
                'role_student' => 0,
                'role_parent' => 0,
                'role_director' => 0,
                'meta' => [
                    'name' => 'Katarzyna',
                    'surname' => 'Grzelak',
                    'phone' => '690337848',
                    'birth_date' => '1969-05-01',
                    'PESEL' => '69050193894',
                ]
            ],
            [
                'email' => 'teacher4admin.pl',
                'password' => 'admin',
                'status' => 1,
                'role_admin' => 0,
                'role_teacher' => 1,
                'role_student' => 0,
                'role_parent' => 0,
                'role_director' => 0,
                'meta' => [
                    'name' => 'Katarzyna',
                    'surname' => 'Grzelak',
                    'phone' => '690337848',
                    'birth_date' => '1969-05-01',
                    'PESEL' => '69050193894',
                ]
            ],
            [
                'email' => 'teacher5admin.pl',
                'password' => 'admin',
                'status' => 1,
                'role_admin' => 0,
                'role_teacher' => 1,
                'role_student' => 0,
                'role_parent' => 0,
                'role_director' => 0,
                'meta' => [
                    'name' => 'Tymoteusz',
                    'surname' => 'Brzozowski',
                    'phone' => '776867494',
                    'birth_date' => '1993-04-05',
                    'PESEL' => '93040538373',
                ]
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
    }
}
