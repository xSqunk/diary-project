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

            Route::get( '/{id}/status/{status}/type/{type}', [
                'uses' => 'UserController@status'
            ] )->name( 'users.status' );

        } );

        Route::group( [ 'prefix' => 'students' ], function(){

            Route::get( '/', [
                'uses' => 'StudentController@index'
            ] )->name( 'students.index' );

            Route::get( '/class/{class_id}', [
                'uses' => 'StudentController@index'
            ] )->name( 'students.class.index' )->where('class_id', '[0-9]+');

            Route::get( '/create', [
                'uses' => 'StudentController@create'
            ] )->name( 'students.create' );

            Route::post( '/create', [
                'uses' => 'StudentController@store'
            ] )->name( 'students.store' );

            Route::get( '/edit/{user}', [
                'uses' => 'StudentController@edit'
            ] )->name( 'students.edit' );

            Route::get( '/show/{id}', [
                'uses' => 'StudentController@show'
            ] )->name( 'student.show' );

            Route::post( '/update', [
                'uses' => 'StudentController@update'
            ] )->name( 'students.update' );

            Route::post( '/panel', [
                'uses' => 'StudentController@getPanel'
            ] )->name( 'students.panel' );

            Route::get( '/parents/{user}', [
                'uses' => 'ParentController@index'
            ] )->name( 'students.parents' );

            Route::delete( '/parents', [
                'uses' => 'ParentController@deleteParent'
            ] )->name( 'students.parents.delete' );

            Route::put( '/parents', [
                'uses' => 'ParentController@addParent'
            ] )->name( 'students.parents.add' );

        } );

        Route::group( [ 'prefix' => 'plan' ], function(){

            Route::get( '/', [
                'uses' => 'PlanMonthController@index'
            ] )->name( 'plan.month.index' );

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

//        Route::group( [ 'prefix' => 'parents' ], function(){
//
//            Route::get( '/', [
//                'uses' => 'ParentController@index'
//            ] )->name( 'parents.index' );
//
//            Route::get( '/create', [
//                'uses' => 'ParentController@create'
//            ] )->name( 'parents.create' );
//
//            Route::post( '/create', [
//                'uses' => 'ParentController@store'
//            ] )->name( 'parents.store' );
//
//            Route::get( '/edit/{user}', [
//                'uses' => 'ParentController@edit'
//            ] )->name( 'parents.edit' );
//
//            Route::post( '/update', [
//                'uses' => 'ParentController@update'
//            ] )->name( 'parents.update' );
//
//        } );

        Route::group( [ 'prefix' => 'classes' ], function(){

            Route::get( '/', [
                'uses' => 'ClassController@index'
            ] )->name( 'classes.index' );

            Route::get( '/create', [
                'uses' => 'ClassController@create'
            ] )->name( 'classes.create' );

            Route::post( '/create', [
                'uses' => 'ClassController@store'
            ] )->name( 'classes.store' );

            Route::get( '/edit/{class}', [
                'uses' => 'ClassController@edit'
            ] )->name( 'classes.edit' );

            Route::post( '/update', [
                'uses' => 'ClassController@update'
            ] )->name( 'classes.update' );

            Route::delete( '/', [
                'uses' => 'ClassController@delete'
            ] )->name( 'classes.delete' );

            Route::put( '/students', [
                'uses' => 'ClassController@addStudent'
            ] )->name( 'class.student.add' );

            Route::delete( '/students', [
                'uses' => 'ClassController@removeStudent'
            ] )->name( 'class.student.remove' );

        } );


        Route::group( [ 'prefix' => 'notes' ], function(){

            Route::get( '/', [
                'uses' => 'NotesController@index'
            ] )->name( 'notes.index' );
            Route::get( '/create', [
                'uses' => 'NotesController@create'
            ] )->name( 'notes.create' );
            Route::post( '/create', [
                'uses' => 'NotesController@store'
            ] )->name( 'notes.store' );


        } );

        Route::group( [ 'prefix' => 'grades' ], function(){

            Route::get( '/', [
                'uses' => 'GradeController@index'
            ] )->name( 'grades.index' );

             Route::get( '/create', [
                 'uses' => 'GradeController@create'
             ] )->name( 'grades.create' );

             Route::post( '/create', [
                 'uses' => 'GradeController@store'
             ] )->name( 'grades.store' );

             Route::get( '/edit/{grade}', [
                 'uses' => 'GradeController@edit'
             ] )->name( 'grades.edit' );

             Route::post( '/update', [
                 'uses' => 'GradeController@update'
             ] )->name( 'grades.update' );

             Route::delete( '/', [
                'uses' => 'GradeController@delete'
            ] )->name( 'grades.delete' );

        } );

    });

});

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');


//Auth::routes();
