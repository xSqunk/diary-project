<?php

namespace App\Http\Controllers;

use App\Lesson;
use App\Presence;
use App\SchoolClass;
use Carbon\Carbon;
use Illuminate\Http\Request;
use League\CommonMark\Block\Renderer\ParagraphRenderer;

class PresencesController extends Controller
{
    public function index(Request $request) {
        $lesson = Lesson::findOrFail($request->lesson_id);
        $presences = Presence::where( 'lesson_id', '=', $lesson->id)->get();

        $date = Carbon::create($lesson->lesson_date);
        $class = SchoolClass::findOrFail($request->class_id);

        return view( 'dashboard.plan.presences.index', [
            'class' => $class,
            'lesson' => $lesson,
            'presences' => $presences,
            'date' => $date,
            'view_type' => 'day',
            'head_text' => "Obecności, {$date->isoFormat('D MMMM YYYY')} klasa: $class->FullName"
        ] );
    }

    public function saveStatus(Request $request) {
        $present = Presence::where('lesson_id', '=', $request->lesson_id)->where('student_id', '=', $request->student_id);

        if($present->count() === 0) {
            Presence::create([
                'lesson_id' => $request->lesson_id,
                'student_id' => $request->student_id,
                'presence' => $request->status
            ]);
        } else {
            $present = Presence::find($present->get()->first()->id);
            $present->presence = $request->status;

            $present->save();
        }
    }
}
