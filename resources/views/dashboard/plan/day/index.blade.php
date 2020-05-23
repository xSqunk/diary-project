@extends('dashboard.home')

@section('title', $head_text)

@section('content_header')
    <div class="content-header-inner">
        <h1>{!! $head_text !!}</h1>

    </div>
@stop

@section('content')



    <table class="is-dataTable table-striped table-bordered mt-3" width="100%">
        <thead>
        <tr>
            <th>{{__('dashboard/plan.Godzina')}}</th>

            <th>{{__('dashboard/plan.Przedmiot')}}</th>
        </tr>
        </thead>

        <tbody>
        @foreach($terms as $term)
                <td>
                    <p>
                    <ul>
                        {{str_pad($term->start_hour, 2, "0", STR_PAD_LEFT ).':'.str_pad($term->start_minute, 2, "0", STR_PAD_LEFT ).' - '.$term->end_hour.':'.str_pad($term->end_minute, 2, "0", STR_PAD_LEFT )}}
                    </ul>
                    </p>
                </td>

                <td>
                    <p>
                    <ul>
                        @foreach ($term->schedules as $schedule)
                            @if ($loop->first)
                                <a href="{{ route( "plan.presences.index", [ 'term_id' => $term->id, 'schedule_id' => $schedule->id, 'class_id' => Request()->class_id] ) }}"> {{$schedule->subject->name}} </a>
                            @endif
                        @endforeach
                    </ul>
                    </p>
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
