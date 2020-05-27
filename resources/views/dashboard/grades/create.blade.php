@extends('dashboard.home')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

@section('title', $head_text)

@section('content_header')
	<div class="content-header-inner">
		<h1>{!! $head_text !!}</h1>

		<a href="{{route('grades.index')}}">
			<button class="btn btn-info btn-sm"><i class="fa fa-undo"></i> {{__('dashboard/grade.Anuluj')}}</button>
		</a>
	</div>
@stop


@section('content')

	<div class="diary-container">
		<div class="diary-container-body">

			@include('dashboard.common.errors', [ 'errors' => $errors ] )

			<form action="{{ route( 'grades.store' ) }}" id="form-grade-insert" method="POST" novalidate enctype="multipart/form-data">
				@csrf

				<div class="" style="display: flex;padding: 40px 0;">
					<div class="diary-form-grid grid-size-2" style="flex:1;margin-bottom: 20px;">

						<div class="diary-form-row">
							<label for="teacher">{{__('dashboard/grade.Wystawiający')}}</label>
							<input type="text" class="form-control" name="teacher" id="teacher" value="{{$user->meta->name}} {{$user->meta->surname}}" readonly>
						</div>

					<div class="form-row">
					<label class="control-label" for="type">{{__('dashboard/grade.Klasa')}}</label>
					<select required name="class" class="form-control mr-3" id="class">
						<option value="0" selected disabled>{{__('dashboard/grade.Wybierz klasę')}}</option>
						@foreach($schoolclasses as $schoolclass)
						<option value="{{$schoolclass->id}}">{{$schoolclass->FullName}}</option>
						@endforeach
					</select>
					</div>

					<div class="form-row">
					<label class="control-label" for="type">{{__('dashboard/grade.Uczeń')}}</label>
					<select required name="student" class="form-control mr-3" id="student">
						<option value="0" selected>{{__('dashboard/grade.Wybierz ucznia')}}</option>
					</select>
					</div>

					<div class="form-row">
					<label class="control-label" for="type">{{__('dashboard/grade.Przedmiot')}}</label>
					<select required name="subject" class="form-control mr-3" id="subject">
						<option value="0" selected>{{__('dashboard/grade.Wybierz przedmiot')}}</option>
					</select>
					</div>

						<div class="diary-form-row">
							<label for="grade">{{__('dashboard/grade.Ocena')}}</label>
							<select name="grade" id="grade" class="form-control mr-3" required>
								<option value="0" selected>{{__('dashboard/grade.Wybierz ocenę')}}</option>
								<option value="1" @if( old( 'grade') == "1" ) selected @endif>{{__('1')}}</option>
								<option value="1.5" @if( old( 'grade') == "1.5" ) selected @endif>{{__('1.5')}}</option>
								<option value="2" @if( old( 'grade') == "2" ) selected @endif>{{__('2')}}</option>
								<option value="2.5" @if( old( 'grade') == "2.5" ) selected @endif>{{__('2.5')}}</option>
								<option value="3" @if( old( 'grade') == "3" ) selected @endif>{{__('3')}}</option>
								<option value="3.5" @if( old( 'grade') == "3.5" ) selected @endif>{{__('3.5')}}</option>
								<option value="4" @if( old( 'grade') == "4" ) selected @endif>{{__('4')}}</option>
								<option value="4.5" @if( old( 'grade') == "4.5" ) selected @endif>{{__('4.5')}}</option>
								<option value="5" @if( old( 'grade') == "5" ) selected @endif>{{__('5')}}</option>
								<option value="5.5" @if( old( 'grade') == "5.5" ) selected @endif>{{__('5.5')}}</option>
								<option value="6" @if( old( 'grade') == "6" ) selected @endif>{{__('6')}}</option>
							</select>
						</div>

						<div class="diary-form-row">
							<label for="weight">{{__('dashboard/grade.Waga')}}</label>
							<select name="weight" id="weight" class="form-control mr-3" required>
								<option value="0" selected>{{__('dashboard/grade.Wybierz wagę')}}</option>
								<option value="1" @if( old( 'weight') == "1" ) selected @endif>{{__('1 - Zadanie domowe')}}</option>
								<option value="2" @if( old( 'weight') == "2" ) selected @endif>{{__('2 - Aktywność')}}</option>
								<option value="3" @if( old( 'weight') == "3" ) selected @endif>{{__('3 - Kartkówka')}}</option>
								<option value="4" @if( old( 'weight') == "4" ) selected @endif>{{__('4 - Odpowiedź')}}</option>
								<option value="5" @if( old( 'weight') == "5" ) selected @endif>{{__('5 - Przykladowa waga')}}</option>
								<option value="6" @if( old( 'weight') == "6" ) selected @endif>{{__('6 - Przykladowa waga')}}</option>
								<option value="7" @if( old( 'weight') == "7" ) selected @endif>{{__('7 - Praca klasowa')}}</option>
							</select>
						</div>

						<div class="diary-form-row">
							<label for="description">{{__('dashboard/grade.Opis')}}</label>
							<input type="text" class="@if( $errors->has('description') ) input-error @endif form-control" name="description" id="description" value="{{ old('description') }}" required>
						</div>


						<div class="form-btn-group form-rows" style="justify-content: flex-end;">
							<button class="action-button btn btn-success confirm"><i class="fas fa-check"></i>{{__('dashboard/grade.Zapisz')}}</button>
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
	<script>
		jQuery(document).ready(function($){
  	$('#class').change(function(){
			$.get("{{ url('api/student')}}", 
				{ option: $(this).val() }, 
				function(data) {
					var students = $('#student');
					students.empty();
 									
					$.each(data, function(index, element) {
			            students.append("<option value='"+ element.user_id +"'> " + element.name +" " + element.surname + " " + "(" + element.PESEL + ")" + "</option>");
			        });
				});


			$.get("{{ url('api/subject')}}", 
				{ option: $(this).val() }, 
				function(data) {
					var subjects = $('#subject');
					subjects.empty();
 					
					subjects.append("<option value='0' disabled>Wybierz przedmiot</option>");

					$.each(data, function(index, element) {
			            subjects.append("<option value='"+ element.id +"'> " + element.name +" </option>");
			        });
				});
		});
	});
	</script>
	 @include('dashboard.grades.js.create')
@stop