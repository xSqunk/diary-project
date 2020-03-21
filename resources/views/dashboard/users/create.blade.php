@extends('dashboard.home')

@section('content_header')
	<h1>Dodawanie użytkownika</h1>

	<a href="{{route('users.index')}}">
		<button class="btn btn-info btn-sm"><i class="fa fa-undo"></i> Anuluj</button>
	</a>
@stop


@section('content')

	<div class="diary-container">
		<div class="diary-container-body">

			@include('dashboard.common.errors', [ 'errors' => $errors ] )

			<form action="{{ route( 'users.store' ) }}" id="form-user-insert" method="POST" novalidate enctype="multipart/form-data">
				@csrf

				<div class="" style="display: flex;padding: 40px 0;">
{{--					@include('dashboard.users.chunks.avatarContainer')--}}
				<div class="diary-form-grid grid-size-2" style="flex:1;margin-bottom: 20px;">
					<label for="name">
						Nazwa
					</label>
					<input type="text" class="@if( $errors->has('name') ) input-error @endif form-control" accept="image/jpeg,image/png" name="name" id="name" value="{{ old('name') }}">

					<label for="status">Status
{{--						@include('dashboard/common/tooltip', [ 'msg' => 'Nieaktywny użytkownik nie będzie mógł się zalogować do systemu' ])--}}
					</label>
					<select required name="status" class=" @if( $errors->has('status') ) input-error @endif custom-select"  id="status">
						<option value="1" @if ( old ( 'status' ) == 1 ) selected @endif>Aktywny</option>
						<option value="0" @if ( old ( 'status' ) == 0 ) selected @endif>Nieaktywny</option>
					</select>

					<label for="email">E-mail</label>
					<input type="email" class="@if( $errors->has('email') ) input-error @endif form-control" name="email"  id="email" value="{{ old('email') }}">


					<label for="phone">Telefon</label>
					<input type="text" class="@if( $errors->has('phone') ) input-error @endif form-control"  name="phone" id="phone"  value="{{ old('phone') }}">

					<label for="password">Hasło

					</label>
					<div style="position: relative" class="password-container">
						<input type="text"  required="" class="@if( $errors->has('password') ) input-error @endif form-control"  name="password" id="password" value="{{ old('password') }}">
						<button type="button" class="random-password-btn" title="Losuj hasło">
							<i class="fas fa-dice" aria-hidden="true"></i>
						</button>
					</div>


					<label for="notices" class="gc-1">Opis</label>
					<textarea name="notices" class="@if( $errors->has('notices') ) input-error @endif form-control rounded-2 span-3" id="notices" cols="30" rows="4">{{ old( 'notices' ) }}</textarea>
				</div>

				</div>

				<div class="user-group-container">
					<div class="form-section-header">Grupy:</div>
{{--					@foreach( $groups as $group )--}}
{{--						<?php $readonly = false; ?>--}}
{{--						<div class="custom-control custom-checkbox">--}}
{{--							<input--}}
{{--								class="custom-control-input"--}}
{{--								@if ( isset( old ( 'groups' )[ $group->hashId ] )  )--}}
{{--								checked--}}
{{--								@endif--}}
{{--								type="checkbox" id="groups[{{ $group->hashId }}]"--}}
{{--								name="groups[{{ $group->hashId }}]"--}}
{{--							>--}}
{{--							<label for="groups[{{ $group->hashId }}]"--}}
{{--								   class="parent-group-name custom-control-label"--}}
{{--								   title="{{ $group->description ?? '' }}"--}}
{{--							>{{ $group->name }}</label>--}}
{{--						</div>--}}
{{--					@endforeach--}}
                    <div class="form-btn-group form-rows" style="justify-content: flex-end;">
                        <button class="action-button btn btn-success confirm"><i class="fas fa-check"></i> Zapisz</button>
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