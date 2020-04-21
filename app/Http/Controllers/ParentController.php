<?php

namespace App\Http\Controllers;

use App\Parents;
use App\User;
use Illuminate\Http\Request;

class ParentController extends Controller
{

    public function index($id) {

        $student = User::findByHashidOrFail( $id );
        $parents = User::InGroup('parent')->NotLogged()->get();

        return view( 'dashboard.students.parents', [
            'student' => $student,
            'parents' => $parents,
        ] );
    }

    public function deleteParent( Request $request ){
        Parents::all()
            ->where('student_id', '=', $request->student_id)
            ->where('parent_id', '=', $request->parent_id)
            ->first()
            ->delete();
    }

    public function addParent(Request $request) {
        Parents::create([
            'student_id' => $request->student_id,
            'parent_id' => $request->parent_id
        ]);
    }
}
