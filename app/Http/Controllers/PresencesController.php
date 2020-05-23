<?php

namespace App\Http\Controllers;

use App\Lesson;
use App\Presence;
use Illuminate\Http\Request;

class PresencesController extends Controller
{
    public function index(Request $request) {
        $lesson_id = Lesson::where('term_id', '=', $request->term_id)->where('schedule_id', '=', $request->schedule_id)
                             ->where('class_id', '=', $request->class_id)->get()[0]->id;


        $presences = Presence::where( 'lesson_id', '=', $lesson_id)->get();

        return view( 'dashboard.plan.presences.index', [
            'presences' => $presences,
            'view_type' => 'day',
            'head_text' => 'Obecności',
        ] );
    }
}
