<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = array(
            //admin
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
            //students
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
            //rodzice
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
            //nauczyciele
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
