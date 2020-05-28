@extends('dashboard.home')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


@section('title', $head_text)

@section('content_header')
    <div class="content-header-inner">
        <h1>{!! $head_text !!}</h1>
        <a href="{{ route('grades.create') }}" class="page-title-action">
            <button class="btn btn-info btn-sm"><i class="fa fa-plus "></i> {{__('dashboard/grade.Dodaj')}}</button>
        </a>
    </div>

@stop

@section('content')
    @include('dashboard.students.panels.grades')
@stop

@section('js')

@stop

@section('css')

@stop
