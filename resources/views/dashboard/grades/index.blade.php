@extends('dashboard.home')

@section('title', $head_text)

@section('content_header')
	<div class="content-header-inner">
		<h1>{!! $head_text !!}</h1>
		<a href="{{ route('grades.create') }}" class="page-title-action">
			<button class="btn btn-info btn-sm"><i class="fa fa-plus "></i> {{__('dashboard/grade.Dodaj')}}</button>
		</a>
	</div>
@stop

@section('content')


	<table class="is-dataTable table-striped table-bordered mt-3" width="100%">
		<thead>
			<tr>
				<th>{{__('dashboard/grade.Wystawiający')}}</th>
				<th>{{__('dashboard/grade.Uczeń')}}</th>
				<th>{{__('dashboard/grade.Przedmiot')}}</th>
				<th>{{__('dashboard/grade.Ocena')}}</th>
				<th>{{__('dashboard/grade.Waga')}}</th>
				<th>{{__('dashboard/grade.Opis')}}</th>
				<th>{{__('dashboard/grade.Data wystawienia')}}</th>
				<th>{{__('dashboard/grade.Akcje')}}</th>
			</tr>
		</thead>

		<tbody>
		@foreach($grades as $grade)
			<tr data-hash_id="{{$grade->hashId}}" data-name="{{$grade->student->meta->name}}" data-surname="{{$grade->student->meta->surname}}">
				<td>
					{{$grade->teacher->meta->name . ' ' . $grade->teacher->meta->surname}}
				</td>
				<td>
					{{$grade->student->meta->name . ' ' . $grade->student->meta->surname}}
				</td>
				<td>
					{{$grade->subject->name}}
				</td>
				<td class="is-text-centered">
					{{$grade->grade}}
				</td>
				<td class="is-text-centered">
					{{$grade->weight}}
				</td>
				<td>
					{{$grade->description}}
				</td>
				<td>
					{{$grade->updated_at}}
				</td>
				<td>
					<a href="{{ route( 'grades.edit', [ 'grade' => $grade->hashId ] ) }}">
						<button class="btn diary-edit-btn" title="{{__('Edytuj ocenę')}}">
							<i class="fas fa-edit"></i>
						</button>
					</a>
					<button class="btn delete-grade" title="{{__('Usuń ocenę')}}">
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
					$('.active').removeGrade('active');
				});
			});

		});
	</script> -->
	@include('dashboard.grades.js.index')
@stop

@section('css')

@stop
