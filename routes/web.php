<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Input;
use App\SchoolClass;
use App\User;
use App\UserMeta;
use App\Subject;
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

Route::get('api/gradefilter', function(){
  
  $input_class = Request::get('option');
  if(Request::get('student')){
  	$input_student = Request::get('student');
  }
  else{
  	$input_student = 'all';
  }

  		if($input_class != 'all'){
  			$class = SchoolClass::findOrFail($input_class);
  			$students = UserMeta::InClass($input_class);
  		}
  		elseif($input_class === 'all' and $input_student != 'all'){
  			$students = UserMeta::where('user_id', '=', $input_student)->first();
  		}
  		else{
  			$students = UserMeta::IsStudent();
  		}

    return Response::make($students->get(['user_id','name','surname', 'PESEL']));
});

Route::get('api/student', function(){
  
  $input_class = Request::get('option');
  $students = UserMeta::InClass($input_class); 

    return Response::make($students->get(['user_id','name','surname', 'PESEL']));
});

Route::get('api/subject', function(){
  
  $input_class = Request::get('option');
  $subjects = Subject::all();

    return Response::make($subjects->get(['id','name']));
});

//Auth::routes();
