@extends('dashboard.home')

@section('title', $head_text)

@section('content_header')
    <div class="content-header-inner">
        <h1>{!! $head_text !!}</h1>

        <a href="{{ route( "plan.day.index", [ 'class_id'  => $class->id, 'year' => $date->year, 'month' => $date->month, 'day' => $date->day]) }}">
            <button class="btn btn-info btn-sm"><i class="fa fa-undo"></i> Cofnij</button>
        </a>

    </div>
@stop

@section('content')

    <table class="is-dataTable table-striped table-bordered mt-3" width="100%">
        <thead>
        <tr>
            <th>{{__('dashboard/plan.Student')}}</th>
            <th>{{__('dashboard/user.Email')}}</th>
            <th>{{__('dashboard/user.Telefon')}}</th>
            <th>{{__('dashboard/plan.Status')}}</th>
        </tr>
        </thead>

        <tbody>
        @foreach($class->students as $student)
            <tr data-student_id="{{$student->id}}" data-lesson_id="{{$lesson->id}}">
            @if(!$student->isActive())
                @continue
            @endif
            <td>
                <img src="{{ $student->meta->getAvatarUrl() }}" class="img-circle udiAvatarImage" alt="User Image">
                    <a href="{{route('student.show', ['id' => $student->hashId])}}">{{ $student->meta->name . ' ' . $student->meta->surname}}</a>
            </td>

            <td>{{ $student->email }}</td>
            <td class="is-text-centered"><p>{{$student->meta->phone}}</p></td>

            <td>
                <select name="status" class="status form-control">
                    <option value="-1" selected disabled>Wybierz opcję</option>
                    @foreach(\App\Presence::getStatuses() as $val => $status)
                        <option value="{{$val}}" @if(($presence = \App\Presence::where('lesson_id', '=', $lesson->id)->where('student_id', '=', $student->id)->first()) && $presence->presence == $val ) selected @endif >{{$status}}</option>
                    @endforeach
                </select>
            </td>

            </tr>
        @endforeach
        </tbody>
    </table>


@stop

@section('js')
    @include('dashboard.plan.presences.js.status')
@stop

@section('css')


@stop
