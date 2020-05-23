<?php

namespace App\Http\Controllers;

use App\Group;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
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


        if(!isset($request->group) || $request->group === 'all') {
            $users = User::all();
        } else {
            $users = User::InGroup($request->group)->get();
        }

        return view( 'dashboard.users.index', [
            'users' => $users,
            'groups' => User::Groups(),
            'class' => null,
            'view_type' => 'users',
            'head_text' => 'Lista użytkowników',
        ] );
    }

    public function create(){
        return view( 'dashboard.users.create', [
            'groups' => User::Groups(),
            'view_type' => 'users',
            'head_text' => 'Dodawanie użytkownika',
        ] );
    }

    public function edit($id) {

        $user = User::findByHashidOrFail( $id );

        return view( 'dashboard.users.edit', [
            'user' => $user,
            'groups' => User::Groups(),
            'view_type' => 'users',
            'head_text' => 'Edycja użytkownika',
        ] );
    }

    public function profileIndex(Request $request) {

        $user  = Auth::user();
        $tabId = $request->session()->pull( 'profileActiveTabId', 1 );

        return view( 'dashboard.users.profile', [
            'current'       => $user,
            'activeTabId'   => $tabId,
        ] );
    }

    public function profileUpdate( Request $request ){
        session( [ 'profileActiveTabId' => 1 ] );
        $user = User::findByHashidOrFail( $request->userId );

        if( isset( $request->avatar ) ){
            $name         = $request->avatar->store( 'avatars', [ 'disk' => 'upload' ] );
            $user->meta->avatar = $name;
            $user->meta->save();
        }

        return redirect()->route( 'users.profile' )->with( 'alert', [
            'title' => 'Pomyślnie zaktualizowano użytkownika!',
            'type'  => 'success',
            'timer' => '5000',
        ] );

    }

    public function passwordUpdate( Request $request ){

        session( [ 'profileActiveTabId' => 2 ] );
        $user = User::findByHashidOrFail( $request->userId );

        $validator = Validator::make( $request->all(), [
            'password'         => 'required|max:255|min:8|regex:/^.*(?=.{3,})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[\d])(?=.*[!@#$%^*]).*$/',
            'confirm-password' => 'required|same:password',
        ] );

        if( ! Hash::check( $request[ 'old-password' ], $user->password ) ){
            $validator->errors()->add( 'old-password', 'Wprowadzone aktualne hasło jest nieprawidłowe.' );
        }

        if( count( $validator->errors()->messages() ) !== 0 || $validator->fails() ){
            return redirect()->back()->withErrors( $validator )->withInput(
                $request->all( 'password' )
            );
        }

        $user->password = Hash::make( $request->password );
        $user->save();

        return redirect()->route( 'users.profile' )->with( 'alert', [
            'title' => 'Pomyślnie zaktualizowano hasło użytkownika!',
            'type'  => 'success',
            'timer' => '5000',
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

        return redirect()->route( 'users.index' )->with( 'alert', [
            'title' => 'Pomyślnie utworzono użytkownika!',
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
            'avatar' => $avatar_name,
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

    public function delete( Request $request ){
        $user = User::findByHashidOrFail( $request->hashId );

        $user->meta()->delete();
        $user->delete();
    }

    public function status( $id, $status, $type ){

        $user = User::findByHashidOrFail( $id );

        $msg = '';
        switch( $status ){
            case 0:
                $user->status = 0;
                $user->save();
                $msg = __( "dashboard/$type.Użytkownik został pomyślnie zablokowany" );
                break;
            case 1:
                $user->status = 1;
                $user->save();
                $msg = __( "dashboard/$type.Użytkownik został pomyślnie odblokowany" );
                break;
            default:
                abort( 404 );
        }

        return redirect()->route( "$type.show", [ 'id' => $user->hashId ] )->with( 'alert', [
            'title' => $msg,
            'type'  => 'success',
            'timer' => '5000',
        ] );
    }
}
