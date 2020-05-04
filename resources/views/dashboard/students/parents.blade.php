@extends('dashboard.home')

@section('title', 'Rodzice ucznia')

@section('content_header')
	<div class="content-header-inner">
		<h1>Rodzice ucznia: {{$student->meta->name . ' ' . $student->meta->surname}}</h1>
		<a href="{{route('students.index')}}">
			<button class="btn btn-info btn-sm"><i class="fa fa-undo"></i> Cofnij</button>
		</a>
	</div>
@stop

@section('content')

	@if(count($student->parents) > 0)
	<table class="is-dataTable table-striped table-bordered mt-3" width="100%">
		<thead>
			<tr>
				<th>{{__('dashboard/user.Imię i Nazwisko')}}</th>
				<th>{{__('dashboard/user.Email')}}</th>
				<th>{{__('dashboard/user.Telefon')}}</th>
				<th>{{__('dashboard/user.Status')}}</th>
				<th>{{__('dashboard/user.Akcje')}}</th>
			</tr>
		</thead>

		<tbody>
		@foreach($student->parents as $user)
			<tr data-hash_id="{{$user->hashId}}" data-name="{{$user->meta->name}}" data-surname="{{$user->meta->surname}}">
				<td>
					<img src="{{ $user->meta->getAvatarUrl() }}" class="img-circle udiAvatarImage" alt="User Image">
					{{ $user->meta->name . ' ' . $user->meta->surname}}
				</td>
				<td>{{ $user->email }}</td>
				<td class="is-text-centered"><p>{{$user->meta->phone}}</p></td>
				<td class="is-text-centered">
					@switch( $user->status )
						@case ( App\User::STATUS_IS_ACTIVE )
						<i class="far fa-check-circle is-color-green" title="{{ $user->statusName }}"></i>
						@break
						@case ( App\User::STATUS_IS_INACTIVE )
						<i class="fas fa-ban is-color-red" title="{{ $user->statusName }}"></i>
						@break
					@endswitch
				</td>
				<td>
					<button data-parent_id="{{$user->id}}" data-student_id="{{$student->id}}" class="btn btn-secondary delete-parent">{{__('dashboard/user.Usuń rodzica')}}</button>
					<a href="{{ route( 'users.edit', [ 'user' => $user->hashId ] ) }}">
						<button class="btn diary-edit-btn" title="{{__('dashboard/user.Edytuj użytkownika')}}">
							<i class="fas fa-edit"></i>
						</button>
					</a>
					@if(auth()->user()->id !== $user->id)
						<button class="btn delete-user" title="{{__('dashboard/user.Usuń użytkownika')}}">
							<i class="fas fa-trash"></i>
						</button>
					@endif
				</td>
			</tr>
		@endforeach
		</tbody>
	</table>
	@else
		<div class="no-results-box">
			<div class="no-results-text">{{__('dashboard/user.Brak przypisanych rodziców do ucznia')}}</div>
		</div>
	@endif

	<div class="add-parent-box">
		<div class="add-parent">
			<i class="fas fa-plus-circle"></i>
			<div class="add-parent-text">{{__('dashboard/user.Dodaj rodzica')}}</div>
		</div>

		<div class="add-parent-accordion" style="display: none;">
			<select data-student_id="{{$student->id}}" name="parent" id="parent" class="add-parent-select form-control input-md input-select2" >
				<option value="0" selected disabled>{{__('dashboard/user.Wybierz rodzica')}}</option>
				@foreach( $parents as $parent )
					<option value="{{$parent->id}}" @if($student->parents->contains('id', $parent->id)) disabled @endif>
						{{$parent->meta->name . ' ' . $parent->meta->surname . ' (' . $parent->meta->PESEL . ')'}}
					</option>
				@endforeach
			</select>
			<button class="btn btn-primary add-parent-button">{{__('dashboard/user.Dodaj rodzica')}}</button>
		</div>

	</div>

@stop

@section('js')
	@include('dashboard.users.js.index')
	@include('dashboard.students.js.parents')
@stop

@section('css')

@stop
