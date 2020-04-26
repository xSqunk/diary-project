@extends('dashboard.home')

@section('title', $head_text)

@section('content_header')
	<div class="content-header-inner">
		<h1>{!! $head_text !!}</h1>

		<a href="{{route("$view_type.index")}}">
			<button class="btn btn-info btn-sm"><i class="fa fa-undo"></i> Anuluj</button>
		</a>
	</div>
@stop


@section('content')

	<div class="diary-container">
		<div class="diary-container-body">

			@include('dashboard.common.errors', [ 'errors' => $errors ] )

			<form action="{{ route( "$view_type.store" ) }}" id="form-user-insert" method="POST" novalidate enctype="multipart/form-data">
				@csrf

				<div class="" style="display: flex;padding: 40px 0;">
					@include('dashboard.users.chunks.avatarContainer')
					<div class="diary-form-grid grid-size-2" style="flex:1;margin-bottom: 20px;">
						<div class="diary-form-row">
							<label for="email">E-mail</label>
							<input type="email" class="@if( $errors->has('email') ) input-error @endif form-control" name="email"  id="email" value="{{ old('email') }}" required>
						</div>

						<div class="diary-form-row">
							<label for="password">Hasło</label>
							<div style="position: relative" class="password-container">
								<input type="text" class="@if( $errors->has('password') ) input-error @endif form-control"  name="password" id="password" value="{{ old('password') }}" required>
								<button type="button" class="random-password-btn" title="Losuj hasło">
									<i class="fas fa-dice" aria-hidden="true"></i>
								</button>
							</div>
						</div>

						<div class="diary-form-row">
							<label for="status">Status
								@include('dashboard/common/tooltip', [ 'msg' => 'Nieaktywny użytkownik nie będzie mógł się zalogować do systemu' ])
							</label>
							<select required name="status" class=" @if( $errors->has('status') ) input-error @endif custom-select"  id="status">
								<option value="1" @if ( old ( 'status' ) == 1 ) selected @endif>Aktywny</option>
								<option value="0" @if ( old ( 'status' ) == 0 ) selected @endif>Nieaktywny</option>
							</select>
						</div>

						@if($view_type === 'students')
							<div class="diary-form-row">
								<label for="class_id">Klasa</label>
								<select required name="class_id" class=" @if( $errors->has('class_id') ) input-error @endif custom-select" id="class_id">
									<option value="0" selected disabled>Wybierz klasę</option>
									@foreach($classes as $class)
									<option value="{{$class->id}}" @if( old( 'class_id') == $class->id ) selected @endif @if( \App\User::InClass($class->id)->count() >= $class->max_members ) disabled @endif>
										{{$class->FullName}}, miejsca - {{\App\User::InClass($class->id)->count()}}/{{$class->max_members}}
									</option>
									@endforeach
								</select>
							</div>
						@endif

						@if($view_type === 'users')
						<div class="user-group-container">
							<div class="form-section-header">Grupy:</div>
							@foreach( $groups as $key => $group )
								<div class="custom-control custom-checkbox">
									<input
											class="custom-control-input"
											type="checkbox" id="groups[{{ $key }}]"
											name="groups[{{ $key }}]"
											@if ( old ( 'groups.' . $key ) )
											checked
											@endif
									>
									<label for="groups[{{ $key }}]"
										   class="parent-group-name custom-control-label"
										   title="{{ $group['description'] ?? '' }}"
									>{{ $group['name'] }}</label>
								</div>
							@endforeach
						</div>
						@endif

						<div class="diary-form-row">
							<label for="name">Imię</label>
							<input type="text" class="@if( $errors->has('name') ) input-error @endif form-control" name="name" id="name" value="{{ old('name') }}" required>
						</div>

						<div class="diary-form-row">
							<label for="surname">Nazwisko</label>
							<input type="text" class="@if( $errors->has('surname') ) input-error @endif form-control" name="surname" id="surname" value="{{ old('surname') }}" required>
						</div>

						<div class="diary-form-row">
							<label for="phone">Telefon</label>
							<input type="text" class="@if( $errors->has('phone') ) input-error @endif form-control" name="phone" id="phone"  value="{{ old('phone') }}" required>
						</div>

						<div class="diary-form-row">
							<label for="birth_date">Data urodzenia</label>
							<input type="date" class="@if( $errors->has('birth_date') ) input-error @endif form-control" name="birth_date" id="birth_date" value="{{ old('birth_date') }}" required>
						</div>

						<div class="diary-form-row">
							<label for="PESEL">PESEL</label>
							<input type="number" class="@if( $errors->has('PESEL') ) input-error @endif form-control" name="PESEL" id="PESEL" value="{{ old('PESEL') }}" required>
						</div>

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