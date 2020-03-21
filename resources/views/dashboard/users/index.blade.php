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
			<th>Nazwa</th>
			<th>Email/Domena</th>
			<th>Grupy</th>
			<th>Notatki</th>
			<th>Status</th>
			<th>Akcje</th>
		</tr>
		</thead>

		<tbody>
		@foreach($users as $user)
			<tr>
				<td>
{{--					<img src="{{ $user->getAvatarUrl() }}" class="img-circle udiAvatarImage" alt="User Image">{{ $user->name }}--}}
				</td>
				<td>{{ $user->email }}</td>
				<td>
					<p> - </p>
				</td>
				<td class="is-text-centered"><p> {{ empty($user->notices) ? '-' : $user->notices }} </p></td>
				<td class="is-text-centered">

				</td>
				<td>
{{--					<a href="{{ route( 'users.edit', [ 'user' => $user->hashId ] ) }}">--}}
{{--						<button class="btn diary-edit-btn" title="Edytuj użytkownika">--}}
{{--							<i class="fas fa-edit"></i>--}}
{{--						</button>--}}
{{--					</a>--}}
				</td>
			</tr>
		@endforeach
		</tbody>
	</table>

@stop

@section('js')

@stop

@section('css')

@stop
