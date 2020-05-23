<?php

namespace App\Http\Controllers;

use App\Term;
use Illuminate\Http\Request;

class PlanDayController extends Controller
{


    public function index(Request $request) {
        $day_of_week = intval(date('w', strtotime($request->date)));
        $terms = Term::where( 'week_day', '=', $day_of_week)->orderBy('start_hour', 'ASC')
            ->orderBy('start_minute', 'ASC')->get();//->sortBy('start_hour')->sortBy('start_minute');

        return view( 'dashboard.plan.day.index', [
            'terms' => $terms,
            'view_type' => 'day',
            'head_text' => 'Plan dla dnia',
        ] );
    }
}
