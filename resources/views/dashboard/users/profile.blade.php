@extends('dashboard.home')

@section('title', 'Profil użytkownika')

@section('content_header')
    <h1>Profil użytkownika</h1>
@stop

@section('content')
    <ul class="nav nav-tabs" id="profile-tabs" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link {{ $activeTabId!=2 ? 'active': '' }}" id="main-tab" data-toggle="tab" href="#main-panel" role="tab" aria-controls="main-tab" aria-selected="true">Moje konto</a>
        </li>
      
        <li class="nav-item" role="presentation">
            <a class="nav-link {{ $activeTabId==2 ? 'active': '' }}" id="password-tab" data-toggle="tab" href="#password-panel" role="tab" aria-controls="password-tab" aria-selected="false">Zmiana hasła</a>
        </li>
    </ul>
    <div class="tab-content" id="profile-content">
        @include('dashboard.common.errors', [ 'errors' => $errors ] )
        <div class="tab-pane fade {{ $activeTabId!=2 ? 'show active': '' }}" id="main-panel" role="tabpanel" aria-labelledby="main-tab">
            <div class="">
                <form action="{{route('users.profileUpdate')}}" id='main-form' class="profile-form" method="POST" novalidate enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="userId" value="{{ $current->hashId }}" required>

                    <div class="form-label">Imię i nazwisko:</div>
                    <input type="text" readonly name="name" id="name" value="{{ $current->meta->name . ' ' . $current->meta->surname}}">

                    <div class="form-label">E-mail:</div>
                    <input type="email" name="email" readonly id="email" value="{{ $current->email }}">

                    <div class="form-label">Telefon:</div>
                    <input type="text" readonly name="phone" id="phone" value="{{ ($current->meta->phone ?? '- brak -') }}">


                    <div class="form-avatar">
                        <label for="avatar" >
                            <img id="avatarPrev" src="{{ !isset($current->meta->avatar) || $current->meta->avatar === 'user.png' ? asset('upload/avatars/user.png') : asset("upload/{$current->meta->avatar}") }}" class=""/>
                        </label>
                        <button type='button' class="btn btn-default btn-sm btn-block" id="upload-avatar">
                            Wybierz awatar <i class="fas fa-camera"></i>
                        </button>
                        <input type="file" accept="image/jpeg,image/png" placeholder="avatar" name="avatar" id="avatar">
                    </div>

                    <div class="form-btn-group">
                        <button class="btn btn-primary confirm">Zapisz</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="tab-pane fade {{ $activeTabId==2 ? 'show active': '' }}" id="password-panel" role="tabpanel" aria-labelledby="password-tab">
            <div class="row">
                <form action="{{route('users.passwordUpdate')}}" id="password-form" class="col-lg-6 offset-lg-3 profile-form" method="POST" novalidate enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="userId" value="{{ $current->hashId }}" required>

                    <div class="form-label">Aktualne hasło:</div>
                    <input class="form-control" type="text"  required="" name="old-password" id="old-password" value="">

                    <div class="form-label">Nowe hasło:</div>
                    <input class="form-control" type="text"  required="" name="password" id="password" value="">

                    <div class="form-label">Powtóż hasło:</div>
                    <input class="form-control" type="text"  required="" name="confirm-password" id="confirm-password" value="">

                    <div class="form-btn-group">
                        <button class="btn btn-primary confirm">Zapisz</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@stop


@section('js')
    <script>
        $( document ).ready( function () {
            $(document).on('click', '#upload-avatar', function(){
                $("#avatar").click()
            })
            $( '#avatar' ).change( function () {
                readURL( this );
            } );
            function readURL( input ) {
                if ( input.files && input.files[ 0 ] ) {
                    var reader = new FileReader();
                    reader.onload = function ( e ) {
                        $( '#avatarPrev' ).attr( 'src', e.target.result );
                    };
                    reader.readAsDataURL( input.files[ 0 ] );
                }
            }
        });
    </script>
{{--    @include('dashboard.users.js.edit')--}}
@stop
