<?php

namespace App\Http\Controllers;

use App\NotesClass;
use App\User;
use App\UserMeta;
use App\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NotesController extends Controller
{
    protected const attributesNames = [
        'student_id'            => '<strong>Student</strong>',
        'teacher_id'            => '<strong>Nauczyciel</strong>',
        'subjects_id'           => '<strong>Przedmiot</strong>',
        'text'                  => '<strong>Treść</strong>',
        'subject_id'            => '<strong>Przedmiot</strong>',
        'positiv'               => '<strong>Typ uwagi</strong>',
    ];

    public function index( Request $request ){

        $notes = NotesClass::all();


        return view( 'dashboard.notes.index', [
            'notes' => $notes,
            'head_text' => 'Lista uwag w szkole',
            'id' => $request,
        ] );


    }


    public function create(){
        return view( 'dashboard.notes.create', [
            'head_text' => 'Dodawanie uwagi',
            'teachers' => User::InGroup('teacher')->OnlyActive()->get(),
            'students' => User::InGroup('student')->OnlyActive()->get(),
            'subjects' => Subject::all(),
            'types' => NotesClass::getAvailableTypes(),
        ] );
    }

    public function edit($id) {

        $note = NotesClass::findByHashidOrFail( $id );

        return view( 'dashboard.notes.edit', [
            'class' => $note,
            'head_text' => 'Edytowanie uwagi',
            'teachers' => User::InGroup('teacher')->OnlyActive()->get(),
            'students' => User::InGroup('student')->OnlyActive()->get(),
            'subjects' => Subject::all(),
            'types' => NotesClass::getAvailableTypes(),
            'note' => $note
        ] );
    }

    public function store( Request $request ){

        $validator = Validator::make( $request->all(), [
            'student_id'       => 'required|not_in:0',
            'teacher_id'       => 'required|not_in:0',
            'subject_id'      => 'required|not_in:0',
            'text'             => 'required|nullable',
            'positiv'          => 'required|nullable',
        ] );

        $validator->setAttributeNames( self::attributesNames );

        if( $validator->fails() ){
            return redirect()->back()->withErrors( $validator )->withInput(
                $request->all( 'student_id', 'teacher_id', 'subject_id', 'text', 'positiv' )
            );
        }

        $now = date('Y-m-d H-i');
        $note = new NotesClass();
        $note->student_id = $request->student_id;
        $note->teacher_id = $request->teacher_id;
        $note->subject_id = $request->subject_id;
        $note->text = $request->text;
        $note->positiv = $request->positiv;
        $now = $request->created_at;
        $note->save();


        return redirect()->route( 'notes.index' )->with( 'alert', [
            'title' => 'Pomyślnie dodano uwagę!',
            'type'  => 'success',
            'timer' => '5000',
        ] );
    }

    public function update( Request $request) {

        $note = NotesClass::findByHashid( $request );

        $validator = Validator::make( $request->all(), [
            'student_id'       => 'required|not_in:0' . $note->id,
            'teacher_id'       => 'required|not_in:0',
            'subject_id'       => 'required|not_in:0',
            'text'             => 'required|nullable',
            'positiv'          => 'required|nullable',
        ] );

        $validator->setAttributeNames( self::attributesNames );

        if( $validator->fails() ){
            return redirect()->back()->withErrors( $validator )->withInput(
                $request->all( 'student_id', 'teacher_id', 'subject_id', 'text', 'positiv' )
            );
        }

        $note = NotesClass::find($id);
        $now = date('Y-m-d H-i');
        $note->student_id = $request->student_id;
        $note->teacher_id = $request->teacher_id;
        $note->subject_id = $request->subject_id;
        $note->text = $request->text;
        $note->positiv = $request->positiv;
        $now = $request->updated_at;
        $note->save();



        return redirect()->route( 'notes.index' )->with( 'alert', [
            'title' => 'Pomyślnie zaktualizowano uwagę!',
            'type'  => 'success',
            'timer' => '5000',
        ] );
    }
    public function usersList(Request $request){
        $this->usersList();
        return $this->usersList();
    }

    public function delete( Request $request ){
        $note = NotesClass::findByHashidOrFail( $request->hashId );
        $note->delete();
    }

}
