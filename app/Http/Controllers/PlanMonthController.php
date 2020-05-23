<?php

namespace App\Http\Controllers;

use App\Grade;
use App\Lesson;
use App\SchoolClass;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PlanMonthController extends Controller
{

    public function index(Request $request)
    {
        $years = array(2020, 2019, 2018, 2017);
        $months = array("Styczeń", "Luty", "Marzec",
            "Kwiecień", "Maj", "Czerwiec",
            "Lipiec", "Sierpień", "Wrzesień",
            "Październik", "Listopad", "Grudzień"
        );

        if ($request->filled("year")) {
            $year = $request->year;
        } else {
            $year = date("Y");
        }

        if ( $request->filled("month")) {
            $month = $request->month;
        } else {
            $month =  date("n");
        }

        $dates = CarbonPeriod::create($year . '-' . $month . '-01', $year . '-' . $month . '-' . Carbon::create($year . '-' . $month . '-01')->daysInMonth);

        $class = SchoolClass::findOrFail($request->class_id);

        return view('dashboard.plan.month.index', [
            'dates' => $dates,
            'view_type' => 'plan',
            'years' => $years,
            'months' => $months,
            'this_year' => $request->year,
            'this_month' => $request->month,
            'head_text' => 'Plan zajęć dla klasy: ' . $class->FullName,
            'class_id' => $request->class_id
        ]);
    }
}
