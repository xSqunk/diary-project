@extends('dashboard.home')

@section('title', 'Godziny lekcyjne')

@section('content_header')
    <div class="content-header-inner">
        <h1>{!! $head_text !!}</h1>

        <a href="{{route('plan.month.index', ['class_id' => $class_id, 'year' => $date->year, 'month' => $date->month, 'day' => $date->day])}}">
            <button class="btn btn-info btn-sm"><i class="fa fa-undo"></i> Cofnij</button>
        </a>
    </div>
@stop

@section('content')

    <table class="table-striped table-bordered mt-3 text-center" width="100%">
        <thead>
        <tr>
            <th>{{__('dashboard/plan.Godzina')}}</th>
            <th>{{__('dashboard/plan.Przedmiot')}}</th>
            <th>{{__('global.Akcje')}}</th>
        </tr>
        </thead>

        <tbody>
        @foreach($terms as $term)
            <tr>
                <td>{{$term->fullHour}}</td>
                <td>
                @if($lesson = App\Lesson::where('lesson_date', '=', $full_date)->where('term_id', '=', (int) $term->id)->first())
                        {{$lesson->schedule->subject->name}}
                    @else
                    -
                @endif
                </td>
                <td>
                    @if($lesson)
                    <a href="{{ route( 'plan.presences.index', [ 'class_id'  => $class_id, 'lesson_id' => $lesson->id]) }}">
                        <button class="btn btn-success diary-edit-btn" title="{{__('dashboard/plan.Obecności')}}">
                            <i class="far fa-calendar-check"></i>
                        </button>
                    </a>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>


@stop

@section('js')
    @include('dashboard.plan.month.js.index')
@stop

@section('css')


@stop
