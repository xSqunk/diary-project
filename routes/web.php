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

            Route::post( '/checkEmail', [
                'uses' => 'UserController@checkEmail'
            ] )->name( 'users.checkEmail' );

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