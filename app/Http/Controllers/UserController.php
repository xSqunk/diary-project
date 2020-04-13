<?php

namespace App\Http\Controllers;

use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
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
        $users = User::all();

        return view( 'dashboard.users.index', [
            'users' => $users,
        ] );
    }

    public function create(){
        return view( 'dashboard.users.create', [
            'groups' => User::Groups()
        ] );
    }

    public function profileIndex() {
        return view( 'dashboard.users.edit', [
            'user' => auth()->user(),
            'groups' => User::Groups()
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
        $user->role_admin = isset($request->groups['admin']) ? 1 : 0;
        $user->role_teacher = isset($request->groups['teacher']) ? 1 : 0;
        $user->role_student = isset($request->groups['student']) ? 1 : 0;
        $user->role_parent = isset($request->groups['parent']) ? 1 : 0;
        $user->role_director = isset($request->groups['director']) ? 1 : 0;

        if( isset( $request->avatar ) ){
            $name         = $request->avatar->store( 'avatars', [ 'disk' => 'upload' ] );
            $user->avatar = $name;
        }

        $user->save();

        $user->meta()->create([
            'name' => $request->name,
            'surname' => $request->surname,
            'phone' => $request->phone,
            'birth_date' => $request->birth_date,
            'PESEL' => $request->PESEL,
        ]);

        return redirect()->route( 'users.index' )->with( 'alert', [
            'title' => 'Pomyślnie utworzono użytkownika!',
            'type'  => 'success',
            'timer' => '5000',
        ] );
    }

    public function update(Request $request) {

        $user = User::findByHashidOrFail( $request->userId );

        $validator = Validator::make( $request->all(), [
            'email'            => 'email|required|unique:users|max:255',
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

//        if( isset( $request->avatar ) ){
//            $name         = $request->avatar->store( 'avatars', [ 'disk' => 'upload' ] );
//            $user->avatar = $name;
//            $user->save();
//        }

        $user->email = $request->email;
        $user->status = $request->status;
        $user->role_admin = isset($request->groups['admin']) ? 1 : 0;
        $user->role_teacher = isset($request->groups['teacher']) ? 1 : 0;
        $user->role_student = isset($request->groups['student']) ? 1 : 0;
        $user->role_parent = isset($request->groups['parent']) ? 1 : 0;
        $user->role_director = isset($request->groups['director']) ? 1 : 0;

        $user->save();

        $user->meta()->delete();

        $user->meta()->create([
            'name' => $request->name,
            'surname' => $request->surname,
            'phone' => $request->phone,
            'birth_date' => $request->birth_date,
            'PESEL' => $request->PESEL,
        ]);

        return redirect()->route( 'users.index' )->with( 'alert', [
            'title' => 'Pomyślnie zaktualizowano użytkownika!',
            'type'  => 'success',
            'timer' => '5000',
        ] );
    }

    public function checkEmail( Request $request ){
        if( ! $request->email ){
            return Response::json( [
                'code'    => 503,
                'message' => 'Brak adresu email do sprawdzenia'
            ], 503 );
        }

        $email = htmlentities( $request->email );

        try{
            $count = User::where( 'email', '=', $email )->count();
        } catch( Exception $e ){
            return Response::json( [
                'code'    => 503,
                'message' => 'Błąd'
            ], 503 );
        }

        return Response::json( [
            'code'  => 200,
            'count' => $count,
        ], 200 );

    }

    public function edit($id) {

        $user = User::findByHashidOrFail( $id );

        return view( 'dashboard.users.edit', [
            'user' => $user,
            'groups' => User::Groups(),
        ] );
    }

    public function delete( Request $request ){
        $user = User::findByHashidOrFail( $request->hashId );

        $user->meta()->delete();
        $user->delete();
    }
}
