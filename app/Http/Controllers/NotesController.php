<?php

namespace App\Http\Controllers;

use App\NotesClass;
use App\User;
use App\UserMeta;
use Illuminate\Http\Request;

class NotesController extends Controller
{
    protected const attributesNames = [
        'student_id'            => '<strong>Oznaczenie klasy</strong>',
        'teacher_id'            => '<strong>Opis</strong>',
        'subjects_id'           => '<strong>Ilość miejsc</strong>',
        'text'                  => '<strong>Wychowawca</strong>',
        'positiv'               => '<strong>Typ klasy</strong>',
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
            'types' => NotesClass::getAvailableTypes(),
        ] );
    }

    public function edit($id) {

        $note = NotesClass::findByHashidOrFail( $id );

        return view( 'dashboard.notes.edit', [
            'class' => $note,
            'head_text' => 'Dodawanie uwagi',
            'teachers' => User::InGroup('teacher')->OnlyActive()->get(),
            'types' => NotesClass::getAvailableTypes(),
        ] );
    }

    public function store( Request $request ){

        $validator = Validator::make( $request->all(), [
            'student_id'       => 'required|unique:notes|not_in:0',
            'teacher_id'       => 'required|unique:notes|not_in:0',
            'subjects_id'      => 'required|max:255',
            'text'             => 'required|nullable',
            'positiv'          => 'required|max:1',
        ] );

        $validator->setAttributeNames( self::attributesNames );

        if( $validator->fails() ){
            return redirect()->back()->withErrors( $validator )->withInput(
                $request->all( 'student_id', 'teacher_id', 'subjects_id', 'text', 'positiv' )
            );
        }

        $note = new NotesClass();
        $note->student_id = $request->student_id;
        $note->teacher_id = $request->teacher_id;
        $note->subjects_id = $request->subjects_id;
        $note->text = $request->text;
        $note->positiv = $request->positiv;
        $note->timestamps = $request->timestamps;
        $note->save();

        $user_meta = new UserMeta();
        $user_meta->user_id = $request->user_id;
        $user_meta->name = $request->name;
        $user_meta->save();

        return redirect()->route( 'notes.index' )->with( 'alert', [
            'title' => 'Pomyślnie dodano uwagę!',
            'type'  => 'success',
            'timer' => '5000',
        ] );
    }

    public function update(Request $request) {

        $note = NotesClass::findByHashidOrFail( $request->noteId );

        $validator = Validator::make( $request->all(), [
            'teacher_id'       => 'required|not_in:0|unique:classes,teacher_id,' . $note->id,
            'student_id'       => 'required|unique:notes|not_in:0',
            'subjects_id'      => 'required|max:255',
            'text'             => 'required|nullable',
            'positiv'          => 'required|max:1',
        ] );

        $validator->setAttributeNames( self::attributesNames );

        if( $validator->fails() ){
            return redirect()->back()->withErrors( $validator )->withInput(
                $request->all( 'student_id', 'teacher_id', 'subjects_id', 'text', 'positiv' )
            );
        }

        $note->student_id = $request->student_id;
        $note->teacher_id = $request->teacher_id;
        $note->subjects_id = $request->subjects_id;
        $note->text = $request->text;
        $note->positiv = $request->positiv;
        $note->timestamps = $request->timestamps;
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
        $class = NotesClass::findByHashidOrFail( $request->hashId );
        $class->delete();
    }
}
