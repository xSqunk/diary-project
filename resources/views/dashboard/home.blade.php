@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Panel główny</h1>
@stop

@section('content_top_nav_right')
    @include('dashboard.header')
@stop

@section('content')
    <p>Welcome to this beautiful admin panel.</p>
@stop

@section('css')

@stop

@section('js')
    
@stop