<?php

namespace App\Http\Controllers;

use App\Lesson;
use Illuminate\Http\Request;

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

        $Dni = array('', 'Poniedziałek', 'Wtorek', 'Środa', 'Czwartek', 'Piątek', 'Sobota', 'Niedziela');
        $Miesiace = array('', 'Stycznia', 'Lutego', 'Marca', 'Kwietnia', 'Maja', 'Czerwca', 'Lipca', 'Sierpnia', 'Września', 'Października', 'Listopada', 'Grudnia');

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

        $year = $request->year;
        $month = $request->month;

        $from = date("Y-m-d", strtotime($year . '-' . $month . '-01'));
        $to = date("Y-m-t", strtotime($year . '-' . $month . '-01'));

        $lessons_for_day = Lesson::whereBetween('lesson_date', [$from, $to])->where('class_id', '=', $request->class_id)->get();

        $lesson_days_with_names = [];

        foreach ($lessons_for_day as $lesson_day) {
            $lesson_date = strtotime($lesson_day->lesson_date);
            $name_of_day = '' . $Dni[date('w', $lesson_date)] . ', ' . date(' j ', $lesson_date) . $Miesiace[date('n', $lesson_date)];
            array_push($lesson_days_with_names, [$lesson_day, $name_of_day]);
        }


        return view('dashboard.plan.month.index', [
            'lesson_days' => $lesson_days_with_names,
            'view_type' => 'plan',
            'years' => $years,
            'months' => $months,
            'head_text' => 'Plan',
        ]);
    }
}
