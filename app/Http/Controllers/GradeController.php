<?php

namespace App\Http\Controllers;

use App\Grade;
use App\User;
use App\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class GradeController extends Controller
{
    protected const attributesNames = [
        'teacher_id'            => '<strong>Wystawiający</strong>',
        'student_id'            => '<strong>Uczeń</strong>',
        'subject_id'     => '<strong>Przedmiot</strong>',
        'grade'     => '<strong>Ocena</strong>',
        'weight'             => '<strong>Waga</strong>',
        'description'             => '<strong>Opis</strong>',
    ];

    public function index( Request $request ){

        $grades = Grade::all();

        return view( 'dashboard.grades.index', [
            'grades' => $grades,
            'head_text' => 'Lista ocen',
        ] );
    }

    public function create(){

        $user = Auth::user();
        return view( 'dashboard.grades.create', [
            'head_text' => 'Dodawanie oceny',
            'students' => User::InGroup('student')->OnlyActive()->get(),
            'teachers' => User::InGroup('teacher')->OnlyActive()->get(),
            'subjects' => Subject::getAvailableSubjects(),
            'user' => $user,
        ] );
    }

    public function store( Request $request ){

        $validator = Validator::make( $request->all(), [
            'student_id'             => 'required|not_in:0',
            'subject_id'      => 'required|not_in:0',
            'grade'             => 'required|in:1,1.5,2,2.5,3,3.5,4,4.5,5,5.5,6',
            'weight'      => 'required|in:1,2,3,4,5,6,7',
            'description'	=> 'max:150'
        ] );

        $validator->setAttributeNames( self::attributesNames );

        if( $validator->fails() ){
            return redirect()->back()->withErrors( $validator )->withInput(
                $request->all('student_id', 'subject_id', 'grade', 'weight', 'description' )
            );
        }

        

        $grade = new Grade();
        $grade->teacher_id = Auth::user()->id;
        $grade->student_id = $request->student_id;
        $grade->subject_id = $request->subject_id;
        $grade->grade = $request->grade;
        $grade->weight = $request->weight;
        $grade->description = $request->description;

        $grade->save();

        return redirect()->route( 'grades.index' )->with( 'alert', [
            'title' => 'Pomyślnie dodano ocenę!',
            'type'  => 'success',
            'timer' => '5000',
        ] );
    }

    public function edit($id) {

        $grade = Grade::findByHashidOrFail( $id );

        return view( 'dashboard.grades.edit', [
            'grade' => $grade,
            'head_text' => 'Edycja oceny',
            'students' => User::InGroup('student')->OnlyActive()->get(),
            'teachers' => User::InGroup('teacher')->OnlyActive()->get(),
            'subjects' => Subject::getAvailableSubjects(),
            'user' => Auth::user(),
        ] );
    
    }

    public function update(Request $request) {

        $grade = Grade::findByHashidOrFail( $request->gradeId );

        $validator = Validator::make( $request->all(), [
            'student_id'             => 'required|not_in:0',
            'subject_id'      => 'required|not_in:0',
            'grade'             => 'required|in:1,1.5,2,2.5,3,3.5,4,4.5,5,5.5,6',
            'weight'      => 'required|in:1,2,3,4,5,6,7',
            'description'	=> 'max:150'
        ] );

        $validator->setAttributeNames( self::attributesNames );

        if( $validator->fails() ){
            return redirect()->back()->withErrors( $validator )->withInput(
                $request->all('student_id', 'subject_id', 'grade', 'weight', 'description' )
            );
        }

        $grade->teacher_id = Auth::user()->id;
        $grade->student_id = $request->student_id;
        $grade->subject_id = $request->subject_id;
        $grade->grade = $request->grade;
        $grade->weight = $request->weight;
        $grade->description = $request->description;

        $grade->save();

        return redirect()->route( 'grades.index' )->with( 'alert', [
            'title' => 'Pomyślnie zaktualizowano ocenę!',
            'type'  => 'success',
            'timer' => '5000',
        ] );
    }

    public function delete( Request $request ){
        $grade = Grade::findByHashidOrFail( $request->hashId );
        $grade->delete();
    }
}
