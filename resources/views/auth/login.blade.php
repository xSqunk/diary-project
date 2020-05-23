@extends('adminlte::master')


@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/iCheck/square/blue.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/css/auth.css') }}">
    @yield('css')
@stop

@section('body_class', 'login-page')

@section('body')
    <div class="login-box-outer">
        <div class="login-box">
            <div class="login-logo">
                <img src="{{asset('img/logo.png')}}" width="140" />
            </div>
            <div class="login-box-body">
                <p class="login-box-msg">Logowanie do dziennika elektronicznego</p>
                <form action="{{ url(config('adminlte.login_url', 'login')) }}" method="post">
                    {!! csrf_field() !!}

                    <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                        <input type="text" name="email" class="form-control" value="{{ old('email') }}"
                               placeholder="Identyfikator">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                        @if ($errors->has('email'))
                            <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>


                    <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
                        <input type="password" name="password" class="form-control"
                               placeholder="Hasło">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        @if ($errors->has('password'))
                            <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="login-btn-box">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Zaloguj</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

@stop