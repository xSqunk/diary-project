<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class TeacherController extends Controller
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
        $teachers = User::isTeacher()->get();

        return view( 'dashboard.users.index', [
            'users' => $teachers,
            'view_type' => 'teachers',
            'head_text' => 'Lista nauczycieli',
        ] );
    }

    public function create(){
        return view( 'dashboard.users.create', [
            'view_type' => 'teachers',
            'head_text' => 'Dodawanie nauczyciela',
        ] );
    }

    public function edit($id) {

        $user = User::findByHashidOrFail( $id );

        return view( 'dashboard.users.edit', [
            'user' => $user,
            'view_type' => 'teachers',
            'head_text' => 'Edycja nauczyciela',
        ] );
    }

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
        $user->role_teacher = 1;

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

        return redirect()->route( 'teachers.index' )->with( 'alert', [
            'title' => 'Pomyślnie utworzono nauczyciela!',
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
        $user->role_teacher = 1;


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

        return redirect()->route( 'teachers.index' )->with( 'alert', [
            'title' => 'Pomyślnie zaktualizowano nauczyciela!',
            'type'  => 'success',
            'timer' => '5000',
        ] );
    }
}
