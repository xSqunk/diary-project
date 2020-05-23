<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Input;
use App\SchoolClass;
// use Request;


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


Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('api/dropdown', function(){
  $input = Request::get('option');
    $class = SchoolClass::findOrFail($input);
    $students = $class->students();
    return Response::make($students->get(['id','email']));
});

//Auth::routes();
