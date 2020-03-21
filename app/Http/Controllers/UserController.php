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
        'name'             => '<strong>nazwa</strong>',
        'email'            => '<strong>E-mail</strong>',
        'password'         => '<strong>Hasło</strong>',
        'old-password'     => '<strong>Aktualne hasło</strong>',
        'confirm-password' => '<strong>Powtóż hasło</strong>',
        'avatar'           => '<strong>Avatar</strong>',
        'phone'            => '<strong>Telefon</strong>',
    ];

    public function index( Request $request ){
        $users = User::all();

        return view( 'dashboard.users.index', [
            'users' => $users,
        ] );
    }

    public function create(){
        return view( 'dashboard.users.create', [

        ] );
    }

    public function store( Request $request ){

        $validator = Validator::make( $request->all(), [
            'name'     => 'required|unique:users|max:255',
            'email'    => 'email|required|unique:users|max:255',
            'password' => "required|max:255|min:8|regex:/^.*(?=.{3,})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[\d])(?=.*[!@#$%^*]).*$/",
        ] );

        $validator->setAttributeNames( self::attributesNames );

        if( $validator->fails() ){
            return redirect()->back()->withErrors( $validator )->withInput(
                $request->all( 'name', 'description', 'password', 'email', 'status', 'notices', 'groups', 'phone' )
            );
        }

        $user = new User();

        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->password = Hash::make( $request->password );
//        $user->status   = $request->status;
//        $user->notices  = $request->notices;

//        if( isset( $request->avatar ) ){
//            $name         = $request->avatar->store( 'avatars', [ 'disk' => 'upload' ] );
//            $user->avatar = $name;
//        }

        $user->save();

        return redirect()->route( 'users.index' )->with( 'alert', [
            'title' => 'Pomyślnie utworzono użytkownika!',
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
}
