<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::middleware( ['auth'] )->group( static function(){
    Route::get( '/', 'DashboardController@index' )->name( 'home' );

    Route::get( '/dashboard', 'DashboardController@index' )->name( 'home' );

    Route::group( [ 'prefix' => 'dashboard' ], function(){

        Route::get( '/profile', [
            'uses' => 'UserController@profileIndex',
        ] )->name( 'users.profile' );

        Route::post( '/profileUpdate', [
            'uses' => 'UserController@profileUpdate'
        ] )->name( 'users.profileUpdate' );

        Route::post( '/passwordUpdate', [
            'uses' => 'UserController@passwordUpdate'
        ] )->name( 'users.passwordUpdate' );

        Route::group( [ 'prefix' => 'users' ], function(){

            Route::get( '/', [
                'uses' => 'UserController@index'
            ] )->name( 'users.index' );

            Route::get( '/create', [
                'uses' => 'UserController@create'
            ] )->name( 'users.create' );

            Route::post( '/create', [
                'uses' => 'UserController@store'
            ] )->name( 'users.store' );

            Route::get( '/edit/{user}', [
                'uses' => 'UserController@edit'
            ] )->name( 'users.edit' );

            Route::post( '/update', [
                'uses' => 'UserController@update'
            ] )->name( 'users.update' );

            Route::post( '/checkEmail', [
                'uses' => 'UserController@checkEmail'
            ] )->name( 'users.checkEmail' );

            Route::delete( '/', [
                'uses' => 'UserController@delete'
            ] )->name( 'users.delete' );

        } );

        Route::group( [ 'prefix' => 'students' ], function(){

            Route::get( '/', [
                'uses' => 'StudentController@index'
            ] )->name( 'students.index' );

            Route::get( '/create', [
                'uses' => 'StudentController@create'
            ] )->name( 'students.create' );

            Route::post( '/create', [
                'uses' => 'StudentController@store'
            ] )->name( 'students.store' );

            Route::get( '/edit/{user}', [
                'uses' => 'StudentController@edit'
            ] )->name( 'students.edit' );

            Route::post( '/update', [
                'uses' => 'StudentController@update'
            ] )->name( 'students.update' );

            Route::get( '/parents/{user}', [
                'uses' => 'StudentController@parents'
            ] )->name( 'students.parents' );

            Route::delete( '/parents', [
                'uses' => 'StudentController@deleteParent'
            ] )->name( 'students.parents.delete' );

            Route::put( '/parents', [
                'uses' => 'StudentController@addParent'
            ] )->name( 'students.parents.add' );

        } );

        Route::group( [ 'prefix' => 'teachers' ], function(){

            Route::get( '/', [
                'uses' => 'TeacherController@index'
            ] )->name( 'teachers.index' );

            Route::get( '/create', [
                'uses' => 'TeacherController@create'
            ] )->name( 'teachers.create' );

            Route::post( '/create', [
                'uses' => 'TeacherController@store'
            ] )->name( 'teachers.store' );

            Route::get( '/edit/{user}', [
                'uses' => 'TeacherController@edit'
            ] )->name( 'teachers.edit' );

            Route::post( '/update', [
                'uses' => 'TeacherController@update'
            ] )->name( 'teachers.update' );

        } );

        Route::group( [ 'prefix' => 'parents' ], function(){

            Route::get( '/', [
                'uses' => 'ParentController@index'
            ] )->name( 'parents.index' );

            Route::get( '/create', [
                'uses' => 'ParentController@create'
            ] )->name( 'parents.create' );

            Route::post( '/create', [
                'uses' => 'ParentController@store'
            ] )->name( 'parents.store' );

            Route::get( '/edit/{user}', [
                'uses' => 'ParentController@edit'
            ] )->name( 'parents.edit' );

            Route::post( '/update', [
                'uses' => 'ParentController@update'
            ] )->name( 'parents.update' );

        } );

    });

});

Route::get( 'parents', [
    'uses' => 'ParentsController@index'
] )->name( 'test.index' );

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');


//Auth::routes();