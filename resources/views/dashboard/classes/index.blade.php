@extends('dashboard.home')

@section('title', $head_text)

@section('content_header')
	<div class="content-header-inner">
		<h1>{!! $head_text !!}</h1>
		<a href="{{ route('classes.create') }}" class="page-title-action">
			<button class="btn btn-info btn-sm"><i class="fa fa-plus "></i> {{__('dashboard/class.Dodaj')}}</button>
		</a>
	</div>
@stop

@section('content')

	<table class="is-dataTable table-striped table-bordered mt-3" width="100%">
		<thead>
			<tr>
				<th>{{__('dashboard/class.Klasa')}}</th>
				<th>{{__('dashboard/class.Opis')}}</th>
				<th>{{__('dashboard/class.Ilość uczniów')}}</th>
				<th>{{__('dashboard/class.Wychowawca')}}</th>
				<th>{{__('dashboard/class.Akcje')}}</th>
			</tr>
		</thead>

		<tbody>
		@foreach($classes as $class)
			<tr data-hash_id="{{$class->hashId}}" data-name="{{$class->fullName}}">
				<td>
					{{$class->fullName}}
				</td>
				<td>
					{{$class->description}}
				</td>
				<td class="is-text-centered">
					{{\App\User::InClass($class->id)->count() . '/' . $class->max_members}}
				</td>
				<td>
					{{$class->teacher->meta->name . ' ' . $class->teacher->meta->surname}}
				</td>
				<td>
					<div class="btn-group" role="group">
						<button id="btnGroupDrop1" type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="fas fa-address-book"></i> Dziennik
						</button>

						<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
							<a class="dropdown-item" href="{{route('students.class.index', ['class_id' => $class->id])}}">
								<div></div>
								<i class="fas fa-list-ol"></i> Uczniowie
								<span class="badge  badge-pill badge-info">{{\App\User::InClass($class->id)->count()}}/{{$class->max_members}}</span>
							</a>
                        <a class="dropdown-item" href="{{route('plan.month.index', ['class_id' => $class->id])}}">
                                <div></div>
                                <i class="fas fa-list-ol"></i> Obecności
						</a>

							<a class="dropdown-item" href="{{route('students.class.notes', ['class_id' => $class->id])}}">
								<div></div>
								<i class="far fa-sticky-note"></i> Lista Uwag
								<span class="badge  badge-pill badge-info"></span>
							</a>
						</div>


					</div>



					<a href="{{ route( 'classes.edit', [ 'class' => $class->hashId ] ) }}">
						<button class="btn btn-success diary-edit-btn" title="{{__('dashboard/class.Edytuj klasę')}}">
							<i class="fas fa-edit"></i>
						</button>
					</a>



					<button class="btn btn-danger delete-class" title="{{__('dashboard/user.Usuń klasę')}}">
						<i class="fas fa-trash"></i>
					</button>
				</td>
			</tr>
		@endforeach
		</tbody>
	</table>


@stop

@section('js')
	<script>
		$(function () {
			$(document).ready(function() {
				$('.dropdown-menu a').click(function (e) {
					$('.active').removeClass('active');
				});
			});

		});
	</script>
	@include('dashboard.classes.js.index')
@stop

@section('css')

@stop
