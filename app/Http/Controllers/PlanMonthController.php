<?php

namespace App\Http\Controllers;

use App\Parents;
use App\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PlanMonthController extends Controller
{
    protected const attributesNames = [
        'email'            => '<strong>E-mail</strong>',
        'password'         => '<strong>Hasło</strong>',
        'old-password'     => '<strong>Aktualne hasło</strong>',
        'name'             => '<strong>Imię</strong>',
        'surname'          => '<strong>Nazwisko</strong>',
        'phone'            => '<strong>Telefon</strong>',
        'birth_date'       => '<strong>Data urodzenia</strong>',
        'PESEL'            => '<strong>PESEL</strong>',
        'confirm-password' => '<strong>Powtóż hasło</strong>',
        'avatar'           => '<strong>Avatar</strong>',
    ];

    public function index( Request $request ){
        #$students = User::isStudent()->get();
        $years = array(2020, 2019, 2018, 2017);
        $months = array('01' => "Styczeń", '02' => "Luty", '03' => "Marzec",
                        '04' => "Kwiecień", '05' => "Maj", '06' => "Czerwiec",
                        '07' => "Lipiec", '08' => "Sierpień", '09' => "Wrzesień",
                        '10' => "Październik", '11' => "Listopad", '12' => "Grudzień"
        ); ###### usunac stringi keys


        $year = $_GET['year'];
        $month = array_search ($_GET['month'], $months);

        #dd($request->filled("month"));
        if ($request->filled("year") and $request->filled("month")) {
            $from = date("Y-m-d", strtotime($year.'-'.$month.'-01'));
            $to = date("Y-m-t", strtotime($year.'-'.$month.'-01'));

            #dd($from.' to '.$to);
            $lesson_days = Lesson::whereBetween('lesson_date', [$from, $to])->get();
            ##dd($lesson_days);
        } else {
            $lesson_days = [];
        }


       #dd($months);

        return view( 'dashboard.plan.month.index', [
            'lesson_days' => $lesson_days,
            'view_type' => 'plan',
            'years' => $years,
            'months' => $months,
            'head_text' => 'Plan',
        ] );
    }
/*
    public function create(){
        return view( 'dashboard.users.create', [
            'view_type' => 'students',
            'head_text' => 'Dodawanie ucznia',
        ] );
    }

    public function edit($id) {

        $user = User::findByHashidOrFail( $id );

        return view( 'dashboard.users.edit', [
            'user' => $user,
            'view_type' => 'students',
            'head_text' => 'Edycja ucznia',
        ] );
    }

    */

/*
    public function store( Request $request ){

        $validator = Validator::make( $request->all(), [
            'email'            => 'email|required|unique:users|max:255',
            'password'         => "required|max:255|min:8|regex:/^.*(?=.{3,})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[\d])(?=.*[!@#$%^*]).*$/",
            'name'             => 'required|max:255',
            'surname'          => 'required|max:255',
            'phone'            => 'required|max:11',
            'birth_date'       => 'required|date|before_or_equal:today',
            'PESEL'            => 'required|min:11|max:11',
        ] );

        $validator->setAttributeNames( self::attributesNames );

        if( $validator->fails() ){
            return redirect()->back()->withErrors( $validator )->withInput(
                $request->all( 'email', 'password', 'name', 'surname', 'phone', 'birth_date', 'PESEL' )
            );
        }

        $user = new User();
        $user->email = $request->email;
        $user->password = Hash::make( $request->password );
        $user->status = $request->status;
        $user->role_student = 1;

        if( isset( $request->avatar ) ){
            $file_name = $request->avatar->store( 'avatars', [ 'disk' => 'upload' ] );
            $avatar_name = $file_name;
        } else {
            $avatar_name = 'user.png';
        }

        $user->save();

        $user->meta()->create([
            'name' => $request->name,
            'surname' => $request->surname,
            'phone' => $request->phone,
            'birth_date' => $request->birth_date,
            'PESEL' => $request->PESEL,
            'avatar' => $avatar_name,
        ]);

        return redirect()->route( 'students.index' )->with( 'alert', [
            'title' => 'Pomyślnie utworzono ucznia!',
            'type'  => 'success',
            'timer' => '5000',
        ] );
    }

    public function update(Request $request) {

        $user = User::findByHashidOrFail( $request->userId );

        $validator = Validator::make( $request->all(), [
            'email'            => 'email|required|unique:users,email,' . $user->id,
            'name'             => 'required|max:255',
            'surname'          => 'required|max:255',
            'phone'            => 'required|max:11',
            'birth_date'       => 'required|date|before_or_equal:today',
            'PESEL'            => 'required|min:11|max:11',
        ] );

        $validator->setAttributeNames( self::attributesNames );

        if( $validator->fails() ){
            return redirect()->back()->withErrors( $validator )->withInput(
                $request->all( 'email', 'name', 'surname', 'phone', 'birth_date', 'PESEL' )
            );
        }

        if( isset( $request->avatar ) ){
            $file_name = $request->avatar->store( 'avatars', [ 'disk' => 'upload' ] );
            $avatar_name = $file_name;
        } else {
            $avatar_name = $user->meta->avatar;
        }

        $user->email = $request->email;
        $user->status = $request->status;
        $user->role_student = 1;


        $user->save();

        $user->meta()->delete();

        $user->meta()->create([
            'name' => $request->name,
            'surname' => $request->surname,
            'phone' => $request->phone,
            'birth_date' => $request->birth_date,
            'PESEL' => $request->PESEL,
            'avatar' => $avatar_name,
        ]);

        return redirect()->route( 'students.index' )->with( 'alert', [
            'title' => 'Pomyślnie zaktualizowano ucznia!',
            'type'  => 'success',
            'timer' => '5000',
        ] );
    }
    */
}
