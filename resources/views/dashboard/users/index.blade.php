@extends('dashboard.home')

@section('title', $head_text)

@section('content_header')
	<div class="content-header-inner">
		<h1>{!! $head_text !!}</h1>
		<a href="{{ route("$view_type.create") }}" class="page-title-action">
			<button class="btn btn-info btn-sm"><i class="fa fa-plus "></i> {{__('dashboard/user.Dodaj')}}</button>
		</a>
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
					{{ $user->meta->name . ' ' . $user->meta->surname}}
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
					@if($view_type === 'students')
					<a href="{{route('students.parents', ['user' => $user->hashId])}}" class="btn btn-secondary">{{__('dashboard/user.Rodzice')}}</a>
					@endif
					<a href="{{ route( "$view_type.edit", [ 'user' => $user->hashId ] ) }}">
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


@stop

@section('js')
	@include('dashboard.users.js.index')
@stop

@section('css')

@stop
