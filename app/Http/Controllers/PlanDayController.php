<?php

namespace App\Http\Controllers;

use App\Lesson;
use App\Term;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PlanDayController extends Controller
{


    public function index(Request $request) {

        $full_date = $request->year . '-' . $request->month . '-' . $request->day;

        $date = Carbon::create($full_date);

        $terms = Term::where( 'week_day', '=', $date->dayOfWeek)->orderBy('start_hour', 'ASC')
            ->orderBy('start_minute', 'ASC')->get();

        return view( 'dashboard.plan.day.index', [
            'class_id' => $request->class_id,
            'terms' => $terms,
            'date' => $date,
            'full_date' => $full_date,
            'head_text' => 'Godziny lekcyjne, dzień: ' . $date->isoFormat('D MMMM YYYY'),
        ] );
    }
}
