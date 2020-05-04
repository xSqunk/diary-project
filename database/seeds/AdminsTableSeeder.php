<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminsTableSeeder extends Seeder
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
                'email' => 'admin@admin.pl',
                'password' => 'admin',
                'status' => 1,
                'role_admin' => 1,
                'role_teacher' => 1,
                'role_student' => 1,
                'role_parent' => 1,
                'role_director' => 1,
                'meta' => [
                    'name' => 'Jan',
                    'surname' => 'Nowak',
                    'phone' => '722354232',
                    'birth_date' => '1990-05-13',
                    'PESEL' => '90051355129',
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
