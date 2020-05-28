<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class StudentsTableSeeder extends Seeder
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
                'email' => 'student1@admin.pl',
                'password' => 'admin',
                'status' => 1,
                'role_admin' => 0,
                'role_teacher' => 0,
                'role_student' => 1,
                'role_parent' => 0,
                'role_director' => 0,
                'meta' => [
                    'name' => 'Mikołaj',
                    'surname' => 'Burek',
                    'phone' => '584992812',
                    'birth_date' => '2002-07-11',
                    'PESEL' => '02071122932',
                ]
            ],
            [
                'email' => 'student2@admin.pl',
                'password' => 'admin',
                'status' => 1,
                'role_admin' => 0,
                'role_teacher' => 0,
                'role_student' => 1,
                'role_parent' => 0,
                'role_director' => 0,
                'meta' => [
                    'name' => 'Sylwia',
                    'surname' => 'Gąsior',
                    'phone' => '660449384',
                    'birth_date' => '2001-01-09',
                    'PESEL' => '01010927770',
                ]
            ],
            [
                'email' => 'student3@admin.pl',
                'password' => 'admin',
                'status' => 1,
                'role_admin' => 0,
                'role_teacher' => 0,
                'role_student' => 1,
                'role_parent' => 0,
                'role_director' => 0,
                'meta' => [
                    'name' => 'Milena',
                    'surname' => 'Major',
                    'phone' => '885992812',
                    'birth_date' => '2005-10-23',
                    'PESEL' => '05102388493',
                ]
            ],
            [
                'email' => 'student4@admin.pl',
                'password' => 'admin',
                'status' => 1,
                'role_admin' => 0,
                'role_teacher' => 0,
                'role_student' => 1,
                'role_parent' => 0,
                'role_director' => 0,
                'meta' => [
                    'name' => 'Bartosz',
                    'surname' => 'Wierzbicki',
                    'phone' => '505393217',
                    'birth_date' => '2000-03-02',
                    'PESEL' => '00030211049',
                ]
            ],
            [
                'class_id' => 4,
                'email' => 'student5@admin.pl',
                'password' => 'admin',
                'status' => 1,
                'role_admin' => 0,
                'role_teacher' => 0,
                'role_student' => 1,
                'role_parent' => 0,
                'role_director' => 0,
                'meta' => [
                    'name' => 'Mariusz',
                    'surname' => 'Nowakowski',
                    'phone' => '660493830',
                    'birth_date' => '2007-06-11',
                    'PESEL' => '07061155843',
                ]
            ],
            [
                'class_id' => 4,
                'email' => 'student6@admin.pl',
                'password' => 'admin',
                'status' => 1,
                'role_admin' => 0,
                'role_teacher' => 0,
                'role_student' => 1,
                'role_parent' => 0,
                'role_director' => 0,
                'meta' => [
                    'name' => 'Andrzej',
                    'surname' => 'Orłowski',
                    'phone' => '560413030',
                    'birth_date' => '2007-03-22',
                    'PESEL' => '07032251280',
                ]
            ],
            [
                'class_id' => 4,
                'email' => 'student7@admin.pl',
                'password' => 'admin',
                'status' => 1,
                'role_admin' => 0,
                'role_teacher' => 0,
                'role_student' => 1,
                'role_parent' => 0,
                'role_director' => 0,
                'meta' => [
                    'name' => 'Aleksandra',
                    'surname' => 'Bukowska',
                    'phone' => '665839103',
                    'birth_date' => '2007-12-07',
                    'PESEL' => '07120750720',
                ]
            ],
            [
                'class_id' => 4,
                'email' => 'student8@admin.pl',
                'password' => 'admin',
                'status' => 1,
                'role_admin' => 0,
                'role_teacher' => 0,
                'role_student' => 1,
                'role_parent' => 0,
                'role_director' => 0,
                'meta' => [
                    'name' => 'Piotr',
                    'surname' => 'Kozłowski',
                    'phone' => '655049302',
                    'birth_date' => '2006-11-12',
                    'PESEL' => '06111250711',
                ]
            ],
            [
                'email' => 'student9@admin.pl',
                'password' => 'admin',
                'status' => 1,
                'role_admin' => 0,
                'role_teacher' => 0,
                'role_student' => 1,
                'role_parent' => 0,
                'role_director' => 0,
                'meta' => [
                    'name' => 'Paweł',
                    'surname' => 'Król',
                    'phone' => '505393102',
                    'birth_date' => '2005-03-12',
                    'PESEL' => '05031239203',
                ]
            ],
            [
                'class_id' => 2,
                'email' => 'student10@admin.pl',
                'password' => 'admin',
                'status' => 1,
                'role_admin' => 0,
                'role_teacher' => 0,
                'role_student' => 1,
                'role_parent' => 0,
                'role_director' => 0,
                'meta' => [
                    'name' => 'Krzysztof',
                    'surname' => 'Łobodziński',
                    'phone' => '550494834',
                    'birth_date' => '2010-05-12',
                    'PESEL' => '10051200123',
                ]
            ],
            [
                'class_id' => 2,
                'email' => 'student11@admin.pl',
                'password' => 'admin',
                'status' => 1,
                'role_admin' => 0,
                'role_teacher' => 0,
                'role_student' => 1,
                'role_parent' => 0,
                'role_director' => 0,
                'meta' => [
                    'name' => 'Mirosław',
                    'surname' => 'Dąbrowski',
                    'phone' => '770493823',
                    'birth_date' => '2009-05-30',
                    'PESEL' => '09053012848',
                ]
            ],
            [
                'email' => 'student12@admin.pl',
                'password' => 'admin',
                'status' => 1,
                'role_admin' => 0,
                'role_teacher' => 0,
                'role_student' => 1,
                'role_parent' => 0,
                'role_director' => 0,
                'meta' => [
                    'name' => 'Kamil',
                    'surname' => 'Zych',
                    'phone' => '775839485',
                    'birth_date' => '2011-04-12',
                    'PESEL' => '11041230494',
                ]
            ],
            [
                'class_id' => 3,
                'email' => 'student13@admin.pl',
                'password' => 'admin',
                'status' => 1,
                'role_admin' => 0,
                'role_teacher' => 0,
                'role_student' => 1,
                'role_parent' => 0,
                'role_director' => 0,
                'meta' => [
                    'name' => 'Ania',
                    'surname' => 'Zych',
                    'phone' => '775839485',
                    'birth_date' => '2002-12-02',
                    'PESEL' => '02120284783',
                ]
            ],
            [
                'email' => 'student14@admin.pl',
                'password' => 'admin',
                'status' => 1,
                'role_admin' => 0,
                'role_teacher' => 0,
                'role_student' => 1,
                'role_parent' => 0,
                'role_director' => 0,
                'meta' => [
                    'name' => 'Marta',
                    'surname' => 'Krukowska',
                    'phone' => '558948374',
                    'birth_date' => '2006-07-15',
                    'PESEL' => '06071548433',
                ]
            ],
            [
                'email' => 'student15@admin.pl',
                'password' => 'admin',
                'status' => 1,
                'role_admin' => 0,
                'role_teacher' => 0,
                'role_student' => 1,
                'role_parent' => 0,
                'role_director' => 0,
                'meta' => [
                    'name' => 'Kacper',
                    'surname' => 'Orzechowski',
                    'phone' => '669472830',
                    'birth_date' => '2004-01-17',
                    'PESEL' => '04011738432',
                ]
            ],
            [
                'class_id' => 3,
                'email' => 'student16@admin.pl',
                'password' => 'admin',
                'status' => 1,
                'role_admin' => 0,
                'role_teacher' => 0,
                'role_student' => 1,
                'role_parent' => 0,
                'role_director' => 0,
                'meta' => [
                    'name' => 'Dariusz',
                    'surname' => 'Piotrowski',
                    'phone' => '778475839',
                    'birth_date' => '2003-11-04',
                    'PESEL' => '03110499384',
                ]
            ],
            [
                'class_id' => 3,
                'email' => 'student17@admin.pl',
                'password' => 'admin',
                'status' => 1,
                'role_admin' => 0,
                'role_teacher' => 0,
                'role_student' => 1,
                'role_parent' => 0,
                'role_director' => 0,
                'meta' => [
                    'name' => 'Julia',
                    'surname' => 'Ciechacka',
                    'phone' => '876994812',
                    'birth_date' => '2003-04-29',
                    'PESEL' => '03042999384',
                ]
            ],
            [
                'class_id' => 3,
                'email' => 'student18@admin.pl',
                'password' => 'admin',
                'status' => 1,
                'role_admin' => 0,
                'role_teacher' => 0,
                'role_student' => 1,
                'role_parent' => 0,
                'role_director' => 0,
                'meta' => [
                    'name' => 'Jagoda',
                    'surname' => 'Cebulak',
                    'phone' => '559493044',
                    'birth_date' => '2003-02-05',
                    'PESEL' => '03020539494',
                ]
            ],
            [
                'class_id' => 3,
                'email' => 'student19@admin.pl',
                'password' => 'admin',
                'status' => 1,
                'role_admin' => 0,
                'role_teacher' => 0,
                'role_student' => 1,
                'role_parent' => 0,
                'role_director' => 0,
                'meta' => [
                    'name' => 'Błażej',
                    'surname' => 'Borowski',
                    'phone' => '559493044',
                    'birth_date' => '2003-07-23',
                    'PESEL' => '03072344958',
                ]
            ],
            [
                'email' => 'student20@admin.pl',
                'password' => 'admin',
                'status' => 1,
                'role_admin' => 0,
                'role_teacher' => 0,
                'role_student' => 1,
                'role_parent' => 0,
                'role_director' => 0,
                'meta' => [
                    'name' => 'Ewelina',
                    'surname' => 'Żukowska',
                    'phone' => '559493044',
                    'birth_date' => '2003-06-05',
                    'PESEL' => '03060567585',
                ]
            ],
            [
                'class_id' => 1,
                'email' => 'student21@admin.pl',
                'password' => 'admin',
                'status' => 1,
                'role_admin' => 0,
                'role_teacher' => 0,
                'role_student' => 1,
                'role_parent' => 0,
                'role_director' => 0,
                'meta' => [
                    'name' => 'Agata',
                    'surname' => 'Rutkowska',
                    'phone' => '550493485',
                    'birth_date' => '2009-04-13',
                    'PESEL' => '090413485',
                ]
            ],
            [
                'class_id' => 2,
                'email' => 'student22@admin.pl',
                'password' => 'admin',
                'status' => 1,
                'role_admin' => 0,
                'role_teacher' => 0,
                'role_student' => 1,
                'role_parent' => 0,
                'role_director' => 0,
                'meta' => [
                    'name' => 'Izabela',
                    'surname' => 'Grabowska',
                    'phone' => '549384932',
                    'birth_date' => '2009-01-23',
                    'PESEL' => '09012347388',
                ]
            ],
            [
                'class_id' => 2,
                'email' => 'student23@admin.pl',
                'password' => 'admin',
                'status' => 1,
                'role_admin' => 0,
                'role_teacher' => 0,
                'role_student' => 1,
                'role_parent' => 0,
                'role_director' => 0,
                'meta' => [
                    'name' => 'Patryk',
                    'surname' => 'Wilczyński',
                    'phone' => '533829093',
                    'birth_date' => '2009-06-30',
                    'PESEL' => '09063049559',
                ]
            ],
            [
                'class_id' => 1,
                'email' => 'student24@admin.pl',
                'password' => 'admin',
                'status' => 1,
                'role_admin' => 0,
                'role_teacher' => 0,
                'role_student' => 1,
                'role_parent' => 0,
                'role_director' => 0,
                'meta' => [
                    'name' => 'Oliwia',
                    'surname' => 'Górska',
                    'phone' => '512849338',
                    'birth_date' => '2009-09-11',
                    'PESEL' => '09091193004',
                ]
            ],
            [
                'class_id' => 1,
                'email' => 'student25@admin.pl',
                'password' => 'admin',
                'status' => 1,
                'role_admin' => 0,
                'role_teacher' => 0,
                'role_student' => 1,
                'role_parent' => 0,
                'role_director' => 0,
                'meta' => [
                    'name' => 'Pola',
                    'surname' => 'Polak',
                    'phone' => '879584339',
                    'birth_date' => '2009-11-05',
                    'PESEL' => '09110533928',
                ]
            ],
            [
                'email' => 'student26@admin.pl',
                'password' => 'admin',
                'status' => 1,
                'role_admin' => 0,
                'role_teacher' => 0,
                'role_student' => 1,
                'role_parent' => 0,
                'role_director' => 0,
                'meta' => [
                    'name' => 'Adam',
                    'surname' => 'Dziedzic',
                    'phone' => '669540493',
                    'birth_date' => '2004-02-19',
                    'PESEL' => '04021929203',
                ]
            ],
        );

        foreach($users as $user) {
            $row = new User();
            $row->class_id = $user['class_id'] ?? null;
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
