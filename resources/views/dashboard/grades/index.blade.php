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
				<form action="{{ route( 'grades.index') }}" id="form-grade-filter" method="GET" novalidate enctype="multipart/form-data">
				<div class="form-group filter-group">
					<label class="control-label" for="type">{{__('dashboard/grade.Klasa')}}</label>
					<select required name="class" class="form-control mr-3" id="class">
                            <option value="all">Wszystkie</option>
							@foreach($classes as $schoolclass )
							<option value="{{$schoolclass->id}}"  @if((int) $this_class === $schoolclass->id) selected @endif>{{$schoolclass->FullName}}</option>
							@endforeach
					</select>
					<label class="control-label" for="type">{{__('dashboard/grade.Uczeń')}}</label>
                    <select required name="student" class="form-control mr-3" id="student">
                            <option value="all">Wszyscy</option>
                            @foreach($students as $student )
							<option value="{{$student->user_id}}"  @if((int) $this_student === $student->user_id) selected @endif>{{$student->name}} {{$student->surname}} ({{$student->PESEL}})</option>
							@endforeach
                    </select>
				</div>
				<button class="btn btn-primary" type="submit" value="{{ request('request') }}" >Filtruj</button>
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
			<tr data-id="{{$grade->id}}" data-name="{{$grade->student->meta->name}}" data-surname="{{$grade->student->meta->surname}}">
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
  	$('#class').change(function(){
			$.get("{{ url('api/gradefilter')}}", 
				{ option: $(this).val() }, 
				function(data) {
					var students = $('#student');
					students.empty();
 					 
 					 students.append("<option value='all'>Wszyscy</option>");
					
					$.each(data, function(index, element) {
			            students.append("<option value='"+ element.user_id +"'> " + element.name +" " + element.surname + " " + "(" + element.PESEL + ")" + "</option>");
			        });
				});
		});
	});
	</script>
	@include('dashboard.grades.js.index')
@stop

@section('css')

@stop
