<?php

namespace App\Http\Controllers;

use App\SchoolClass;
use App\User;
use App\ClassSubjects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;


class ClassController extends Controller
{

    protected const attributesNames = [
        'sign'            => '<strong>Oznaczenie klasy</strong>',
        'description'            => '<strong>Opis</strong>',
        'max_members'     => '<strong>Ilość miejsc</strong>',
        'teacher_id'     => '<strong>Wychowawca</strong>',
        'type'             => '<strong>Typ klasy</strong>',
    ];

    public function index( Request $request ){

        $classes = SchoolClass::all();

        return view( 'dashboard.classes.index', [
            'classes' => $classes,
            'head_text' => 'Lista klas w szkole',
        ] );
    }

    public function create(){
        return view( 'dashboard.classes.create', [
            'head_text' => 'Dodawanie użytkownika',
            'teachers' => User::InGroup('teacher')->OnlyActive()->get(),
            'types' => SchoolClass::getAvailableTypes(),
        ] );
    }

    public function edit($id) {

        $class = SchoolClass::findByHashidOrFail( $id );

        return view( 'dashboard.classes.edit', [
            'class' => $class,
            'head_text' => 'Dodawanie użytkownika',
            'teachers' => User::InGroup('teacher')->OnlyActive()->get(),
            'types' => SchoolClass::getAvailableTypes(),
        ] );
    }

    public function store( Request $request ){

        $validator = Validator::make( $request->all(), [
            'teacher_id'       => 'required|unique:classes|not_in:0',
            'sign'             => 'required|max:10',
            'description'      => 'required|max:255',
            'type'             => 'required|not_in:0',
            'max_members'      => 'required|max:150',
        ] );

        $validator->setAttributeNames( self::attributesNames );

        if( $validator->fails() ){
            return redirect()->back()->withErrors( $validator )->withInput(
                $request->all( 'teacher_id', 'sign', 'description', 'type', 'max_members' )
            );
        }

        $class = new SchoolClass();
        $class->teacher_id = $request->teacher_id;
        $class->sign = $request->sign;
        $class->description = $request->description;
        $class->type = $request->type;
        $class->max_members = $request->max_members;

        $class->save();

        return redirect()->route( 'classes.index' )->with( 'alert', [
            'title' => 'Pomyślnie utworzono klasę!',
            'type'  => 'success',
            'timer' => '5000',
        ] );
    }

    public function update(Request $request) {

        $class = SchoolClass::findByHashidOrFail( $request->classId );
        $validator = Validator::make( $request->all(), [
            'teacher_id'       => 'required|not_in:0|unique:classes,teacher_id,' . $class->id,
            'sign'             => 'required|max:10',
            'description'      => 'required|max:255',
            'type'             => 'required|not_in:0',
            'max_members'      => 'required|max:150',
        ] );

        $validator->setAttributeNames( self::attributesNames );

        if( $validator->fails() ){
            return redirect()->back()->withErrors( $validator )->withInput(
                $request->all( 'teacher_id', 'sign', 'description', 'type', 'max_members' )
            );
        }

        $class->teacher_id = $request->teacher_id;
        $class->sign = $request->sign;
        $class->description = $request->description;
        $class->type = $request->type;
        $class->max_members = $request->max_members;

        $class->save();

        return redirect()->route( 'classes.index' )->with( 'alert', [
            'title' => 'Pomyślnie zaktualizowano klasę!',
            'type'  => 'success',
            'timer' => '5000',
        ] );
    }

    public function delete( Request $request ){
        $class = SchoolClass::findByHashidOrFail( $request->hashId );
        $class->delete();
    }

    public function addStudent( Request $request) {
        $user = User::findOrFail($request->student_id);
        $user->class_id = $request->class_id;
        $user->save();
    }

    public function removeStudent( Request $request) {
        $user = User::findOrFail($request->student_id);
        $user->class_id = 0;
        $user->save();
    }

}
