@extends('dashboard.home')

@section('title', $head_text)

@section('content_header')
	<div class="content-header-inner">
		<h1>{!! $head_text !!}</h1>
		@if(!$class)
		<a href="{{ route("$view_type.create") }}" class="page-title-action">
			<button class="btn btn-info btn-sm"><i class="fa fa-plus "></i> {{__('dashboard/user.Dodaj')}}</button>
		</a>
		@endif
	</div>
@stop

@section('content')

	@if($view_type === 'users')

	<div class="filter-container">
		<h3 class="mb-4">{{__('dashboard/user.Filtrowanie')}}</h3>

		<div class="form-row">
			<form action="{{ route( "$view_type.index" ) }}" id="form-user-filter" method="GET" novalidate enctype="multipart/form-data">
				@csrf
				<div class="form-group filter-group">
					<label class="control-label" for="type">{{__('dashboard/user.Grupa')}}</label>
					<select required name="group" class="form-control" id="group">
						<option value="all">Wszystkie</option>
						@foreach( $groups as $key => $group )
							<option value="{{$key}}" @if(isset($_GET['group']) && $_GET['group'] === $key) selected @endif >{{$group['name']}}</option>
						@endforeach
					</select>
				</div>
				<button class="btn btn-primary" type="submit" >Filtruj</button>
			</form>
		</div>
	</div>

	@endif

	@if($class)
		<div class="add-class-student-box">
			<div class="add-student">
				<i class="fas fa-plus-circle"></i>
				<div class="add-student-text">{{__('dashboard/user.Dodaj ucznia do klasy')}}</div>
			</div>


			<div class="add-student-accordion" style="display: none;">
				<select data-class_id="{{$class->id}}" name="student" id="student" class="add-student-select form-control input-md input-select2" >
					<option value="0" selected disabled>{{__('dashboard/user.Wybierz ucznia')}}</option>
					@foreach( $free_students as $f_student )
						<option value="{{$f_student->id}}">
							{{$f_student->meta->name . ' ' . $f_student->meta->surname . ' (' . $f_student->meta->PESEL . ')'}}
						</option>
					@endforeach
				</select>
				<button class="btn btn-primary add-student-button">{{__('dashboard/user.Dodaj ucznia')}}</button>
			</div>

		</div>
	@endif

	<table class="is-dataTable table-striped table-bordered mt-3" width="100%">
		<thead>
			<tr>
				<th>{{__('dashboard/user.Imię i Nazwisko')}}</th>
				@if($view_type === 'users')
					<th>{{__('dashboard/user.Grupy')}}</th>
				@endif
				<th>{{__('dashboard/user.Email')}}</th>
				<th>{{__('dashboard/user.Telefon')}}</th>
				<th>{{__('dashboard/user.Status')}}</th>
				<th>{{__('dashboard/user.Akcje')}}</th>
			</tr>
		</thead>

		<tbody>
		@foreach($users as $user)
			<tr data-hash_id="{{$user->hashId}}" data-name="{{$user->meta->name}}" data-surname="{{$user->meta->surname}}">
				<td>
					<img src="{{ $user->meta->getAvatarUrl() }}" class="img-circle udiAvatarImage" alt="User Image">
					@if($view_type === 'students')
                        <a href="{{route('student.show', ['id' => $user->hashId])}}">{{ $user->meta->name . ' ' . $user->meta->surname}}</a>
					@else
					{{ $user->meta->name . ' ' . $user->meta->surname}}
					@endif
				</td>
				@if($view_type === 'users')
				<td>
					<p>
						@if($user->groups)
							<ul>
							@foreach($user->groups as $group)
								<li>{{$group->name}}</li>
							@endforeach
							</ul>
						@else
							-
						@endif
					</p>
				</td>
				@endif
				<td>{{ $user->email }}</td>
				<td class="is-text-centered"><p>{{$user->meta->phone}}</p></td>
				<td class="is-text-centered">
					@switch( $user->status )
						@case ( App\User::STATUS_IS_ACTIVE )
						<div class=" badge badge-success"><span style="display: none">_active</span> {{__('dashboard/user.Aktywny')}}</div>
						@break
						@case ( App\User::STATUS_IS_INACTIVE )
						<div class="badge badge-danger"><span style="display: none">_inactive</span> {{__('dashboard/user.Nieaktywny')}}</div>
						@break
					@endswitch
				</td>
				<td>
					<div class="btn-group" role="group">
						<button id="btnGroupDrop1" type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="fas fa-address-book"></i> Akcje
						</button>
						<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
							@if($view_type === 'students')
								<a class="dropdown-item" href="{{route('students.parents', ['user' => $user->hashId])}}">
									<div></div>
									<i class="fas fa-users"></i> {{__('dashboard/user.Rodzice')}}
									<span class="badge badge-pill badge-info">{{$user->parents()->count()}}</span>
								</a>
							@endif
							@if($class)
								<button class="dropdown-item class-signout"
										data-student_id="{{$user->id}}"
										data-student_name="{{$user->FullName}}">
									<div></div>
									<i class="fas fa-sign-out-alt"></i> {{__('dashboard/user.Wypisz z klasy')}}
								</button>
							@endif
						</div>
					</div>

					<a href="{{ route( "$view_type.edit", [ 'user' => $user->hashId ] ) }}">
						<button class="btn btn-success diary-edit-btn" title="{{__('dashboard/user.Edytuj użytkownika')}}">
							<i class="fas fa-edit"></i>
						</button>
					</a>
					@if(auth()->user()->id !== $user->id)
						<button class="btn btn-danger delete-user" title="{{__('dashboard/user.Usuń użytkownika')}}">
							<i class="fas fa-trash"></i>
						</button>
					@endif
				</td>
			</tr>
		@endforeach
		</tbody>
	</table>

@stop

@section('js')
	@include('dashboard.users.js.index')
@stop

@section('css')

@stop
