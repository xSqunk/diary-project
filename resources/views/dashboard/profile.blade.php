@extends('dashboard.home')

@section('content_header')
    <h1>Profil użytkownika</h1>
@stop

@section('content')

    <div class="diary-container">
        <div class="diary-container-body">

            @include('dashboard.common.errors', [ 'errors' => $errors ] )

            <form action="{{ route( 'users.store' ) }}" id="form-user-insert" method="POST" novalidate enctype="multipart/form-data">
                @csrf

                <div class="" style="display: flex;padding: 40px 0;">
                    @include('dashboard.users.chunks.avatarContainer')
                    <div class="diary-form-grid grid-size-2" style="flex:1;margin-bottom: 20px;">
                        <label for="email">E-mail</label>
                        <input type="email" class="@if( $errors->has('email') ) input-error @endif form-control" name="email"  id="email" value="{{ old('email', $user->email) }}" required>

                        <label for="status">Status
                            @include('dashboard/common/tooltip', [ 'msg' => 'Nieaktywny użytkownik nie będzie mógł się zalogować do systemu' ])
                        </label>
                        <select required name="status" class=" @if( $errors->has('status') ) input-error @endif custom-select"  id="status">
                            <option value="1" @if ( old ( 'status', $user->status ) == 1 ) selected @endif>Aktywny</option>
                            <option value="0" @if ( old ( 'status', $user->status ) == 0 ) selected @endif>Nieaktywny</option>
                        </select>

                        <div class="user-group-container">
                            <div class="form-section-header">Grupy:</div>
                            @foreach( $groups as $key => $group )
                                <div class="custom-control custom-checkbox">
                                    <input
                                            class="custom-control-input"
                                            @if ( old ( 'group-' . $key, $user->{'role_'.$key} ) )
                                            checked
                                            @endif
                                            type="checkbox" id="groups[{{ $key }}]"
                                            name="groups[{{ $key }}]"
                                    >
                                    <label for="groups[{{ $key }}]"
                                           class="parent-group-name custom-control-label"
                                           title="{{ $group['description'] ?? '' }}"
                                    >{{ $group['name'] }}</label>
                                </div>
                            @endforeach
                        </div>

                        <label for="name">Imię</label>
                        <input type="text" class="@if( $errors->has('name') ) input-error @endif form-control" name="name" id="name" value="{{ old('name', $user->meta->name) }}" required>

                        <label for="surname">Nazwisko</label>
                        <input type="text" class="@if( $errors->has('surname') ) input-error @endif form-control" name="surname" id="surname" value="{{ old('surname', $user->meta->surname) }}" required>

                        <label for="phone">Telefon</label>
                        <input type="text" class="@if( $errors->has('phone') ) input-error @endif form-control" name="phone" id="phone"  value="{{ old('phone', $user->meta->phone) }}" required>

                        <label for="birth_date">Data urodzenia</label>
                        <input type="date" class="@if( $errors->has('birth_date') ) input-error @endif form-control" name="birth_date" id="birth_date" value="{{ old('birth_date', $user->meta->birth_date) }}" required>

                        <label for="PESEL">PESEL</label>
                        <input type="number" class="@if( $errors->has('PESEL') ) input-error @endif form-control" name="PESEL" id="PESEL" value="{{ old('PESEL', $user->meta->PESEL) }}" required>

                        <div class="form-btn-group form-rows" style="justify-content: flex-end;">
                            <button class="action-button btn btn-success confirm"><i class="fas fa-check"></i> Zapisz</button>
                        </div>

                    </div>

                </div>
            </form>
        </div>
    </div>
@stop


@section('js')
    <script>
        @include('dashboard.common.errorsJs')
    </script>
    @include('dashboard.users.js.create')
@stop