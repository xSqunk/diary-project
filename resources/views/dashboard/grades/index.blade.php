@extends('dashboard.home')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


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

<div class="filter-container">
		<h3 class="mb-4">{{__('dashboard/user.Filtrowanie')}}</h3>

		<div class="form-row">
			<form action="{{ route( "$view_type.index" ) }}" id="form-grade-filter" method="GET" novalidate enctype="multipart/form-data">
				@csrf
				<div class="form-sclass filter-sclass">
					<label class="control-label" for="type">{{__('dashboard/grade.Klasa')}}</label>
					<select required name="sclass" class="form-control" id="sclass">
						<option value="all">Wszystkie</option>
						@foreach($classes as $schoolclass )
							<option value="{{$schoolclass->id}}">{{$schoolclass->FullName}}</option>
						@endforeach
					</select>
				</div>

				<div class="form-cstudent filter-cstudent">
					<label class="control-label" for="type">{{__('dashboard/grade.Uczeń')}}</label>
					<select required name="cstudent" class="form-control" id="cstudent">
						<option value="all">Wszyscy</option>
						<!-- @foreach($students as $student )
							<option value="{{$student->id}}">{{$student->meta-> name}} {{$student->meta->surname}}</option>
						@endforeach -->
					</select>
				</div>
				<button class="btn btn-primary" type="submit" >Filtruj</button>
			</form>
		</div>
	</div>

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
	</script>
	<script>
		jQuery(document).ready(function($){
  	$('#sclass').change(function(){
			$.get("{{ url('api/dropdown')}}", 
				{ option: $(this).val() }, 
				function(data) {
					var students = $('#cstudent');
					students.empty();
 					 
 					 students.append("<option value='0'>Wszyscy użytkownicy</option>");
					
					$.each(data, function(index, element) {
			            students.append("<option value='"+ element.id +"'>" + element.email + "</option>");
			        });
				});
		});
	});
	</script>
	@include('dashboard.grades.js.index')
@stop

@section('css')

@stop
