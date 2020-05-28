<?php

namespace App\Http\Controllers;

use App\Grade;
use App\User;
use App\UserMeta;
use App\Subject;
use App\SchoolClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class GradeController extends Controller
{
    protected const attributesNames = [
        'teacher'            => '<strong>Wystawiający</strong>',
        'student'            => '<strong>Uczeń</strong>',
        'subject'     => '<strong>Przedmiot</strong>',
        'class'     => '<strong>Klasa</strong>',
        'grade'     => '<strong>Ocena</strong>',
        'weight'             => '<strong>Waga</strong>',
        'description'             => '<strong>Opis</strong>',
    ];

    public function index( Request $request ){


        if((!isset($request->class) || $request->class == 'all') && (!isset($request->student) || $request->student == 'all')) {
            $grades = Grade::all();
         } elseif($request->class != 'all' && $request->student == 'all'){
            $grades = Grade::InClass($request->class)->get();
        } else{
            $grades = Grade::where('student_id', '=',$request->student)->get();
        }

        $classes = SchoolClass::all();
        if(isset($request->class) && $request->class != 'all'){
            $students = UserMeta::InClass($request->class)->get();
         }
         else{
             $students = UserMeta::IsStudent()->get();
         }
        
        return view( 'dashboard.grades.index', [
            'grades' => $grades,
            'classes' => $classes,
            'students' => $students,
            'head_text' => 'Lista ocen',
            'view_type' => 'grades',
            'this_class' => $request->class,
            'this_student' => $request->student
        ] );
    }

    public function student(Request $request) {

        $grades = Grade::where('student_id', '=', auth()->user()->id)->get();

        return view( 'dashboard.student-grades.index', [
            'grades' => $grades,
            'class_subjects' => Subject::all(),
            'student' => User::findOrFail(auth()->user()->id),
            'head_text' => 'Lista ocen',
            'avg' => 0,
            'weights' => 1,
            'average' => 0,
            'gradenumber' =>0
        ] );
    }

    public function create(){

        $user = Auth::user();
        return view( 'dashboard.grades.create', [
            'head_text' => 'Dodawanie oceny',
            'students' => User::InGroup('student')->OnlyActive()->get(),
            'teachers' => User::InGroup('teacher')->OnlyActive()->get(),
            'subjects' => Subject::all(),
            'schoolclasses' => SchoolClass::all(),
            'user' => $user,
        ] );
    }

    public function store( Request $request ){

        $validator = Validator::make( $request->all(), [
            'student'             => 'required|not_in:0',
            'subject'      => 'required|not_in:0',
            'class'         => 'required|not_in:0',
            'grade'             => 'required|in:1,1.5,2,2.5,3,3.5,4,4.5,5,5.5,6',
            'weight'      => 'required|in:1,2,3,4,5,6,7',
            'description'	=> 'max:150'
        ] );

        $validator->setAttributeNames( self::attributesNames );

        if( $validator->fails() ){
            return redirect()->back()->withErrors( $validator )->withInput(
                $request->all('student', 'subject', 'grade', 'weight', 'description' )
            );
        }

        

        $grade = new Grade();
        $grade->teacher_id = Auth::user()->id;
        $grade->student_id = $request->student;
        $grade->subject_id = $request->subject;
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
            'subject' => $grade->subject,
            'student' => $grade->student,
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
        echo $request->id;
        $grade = Grade::findOrFail( $request->id );
        $grade->delete();
    }

}
