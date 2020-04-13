@extends('dashboard.home')

@section('title', 'Lista Użytkowników')

@section('content_header')
	<h1>LISTA UŻYTKOWNIKÓW W SYSTEMIE</h1>
	<a href="{{ route('users.create') }}" class="page-title-action">
		<button class="btn btn-info btn-sm"><i class="fa fa-plus "></i> Dodaj</button>
	</a>
@stop

@section('content')

	<table class="is-dataTable table-striped table-bordered" width="100%">
		<thead>
		<tr>
			<th>Imię i Nazwisko</th>
			<th>Grupy</th>
			<th>Email</th>
			<th>Telefon</th>
			<th>Status</th>
			<th>Akcje</th>
		</tr>
		</thead>

		<tbody>
		@foreach($users as $user)
			<tr data-hash_id="{{$user->hashId}}" data-name="{{$user->meta->name}}" data-surname="{{$user->meta->surname}}">
				<td>
					<img src="{{ $user->meta->getAvatarUrl() }}" class="img-circle udiAvatarImage" alt="User Image">
					{{ $user->meta->name . ' ' . $user->meta->surname}}
				</td>
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
					<a href="{{ route( 'users.edit', [ 'user' => $user->hashId ] ) }}">
						<button class="btn diary-edit-btn" title="Edytuj użytkownika">
							<i class="fas fa-edit"></i>
						</button>
					</a>
					@if(auth()->user()->id !== $user->id)
						<button class="btn delete-user" title="Usuń użytkownika">
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
